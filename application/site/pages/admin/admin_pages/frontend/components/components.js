function add_component(id){
  const form = document.getElementById(`create-component-${id}`);
  const class_name = form.querySelector('[name=class_name]');

  fetch_handle('/api/admin/components/add', {
    method: 'POST',
    body: JSON.stringify({
      'class_name': class_name.value
    })
  }).then(()=> {
    class_name.value = '';
    notify('Components added!', 'success');
    fetch_refresh("admin_components_form");
  });
}

function auto_load_components(){
  fetch_format("/api/admin/components/load", {
    method: 'POST',
  }).then((data) => notify(data, 'success'))
  .then(()=> fetch_refresh("admin_components_form"));
}