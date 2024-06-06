function add_page_content(element, id){
  const form = element;
  const class_name = form.querySelector('[name=class_name]').value;
  
  fetch_handle('/api/admin/pages/content/add', {
    method: 'POST',
    body: JSON.stringify({
      'page_id': id,
      'class_name': class_name
    })
  }).then((content)=>{
    notify(content, 'success');
    fetch_refresh("admin_pages_content_form", (element) => element === form.parentElement);
  });
}

function remove_page_content(id, form_id){
  fetch_handle('/api/admin/pages/content/delete', {
    method: 'DELETE',
    body: JSON.stringify({
      'id': id
    })
  }).then((content)=>{
    notify(content, 'success');
    document.getElementById(form_id).remove();
  });
}

function copy_page_content(id){
  localStorage.setItem('copied_content', id);
  notify('Text copied to clipboard', 'success');
}

function paste_page_content(page_id){
  const id = localStorage.getItem('copied_content');
  if(id === null) return notify('Nothing to paste', 'warning');
  
  fetch_handle('/api/admin/pages/content/paste', {
    method: 'POST',
    body: JSON.stringify({
      'page_id': page_id,
      'content_id': id
    })
  }).then((content)=>{
      notify(content, 'success');
      fetch_refresh("admin_pages_content_form", (element) => element.parentElement.parentElement);
    })
    .catch((error) => {
      localStorage.removeItem('copied_content');
    });
}

function change_page_content_order(element_id){
  const element = document.getElementById(element_id);
  const id = element.getAttribute('data-id');
  const before = element.previousElementSibling !== null ? element.previousElementSibling : null;
  const before_id = before === null ? -1 : before.getAttribute('data-id');
  fetch_handle('/api/admin/pages/content/move', {
    method: 'POST',
    body: JSON.stringify({
      'id': id,
      'after_id': before_id,
    })
  }).then((content)=>{
    notify(content, 'success');
    fetch_refresh("admin_pages_content_form", (e) => e === element.parentElement.parentElement);
  });
}