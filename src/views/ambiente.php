<?php
    if(!isset($_SESSION['id_usuario'])){
        session_destroy();
        header("Location: ../../public/index.php");
    }
    ?>

<head>
    <div class="container-fluid top-nav">
        <div class="navbar-brand"><img src="images/logo.png" alt="logo do site" id="logo"></div>
        <div class="nav-config">
            <i class="bi bi-gear nav-config-items" id="config"></i>
            <div class="dropdown">
                <i class="bi bi-person-circle nav-config-items" id="user" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu p-3">
                    <li><p class="mb-0"><?= $_SESSION["email"]; ?></p></li>
                    <li><hr class="dropdown-divider" style="background-color: white;"></li>
                    <li class="d-flex align-items-center"><a href="../src/controllers/session_out.php" id="logout" >Sair</a></li>
                </ul>
            </div>
            
        </div>
    </div>
    <nav class="navbar navbar-expand-lg" id="nav-bar">
        <div class="container-fluid" id="container-nav">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#" onclick="getPage('home')">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="getPage('registros', [createTable, formEntrada, formSaida])">Registros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="getPage('metas', [formMeta])">Metas Financeiras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="getPage('sonhos', [formSonho])">Sonhos de Consumo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="getPage('dashboards', [createCharts])">Meus Gastos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</head>
<main>
    <div class="container" id="main">
        <?php include "../src/views/home.php" ?>
    </div>
</main>
<footer>
    <div class="container-fluid" id="footer">
        &copy; All rights reserved | TechFinance 2024. Todos os direitos reservados.
    </div>
</footer>

