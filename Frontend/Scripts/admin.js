document.addEventListener("DOMContentLoaded", async () => {
    try {
        const response = await axios.get(`${base_url}/users`);
        const users = response.data.data;

        const tbody = document.querySelector("#usersTable tbody");
        tbody.innerHTML = ""; 

        users.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.created_at}</td>
                <td>
                    <button class="deleteBtn" id=${user.id}>Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });
       handleDeleteButtons();
    } catch (error) {
        console.error("Error fetching users:", error);
    }
});


function handleDeleteButtons() {
    document.querySelectorAll(".deleteBtn").forEach(btn => {
        btn.addEventListener("click", async (e) => {
        const id = e.target.id;
        if (!confirm("Are you sure you want to delete this user?"))
             return;

        deleteUser(id);
        });
    });
}

async function deleteUser(id) {
    try {
        await axios.delete(`${base_url}/user/delete`, {
            data: { id: id }  
        });

        alert("User deleted");
        location.reload();

    } catch (error) {
        console.error(error);
        alert("Failed to delete user.");
    }
}


