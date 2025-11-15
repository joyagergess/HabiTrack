document.addEventListener("DOMContentLoaded", () => {
    const sleepStartInput = document.getElementById("quickSleepStart");
    const sleepEndInput = document.getElementById("quickSleepEnd");
    const quickSaveBtn = document.getElementById("quickSaveBtn");

    sleepEndInput.addEventListener("change", () => {
        if (sleepStartInput.value && sleepEndInput.value) {
            const start = sleepStartInput.value;
            const end = sleepEndInput.value;

           
        }
    });

    quickSaveBtn.addEventListener("click", async () => {
        const sleepStart = sleepStartInput.value;
        const sleepEnd = sleepEndInput.value;

        const steps = document.getElementById("quickSteps").value;
        const caffeine = document.getElementById("quickCaffeine").value;
        const userId = localStorage.getItem("userId");

        if (!userId) return alert("User not logged in");
        if (!sleepStart && !sleepEnd && !steps && !caffeine)
            return alert("Please fill at least one field");

       
        let textSummary = "Quick log:";
        if (steps) textSummary += ` ${steps} steps;`;
        if (caffeine) textSummary += ` ${caffeine} cups of coffee;`;
        if (sleepStart && sleepEnd) 
            textSummary += ` slept from ${sleepStart} to ${sleepEnd};`;

        try {
            const payload = {
                user_id: parseInt(userId),
                text: textSummary,
                steps: steps ? parseInt(steps) : null,
                caffeine: caffeine ? parseInt(caffeine) : null,
                sleep_hours: null
            };

            const response = await axios.post(`${base_url}/entry/create`, payload);

            if (response.data.status === 200) {
                alert("Quick log saved successfully!");
                sleepStartInput.value = "";
                sleepEndInput.value = "";
                document.getElementById("quickSteps").value = "";
                document.getElementById("quickCaffeine").value = "";

                if (typeof loadEntries === "function") loadEntries();
            } else {
                alert(response.data.message || "Failed to save quick log");
            }
        } catch (error) {
            console.error("Quick log error:", error);
            alert("Network error. Could not save quick log.");
        }
    });
});
