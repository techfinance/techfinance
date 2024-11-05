<?php  
    spl_autoload_register(function ($class_name) {
        include '../../src/models/' . $class_name . '.php';
    });

    session_start();

    if(isset($_GET["nome"])){
        $tipo = addslashes($_GET["nome"]);
        $categoria = addslashes($_GET["categoria"]);
        $valor = addslashes($_GET["valor"]);
        $data = addslashes($_GET["data"]);
        $tipoCategoria = $_GET["tipo"];
        $idCategoria = $_GET["id"];
        $id = $_SESSION["id_usuario"];

        if(!empty($tipo) && !empty($categoria) && !empty($valor)){
            $query = new Registro("tech_finance1", "localhost", "root", "");

            if($query->erro == ""){
                if($query->cadastrarDespesa($tipo, $categoria, $valor, $data, $tipoCategoria, $idCategoria, $id)){
                    echo "Cadastrado com sucesso!";
                    $valorAtual = $query->valorCarteira($id);
                    $newValor = $valorAtual - $valor;
                    $query->updateCarteira($id, $newValor);

                } else {
                    echo "Não cadastrado!";
                }
            } else {
                echo "Erro: ".$query->erro;
            }
        } else {
            echo "Preencha todos os campos!";
        }
    } else {
        echo "sem resposta";
    }

?>