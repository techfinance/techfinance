<?php
    spl_autoload_register(function ($class_name) {
        include "../../src/models/$class_name.php";
    });

    session_start();
    $id = $_SESSION["id_usuario"];

    $query = new Meta("tech_finance1", "localhost", "root", "");

    if(isset($_GET["id_meta"])){
        $meta = $_GET["id_meta"];
        $user = $_GET["id_usuario"];
        $query->deleteMeta($meta, $user);
    }

    echo "ok";
?>