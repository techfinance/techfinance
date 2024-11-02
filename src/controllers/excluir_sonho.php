<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    session_start();
    $id = $_SESSION["id_usuario"];

    $query = new Sonho("tech_finance1", "localhost", "root", "");

    if(isset($_GET["id_sonho"])){
        $sonho = $_GET["id_sonho"];
        $user = $_GET["id_usuario"];
        $query->deleteSonho($sonho, $user);
    }
    echo "ok";
?>