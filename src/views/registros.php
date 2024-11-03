<?php
if(!isset($_SESSION["id_usuario"])){
  session_start();
}
?>
<div class="container-fluid d-flex flex-wrap p-2 flex-registros">
    <div class="text-registros">
      <div class="title text-start">
        <div class="d-flex align-items-center div-info">
          <h1>Vamos lá!</h1>
          <i class="bi bi-info-circle info" data-bs-toggle="offcanvas" data-bs-target="#info-container" aria-controls="info-container"></i>
        </div>
        <p>Registre sua despesa ou entrada e mantenha suas finanças em dia</p>
      </div>
        
        <img src="./images/lembrete.svg" alt="lembrete" class="lembrete">
        <h3>Lembrete</h3>
        <p>Antes de comprar, pergunte-se: isso é uma necessidade ou um desejo?</p>

        <!-- Info -->
      <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="info-container" aria-labelledby="tituloInfo">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="tituloInfo">Registros</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <p>Try scrolling the rest of the page to see this option in action.</p>
        </div>
      </div>

        <div class="modal fade" id="modal-escolha" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-form">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Selecione o tipo de registro:</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center escolha">
                      <button class="btn btn-despesa" data-bs-target="#modal-despesa" data-bs-toggle="modal">Despesa</button>
                      <button class="btn" data-bs-target="#modal-entrada" data-bs-toggle="modal">Entrada</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal despesa -->
        <div class="modal fade" id="modal-despesa" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-form">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Registrar Despesa</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- FORMULARIO DESPESA -->
                        <form class="form-despesa text-start" id="form-saida">
                          <div class="mb-3">
                            <label for="nomeDespesa" class="form-label">Nome da Despesa</label>
                            <input type="text" class="form-control form-despesa-input" id="nomeDespesa" required>
                          </div>
                          <div class="mb-3">
                            <label for="categoriaDespesa" class="form-label">Categoria da Despesa</label>
                            <select class="form-select form-despesa-input" aria-label="Default select example" id="categoriaDespesa" required>
                              <option selected disabled>Selecione</option>
                              <?php
                                spl_autoload_register(function ($class_name) {
                                  include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
                                });

                                $id = $_SESSION["id_usuario"];
                                $categorias = new Categoria("tech_finance1", "localhost", "root", "");

                                $data = $categorias->getAllCategoria($id);

                                if(count($data) > 0) {
                                  for($i = 0; $i < count($data); $i++){
                                    foreach($data[$i] as $key => $value){
                                      if($key == "usuario_id_usuario"){
                                        if($value == null){
                                          $tipo = "padrao";
                                        } else $tipo = "usuario";
                                      }
                                      if($key == "nome"){
                                        $nome = $value;
                                      }
                                      if($key == "id"){
                                        $id = $value;
                                      }
                                    }

                                    echo "<option value='$nome' data-tipo='$tipo' data-id='$id'>$nome</option>";
                                  }
                                }
                              ?>

                              <option value="Outros">Outros</option>
                            </select>
                          </div>
                          <div class="mb-3" id="categoriaNome" hidden>
                              <label for="textCategoria" class="form-label">Nome da Categoria</label>
                              <input type="text" class="form-control form-despesa-input" id="textCategoria" >
                          </div>
                          <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <div class="input-group">
                              <span class="input-group-text form-text-input-despesa" id="addon-wrapping">R$</span>
                              <input type="number" step="0.01" min="0" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valor" required>
                            </div>
                          </div>
                        </form>
                        <div class="sucesso-registro text-center" style="color: #DE6771" hidden>Despesa registrada!</div>
                    </div>
                    <div class="modal-footer border-0">
                        
                        <input type="submit" class="btn btn-despesa" value="Registrar" form="form-saida"></input>
                    </div>
                </div>
            </div>
        </div> 
        <!-- modal entrada-->                   
        <div class="modal fade" id="modal-entrada" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-form">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Registrar Entrada</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- FORMULARIO DA ENTRADA -->
                    <div class="modal-body">

                    <form class="text-start" id="form-entrada">
                      <div class="mb-3">
                          <label for="nomeEntrada" class="form-label">Nome da Entrada</label>
                          <input type="text" class="form-control form-despesa-input" id="nomeEntrada" required>
                          </div>
                        <div class="mb-3">
                          <label for="valorEntrada" class="form-label">Valor</label>
                          <div class="input-group">
                            <span class="input-group-text form-text-input" id="addon-wrapping">R$</span>
                            <input type="number" step="0.01" min="0" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valorEntrada" required>
                          </div>
                        </div>
                    </form>
                    <div class="sucesso-entrada text-center" hidden>Entrada registrada!</div>
                    <div class="negado-entrada" hidden>Preencha todos os campos!</div>
                    </div>
                    <div class="modal-footer border-0">
                        <input type="submit" class="btn" value="Registrar" form="form-entrada"></input>
                        <!--<button type="button" class="btn" form="form-entrada" id="registro-entrada">Registrar</button>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button class="btn" data-bs-target="#modal-escolha" data-bs-toggle="modal" id="modal-registrar">Registrar</button>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-hover flex-grow-1 flex-shrink-1" id="main-table">
      
  <thead>
    <div class="text-center" style="font-weight: 600; font-size: 14px;">Últimos Registros</div>
    <tr>
      <th scope="col">N&deg;</th>
      <th scope="col">Tipo</th>
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>
      <th scope="col">Valor</th>
      <th scope="col">Data da Transação</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody class="table-registros">
    <?php
      include "../../src/controllers/controle_tabela.php";

    ?>

  </tbody>
</table>

    </div>
</div>





