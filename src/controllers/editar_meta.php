<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    session_start();
    $id = $_SESSION["id_usuario"];

    $query = new Meta("tech_finance1", "localhost", "root", "");

    if(isset($_GET["valor"])){
        $valor = $_GET["valor"];
        $id_meta = $_GET["id_meta"];
        if($valor > 0)
            $query->editValorMeta($id_meta, $valor, $id);
        else 
            echo "error";
    }

    echo "ok";
?>