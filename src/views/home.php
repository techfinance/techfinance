<?php if(!isset($_SESSION["nome"])) session_start();?>

<div class="container-fuid p-2">
  <div class="row top-row ">
    <div class="col-md-8">
      <div class="d-flex align-items-center div-info">
        <h1>Olá, <?php echo $_SESSION["nome"]; ?>!</h1> 
        <i class="bi bi-info-circle info" data-bs-toggle="offcanvas" data-bs-target="#info-container" aria-controls="info-container"></i>
      </div>

      <p>Espero que esteja bem. Vamos dar uma olhada nas suas finanças? Veja como está seu progresso e continue no caminho certo para alcançar suas metas!</p>

      <!-- Info -->
      <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="info-container" aria-labelledby="tituloInfo">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="tituloInfo">Home</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <p>Olá, seja bem-vindo! Esta é a página inicial do seu aplicativo. Aqui, você encontrará as informações essenciais sobre o seu progresso, incluindo o saldo da sua carteira, a quantidade de metas e sonhos em andamento.</p>
          <p>Sinta-se à vontade para explorar as diversas funcionalidades do aplicativo. Descubra como acompanhar suas finanças, definir novas metas e visualizar seu progresso de forma intuitiva. Estamos aqui para ajudar você a alcançar seus objetivos financeiros!</p>
        </div>
      </div>

    </div>
    <div class="col-md-4 text-center ideia">
      <img src="./images/lamp.svg" alt="lampada" class="lampada">
      <h5 style="font-weight: 600;">Dica</h5>
      <p id="dica-home">Registre cada gasto, cada centavo conta!</p>
    </div>
  </div>
  <div class="row column-gap-4">
    <div class="col-md home-width">
    <h3>Carteira</h3>
      <div class="carteira">
        <?php 
          require_once "$_SERVER[DOCUMENT_ROOT]/src/controllers/valor_carteira.php";
        ?>
        <a href="#" id="homeRegistros" onclick="getPage('registros')">Conferir registros</a>
      </div>
    </div>
    <div class="col-md home-width">
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
    <div class="col-md home-width">
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
