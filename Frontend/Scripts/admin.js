document.addEventListener("DOMContentLoaded", async () => {
    try {
        const response = await axios.get(`${base_url}/users`);
        const users = response.data.data;

        const tbody = document.querySelector("#usersTable tbody");
        tbody.innerHTML = ""; 

        users.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>
                    <button class="editBtn">Edit</button>
                    <button class="deleteBtn">Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    } catch (error) {
        console.error("Error fetching users:", error);
    }
});

