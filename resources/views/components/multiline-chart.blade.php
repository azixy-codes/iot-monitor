<canvas id="multiline"></canvas>
<script>
    let ctx = document.getElementById('multiline').getContext('2d');
    let chartData = <?= json_encode($chartData) ?>;


    let datasets = [];
    let color = ['#4CAF50', '#2196f3', '#fcba03', '#fc0352', '#00b315']

    for (var key of Object.keys(chartData)) {
        obj = {
            label: chartData[key].nom,
            data: chartData[key].data,
            borderColor: color[key],
            backgroundColor: color[key],
            borderWidth: 1
        }

        datasets.push(obj)
    }


    let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Object.values(chartData)[0]['labels'],
            datasets: datasets
        },
        options: {
            responsive: true, // Instruct chart js to respond nicely.
            scales: {
                x: {
                    beginAtZero: true,
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        display: true
                    },
                }
            },
        }
    });
</script>