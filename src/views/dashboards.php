<!-- Info -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="info-container" aria-labelledby="tituloInfo">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="tituloInfo">Meus Gastos</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Try scrolling the rest of the page to see this option in action.</p>
    </div>
</div>

<div class="container-fluid p-2 dashboard">
    <div class="d-flex align-items-center div-info">
        <h1>Meus Gastos</h1>
        <i class="bi bi-info-circle info" data-bs-toggle="offcanvas" data-bs-target="#info-container" aria-controls="info-container"></i>
    </div>
    <p>Aqui estão alguns gráficos gerados a partir dos seus registros nos últimos meses. Se quiser, você pode exportá-los para PDF.</p>
    <div class="row p-2 justify-content-around">
        <div class="col-sm-auto">
            <canvas id="myLineChart" width="600" height="300"></canvas>
            <button class ="btn" id="download-pdf-line" style="font-size: 14px;">Exportar PDF</button>
        </div>
        <div class="col-sm-auto">
            <canvas id="myBarChart" width="600" height="300"></canvas>
            <button class ="btn" id="download-pdf-bar" style="font-size: 14px;">Exportar PDF</button>
        </div>
    </div>
</div>


