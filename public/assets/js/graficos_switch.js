
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-switch button');
    const canvas = document.getElementById('graficoSwitch');
    let currentChart = null;

    const dataMes = {
        labels: labelsMes,
        datasets: [{
            label: "Vencimientos por Mes",
            data: valoresMes,
            backgroundColor: 'rgba(78, 115, 223, 0.2)',
            borderColor: 'rgba(78, 115, 223, 1)',
            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
            fill: true,
            tension: 0.4
        }]
    };

    const dataPasillo = {
        labels: labelsPasillo,
        datasets: [{
            label: "Vencimientos por Pasillo",
            data: valoresPasillo,
            backgroundColor: '#ffc107'
        }]
    };

    const configMes = {
        type: 'line',
        data: dataMes,
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    };

    const configPasillo = {
        type: 'bar',
        data: dataPasillo,
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    };

    function renderChart(config) {
        if (currentChart) currentChart.destroy();
        currentChart = new Chart(canvas.getContext('2d'), config);
    }

    // Inicializa con gráfico de Mes
    renderChart(configMes);

    tabs.forEach(button => {
        button.addEventListener('click', () => {
            tabs.forEach(b => b.classList.remove('active'));
            button.classList.add('active');

            if (button.dataset.target === 'mes') {
                renderChart(configMes);
            } else {
                renderChart(configPasillo);
            }
        });
    });
});
