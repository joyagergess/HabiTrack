const base_url = "http://localhost/HabiTrack/Server";

document.getElementById("signup-btn").addEventListener('click', async () => {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const signupMessage = document.getElementById("signup-message");

    signupMessage.textContent = "";

    if (!name || !email || !password) {
        signupMessage.style.color = "red";
        signupMessage.textContent = "Enter your name, email and password";
        return;
    }

    let response;

    try {
        response = await axios.post(base_url + "/auth/signup", { name, email, password });

        if (response.data.status === 200) {
            signupMessage.style.color = "green";
            signupMessage.textContent = "Signup successful! You can login now.";
            console.log("Response data:", response.data);
        } else {
            signupMessage.style.color = "red";
            signupMessage.textContent = response.data.message || "Signup failed";
        }

    } catch (error) {
        console.error("Axios error:", error);

        signupMessage.style.color = "red";
        signupMessage.textContent = "Network error. Please check your server.";
    }
});
