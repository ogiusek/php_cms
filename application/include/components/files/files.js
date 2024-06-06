/**
 * @param {HTMLElement} element
 */
function redirect_files_directory(element){
  const parent = select_parent_component(element);
  const data_addr = select_parent_with_attr(element, 'data-addr').getAttribute('data-addr');
  parent.setAttribute('data-initializer', data_addr);
  fetch_refresh_parent("files", parent);
}

/**
 * @param {HTMLElement} element 
 * @param {string} path 
 */
function create_directory(element, path){
  fetch_controller("files", "create_directory", {
    ...get_form_data(element),
    'path': path
  })
    .then((data) => notify(data, "success"))
    .then(() => fetch_refresh_parent("files", element));
}

function remove_directory(element){
  const path = select_parent_with_attr(element, 'data-addr').getAttribute('data-addr');
  fetch_controller("files", "remove_directory", {
    'path': path
  })
    .then((data) => notify(data, "success"))
    .then(() => fetch_refresh_parent("files", element));
}

function remove_file(element){
  const path = select_parent_with_attr(element, 'data-addr').getAttribute('data-addr');
  fetch_controller("files", "remove_file", {
    'path': path
  })
    .then((data) => notify(data, "success"))
    .then(() => fetch_refresh_parent("files", element));
}

/**
 * @param {HTMLElement} element 
 * @param {string} path 
 */
async function upload_file(element, path){
  const get_file = (file) => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
    reader.readAsDataURL(file);
  });

  const file_element = element.querySelector("[data-name=file]");
  const file = file_element.files[0];
  const file_content = await get_file(file);

  const file_name = element.querySelector("[data-name=file_name]").value;
  const file_extension = file.type.split("/").at(-1).split("+").at(0);
  const file_name_with_extension = file_name + "." + file_extension;
  const file_path = `${path}/${file_name_with_extension}`;

  fetch_controller("files", "upload_file", {
    'file_name': file_path,
    'content': file_content
  })
    .then((data) => notify(data, "success"))
    .then(() => fetch_refresh_parent("files", element));
}