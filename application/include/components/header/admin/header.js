/**
 * @param {HTMLElement} element 
 */
function add_to_header_component_dropdown(element){
  const parent = select_parent_component(element);
  const ul = parent.querySelector('[data-refresh=header] > ul');
  fetch_controller("header", "add_dropdown")
    .then(html => {
      console.log(ul)
      ul.insertAdjacentHTML('beforeend', format_html(html))
    });
}
