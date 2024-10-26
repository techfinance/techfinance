<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    header('Content-Type: application/json');

    $data = [
        "labels" => ['Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro'],
        "entrada" => [1500, 2500, 3500, 3000, 2500, 2500],
        "saida" => [2000, 1800, 2500, 1450, 2000, 1500]
    ];

    echo json_encode($data);

?>