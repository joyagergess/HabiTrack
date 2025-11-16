

const habitPopup = document.getElementById("habitPopup");
const habitNameInput = document.getElementById("habitName");
const habitTargetInput = document.getElementById("habitTarget");
const saveHabitBtn = document.getElementById("saveHabitBtn");
const closeHabitBtn = document.getElementById("closeHabitPopup");
const predefinedHabitsContainer = document.getElementById("predefinedHabits");

let editingHabitId = null;

document.getElementById("addHabitBtn").addEventListener("click", () => {
    editingHabitId = null;
    habitNameInput.value = "";
    habitTargetInput.value = "";
    Array.from(predefinedHabitsContainer.querySelectorAll("input[type=checkbox]"))
         .forEach(cb => cb.checked = false);
    habitPopup.classList.remove("hidden");
});

closeHabitBtn.addEventListener("click", () => habitPopup.classList.add("hidden"));

saveHabitBtn.addEventListener("click", async () => {
    const userId = localStorage.getItem("userId");
    if (!userId) return alert("User not logged in");


    const selectedHabits = Array.from(predefinedHabitsContainer.querySelectorAll("input[type=checkbox]:checked"))
                                .map(cb => cb.value);

    const customHabit = habitNameInput.value.trim();
    if (customHabit) selectedHabits.push(customHabit);

    if (selectedHabits.length === 0) return alert("Select or enter at least one habit");

    try {
        for (let name of selectedHabits) {
            if (editingHabitId) {
                await axios.put(`${base_url}/habit/update?id=${editingHabitId}`, {
                    name, target: habitTargetInput.value.trim()
                });
            } else {
                await axios.post(`${base_url}/habit/create`, {
                    name, target: habitTargetInput.value.trim(), user_id: parseInt(userId)
                });
            }
        }
        habitPopup.classList.add("hidden");
        loadHabits();
    } catch (error) {
        console.error(error);
        alert("Error saving habit.");
    }
});

async function loadHabits() {
    const userId = localStorage.getItem("userId");
    const container = document.getElementById("habitsList");
    container.innerHTML = "";

    if (!userId) {
        container.textContent = "User not logged in";
        return;
    }

    try {
        const response = await axios.get(`${base_url}/habits/user?user_id=${userId}`);
        if (response.data.status !== 200) {
            container.textContent = response.data.message || "Failed to load habits";
            return;
        }

        const habits = response.data.data;
        if (!habits || habits.length === 0) {
            container.textContent = "No habits yet. Add one!";
            return;
        }

        habits.forEach(habit => {
            const card = document.createElement("div");
            card.className = "habit-card";
            if (habit.status === 0) card.classList.add("inactive");
            card.setAttribute("data-id", habit.id);

            const name = document.createElement("div");
            name.className = "habit-name";
            name.textContent = habit.name;

            const target = document.createElement("div");
            target.className = "habit-target";
            target.textContent = habit.target || "No target";

            const actions = document.createElement("div");
            actions.className = "habit-actions";

            const toggleBtn = document.createElement("button");
            toggleBtn.textContent = habit.status === 1 ? "Deactivate" : "Activate";
            toggleBtn.classList.add("btn-primary"); 
            toggleBtn.addEventListener("click", () => toggleStatus(habit.id));

            const editBtn = document.createElement("button");
            editBtn.textContent = "Edit";
            editBtn.classList.add("btn-primary");
            editBtn.addEventListener("click", () => editHabit(habit));

            const deleteBtn = document.createElement("button");
            deleteBtn.textContent = "Delete";
            deleteBtn.classList.add("btn-primary");  
            deleteBtn.addEventListener("click", () => deleteHabit(habit.id));

            actions.append(toggleBtn, editBtn, deleteBtn);
            card.append(name, target, actions);
            container.appendChild(card);
        });

    } catch (error) {
        console.error(error);
        container.textContent = "Network error. Please check the server.";
    }
}

async function toggleStatus(id) {
    try {
        await axios.put(`${base_url}/habit/toggleStatus?id=${id}`);
        loadHabits();
    } catch (error) {
        console.error(error);
        alert("Failed to toggle status.");
    }
}

function editHabit(habit) {
    editingHabitId = habit.id;
    habitNameInput.value = habit.name;
    habitTargetInput.value = habit.target || "";
    Array.from(predefinedHabitsContainer.querySelectorAll("input[type=checkbox]"))
         .forEach(cb => cb.checked = habit.name === cb.value);
    habitPopup.classList.remove("hidden");
}

async function deleteHabit(id) {
    if (!confirm("Are you sure you want to delete this habit?")) return;
    try {
        await axios.delete(`${base_url}/habit/delete?id=${id}`);
        loadHabits();
    } catch (error) {
        console.error(error);
        alert("Failed to delete habit.");
    }
}

document.addEventListener("DOMContentLoaded", loadHabits);
