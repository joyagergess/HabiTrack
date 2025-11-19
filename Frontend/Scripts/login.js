

document.getElementById("login-btn").addEventListener('click', async () => {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const loginMessage = document.getElementById("login-message");

    loginMessage.textContent = "";

    if (!email || !password) {
        loginMessage.style.color = "red";
        loginMessage.textContent = "Enter your email and password";
        return;
    }

    let response; 

    try {
    
        response = await axios.post(`${base_url}/auth/login`, { email, password });
       

        if (response.data.status === 200) {
            loginMessage.style.color = "green";
            loginMessage.textContent = "Login successful!";
            
            localStorage.setItem("userId", response.data.data.id);
            
            const role =response.data.data.role;
            localStorage.setItem("role", response.data.data.role);

            if (role=="admin"){
            window.location.href = "admin.html";

            }else {
             window.location.href = "dashboard.html";
        
            }
        } else {
            loginMessage.style.color = "red";
            loginMessage.textContent = response.data.data || "Login failed";
        }

    } catch (error) {
        console.error("Axios error:", error);

            loginMessage.style.color = "red";
            loginMessage.textContent = "Network error. Please check your server.";
        
    }
});

console.log("hello")