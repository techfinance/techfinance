<?php
    require_once "../models/Usuario.php";

    if(isset($_POST['nome'])){

        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confSenha = addslashes($_POST['confSenha']);
        //verificar se está preenchido

        if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confSenha)){
            $query = new Usuario("techfinance", "localhost", "root", "");

            if($query->erro == ""){ //sem erros
                if($senha == $confSenha){
                    if($query->cadastrar($nome, $email, $senha)){
                        echo "Cadastrado com sucesso! Acesse para entrar!";
                    } else {
                        echo "E-mail já cadastrado!";
                    }
                } else{
                    header("Location: ../../public/index.php?senha=false");
                }

            } else {
                echo "ERRO: ".$query->erro;
            }

        } else {
            echo "Preencha todos os campos!";
        }

    }

?>