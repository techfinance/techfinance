<h1>Vamos lá!</h1>
<p>Registre sua despesa ou entrada e mantenha suas finanças em dia</p>
<div class="container-fluid d-flex align-items-center flex-wrap p-2 flex-registros">
    <div class="text-registros">
        <img src="./images/lembrete.svg" alt="lembrete">
        <h3>Lembrete</h3>
        <p>Antes de comprar, pergunte-se: isso é uma necessidade ou um desejo?</p>

        <!-- Button trigger modal -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Registrar Gasto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Show a second modal and hide this one with the button below.
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Registrar Entrada</button>
                        <button type="button" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Registrar Entrada</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        Hide this modal and show the first with the button below.
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Registrar Gasto</button>
                        <button type="button" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="modal-registrar">Registrar</button>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-hover flex-grow-1 flex-shrink-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tipo</th>
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>
      <th scope="col">Valor</th>
      <th scope="col">Data da Transação</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Saída</td>
      <td>Alimentação</td>
      <td>Supermercado</td>
      <td>250.00</td>
      <td>2024-10-07</td>
      <td>X</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Saída</td>
      <td>Alimentação</td>
      <td>Supermercado</td>
      <td>250.00</td>
      <td>2024-10-07</td>
      <td>X</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Entrada</td>
      <td>Salário</td>
      <td>-</td>
      <td>3000.00</td>
      <td>2024-10-07</td>
      <td>X</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Entrada</td>
      <td>Salário</td>
      <td>-</td>
      <td>3000.00</td>
      <td>2024-10-07</td>
      <td>X</td>
    </tr>

  </tbody>
</table>


    </div>





</div>


