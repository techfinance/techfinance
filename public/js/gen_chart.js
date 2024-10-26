waitForElement(".dashboard", async () => {

    const ctx = document.getElementById('myLineChart').getContext('2d');
    const data = await getChartData();


        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels, // rótulos do eixo X
                datasets: [
                    {
                        label: 'Entrada',
                        data: data.entrada, // dados para entrada
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.1
                    },
                    {
                        label: 'Saída',
                        data: data.saida, // dados para saída
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
                }
            }
        });

        const ctx2 = document.getElementById('myBarChart').getContext('2d');
        const myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Alimentação', 'Lazer', 'Transporte', 'Saúde', 'Academia', 'Carro'],
                datasets: [{
                    label: 'Despesas',
                    data: [1300.00, 800.00, 500.00, 320.25, 1150.32, 625],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
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

});


async function getChartData() {
    const response = await fetch('/../src/controllers/get_chart_data.php');
    const data = await response.json();
    return data;
}