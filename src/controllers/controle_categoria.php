<?php

    spl_autoload_register(function ($class_name) {
        include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
      });

    session_start();

    if(isset($_GET["nome_categoria"])){
        $nome_categoria = $_GET["nome_categoria"];
        $id = $_SESSION["id_usuario"];

        $categoria = new Categoria("tech_finance1", "localhost", "root", "");

        if($categoria->setCategoriau($nome_categoria, $id)){
            
            $dados = $categoria->getCategoriau($nome_categoria);
            echo $dados["id_categoriau"];

        }
        
    }


?>