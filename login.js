const showpassword = document.querySelector("#showpassword");
const password = document.querySelector("#password");
showpassword.addEventListener("click", function () {
   this.classList.toggle('bi-eye');
   const type = password.getAttribute("type") === "password" ? "text" : "password";
   password.setAttribute("type", type);
});
