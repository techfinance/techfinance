<?php
    spl_autoload_register(function ($class_name) {
        include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
        });

    if(!isset($_SESSION["id_usuario"])) session_start();

    $id_usuario = $_SESSION["id_usuario"];
    $metas = new Meta("tech_finance1", "localhost", "root", "");
    
    $dados = $metas->getMetas($id_usuario);

    // criação da lista das metas em progresso
    if(count($dados) > 0){
        for($i = 0; $i < count($dados); $i++){
            if($dados[$i]["META_STATUS"] == "progresso"){

            $id_meta = $dados[$i]["ID_META"];
            $valorMeta = $dados[$i]["VALOR"];
            $descricaoMeta = $dados[$i]["META_DESCRICAO"];
            $somaSaidas = $metas->getSomaSaidas($dados[$i]["ID_META"], $id_usuario);
            $valorDiff = $valorMeta - $somaSaidas;
            $percentDiff = $somaSaidas / $valorMeta * 100;
            $percentRest = 100 - $percentDiff;
            $date = date('Y-m-d');

            $classPercent = "";

            if($percentRest >= 70){
                $classPercent = "primary-green";
            } else if($percentRest < 70 && $percentRest >= 25){
                $classPercent = "bg-warning";
            } else if($percentRest < 25) {
                $classPercent = "bg-secondary-red";
            }

            // se ultrapassar limite
            if($somaSaidas > $valorMeta){
                $metas->setMetaNaoConcluida($id_meta, $id_usuario);
                continue;
            }

            //se alcançar data limite
            if($dados[$i]["META_DATA"] == $date) {
                $metas->setMetaConcluida($id_meta, $id_usuario);
                continue;
            }

            ?>


        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-start">
            
                <div class="ms-2 me-auto">
                <div class="fw-bold">Limitar gastos com <?php
                    $categoria = new Categoria("tech_finance1", "localhost", "root", "");
                    $data = $categoria->getCategoriaName($dados[$i]["Categoria_ID_CATEGORIA"], $dados[$i]["CategoriaU_ID_CATEGORIAU"], $id_usuario);
                    echo $data["nome_categoria"];
                ?> a R$ <?php echo number_format($valorMeta,2,",",".") ?></div>
                <div class="progress-stacked">

                    <div class="progress" role="progressbar" aria-label="Segment one" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentDiff; ?>%">
                        <div class="progress-bar <?= $classPercent ?> fw-bold" style="font-size: 10px;">R$<?php echo number_format($somaSaidas,2,",",".") ?></div>
                    </div>
                    <div class="progress" role="progressbar" aria-label="Segment two" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentRest; ?>%">
                        <div class="progress-bar bg-dark fw-bold" style="font-size: 10px;">R$<?php echo number_format($valorDiff,2,",",".") ?></div>
                    </div>
                </div>
            </div>
            <div>
                <span class="badge <?= $classPercent ?> rounded-pill"><?= round($percentRest); ?>% para o limite</span>
                    <!-- trigger modal -->
                <i class="bi bi-three-dots" data-bs-toggle="modal" data-bs-target="#detalhesModal<?= $i?>" style="cursor: pointer;"></i>
                    <!-- Modal status meta-->
                <div class="modal fade" id="detalhesModal<?= $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-metas modal-form">
                    <div class="modal-header" style="border: none;">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" ><?= $descricaoMeta; ?></h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-modal">Você usou <strong><?= round($percentDiff) ?>%</strong> do seu limite.</li>
                            <li class="list-group-item list-group-item-modal">Data limite: <?php 
                            $data_edit = DateTime::createFromFormat('Y-m-d', $dados[$i]["META_DATA"]);
                            echo $data_edit->format('d/m/Y');
                            ?><br>
                                Restam <?php 
                                $now = time(); // data atual
                                $your_date = strtotime($dados[$i]["META_DATA"]);
                                $datediff = $now - $your_date;
                                echo round($datediff / (60 * 60 * 24))*-1;  
                            ?> dias.
                        </li>
                        </ul>

                    </div>
                    <div class="modal-footer" style="border: none; font-size: 24px;">
                        <i class='bi bi-pencil-square' style='cursor: pointer;' data-bs-target="#editar<?= $i?>" data-bs-toggle="modal"></i>
                        <i class='bi bi-trash-fill' style='cursor: pointer; color:var(--secondary-red);' data-bs-target="#excluir<?= $i?>" data-bs-toggle="modal"></i>
                    </div>
                    </div>
                </div>
                </div>

                <div class="modal fade" id="excluir<?= $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content modal-metas modal-form">
                            <div class="modal-header" style="border: none;">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" >Tem certeza que deseja excluir a meta?</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <div class="modal-footer" style="border: none;">
                                <button class="btn btn-primary-blue" data-bs-target="#detalhesModal<?= $i?>" data-bs-toggle="modal" style='cursor: pointer;'>Voltar</button>
                                <!-- Excluir meta -->
                                <button class="btn btn-despesa" data-bs-dismiss="modal" onclick="excluirMeta(<?= $id_meta ?>, <?= $id_usuario ?>)">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editar<?= $i?>" tabindex="-1" aria-labelledby="editMeta" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content modal-metas modal-form">
                            <div class="modal-header" style="border: none;">
                                <h1 class="modal-title fs-5" id="editMeta" >Ajustar limite</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-despesa" id="form-update-metas" data-id="<?= $id_meta ?>">
                                    <div class="mb-3">
                                        <label for="valor-meta" class="form-label">Valor máximo</label>
                                        <div class="input-group">
                                            <span class="input-group-text form-text-input" id="addon-wrapping">R$</span>
                                            <input type="number" step="0.01" min="1" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valor-meta-update<?= $i ?>" required>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer" style="border: none;">
                                <button class="btn btn-primary-blue" data-bs-target="#detalhesModal<?= $i?>" data-bs-toggle="modal" style='cursor: pointer;'>Voltar</button>
                                <!-- Editar meta -->
                                <button class="btn" data-bs-dismiss="modal" onclick="formUpdateMeta(<?= $id_meta ?>, document.querySelector('#valor-meta-update<?= $i ?>').value)">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div> 
        </li>
        <?php  }
        }  ?>


        <button type="button" class="btn-messages btn position-relative" data-bs-toggle="modal" data-bs-target="#metas-concluidas">
        Finalizadas
            <?php 
                $count = 0;
                foreach($dados as $key){
                    if($key["META_STATUS"] !== "progresso") $count++;
                }
                if($count > 0) { 
            ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notifications">
                    <?= $count ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            <?php
                }
            ?>
            
        </button>
        <!-- Modal concluidas -->
        <div class="modal fade" id="metas-concluidas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog scrollable">
                <div class="modal-content modal-metas modal-form">
                    <div class="modal-header" style="border: none;">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Metas Concluídas</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <?php

                                //METAS CONCLUIDAS OU NÃO ATINGIDAS
                                for($i = 0; $i < count($dados); $i++){
                                    if($dados[$i]["META_STATUS"] == "concluido" || $dados[$i]["META_STATUS"] == "nao concluido"){
                                        $valorMeta = $dados[$i]["VALOR"];
                                        $descricaoMeta = $dados[$i]["META_DESCRICAO"];
                                        
                                    ?>
                                        <li class="list-group-item list-group-item-modal">
                                            <?php 
                                            $categoria = new Categoria("tech_finance1", "localhost", "root", "");
                                            $data = $categoria->getCategoriaName($dados[$i]["Categoria_ID_CATEGORIA"], $dados[$i]["CategoriaU_ID_CATEGORIAU"], $id_usuario);
                                            
                                            echo "R$ ".number_format($valorMeta,2,",",".")." com ". $data["nome_categoria"] ."<br><strong>Descrição: </strong>".$descricaoMeta;
                                            echo "<br> <strong>Data de criação: </strong>".$dados[$i]["META_DATACRIACAO"];
                                            echo "<br> <strong>Data de conclusão: </strong>".$dados[$i]["META_DATA"];
                                            if($dados[$i]["META_STATUS"] == "concluido"){
                                                echo "<br> <strong>Status da meta: </strong>"."<span style='font-weight: 600; color: #29C292;'>Concluída</span>";
                                            } else if($dados[$i]["META_STATUS"] == "nao concluido"){
                                                echo "<br> <strong>Status da meta: </strong>"."<span class='text-danger' style='font-weight: 600'>Não Concluída</span>";
                                            }
                                            
                                            ?>
                                        </li>

                            <?php  }
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
<?php 
    } else {
        echo "<p>Não há registros</p>";
    }
?>