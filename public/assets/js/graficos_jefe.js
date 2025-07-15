document.addEventListener("DOMContentLoaded", () => {
  // Gráfico por mes
  const ctxMes = document.getElementById("graficoMes");
  if (ctxMes) {
    new Chart(ctxMes, {
      type: "line",
      data: {
        labels: etiquetasMes,
        datasets: [{
          label: "Vencimientos por Mes",
          data: datosMes,
          backgroundColor: 'rgba(78, 115, 223, 0.2)',
          borderColor: 'rgba(78, 115, 223, 1)',
          pointBackgroundColor: 'rgba(78, 115, 223, 1)',
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
      }
    });
  }

  // Gráfico por pasillo
  const ctxPasillo = document.getElementById("graficoPasillo");
  if (ctxPasillo) {
    new Chart(ctxPasillo, {
      type: "bar",
      data: {
        labels: etiquetasPasillo,
        datasets: [{
          label: "Vencimientos por Pasillo",
          data: datosPasillo,
          backgroundColor: "#ffc107"
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
      }
    });
  }
});
