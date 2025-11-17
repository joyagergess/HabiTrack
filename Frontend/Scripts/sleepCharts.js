document.addEventListener("DOMContentLoaded", async () => {
    const ctx = document.getElementById('myChartSleep').getContext('2d');
    const userId = localStorage.getItem("userId"); 

    if (!userId) return;

    try {
        const response = await axios.get(`${base_url}/entries?user_id=${userId}`);
        if (response.data.status !== 200 || !response.data.data) {
            console.log("No entries found or error fetching entries");
            return;
        }
        const entries = response.data.data;

        const filteredEntries = entries.filter(e => e.sleep_hours != null);

        const labels = entries.map(e => {
            const date = new Date(e.created_at);
            return date.toLocaleDateString(undefined, { month: 'short', day: 'numeric' }); 
        });
        const sleepData = filteredEntries.map(e => parseFloat(e.sleep_hours));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Sleep (hours)',
                        data: sleepData,
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
                    title: { display: true, text: 'Daily Sleep' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

    } catch (error) {
        console.error("Error loading sleep entries for chart:", error);
    }
});
