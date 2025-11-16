document.addEventListener("DOMContentLoaded", () => {
    const entryListContainer = document.getElementById("entriesList");
    const entryPopup = document.getElementById("entryPopup");
    const entryTextInput = document.getElementById("entryText");
    const saveEntryBtn = document.getElementById("saveEntryBtn");
    const closeEntryBtn = document.getElementById("closeEntryPopup");
    const addEntryBtn = document.getElementById("addEntryBtn");

    let editingEntryId = null;

    addEntryBtn.addEventListener("click", () => {
        editingEntryId = null;
        entryTextInput.value = "";
        entryPopup.classList.remove("hidden");
    });

    closeEntryBtn.addEventListener("click", () => entryPopup.classList.add("hidden"));

    saveEntryBtn.addEventListener("click", async () => {
        const text = entryTextInput.value.trim();
        const userId = localStorage.getItem("userId");

        if (!userId) return alert("User not logged in");
        if (!text) return alert("Entry cannot be empty");

        try {
           const payload = { 
            user_id: parseInt(userId), 
            text: text   
          };


            if (editingEntryId) {
                await axios.put(`${base_url}/entry/update?id=${editingEntryId}`, payload);
            } else {
                await axios.post(`${base_url}/entry/create`, payload);
            }

            entryPopup.classList.add("hidden");
            loadEntries();
        } catch (error) {
            console.error(error);
            alert("Error saving entry. Check console.");
        }
    });

    
async function loadEntries() {
    const userId = localStorage.getItem("userId");
    entryListContainer.innerHTML = "";

    if (!userId) {
        entryListContainer.textContent = "User not logged in";
        return;
    }

    try {
        const response = await axios.get(`${base_url}/entries?user_id=${userId}`);
        if (response.data.status !== 200) {
            entryListContainer.textContent = response.data.message || "Failed to load entries";
            return;
        }

        const entries = response.data.data;
        if (!entries || entries.length === 0) {
            entryListContainer.textContent = "No entries yet. Add one!";
            return;
        }

        entries.forEach(entry => {
            const card = document.createElement("div");
            card.className = "entry-card";
            card.setAttribute("data-id", entry.id);

      
            const dateDiv = document.createElement("div");
            dateDiv.className = "entry-date";
            const formattedDate = new Date(entry.created_at).toLocaleString("en-US", {
                year: "numeric",
                month: "short",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit"
            });
            dateDiv.textContent = `🗓️ ${formattedDate}`;

            const textDiv = document.createElement("div");
            textDiv.className = "entry-text";
            textDiv.textContent = entry.free_text;

            const actions = document.createElement("div");
            actions.className = "entry-actions";

            const editBtn = document.createElement("button");
            editBtn.textContent = "Edit";
            editBtn.classList.add("btn-primary");  
            editBtn.addEventListener("click", () => editEntry(entry));

            const deleteBtn = document.createElement("button");
            deleteBtn.textContent = "Delete";
            deleteBtn.classList.add("btn-primary");  
            deleteBtn.addEventListener("click", () => deleteEntry(entry.id));

            actions.append(editBtn, deleteBtn);

     
            card.append(dateDiv, textDiv, actions);

            entryListContainer.appendChild(card);
        });
    } catch (error) {
        console.error("Axios error:", error);
        entryListContainer.textContent = "Network error. Please check the server.";
    }
}


    function editEntry(entry) {
        editingEntryId = entry.id;
        entryTextInput.value = entry.free_text;
        entryPopup.classList.remove("hidden");
    }

    async function deleteEntry(id) {
        if (!confirm("Are you sure you want to delete this entry?")) return;
        try {
            await axios.delete(`${base_url}/entry/delete?id=${id}`);
            loadEntries();
        } catch (error) {
            console.error(error);
            alert("Failed to delete entry.");
        }
    }
    loadEntries();
    
});
