

document.addEventListener("DOMContentLoaded", async () => {
    const ctx = document.getElementById('myChart').getContext('2d');
    const userId = localStorage.getItem("userId"); 

    if (!userId) return;

    try {
        const response = await axios.get(`${base_url}/entries?user_id=${userId}`);
        if (response.data.status !== 200 || !response.data.data) {
            console.log("No entries found or error fetching entries");
            return;
        }

        const entries = response.data.data;
        const dailySteps = {};
        entries.forEach(e => {
            const date = new Date(e.created_at).toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
            dailySteps[date] = (dailySteps[date] || 0) + parseInt(e.steps);
        });

        const labels = Object.keys(dailySteps);
        const data = Object.values(dailySteps);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Steps',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Daily Steps'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    } catch (error) {
        console.error("Error loading entries for chart:", error);
    }
});
