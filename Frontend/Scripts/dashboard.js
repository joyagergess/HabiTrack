
 const role = localStorage.getItem("role");
 const id = localStorage.getItem("userId");

    if (!role || !id ) {
        window.location.href = "login.html";
    }
document.getElementById("logout").addEventListener("click",()=>{
    localStorage.removeItem("userId");
    localStorage.removeItem("role");
    window.location.href = "index.html";

})
