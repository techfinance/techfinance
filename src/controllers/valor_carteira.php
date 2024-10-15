<?php
 spl_autoload_register(function ($class_name) {
    include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
  });

  $carteira = new Carteira("tech_finance1", "localhost", "root", "");

  $valor =  $carteira->valorCarteira($_SESSION["id_usuario"]);
  echo "R$ ".number_format($valor,2,",",".");

?>