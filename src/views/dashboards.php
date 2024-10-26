<div class="container-fluid p-2 dashboard">
    <h1>Meus Gastos</h1>
    <p>Aqui estão alguns gráficos gerados a partir dos seus registros no último mês. Se quiser, você pode exportá-los para PDF.</p>
    <div class="row p-2 justify-content-around">
        <div class="col-sm-auto">
            <canvas id="myLineChart" width="600" height="300"></canvas>
            <button class ="btn" id="download-pdf-line">Exportar PDF</button>
        </div>
        <div class="col-sm-auto">
            <canvas id="myBarChart" width="600" height="300"></canvas>
            <button class ="btn" id="download-pdf-bar">Exportar PDF</button>
        </div>
    </div>
</div>


