<?php
if(!isset($_SESSION["id_usuario"])){
  session_start();
}
?>
<div class="container-fluid d-flex flex-wrap p-2 flex-registros">
    <div class="text-registros">
      <div class="title text-start">
        <h1>Vamos lá!</h1>
        <p>Registre sua despesa ou entrada e mantenha suas finanças em dia</p>
      </div>
        
        <img src="./images/lembrete.svg" alt="lembrete">
        <h3>Lembrete</h3>
        <p>Antes de comprar, pergunte-se: isso é uma necessidade ou um desejo?</p>

        <!-- Button trigger modal -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" data-bs-backdrop="static">
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
                              <option value="Geral">Geral</option>
                              <option value="Lazer">Lazer</option>
                              <option value="Alimentação">Alimentação</option>
                              <option value="Transporte">Transporte</option>
                              <option value="Saúde">Saúde</option>
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
                              <span class="input-group-text form-text-input" id="addon-wrapping">R$</span>
                              <input type="number" step="0.01" min="0" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valor">
                            </div>
                          </div>
                        </form>
                        <div class="sucesso-registro text-center" hidden>Despesa registrada!</div>
                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Entrada</button>
                        <input type="submit" class="btn" value="Registrar" form="form-saida"></input>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" data-bs-backdrop="static">
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
                        <button class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Despesa</button>
                        <button type="button" class="btn" form="form-entrada" id="registro-entrada">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="modal-registrar">Registrar</button>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-hover flex-grow-1 flex-shrink-1">
      
  <thead>
  <tr><th colspan="7" class="text-center" style="font-weight: 600;">Últimos Registros</th></tr>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tipo</th>
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>
      <th scope="col">Valor</th>
      <th scope="col">Data da Transação</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      spl_autoload_register(function ($class_name) {
        include '../../src/models/' . $class_name . '.php';
      });

      $registrar = new Registro("tech_finance1", "localhost", "root", "");
      $dados = $registrar->getAllRegistros($_SESSION["id_usuario"]);

      if(count($dados) > 0){
        for($i = 0; $i < 10; $i++){
          echo "<tr>";
          echo "<td>$i</td>";
          foreach($dados[$i] as $key => $value){
            if($value == NULL){
              echo "<td>-</td>";
              continue;
            }

            if($key == "valor") {
              echo"<td>R$ ".number_format($value,2,",",".")."</td>";
              continue;
            }
  
            if($key == "data_transacao"){
              $data_edit = DateTime::createFromFormat('Y-m-d', $value);
              echo "<td>".$data_edit->format('d/m/Y')."</td>";
              continue;
            }
  
            echo "<td>$value</td>";
          }
          echo "<td><i class='bi bi-trash-fill'></i></td>";
          echo "</tr>";
        }



      }

    ?>

  </tbody>
</table>


    </div>
</div>





