function update_color(element){
  const parent = element.parentElement;
  parent.style.backgroundColor = element.value;
  parent.setAttribute('data-color', element.value);
  return;
}

function remove_color_palette(id){
  fetch_handle('/api/admin/colors/delete', {
    method: 'DELETE',
    body: JSON.stringify({
      'id': id
    })
  }).then((response)=>{
    notify(response, 'success');
    document.querySelector(`.color-palette[data-id="${id}"]`).remove();
  });
}

function edit_color_palette(id){
  const element = document.querySelector(`.color-palette[data-id="${id}"]`);
  const form_data = get_form_data(element);
  form_data['id'] = id;
  fetch_handle("/api/admin/colors/edit", {
    method: 'POST',
    body: JSON.stringify(form_data)
  }).then((response)=>{
    notify(response, 'success');
  });
}