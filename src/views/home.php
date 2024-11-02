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
        <?php
          $id = $_SESSION["id_usuario"];
          $metas = new Meta("tech_finance1", "localhost", "root", "");

          $total_metas = $metas->getMetasEmProgresso($id);
          if(count($total_metas) > 0){
            echo "<p>Você tem ".count($total_metas)." meta(s) em progresso</p>";
          } 
          else echo "Vamos lançar sua primeira meta!";
        ?>
        <a href="#" class="homeMetas" onclick="getPage('metas')" style="color: var(--primary-green);font-weight: 600"><i class="bi bi-bullseye"></i> Conferir metas</a>
      </div>

    </div>
    <div class="col-md">
      <h3>Seus Sonhos</h3>
      <div class="metas-home">
        <?php 
          $sonho = new Sonho("tech_finance1", "localhost", "root", "");

          $total_sonhos = $sonho->getSonhosEmProgresso($id);
          if(count($total_sonhos) > 0){
            echo "<p>Você tem ".count($total_sonhos)." sonho(s) em progresso</p>";
          } 
          else echo "Vamos em busca do seu primeiro sonho!";

        ?>
        <a href="#" class="homeMetas" onclick="getPage('sonhos')" style="color: var(--primary-green);font-weight: 600"><i class="bi bi-cloud-check"></i> Conferir sonhos </a>
      </div>
    </div>
  </div>
</div>

        
