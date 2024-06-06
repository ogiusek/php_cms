var image_component_observer = image_component_observer ?? new Observer();

/**
 * @param {string} currect_image 
 * @param {HTMLElement} element 
 */
function admin_image_component_edit(currect_image, element){
  currect_image = "/" + currect_image.split('/static/').slice(1).join('/static/');
  const edit_image = (image) => {
    image_component_observer.unsubscribe(edit_image);
    if(image === '') return;
    while(image[0] === '/') image = image.slice(1);
    element.querySelector('input').value = image;
    element.querySelector('img').src = `/static/${image}`;
  };
  image_component_observer.subscribe(edit_image);
  const directory = currect_image.split('/').slice(0, -1).join('/');
  fetch_controller('image', 'select_image', {'directory': directory})
    .then(html => {
      element.insertAdjacentHTML('beforeend', html);
    });
}

/**
 * @param {string} path 
 */
function admin_image_save_image(path){
  image_component_observer.notify(path);
}

/**
 * @param {string} directory 
 * @param {HTMLElement} element 
 */
function admin_image_select_directory(directory, element){
  fetch_controller('image', 'select_image', {'directory': directory})
    .then(html => {
      element.outerHTML = html;
    });
}

/**
 * @param {string} image 
 * @param {HTMLElement} element 
 */
function admin_image_select_image(image, element){
  image_component_observer.notify(image);
  element.remove();
}

function admin_image_component_exit(element){
  const component = select_parent_component(element);
  component.remove();
  image_component_observer.notify('');
}

function admin_image_select_center(element){
  const component = select_parent_component(element);
  // TODO
}