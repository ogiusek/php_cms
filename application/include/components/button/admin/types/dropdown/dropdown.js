function admin_button_add_dropdown(button) {
  const ul = select_parent_component(button).querySelector('ul');
  fetch_controller('button', 'add_dropdown').then(html =>
    ul.insertAdjacentHTML('beforeend', format_html(html)));
}