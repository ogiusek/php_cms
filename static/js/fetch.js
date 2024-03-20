function handle_fetch(response){
  return new Promise(async (resolve, reject)=>{
    const text = await response.text();
    // console.log(text);
    const json = JSON.parse(text);
    // const json = await response.json();
    if(json['error']) return reject(json['content']);
    resolve(json['content']);
  });
}

function fetch_function(url, func, args = {}){
  return new Promise((resolve, reject)=>
    fetch(url, args)
      .then(handle_fetch)
      .then((data) => resolve(func(data)))
      .catch((error) => reject(notify(error, 'error')))
  );
}

function fetch_format(url, args){
  const element = document.createElement('div');
  return fetch_function(url, (content)=>{
    element.innerHTML += content;
    
    const move_to_head = (tag) => {
      element.querySelectorAll(tag).forEach(element => {
        const script = document.createElement(tag);
        script.innerHTML = element.innerHTML;
        element.remove();
        if(![...document.head.querySelectorAll(tag)].map(e=>e.innerHTML).includes(script.innerHTML))
          document.head.appendChild(script);
      });
    }
  
    move_to_head('script');
    move_to_head('style');
    return element.innerHTML;
  }, args);
}

function fetch_append(url, element){
  return fetch_format(url).then(content => element.insertAdjacentHTML('beforeend', content));
}

function fetch_replace(url, element, additional){
  return fetch_format(url).then(content => {
    const assign_element = (element)=>{
      if(additional === 'innerHTML'){
        element.innerHTML = content;
      }else{
        element.outerHTML = content;
      }
    }
    if(!Array.isArray(element)){
      assign_element(element);
    }else{
      element.forEach(assign_element);
    }
  });
}

function get_form_data(element){
  const array_regex = /.*\[.*\].*/;
  const attr_name = "data-name";
  const ready_data = {};
  
  const elements_to_diff = [...element.querySelectorAll(`[${attr_name}]`)].map(e => [...e.querySelectorAll(`[${attr_name}]`)]).flat();
  const elements = [...element.querySelectorAll(`[${attr_name}]`)];
  const elements_filtered = elements.filter(e => !elements_to_diff.includes(e));
  elements_filtered.map(e => {
    const name = e.getAttribute(attr_name);
    const to_add = e.value?? get_form_data(e);
    const is_array = array_regex.test(name);
    if(is_array){
      ready_data[name] ??= [];
      ready_data[name].push(to_add);
    }else{
      ready_data[name] = to_add;
    }
  });
  return ready_data;
}

function fetch_refresh(class_name, filter_function = () => true){
  const url_search_params = new URLSearchParams({"class_name": class_name});
  const elements_before_filter = [...document.querySelectorAll(`[data-refresh="${class_name}"]`)];
  const elements = elements_before_filter.filter(filter_function);
  if(elements.length == 0) return;
  fetch_replace(`/api/components/render?${(url_search_params.toString())}`, elements.filter(e => !e.getAttribute('data-initializer')));
  elements.filter(e => e.getAttribute('data-initializer')).map(e => {
    const url_search_params = new URLSearchParams({"class_name": class_name, "initializer": e.getAttribute('data-initializer')});
    fetch_replace(`/api/components/render?${(url_search_params.toString())}`, e);
  })
}
