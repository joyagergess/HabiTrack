document.addEventListener("DOMContentLoaded", () => {
  const analyzeBtn = document.getElementById("analyzeNutritionBtn");
  const inputField = document.getElementById("nutritionInput");
  const outputContainer = document.getElementById("nutritionAIOutput");

  if (!analyzeBtn || !inputField || !outputContainer) return;

  analyzeBtn.addEventListener("click", async () => {
    const userId = localStorage.getItem("userId");
    const foodText = inputField.value.trim();

    if (!userId) return console.warn("User not logged in");
    if (!foodText) return outputContainer.innerHTML = "<p>Please enter your meals first.</p>";

    outputContainer.innerHTML = "<p>Analyzing your meals...</p>";

    try {
      const response = await axios.post(`${base_url}/AICalories`, {
        user_id: parseInt(userId),
        food_log: foodText
      });

      if (response.data.status === 200 && response.data.data?.summary) {
        outputContainer.innerHTML = `<p>${response.data.data.summary}</p>`;
      } else {
        outputContainer.innerHTML = "<p>Failed to get nutrition data.</p>";
        console.error("Failed to get calories:", response.data);
      }

    } catch (error) {
      outputContainer.innerHTML = "<p>Error fetching nutrition data.</p>";
      console.error("Error fetching calories:", error);
    }
  });
});
