<?php
  spl_autoload_register(function ($class_name) {
    include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
  });

  $carteira = new Carteira("tech_finance1", "localhost", "root", "");

  $valor =  $carteira->valorCarteira($_SESSION["id_usuario"]);
  ?> 
  
  <p class="valor-carteira <?php if($valor > 0) echo "positive"; else echo "negative"?>">
    <?php echo "R$ ".number_format($valor,2,",",".");?>
  </p>
