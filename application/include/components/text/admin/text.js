setTimeout(() => {
  const textareas = [...document.querySelectorAll('.rtf-textarea')];
  textareas.map((textarea) => {
    if(textarea.hasAttribute('data-rtf-name')) return;
    const rtf_textarea = CKEDITOR.replace(textarea);
    const instance_key = rtf_textarea.name;
    textarea.setAttribute('data-rtf-name', instance_key);
  });
});
