<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    session_start();
    $id = $_SESSION["id_usuario"];

    $registros = new Registro("tech_finance1", "localhost", "root", "");

    if(isset($_GET["entrada"])){
        $entrada = $_GET["entrada"];
        $valor = $_GET["valor"];
        $registros->deleteEntrada($entrada);

        $valorAtual = $registros->valorCarteira($id);

        $newValor = $valorAtual - $valor;
        $registros->updateCarteira($id, $newValor);

    }

    if(isset($_GET["saida"])){
        $saida = $_GET["saida"];
        $valor = $_GET["valor"];
        $registros->deleteSaida($saida);

        $valorAtual = $registros->valorCarteira($id);
        $newValor = $valorAtual + $valor;
        $registros->updateCarteira($id, $newValor);
    }

    echo "ok";
?>