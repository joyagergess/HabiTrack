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

        const caffeine = {};
        entries.forEach(e => {
            if (e.sleep_hours != null) {
                const date = new Date(e.created_at).toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
                caffeine[date] = ( caffeine[date] || 0) + parseFloat(e.caffeine);
            }
        });

        const labels = Object.keys(caffeine);
        const caffeineData = Object.values(caffeine);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Caffeine intake (mg)',
                        data: caffeineData,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Caffeine intake (mg)' }
                },
                scales: { y: { beginAtZero: true } }
            }
        });

    } catch (error) {
        console.error("Error loading sleep entries for chart:", error);
    }
});
