document.getElementById("login-btn").addEventListener('click', async ()=>{
    const email =document.getElementById("email").value;
    const password =document.getElementById("password").value;
    
    if (!email || !password){
        document.getElementById("login-message").textContent="Enter your email and password";
    }
})