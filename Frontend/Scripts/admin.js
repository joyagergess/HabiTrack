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
                    <button class="deleteUserBtn" id=${user.id}>Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });
       handleDeleteButtonUser();
    } catch (error) {
        console.error("Error fetching users:", error);
    }
});


function handleDeleteButtonUser() {
    document.querySelectorAll(".deleteUserBtn").forEach(btn => {
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
            data: { id }    
        });

        alert("User deleted");
        location.reload();

    } catch (error) {
        console.error(error);
        alert("Failed to delete user.");
    }
}



document.addEventListener("DOMContentLoaded", async () => {
    try {
        const response = await axios.get(`${base_url}/habits`);
        const habits = response.data.data;

        const tbody = document.querySelector("#habitsTable tbody");
        tbody.innerHTML = ""; 

        habits.forEach(habit => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${habit.id}</td>
                <td>${habit.user_id}</td>
                <td>${habit.name}</td>
                <td>${habit.category}</td>
                <td>${habit.target}</td>
                <td>${habit.status}</td>
                <td>${habit.created_at}</td>
                <td>
                    <button class="deleteHabitBtn" id=${habit.id}>Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });
       handleDeleteButtonHabit();
    } catch (error) {
        console.error("Error fetching habits:", error);
    }
});


function handleDeleteButtonHabit() {
    document.querySelectorAll(".deleteHabitBtn").forEach(btn => {
        btn.addEventListener("click", async (e) => {
        const id = e.target.id;
        if (!confirm("Are you sure you want to delete this habit?"))
             return;

        deleteHabit(id);
        });
    });
}

async function deleteHabit(id) {
    try {
     await axios.delete(`${base_url}/habit/delete?id=${id}`);
   

        alert("habit deleted");
        location.reload();

    } catch (error) {
        console.error(error);
        alert("Failed to delete habit.");
    }
}

