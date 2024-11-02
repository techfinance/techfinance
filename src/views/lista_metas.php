<?php
    spl_autoload_register(function ($class_name) {
        include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
        });

    $id_usuario = $_SESSION["id_usuario"];
    $metas = new Meta("tech_finance1", "localhost", "root", "");
    
    $dados = $metas->getMetas($id_usuario);

    // criação da lista das metas em progresso
    if(count($dados) > 0){
        for($i = 0; $i < count($dados); $i++){
            if($dados[$i]["META_STATUS"] == "progresso"){

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
            } else {
                $classPercent = "bg-danger";
            }

            // se ultrapassar limite
            if($somaSaidas > $valorMeta){
                $metas->setMetaNaoConcluida($dados[$i]["ID_META"], $id_usuario);
                continue;
            }

            //se alcançar data limite
            if($dados[$i]["META_DATA"] == $date) {
                $metas->setMetaConcluida($dados[$i]["ID_META"], $id_usuario);
                continue;
            }

            ?>


        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-start">
            
                <div class="ms-2 me-auto">
                <div class="fw-bold">Reduzir gastos com <?php
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
                    <div class="modal-content modal-metas">
                    <div class="modal-header" style="border: none;">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" >Detalhes</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item"><?= $descricaoMeta; ?></li>
                            <li class="list-group-item">Você usou <strong><?= round($percentDiff) ?>%</strong> do seu limite.</li>
                            <li class="list-group-item">Data limite: <?php 
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
                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none;">Fechar</button>
                    </div>
                    </div>
                </div>
                </div>
            </div> 
        </li>
        <?php  }
        }  ?>

        <a href="#" data-bs-toggle="modal" data-bs-target="#metas-concluidas" id="botao-metas-concluidas">
        Metas Finalizadas
        </a>
        <!-- Modal concluidas -->
        <div class="modal fade" id="metas-concluidas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog scrollable">
                <div class="modal-content modal-metas">
                    <div class="modal-header" style="border: none;">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Metas Concluídas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <?php

                                //METAS CONCLUIDAS OU NÃO ATINGIDAS
                                for($i = 0; $i < count($dados); $i++){
                                    if($dados[$i]["META_STATUS"] == "concluido" || $dados[$i]["META_STATUS"] == "nao concluido"){
                                        $valorMeta = $dados[$i]["VALOR"];
                                        $descricaoMeta = $dados[$i]["DESCRICAO"];
                                        
                                    ?>
                                        <li class="list-group-item">
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