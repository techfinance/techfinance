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
            <?php
                spl_autoload_register(function ($class_name) {
                    include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
                  });

                $id_usuario = $_SESSION["id_usuario"];
                $sonhos = new Sonho("tech_finance1", "localhost", "root", "");

                $dados = $sonhos->buscarSonho($id_usuario);
                $valor_carteira = $sonhos->valorCarteira($id_usuario);

                for($i = 0; $i < count($dados); $i++){
                    $id_sonho = $dados[$i]["ID_SONHO"];
                    $valor = $dados[$i]["VALOR"];
                    $data_fim = $dados[$i]["SONHO_DATA"];
                    $nome_sonho = $dados[$i]["SONHO_NOME"];
                    $status = $dados[$i]["SONHO_STATUS"];

                    if($status !== "progresso") continue;
                    if($valor_carteira >= $valor){
                        $sonhos->setSonhoConcluido($id_sonho, $id_usuario);
                        continue;
                    }

                    $valorDiff = $valor - $valor_carteira;
                    
                    $percentDiff = ($valor_carteira/$valor) * 100;

                    $date1 = date('Y-m-d');
                    $date2 = $data_fim;
                    $ts1 = strtotime($date1);
                    $ts2 = strtotime($date2);
                    $year1 = date('Y', $ts1);
                    $year2 = date('Y', $ts2);
                    $month1 = date('m', $ts1);
                    $month2 = date('m', $ts2);
                    $monthsDiff = (($year2 - $year1) * 12) + ($month2 - $month1);

                    $parcelas = $valorDiff / $monthsDiff;

                    
                    ?>

                <li class="list-group-item d-flex flex-wrap justify-content-between align-items-start">
                
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><?= $nome_sonho ?></div>
                    <div class="progress-stacked" style="min-width: 300px;">

                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentDiff ?>%">
                            <div class="progress-bar fw-bold primary-green" style="font-size: 10px;"><?= round($percentDiff) ?>%</div>
                        </div>
                        
                    </div>
                    <p style="font-size: 14px; margin-top: 5px;">Você deve poupar <strong>R$<?= number_format($parcelas,2,",",".") ?></strong> por mês para alcançar esse objetivo
                    </p>
                    
                </div>
                <div>
                        
                    <i class="bi bi-three-dots" data-bs-toggle="modal" data-bs-target="#detalhesModal<?= $i?>" style="cursor: pointer;"></i>
                        
                    <div class="modal fade" id="detalhesModal<?= $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content modal-metas">
                        <div class="modal-header" style="border: none;">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" >Detalhes</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item">Valor a atingir: R$<?= number_format($valor,2,",",".") ?> <br>
                                </li>
                                <li class="list-group-item">Data limite: <?php
                                    $data_edit = DateTime::createFromFormat('Y-m-d', $data_fim);
                                    echo $data_edit->format('d/m/Y');
                                ?></li>
                            </ul>
                        </div>
                        <div class="modal-footer" style="border: none;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none;">Fechar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div> 
            </li>



              <?php  }
            
            ?>

            <a href="#" data-bs-toggle="modal" data-bs-target="#metas-concluidas" id="botao-metas-concluidas">
                Sonhos Concluídos
            </a>
            <!-- Modal concluidas -->
            <div class="modal fade" id="metas-concluidas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog scrollable">
                    <div class="modal-content modal-metas">
                        <div class="modal-header" style="border: none;">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Sonhos Concluídos</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                            
                            <?php 
                                for($i = 0; $i < count($dados); $i++){
                                    $valor = $dados[$i]["VALOR"];
                                    $data_fim = $dados[$i]["SONHO_DATA"];
                                    $nome_sonho = $dados[$i]["SONHO_NOME"];
                                    $status = $dados[$i]["SONHO_STATUS"];
                                    if($status == "concluido"){?>

                                        <li class="list-group-item">
                                            Sonho: <?= $nome_sonho ?><br>
                                            Valor atingido: R$<?= number_format($valor,2,",",".") ?><br>
                                            Data: <?= $data_fim ?>
                                        </li>
                                    <?php
                                    }
                                } 
                            ?>
                            
                            </ul>
                        </div>
                        <div class="modal-footer" style="border: none;">
                            <button type="button" class="btn" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
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

