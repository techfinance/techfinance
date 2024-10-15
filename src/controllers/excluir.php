<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    $registros = new Registro("tech_finance1", "localhost", "root", "");

    if(isset($_GET["entrada"])){
        $entrada = $_GET["entrada"];
        $registros->deleteEntrada($entrada);
    }

    if(isset($_GET["saida"])){
        $saida = $_GET["saida"];
        $registros->deleteSaida($saida);
    }

    echo "ok";
?>