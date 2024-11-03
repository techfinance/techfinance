<!-- Info -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="info-container" aria-labelledby="tituloInfo">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="tituloInfo">Meus Gastos</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Nesta tela, você encontrará dois gráficos que ajudam a recapitular seus últimos registros e a identificar áreas de melhoria para alcançar seus objetivos financeiros.</p>
        <p>O primeiro gráfico exibe o valor total das entradas e saídas por mês nos últimos seis meses, oferecendo uma visão clara do seu fluxo financeiro ao longo do tempo. O segundo gráfico detalha os gastos nos últimos 30 dias, organizados por categoria, para que você possa entender melhor onde está investindo seu dinheiro.</p>
        <p>Além disso, você tem a opção de exportar esses gráficos para PDF, permitindo que você os guarde para consultas futuras e acompanhe seu progresso de maneira prática.</p>
        <p>Utilize essas informações para ajustar suas estratégias financeiras e continuar avançando em direção às suas metas!</p>
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


