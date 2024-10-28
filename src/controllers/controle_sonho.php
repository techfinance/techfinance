<?php
    spl_autoload_register(function ($class_name) {
        include '../../src/models/' . $class_name . '.php';
    });

    session_start();

    if(isset($_GET["descricao"])){
        $valor = addslashes($_GET["valor"]);
        $data = addslashes($_GET["data"]);
        $descricao = addslashes($_GET["descricao"]);
        $id_usuario = $_SESSION["id_usuario"];

        if(!empty($valor) && !empty($data) && !empty($descricao)) {
            $sonho = new Sonho("tech_finance1", "localhost", "root", "");

            if($sonho->criarSonho($descricao, $valor, $data, $id_usuario)){
                echo "Cadastrado com sucesso!";
            }
        } else {
            echo "Preencha todos os campos!";
        }

    } else {
        echo "Sem resposta";
    }




?>