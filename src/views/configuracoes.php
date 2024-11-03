<?php if(!isset($_SESSION["id_usuario"])) session_start(); ?>
<div class="conainer-fluid p-2 container-config">
    <h1>Configurações</h1>
    <div class="container-fluid">
        <h5>Excluir categoria criada</h5>
        <form id="form-excluir" action="../../src/controllers/excluir_categoria.php" method="GET">
            <select class="form-select select-config" aria-label="Default select example" id="categoria-excluir-cat" name="categoria" required>
                <option value="" disabled selected hidden>Selecione...</option>
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
                        } if($tipo == "usuario"){
                            echo "<option value='$id'>$nome</option>";
                        }

                        }
                    }
                ?>
            </select>
            
        </form>
        <button class="btn btn-messages" data-bs-target="#excluirCat" data-bs-toggle="modal" style="margin-top: 10px; font-size: 14px;">Excluir</button>

        <div class="modal fade" id="excluirCat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-metas modal-form">
                    <div class="modal-header" style="border: none;">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" >Tem certeza que deseja excluir a categoria?</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Todos os registros e metas relacionados a esta categoria serão apagados.</p>
                    </div>
                    <div class="modal-footer" style="border: none;">
                        <!-- Excluir categoria -->
                        <input type="submit" class="btn btn-despesa" value="Excluir" form="form-excluir" style="margin: 0;"></input>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>