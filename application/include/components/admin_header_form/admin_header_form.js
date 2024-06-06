function edit_head(id){
  const element = document.getElementById(`edit-head-form-${id}`);
  const form_data = get_form_data(element);
  form_data['page_id'] = id;
  fetch_handle("/api/admin/pages/head/update", {
    method: 'PUT',
    body: JSON.stringify(form_data)
  }).then((response)=>{
    notify(response, 'success');
  });
}