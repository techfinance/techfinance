<?php
    if(!isset($_SESSION["nome"])) session_start();
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    $id = $_SESSION["id_usuario"];
    $registro = new Registro("tech_finance1", "localhost", "root", "");

?>

<!-- Info -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="info-container" aria-labelledby="tituloInfo">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="tituloInfo">Meus Gastos</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Nesta tela, você encontrará gráficos que ajudam a identificar áreas de melhoria para alcançar seus objetivos financeiros.</p>
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
    <p>Aqui estão alguns gráficos gerados a partir dos seus registros nos últimos meses.</p>
    <div class="row p-2 justify-content-center text-center cards">
        <div class="col-sm-auto card">
            <div class="card-body">
                <h5 class="card-title">Total Gasto</h5>
                <p class="card-text">
                    <?php
                        $soma = 0;
                        $dados = $registro->getDespesa($id);
                        for($i = 0; $i < count($dados); $i++){
                            foreach($dados[$i] as $key=>$value){
                                if($key === "valor")
                                    $soma += (float) $value;
                            }
                        }
                        echo "<p class='valor-carteira negative'>R$ ".number_format($soma,2,",",".")."</p>";
                    ?>
                </p>
            </div>
        </div>
        <div class="col-sm-auto card">
            <div class="card-body">
                <h5 class="card-title">Média Mensal</h5>
                <p class="card-text">
                    <?php
                        $dados = $registro->getDespesaPorMes($id, 12);
                        $soma = 0;
                        $aux = 0;
                        for($i = 0; $i < count($dados); $i++){
                            foreach($dados[$i] as $key=>$value){
                                if($key === "total"){
                                    $soma += (float) $value;
                                    $aux++;
                                }
                            }
                        }
                        if($soma > 0) $total = $soma/$aux;
                        echo "<p class='valor-carteira negative'>R$ ".number_format($total,2,",",".")."</p>";
                    ?>
                </p>
            </div>
        </div>
        <div class="col-sm-auto card">
            <div class="card-body">
                <h5 class="card-title">Carteira</h5>
                <p class="card-text">
                    <?php
                        require_once "$_SERVER[DOCUMENT_ROOT]/src/controllers/valor_carteira.php";
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="row p-2 justify-content-around">
        <div class="col-sm-auto grafico">
            <canvas id="myLineChart" width="612" height="306"></canvas>
            <button class ="btn" id="download-pdf-line" style="font-size: 14px;">Exportar PDF</button>
        </div>
        <div class="col-sm-auto grafico">
            <canvas id="myBarChart" width="612" height="306"></canvas>
            <button class ="btn" id="download-pdf-bar" style="font-size: 14px;">Exportar PDF</button>
        </div>
    </div>
    
</div>


