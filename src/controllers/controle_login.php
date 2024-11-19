<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    if(isset($_POST['email'])){

        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        
        //verificar se está preenchido
        if(!empty($email) && !empty($senha)){
            $query = new Usuario("tech_finance1", "localhost", "root", "");

            if($query->erro == ""){
                if($query->logar($email, $senha)){
                    header("Location: ../../public/index.php");
                } else {
                    header("Location: ../../public/index.php?login=false");
                }
            } else {
                echo "Erro: ".$query->erro;
            }
           
        } else {
            echo "Preencha todos os campos";
        }
    }

    
?>