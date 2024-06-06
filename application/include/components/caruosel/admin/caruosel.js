function caruosel_admin_add_slide(form) {
  const parent = select_parent_component(form);
  const ul = parent.querySelector('ul');
  fetch_controller('caruosel', 'add_slide').then(html =>
    ul.insertAdjacentHTML('beforeend', format_html(html))
  );
}
