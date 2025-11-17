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



document.addEventListener("DOMContentLoaded", async () => {
    try {
        const response = await axios.get(`${base_url}/entries/All`);
        const entries = response.data.data;

        const tbody = document.querySelector("#entriesTable tbody");
        tbody.innerHTML = "";

        entries.forEach(entry => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${entry.id}</td>
                <td>${entry.user_id}</td>
                <td>${entry.free_text}</td>
                <td>${entry.steps}</td>
                <td>${entry.caffeine}</td>
                <td>${entry.sleep_time}</td>
                <td>${entry.sleep_hours}</td>
                <td>${entry.created_at}</td>
                <td>
                    <button class="deleteEntryBtn" id="${entry.id}">Delete</button>
                </td>
            `;

            tbody.appendChild(row);
        });

        handleDeleteButtonsEntry();

    } catch (error) {
        console.error("Error fetching entries:", error);
    }
});


function handleDeleteButtonsEntry() {
    document.querySelectorAll(".deleteEntryBtn").forEach(btn => {
        btn.addEventListener("click", async e => {
            const id = e.target.id;

            if (!confirm("Are you sure you want to delete this entry?")) return;

            deleteEntry(id);
        });
    });
}


async function deleteEntry(id) {
    try {
        await axios.delete(`${base_url}/entry/delete?id=${id}`);

        alert("Entry deleted");
        location.reload();

    } catch (error) {
        console.error("Delete entry failed:", error);
        alert("Failed to delete entry.");
    }
}

 const role = localStorage.getItem("role");
    if (!role || role.toLowerCase() !== "admin") {
        window.location.href = "index.html";
    }
