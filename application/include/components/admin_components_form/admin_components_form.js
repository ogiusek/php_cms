function delete_component(id, component_id){
  fetch_handle('/api/admin/components/delete', {
    method: 'DELETE',
    body: JSON.stringify({
      'id': id
    })
  }).then(()=>{
    notify('Component deleted!', 'success');
    const element = document.querySelector(`.${component_id} [data-id="${id}"]`);
    element.parentElement.remove();
  });
}

function edit_component(id){
  const form = document.querySelector(`.edit-form[data-id="${id}"]`);
  const class_name = form.querySelector('[name=class_name]');

  fetch_handle('/api/admin/components/edit', {
    method: 'POST',
    body: JSON.stringify({
      'id': id,
      'class_name': class_name.value
    })
  }).then(()=>{
    notify('Page updated!', 'success');
  });
}