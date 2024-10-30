<?php
if(!isset($_SESSION["id_usuario"])){
  session_start();
}
?>
<div class="container-fluid d-flex flex-wrap p-2">
    <div class="sonhos">
        <h1>Sonhos de Consumo</h1>
        <p>Acompanhe o progresso dos seus sonhos. Pequenas mudanças hoje podem fazer uma grande diferença amanhã!</p>

        <ol class="list-group">
            <?php include "lista_sonhos.php" ?>
        </ol>

    </div>
    <div class="sonhos-registro">
        <h3>Registre seu sonho</h3>
        <p>Dê o primeiro passo rumo à realização dos seus desejos!</p>

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-form">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Registrar Sonho</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- FORMULARIO META -->
                        <form class="form-sonho text-start" id="form-sonho">
                            <div class="mb-3">
                                <label for="descricao-sonho" class="form-label">Título do sonho</label>
                                <textarea class="form-control form-despesa-input" id="descricao-sonho" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="valor-sonho" class="form-label">Valor a atingir</label>
                                <div class="input-group">
                                    <span class="input-group-text form-text-input" id="addon-wrapping">R$</span>
                                    <input type="number" step="0.01" min="0" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valor-sonho" required>
                                </div>
                            </div>
                          <div class="mb-3">
                            <label for="data-sonho" class="form-label">Data limite</label>
                            <input type="date" class="form-control form-despesa-input" id="data-sonho" min="<?php echo date('Y-m-d');  ?>" required>
                          </div>
                        </form>
                        <div class="sucesso-sonho text-center" hidden>Sonho registrado!</div>
                    </div>
                    <div class="modal-footer border-0">
                        <input type="submit" class="btn" value="Registrar" form="form-sonho"></input>
                    </div>
                </div>
            </div>
        </div>
        <img src="./images/lembrete.svg" alt="lembrete" class="lembrete">
        <h3>Lembrete</h3>
        <p>Sonhos se tornam realidade quando você dá o primeiro passo!</p>
        <button class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="modal-registrar">Registrar</button>
    </div>

</div>

