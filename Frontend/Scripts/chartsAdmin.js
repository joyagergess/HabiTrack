document.addEventListener("DOMContentLoaded", async () => {
    const ctx = document.getElementById('myChart').getContext('2d');

    try {
        const response = await axios.get(`${base_url}/entries/All`);
        if (response.data.status !== 200 || !response.data.data) {
            console.log("No entries found or error fetching entries");
            return;
        }

        const entries = response.data.data;

        const userStepsMap = {};
        entries.forEach(e => {
            if (!userStepsMap[e.user_id]) userStepsMap[e.user_id] = 0;
            userStepsMap[e.user_id] += e.steps || 0;
        });

        const labels = Object.keys(userStepsMap).map(u => `User ${u}`);
        const stepsData = Object.values(userStepsMap);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Steps per User',
                        data: stepsData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Total Steps per User' }
                },
                scales: { y: { beginAtZero: true } }
            }
        });

    } catch (error) {
        console.error("Error loading entries for chart:", error);
    }
});

document.addEventListener("DOMContentLoaded", async () => {
    const ctx = document.getElementById('activeHabitsChart').getContext('2d');

    try {
        const response = await axios.get(`${base_url}/habits`);
        if (response.data.status !== 200 || !response.data.data) {
            console.log("No habits found or error fetching habits");
            return;
        }

        const habits = response.data.data;

        const activeHabitsMap = {};
        habits.forEach(habit => {
            if (habit.status =="1") {
                if (!activeHabitsMap[habit.user_id]) activeHabitsMap[habit.user_id] = 0;
                activeHabitsMap[habit.user_id] += 1;
            }
        });

        const labels = Object.keys(activeHabitsMap).map(u => `User ${u}`);
        const data = Object.values(activeHabitsMap);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Active Habits',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Number of Active Habits per User' }
                },
                scales: { y: { beginAtZero: true, precision: 0 } } // integer y-axis
            }
        });

    } catch (error) {
        console.error("Error loading active habits chart:", error);
    }
});
