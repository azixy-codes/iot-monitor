<canvas class="w-24" id="barChart-{{ $module->id }}"></canvas>
<script>
    var ctx = document.getElementById('barChart-{{ $module->id }}').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartData['labels']); ?>,
            datasets: [{
                label: '<?= ucfirst($module->type_de_mesure->nom) ?>',
                data: <?= json_encode($chartData['data']); ?>,
                backgroundColor: 'rgba(107, 114, 128, 1)',
                borderColor: 'rgba(107, 114, 128, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            barPercentage: 1.0,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        display: true
                    },
                    grid: {
                        display: false
                    },
                    display: false
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            pointRadius: 1,
        }
    });
</script>