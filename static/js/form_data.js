/**
 * returns form data
 * @param {HTMLElement} element 
 * @returns {object} - form data 
 */
function get_form_data(element){
  const empty_array_regex = /.*\[\].*/;
  const array_regex = /.*\[.*\].*/;
  const attr_name = "data-name";
  const ready_data = {};
  
  const elements_to_diff = [...element.querySelectorAll(`[${attr_name}]`)].map(e => [...e.querySelectorAll(`[${attr_name}]`)]).flat();
  const elements = [...element.querySelectorAll(`[${attr_name}]`)];
  const elements_filtered = elements.filter(e => !elements_to_diff.includes(e));
  elements_filtered.map(e => {
    const get_value = () => {
      const types = ["input", "select", "textarea", "button"];
      if(!types.includes(e.tagName.toLocaleLowerCase())) return null;
      if(e.tagName.toLocaleLowerCase() === "textarea" && e.classList.contains("rtf-textarea") && e.getAttribute("data-rtf-name"))
        return CKEDITOR.instances[e.getAttribute("data-rtf-name")]?.getData();
      const input_type = e.getAttribute("type");
      if(input_type === "checkbox")
        return e.checked ? "1" : "0";
      return e.value;
    };
    const attr = e.getAttribute(attr_name);
    const has_extra_name = !empty_array_regex.test(attr) && array_regex.test(attr)
    const extra_name = !has_extra_name ? null : attr.slice(attr.indexOf('[') + 1, attr.indexOf(']'));
    const name = !has_extra_name ? attr : attr.slice(0, attr.indexOf('[')) + '[]';

    const data = get_value() ?? get_form_data(e);
    const to_add = has_extra_name ? {[extra_name]: data} : data;
    const is_array = array_regex.test(name);
    if(is_array){
      ready_data[name] ??= [];
      ready_data[name].push(to_add);
    }else{
      ready_data[name] = to_add;
    }
  });
  return ready_data;
}