/**
 * handles fetch response
 * @param {Response} response - fetch response
 * @returns {Promise<any>} - fetch promise
 */
function handle_fetch(response){
  return new Promise(async (resolve, reject)=>{
    const text = await response.text();
    try{
      const json = JSON.parse(text);
      if(json['error']) return reject(json['content']);
      return resolve(json['content']);
    }catch(e){
      return reject(text);
    }
  });
}

/**
 * fetches and returns formated promise
 * @param {string} url - url to fetch
 * @param {object} args - fetch arguments
 * @returns {Promise<any>} - fetch promise
 */
function fetch_handle(url, args = {}){
  return new Promise((resolve, reject)=>
    fetch(url, args)
      .then(handle_fetch)
      .then((data) => resolve(data))
      .catch((error) => {
        if(error === "Session token is missing")
          return window.location.reload();

        notify(error, 'error');
        reject(error);
    })
  );
}


/**
 * formats html
 * moves scripts and styles to head
 * @param {string} content - html to format
 * @returns {string} - formatted html
 */
function format_html(content){
  const element = document.createElement('div');
  element.innerHTML += content;
    
  const move_to_head = (tag, refresh_duplicates = false) => {
    element.querySelectorAll(tag).forEach(element => {
      const script = document.createElement(tag);
      script.innerHTML = element.innerHTML;
      element.remove();
      const duplicates = [...document.head.querySelectorAll(tag)].filter(e=>e.innerHTML === script.innerHTML);
      if(refresh_duplicates || duplicates.length === 0){
        document.head.appendChild(script);
        duplicates.map(e => e.remove());
      }
    });
  }

  move_to_head('style');
  move_to_head('script', true);
  return element.innerHTML;
}

/**
 * fetches and formats html
 * moves scripts and styles to head
 * @param {string} url - url to fetch
 * @param {object} args - fetch arguments
 * @returns {Promise<string>} - formatted html
 */
function fetch_format(url, args){
  return fetch_handle(url, args).then(format_html);
}


/**
 * appends in component content returned from url
 * @param {string} url 
 * @param {HTMLElement} element 
 * @returns {Promise<void>}
 */
function fetch_append(url, element){
  return fetch_format(url).then(content => element.insertAdjacentHTML('beforeend', content));
}

/**
 * replaces elemnt with content returned from url
 * @param {string} url - url to fetch
 * @param {HTMLElement} element - element to replace
 * @param {'outerHTML' | 'innerHTML'} additional - if 'innerHTML' then innerHTML will be replaced instead of outerHTML
 * @returns {void}
 */
function fetch_replace(url, element, additional = 'outerHTML'){
  if(Array.isArray(element) && element.length === 0) return;
  return fetch_format(url).then(content => {
    const assign_element = (element)=>{
      additional === 'innerHTML' ?
        (element.innerHTML = content) :
        (element.outerHTML = content);
    }
    !Array.isArray(element) ?
      assign_element(element) :
      element.forEach(assign_element);
  });
}


/**
 * fetch component and load new from server
 * @param {string} class_name - name of component
 * @param {function} filter_function - function which filters elements to refresh
 * @returns {void}
 */
function fetch_refresh(class_name, filter_function = () => true){
  const url_search_params = new URLSearchParams({"class_name": class_name});
  const elements_before_filter = [...document.querySelectorAll(`[data-refresh="${class_name}"]`)];
  const elements = elements_before_filter.filter(filter_function);
  if(elements.length == 0) return;
  fetch_replace(`/api/components/render?${(url_search_params.toString())}`, elements.filter(e => !e.getAttribute('data-initializer')));
  elements.filter(e => e.getAttribute('data-initializer')).map(e => {
    const url_search_params = new URLSearchParams({"class_name": class_name, "initializer": e.getAttribute('data-initializer')});
    fetch_replace(`/api/components/render?${(url_search_params.toString())}`, e);
  });
}

/**
 * fetch component and load new from server
 * @param {string} class_name - name of component
 * @param {function} element - this component will be refreshed
 * @returns {void}
 */
function fetch_refresh_parent(class_name, element){
  const parent = select_parent_component(element);
  fetch_refresh(class_name, (e) => e === parent);
}

/**
 * fetches component controller
 * @param {string} class_name - name of component
 * @param {string} action - name of action which should be called
 * @param {object} body - body to send to server
 * @returns {Promise<any>} - fetch promise
*/
function fetch_controller(component, action, body = {}){
  const url_search_params = new URLSearchParams({"component": component, "action": action});
  return fetch_handle(`/api/components/controller?${(url_search_params.toString())}`, {
    'method': "POST",
    'body': JSON.stringify(body),
  });
}
