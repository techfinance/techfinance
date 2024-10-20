<?php if(!isset($_SESSION["nome"])) session_start();?>

<div class="container-fuid p-2">
  <div class="row top-row ">
    <div class="col-md-8">
      <h1>Olá, <?php echo $_SESSION["nome"]; ?>!</h1>
      <p>Espero que esteja bem. Vamos dar uma olhada nas suas finanças? Veja como está seu progresso e continue no caminho certo para alcançar suas metas!</p>
    </div>
    <div class="col-md-4 text-center ideia">
      <img src="./images/lamp.svg" alt="lampada" class="lampada">
      <h5 style="font-weight: 600;">Dica do Dia</h5>
      <p>Registre cada gasto, cada centavo conta!</p>
    </div>
  </div>
  <div class="row column-gap-4">
    <div class="col-md">
    <h3>Carteira</h3>
      <div class="carteira">
        <?php 
          require_once "$_SERVER[DOCUMENT_ROOT]/src/controllers/valor_carteira.php";
        ?>
        <a href="#" id="homeRegistros" onclick="getPage('registros')">Conferir registros</a>
      </div>
    </div>
    <div class="col-md">
      <h3>Suas Metas</h3>
      <div class="metas-home">
        

      </div>

    </div>
    <div class="col-md">
      <h3>Seus sonhos</h3>
    </div>
  </div>
</div>
    

        
