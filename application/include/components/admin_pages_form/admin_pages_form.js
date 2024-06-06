function delete_page(id){
  fetch_handle('/api/admin/pages/delete', {
    method: 'DELETE',
    body: JSON.stringify({
      'id': id
    })
  }).then(()=>{
    notify('Page deleted!', 'success');
    document.querySelector(`.edit-page-form[data-id="${id}"]`).parentElement.remove();
  });
}

function edit_page(id){
  const form = document.querySelector(`.edit-page-form[data-id="${id}"]`);
  const page = form.getElementsByClassName('page-name')[0];
  const file = form.getElementsByClassName('page-file')[0];
  const order = form.getElementsByClassName('page-order')[0];

  fetch_handle('/api/admin/pages/edit', {
    method: 'POST',
    body: JSON.stringify({
      'id': id,
      'page': page.value,
      'file': file.value,
      'order': order.value
    })
  }).then((data)=>{
    const links = form.querySelectorAll('a.preview');
    [...links].map(link => link.href = data['new_link']);
    // link.href = data['new_link'];
    notify('Page updated!', 'success');
  });
}

function toggle_edit_page_content(id){
  const current_element_id = `page-content-${id}`;
  [...document.querySelectorAll(`.page-content-editor:not(#${current_element_id})`)].map(e => e.classList.remove('open'));
  const current_element = document.querySelector(`#${current_element_id}`);
  current_element.classList.toggle('open');
  // refresh on toggle
  // comment to optimaze
  if(current_element.classList.contains('open')){
    const refresh = current_element.querySelector("[data-refresh]");
    fetch_refresh("admin_pages_content_form", (element) => element === refresh);
  }
}

function edit_page_content(id, form_id){
  const element = document.getElementById(form_id);
  const form_data = get_form_data(element);
  const url_params = new URLSearchParams({'id': id});
  fetch_handle(`/api/admin/pages/content/edit?${url_params.toString()}`, {
    method: 'POST',
    body: JSON.stringify(form_data)
  }).then((content)=>{
    notify(content, 'success');
  });
}