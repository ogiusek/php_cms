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
  const selectParent = (e) => e.hasAttribute(attr) ? e : selectParent(e.parentElement);
  return selectParent(element);
}