<?php
if(!isset($_SESSION["id_usuario"])){
  session_start();
}
?>
<!-- Info -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="info-container" aria-labelledby="tituloInfo">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="tituloInfo">Sonhos de Consumo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Info texto -->
        <p>Nesta tela, você pode criar e gerenciar seus sonhos de consumo, que são objetivos a longo prazo, como a compra de um carro ou de uma casa.</p>
        <p>Para registrar um sonho, basta inserir o nome do objetivo, o valor que deseja atingir e a data em que pretende concluir essa meta. O sistema levará em consideração o saldo da sua carteira e calculará automaticamente as parcelas mensais que você precisará guardar para alcançar seu sonho dentro do prazo estabelecido.</p>
        <p>Assim como nas metas, você terá a opção de visualizar os sonhos que já foram concluídos, permitindo acompanhar seu progresso e celebrar suas conquistas.</p>
        <p>Use esta funcionalidade para transformar seus sonhos em realidade e planejar seu futuro financeiro com confiança!</p>
    </div>
</div>

<div class="container-fluid d-flex flex-wrap p-2">
    <div class="sonhos">
        <div class="d-flex align-items-center div-info">
            <h1>Sonhos de Consumo</h1>
            <i class="bi bi-info-circle info" data-bs-toggle="offcanvas" data-bs-target="#info-container" aria-controls="info-container"></i>
        </div>
        <p>Acompanhe o progresso dos seus sonhos. Pequenas mudanças hoje podem fazer uma grande diferença amanhã!</p>

        <ol class="list-group" id="list-sonhos">
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
                                <input class="form-control form-despesa-input" id="descricao-sonho" required>
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