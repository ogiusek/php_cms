let dragged = null;

function getDragAfterElement(container, y) {
  const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging):not(.placeholder)')];
  return draggableElements.reduce((closest, child) => {
    const box = child.getBoundingClientRect()
    const offset = y - box.top - box.height / 2
    if (offset < 0 && offset > closest.offset) {
      return { offset: offset, element: child };
    }
    return closest;
  }, { offset: Number.NEGATIVE_INFINITY }).element;
}

function drag(mouse_x, mouse_y){
  if (!dragged) return;
  dragged.style.left = mouse_x + 'px';
  dragged.style.top = mouse_y + 'px';
  const parent = dragged.parentElement;
  const afterElement = getDragAfterElement(parent, mouse_y);
  if(afterElement?.classList.contains('placeholder') ||
      afterElement?.previousElementSibling?.classList.contains('placeholder')) {
    return;
  }
  parent.querySelector('.placeholder')?.remove();
  const placeholder = dragged.cloneNode(true);
  placeholder.classList.add('placeholder');
  placeholder.classList.remove('dragging');
  if(!afterElement) {
    parent.appendChild(placeholder);
  }else{
    parent.insertBefore(placeholder, afterElement);
  }
}

document.addEventListener('mousemove', (e) => drag(e.clientX, e.clientY));
document.addEventListener('touchmove', (e) => drag(e.touches[0].clientX, e.touches[0].clientY));

function drag_on_mouse_up() {
  if (!dragged) return;
  const draggable = dragged;
  if(draggable.getAttribute('data-drag-once'))
    draggable.setAttribute('data-drag-disabled', 'true');
  dragged = null;
  const container = draggable.parentElement;
  const placeholder = container.querySelector('.placeholder');
  draggable.classList.remove('dragging');
  draggable.style = "";

  placeholder.replaceWith(draggable);
  const on_drag_end_function = draggable.getAttribute('ondragend');
  if(on_drag_end_function) eval(on_drag_end_function);
}

document.addEventListener('mouseup', drag_on_mouse_up);
document.addEventListener('touchend', drag_on_mouse_up);

function load_drag_element(element) {
  if(element.getAttribute('data-drag-loaded') === 'true') return;
  element.setAttribute('data-drag-loaded', 'true');
  function load_element(){
    if(dragged) return;
    if(element.getAttribute('data-drag-disabled') === 'true') return;
    const element_x = element.offsetLeft;
    const element_y = element.offsetTop;
    element.classList.add('dragging');
    element.style = "";
    dragged = element;
    drag(element_x, element_y);
  }
  element.addEventListener('mousedown', load_element);
  element.addEventListener('touchstart', load_element);
}

function load_drag_container(container) {
  const draggables = [...container.children];
  draggables.map(draggable => load_drag_element(draggable));
}

/**
 * @param {HTMLElement} element 
 */
function drag_once(element) {
  const select_draggable = (e) => e.classList.contains("draggable") ? e : select_draggable(e.parentElement);
  element = select_draggable(element);

  setTimeout(() => {
    const container = element.parentElement;
    load_drag_container(container);
    [...container.children].map(draggable => draggable.setAttribute('data-drag-once', 'true'));
    [...container.children].map(draggable => draggable.setAttribute('data-drag-disabled', 'true'));
    element.setAttribute('data-drag-disabled', 'false');
    const event = new MouseEvent('mousedown');
    element.dispatchEvent(event);
  }, 0);
}