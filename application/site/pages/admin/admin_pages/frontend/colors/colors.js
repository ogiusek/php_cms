function add_color(id){
  const form = document.getElementById(`create-color-${id}`);
  const name = form.querySelector('[name=name]');

  fetch_handle('/api/admin/colors/add', {
    method: 'POST',
    body: JSON.stringify({
      'name': name.value
    })
  }).then((response)=> {
    name.value = '';
    notify(response, 'success');
    fetch_refresh("admin_colors_form");
  });
}