function login(id) {
  const email = document.getElementsByName(`email-${id}`)[0];
  const password = document.getElementsByName(`password-${id}`)[0];

  fetch_handle("/api/admin/login", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: JSON.stringify({
      email: email.value,
      password: password.value,
    })
  }).then((content)=>{
      window.location = "/admin";
    })
    .catch((content)=>{
      const elements = [email, password];
      elements.map((element) => {
        element.value = "";
        element.blur();
        element.classList.add("invalid");
        element.addEventListener("focus", () => email.classList.remove("invalid"));
      });
      return;
    });
}
