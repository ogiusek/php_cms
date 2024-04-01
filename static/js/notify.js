function notify(message, type = "error") {
  const types = {
    success: "--color-success",
    error: "--color-error",
    warning: "--color-warning",
    info: "--color-info"
  };
  function getWrapper(){
    const existing_wrapper = document.getElementsByClassName("notifications");
    if(existing_wrapper.length > 0)
      return existing_wrapper[0];
    const wrapper = document.createElement("div");
    wrapper.className = "notifications";
    document.body.appendChild(wrapper);
    return wrapper;
  }

  const existing_wrappers = getWrapper();
  const notification_wrapper = document.createElement("div");
  notification_wrapper.className = "notification";
  notification_wrapper.style.backgroundColor = `var(${types[type]})`;
  notification_wrapper.innerHTML = message;
  existing_wrappers.appendChild(notification_wrapper);

  const removeNotification = () => {
    notification_wrapper.classList.add("remove");
  
    setTimeout(() => 
      notification_wrapper.remove(), 300);
  };

  notification_wrapper.addEventListener("click", () => removeNotification());
  setTimeout(removeNotification, 10000);
}

function show_tadam(data) {
  console.log('not yet implemented tadam: ', data);
}