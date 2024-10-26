<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    header('Content-Type: application/json');
    session_start();

    $id = $_SESSION["id_usuario"];
    $categoria = new Categoria("tech_finance1", "localhost", "root", "");

    $categorias = $categoria->getAllCategoria($id);
    $data = [
        "labels" => [],
        "values" => []
    ];

    for($i = 0; $i < count($categorias); $i++){
        $somaSaida = $categoria->getSomaSaidasPorCategoria($categorias[$i]["id"], $id);
        array_push($data["labels"], $categorias[$i]["nome"]);
        array_push($data["values"], $somaSaida);
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);

?>