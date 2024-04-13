/**
 * returns parent element with 'data-refresh'
 * @param {HTMLElement} element 
 * @returns {HTMLElement}
 */
function select_parent_component(element){
  return select_parent_with_attr(element, 'data-refresh');
}

/**
 * returns parent element with 'attr'
 * @param {HTMLElement} element
 * @param {string} attr 
 * @returns {HTMLElement}
 */
function select_parent_with_attr(element, attr){
  return select_parent_where(element, (e) => e.hasAttribute(attr));
  // const selectParent = (e) => e.hasAttribute(attr) ? e : selectParent(e.parentElement);
  // return selectParent(element);
}

/**
 * @param {HTMLElement} element 
 * @param {(HTMLElement) => boolean} filter_func 
 * @returns {HTMLElement}
 */
function select_parent_where(element, filter_func){
  if(!element) return;
  return filter_func(element) ? 
            element :
            select_parent_where(element.parentElement, filter_func);
}