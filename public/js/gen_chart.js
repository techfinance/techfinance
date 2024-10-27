async function getChartData(url) {
    const response = await fetch(url);
    const data = await response.json();
    return data;
}


async function createCharts() {

    const ctx = document.getElementById('myLineChart').getContext('2d');
    const dataBar = await getChartData('/../src/controllers/get_chart_data.php');
    const dataLine = await getChartData('/../src/controllers/get_chart_dataline.php');

        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dataLine.labels, // rótulos do eixo X
                datasets: [
                    {
                        label: 'Entrada',
                        data: dataLine.entradas, // dados para entrada
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.1
                    },
                    {
                        label: 'Despesa',
                        data: dataLine.saidas, // dados para despesa
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Entradas e despesas nos últimos 6 meses (em R$)'
                    }
                }
            }
        });

        const ctx2 = document.getElementById('myBarChart').getContext('2d');
        const myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: dataBar.labels,
                datasets: [{
                    label: 'Despesas',
                    data: dataBar.values,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',   
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Saídas por categoria nos últimos 30 dias (em R$)'
                    },
                    legend: {
                        display: false
                      }
                }
            }
        });

          // Função para exportar o gráfico para PDF
          document.getElementById('download-pdf-line').addEventListener('click', function() {
            html2canvas(document.querySelector('#myLineChart')).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                doc.addImage(imgData, 'PNG', 10, 10, 190, 100);  // Ajuste o tamanho da imagem no PDF
                doc.save('grafico-registros.pdf');
            });
        });

        document.getElementById('download-pdf-bar').addEventListener('click', function() {
            html2canvas(document.querySelector('#myBarChart')).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                doc.addImage(imgData, 'PNG', 10, 10, 190, 100);  // Ajuste o tamanho da imagem no PDF
                doc.save('grafico-categorias.pdf');
            });
        });
}


