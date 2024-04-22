<canvas class="w-24" id="lineChart-{{ $module->id }}"></canvas>
<script>
    var ctx = document.getElementById('lineChart-{{ $module->id }}').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
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
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        display: true
                    },
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            pointRadius: 3,
        }
    });
</script>