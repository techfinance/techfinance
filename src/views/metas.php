<?php
if(!isset($_SESSION["id_usuario"])){
  session_start();
}
?>
<div class="container-fuid d-flex flex-wrap p-2 container-metas">

    <!-- REGISTRO DAS METAS CRIADAS -->
    <div class="metas">
        <h1>Suas Metas</h1>
        <p>Acompanhe seu progresso e mantenha-se motivado, pois cada passo é importante na sua
        jornada rumo a uma vida financeira saudável!</p>

        <ol class="list-group list-group-numbered">
                <?php
                    spl_autoload_register(function ($class_name) {
                        include "$_SERVER[DOCUMENT_ROOT]/src/models/" . $class_name . '.php';
                      });

                    $id_usuario = $_SESSION["id_usuario"];
                    $metas = new Meta("tech_finance1", "localhost", "root", "");
                    
                    $dados = $metas->getMetas($id_usuario);

                    // CRIAÇÃO DA LISTA DE METAS EM PROGRESSO
                    if(count($dados) > 0){
                        for($i = 0; $i < count($dados); $i++){
                            if($dados[$i]["META_STATUS"] == "progresso"){

                            $valorMeta = $dados[$i]["VALOR"];
                            $descricaoMeta = $dados[$i]["DESCRICAO"];
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
                                        <div class="progress-bar <?php echo $classPercent ?> fw-bold" style="font-size: 10px;">R$<?php echo number_format($somaSaidas,2,",",".") ?></div>
                                    </div>
                                    <div class="progress" role="progressbar" aria-label="Segment two" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentRest; ?>%">
                                        <div class="progress-bar bg-dark fw-bold" style="font-size: 10px;">R$<?php echo number_format($valorDiff,2,",",".") ?></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="badge <?php echo $classPercent ?> rounded-pill"><?php echo round($percentRest); ?>% para o limite</span>
                                    <!-- Button trigger modal -->
                                <i class="bi bi-three-dots" data-bs-toggle="modal" data-bs-target="#detalhesModal<?php echo $i?>" style="cursor: pointer;"></i>
                                    <!-- Modal -->
                                <div class="modal fade" id="detalhesModal<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content modal-metas">
                                    <div class="modal-header" style="border: none;">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel" >Detalhes</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><?php echo $descricaoMeta; ?></li>
                                            <li class="list-group-item">Restam <?php 
                                                $now = time(); // data atual
                                                $your_date = strtotime($dados[$i]["META_DATA"]);
                                                $datediff = $now - $your_date;
                                                echo round($datediff / (60 * 60 * 24))*-1;  
                                            ?> dias</li>
                                            <li class="list-group-item">Data limite: <?php 
                                            $data_edit = DateTime::createFromFormat('Y-m-d', $dados[$i]["META_DATA"]);
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
                        }  ?>

                        <a href="#" data-bs-toggle="modal" data-bs-target="#metas-concluidas" id="botao-metas-concluidas">
                        Metas Concluídas
                        </a>
                        <!-- Modal concluídas -->
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
                                                            echo "<br> <strong>Data de criação: </strong>".$dados[$i]["data_criacao"];
                                                            echo "<br> <strong>Data de conclusão: </strong>".$dados[$i]["META_DATA"];
                                                            echo "<br> <strong>Status da meta: </strong>".$dados[$i]["META_STATUS"]
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
        </ol>
    </div>
    

    <!-- registrar metas -->
    <div class="registro-metas">
        <h3>Registre sua nova meta</h3>
        <p>Cada meta é uma conquista no seu caminho financeiro!</p>

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-form">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Registrar Meta</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- FORMULARIO META -->
                        <form class="form-despesa text-start" id="form-metas">
                            <div class="mb-3">
                                <label for="categoriaDespesa" class="form-label">Categoria da Meta</label>
                                <select class="form-select form-despesa-input" aria-label="Default select example" id="categoria-meta" required>
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
        
                                            echo "<option value='$nome' class='categorias' data-tipo='$tipo' data-id='$id'>$nome</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="valor-meta" class="form-label">Valor máximo</label>
                                <div class="input-group">
                                    <span class="input-group-text form-text-input" id="addon-wrapping">R$</span>
                                    <input type="number" step="0.01" min="0" class="form-control form-despesa-input" aria-label="Value" aria-describedby="addon-wrapping" id="valor-meta" required>
                                </div>
                            </div>
                          <div class="mb-3">
                            <label for="nomeDespesa" class="form-label">Data limite</label>
                            <input type="date" class="form-control form-despesa-input" id="data-meta" min="<?php echo date('Y-m-d');  ?>" required>
                          </div>
                          <div class="mb-3">
                                <label for="descricao-meta" class="form-label">Descrição adicional</label>
                                <textarea class="form-control form-despesa-input" id="descricao-meta" rows="2"></textarea>
                            </div>
                        </form>
                        <div class="sucesso-meta text-center" hidden>Meta registrada!</div>
                    </div>
                    <div class="modal-footer border-0">
                        <input type="submit" class="btn" value="Registrar" form="form-metas"></input>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" id="modal-registrar">Registrar</button>
    </div>
    
</div>

