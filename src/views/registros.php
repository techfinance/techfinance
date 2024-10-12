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
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Outros</option>
                            </select>
                          </div>
                          <div class="row flex align-items-center">
                            <div class="col">
                              <div class="mb-3">
                                <label for="exampleInputPassword" class="form-label">Nome da Categoria</label>
                                <input type="text" class="form-control form-despesa-input" id="exampleInputPassword" >
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check">
                                <label class="form-check-label" for="flexCheckDefault" style="font-weight: 500;">DESEJA SALVAR?</label>
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <div class="input-group">
                              <span class="input-group-text form-text-input" id="addon-wrapping">R$</span>
                              <input type="text" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valor">
                            </div>
                          </div>
                        </form>
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

                    <form action="" class="text-start">
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nome da Entrada</label>
                          <input type="text" class="form-control form-despesa-input" id="exampleInputEmail1">
                          </div>
                        <div class="mb-3">
                          <label for="valor" class="form-label">Valor</label>
                          <div class="input-group">
                            <span class="input-group-text form-text-input" id="addon-wrapping">R$</span>
                            <input type="text" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valor">
                          </div>
                        </div>
                    </form>
                    
                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Despesa</button>
                        <button type="button" class="btn">Registrar</button>
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





