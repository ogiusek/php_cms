function admin_button_select_type(element){
  const parent = select_parent_component(element);
  const all_types = [...parent.querySelectorAll('.types')];
  const except_types = all_types.map(e => [...e.querySelectorAll('.types')]).flat();
  const types = all_types.filter(e => !except_types.includes(e));
  types.map(e =>
    e.getAttribute('data-name') === element.value ?
      e.classList.add('show'):
      e.classList.remove('show'));
}
