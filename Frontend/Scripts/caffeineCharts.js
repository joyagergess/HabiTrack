document.addEventListener("DOMContentLoaded", async () => {
    const ctx = document.getElementById('myChartCaffeine').getContext('2d');
    const userId = localStorage.getItem("userId"); 

    if (!userId) return;

    try {
        const response = await axios.get(`${base_url}/entries?user_id=${userId}`);
        if (response.data.status !== 200 || !response.data.data) {
            console.log("No entries found or error fetching entries");
            return;
        }

        const entries = response.data.data;

        const labels = entries.map(e => new Date(e.created_at).toLocaleDateString());
        const caffeineData = entries.map(e => e.caffeine != null ? parseInt(e.caffeine) : 0);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Caffeine (mg)',
                        data: caffeineData,
                        backgroundColor: 'rgba(255, 206, 86, 0.7)',
                        borderColor: 'rgba(255, 206, 86, 1)',
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
                        text: 'Daily Caffeine Intake'
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
        console.error("Error loading caffeine entries for chart:", error);
    }
});
