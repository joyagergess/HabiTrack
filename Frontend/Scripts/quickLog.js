// quickLog.js
document.addEventListener("DOMContentLoaded", () => {
    const quickSaveBtn = document.getElementById("quickSaveBtn");

    quickSaveBtn.addEventListener("click", async () => {
        const sleepHours = document.getElementById("quickSleepHours").value;
        const steps = document.getElementById("quickSteps").value;
        const caffeine = document.getElementById("quickCaffeine").value;
        const userId = localStorage.getItem("userId");

        if (!userId) {
            alert("User not logged in");
            return;
        }

        if (!sleepHours && !steps && !caffeine) {
            alert("Please fill at least one field");
            return;
        }

        let textSummary = "Quick log:";
        if (steps) textSummary += ` ${steps} steps;`;
        if (caffeine) textSummary += ` ${caffeine} cups of coffee;`;
        if (sleepHours) textSummary += ` slept ${sleepHours} hours;`;

        try {
            const payload = {
                user_id: parseInt(userId),
                text: textSummary, 
                steps: steps ? parseInt(steps) : null,
                caffeine: caffeine ? parseInt(caffeine) : null,
                sleep_hours: sleepHours ? parseFloat(sleepHours) : null
            };

            const response = await axios.post(`${base_url}/entry/create`, payload);

            if (response.data.status === 200) {
                alert("Quick log saved successfully!");

               
                document.getElementById("quickSleepHours").value = "";
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
