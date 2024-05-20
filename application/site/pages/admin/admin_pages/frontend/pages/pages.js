function add_page(id){
  const form = document.getElementById(`create-page-${id}`);
  const page = form.getElementsByClassName('page-name')[0];
  const file = form.getElementsByClassName('page-file')[0];
  const order = form.getElementsByClassName('page-order')[0];

  fetch_handle('/api/admin/pages/add', {
    method: 'POST',
    body: JSON.stringify({
      'page': page.value,
      'file': file.value,
      'order': order.value
    })
  }).then(()=> {
    page.value = '';
    notify('Page created!', 'success');
    fetch_refresh("admin_pages_form");
  });
}
