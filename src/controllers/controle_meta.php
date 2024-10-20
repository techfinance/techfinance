<?php
    spl_autoload_register(function ($class_name) {
        include '../../src/models/' . $class_name . '.php';
    });

    session_start();

    if(isset($_GET["id_categoria"])){
        $id_categoria = addslashes($_GET["id_categoria"]);
        $valor = addslashes($_GET["valor"]);
        $data = addslashes($_GET["data"]);
        $descricao = addslashes($_GET["descricao"]);
        $tipo = $_GET["tipo"];
        $id_usuario = $_SESSION["id_usuario"];

        if(!empty($id_categoria) && !empty($valor) && !empty($data) && !empty($descricao) && !empty($tipo)) {
            $meta = new Meta("tech_finance1", "localhost", "root", "");

            if($meta->criarMeta($valor, $data, $id_usuario, $descricao, $tipo, $id_categoria)){
                echo "Cadastrado com sucesso!";
            }
        } else {
            echo "Preencha todos os campos!";
        }

    } else {
        echo "Sem resposta";
    }

?>