<?php
    spl_autoload_register(function ($class_name) {
        include '../../src/models/' . $class_name . '.php';
    });

    session_start();

    if(isset($_GET["nome"])){
        $tipo = addslashes($_GET["nome"]);
        $valor = addslashes($_GET["valor"]);
        $data = addslashes($_GET["data"]);

        if(!empty($tipo) && !empty($valor) && !empty($data)){
            $query = new Registro("tech_finance1", "localhost", "root", "");
            $id = $_SESSION["id_usuario"];

            if($query->erro == ""){
                if($query->cadastrarEntrada($tipo, $valor, $data, $id)){
                    $valorAtual = $query->valorCarteira($id);
                    $newValor = $valorAtual + $valor;
                    $query->updateCarteira($id, $newValor);

                    echo json_encode("Cadastrado com sucesso!");
                    
                } else {
                    echo "Não cadastrado!";
                }
            }
        }
    } 
    
?>