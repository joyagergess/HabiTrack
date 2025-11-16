
document.addEventListener("DOMContentLoaded", () => {

  async function fetchWeeklySummary() {
    const userId = localStorage.getItem("userId");

    if (!userId) return console.warn("User not logged in");

    try {
      const response = await axios.post(`${base_url}/summary/weekly`, {
        user_id: parseInt(userId)
      });

      if (response.data.status === 200) {
        const summary = response.data.data.summary;
        if (!summary) {
          console.warn("No summary returned from backend.");
        }
        displayWeeklySummary(summary);
      } else {
        console.error("Failed to get summary:", response.data.message);
      }
    } catch (error) {
      console.error("Error fetching weekly summary:", error);
    }
  }

  function displayWeeklySummary(summaryText) {
    const container = document.getElementById("summaryContent");

    if (container) {
      container.innerHTML = `<p>${summaryText}</p>`;
    }
  }

  fetchWeeklySummary();
});
