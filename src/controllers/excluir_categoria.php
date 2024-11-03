<?php
   header("Location: ../../public/index.php");

    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    session_start();
    $id_usuario = $_SESSION["id_usuario"];
    $id_categoria = $_GET["categoria"];
    $categoria = new Categoria("tech_finance1", "localhost", "root", "");

    if($categoria->excluirCategoriaU($id_categoria, $id_usuario)) {
        echo "ok!";
    }

?>