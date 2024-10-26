<?php
spl_autoload_register(function ($class_name) {
    include "../../src/models/$class_name.php";
});

header('Content-Type: application/json');
session_start();

$id = $_SESSION["id_usuario"];
$registro = new Registro("tech_finance1", "localhost", "root", "");

$dados = $registro->getDespesaPorMes($id);
$dadosEntr = $registro->getEntradaPorMes($id);

$data = [
    "labels" => [],
    "saidas" => [],
    "entradas" => []
];

// Obter todos os meses únicos
foreach ($dados as $saida) {
    if (!in_array($saida["mes_nome"], $data["labels"])) {
        array_push($data["labels"], $saida["mes_nome"]);
    }
}

foreach ($dadosEntr as $entrada) {
    if (!in_array($entrada["mes_nome"], $data["labels"])) {
        array_push($data["labels"], $entrada["mes_nome"]);
    }
}

// Preencher saídas e entradas
foreach ($data["labels"] as $label) {
    // Preencher total de saídas
    $totalSaida = null;
    foreach ($dados as $saida) {
        if ($saida["mes_nome"] === $label) {
            $totalSaida = $saida["total"];
            break;
        }
    }
    array_push($data["saidas"], $totalSaida);

    // Preencher total de entradas
    $totalEntrada = null; 
    foreach ($dadosEntr as $entrada) {
        if ($entrada["mes_nome"] === $label) {
            $totalEntrada = $entrada["total"];
            break;
        }
    }
    array_push($data["entradas"], $totalEntrada);
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

?>