<?php if(!isset($_SESSION["id_usuario"])) session_start(); ?>
<div class="conainer-fluid p-2">
    <h1>Configurações</h1>
    <div>
        <h5>Excluir categoria criada</h5>
        <form id="form-excluir">
        <div class="mb-3">
            <select class="form-select select-config" aria-label="Default select example" id="categoria-excluir-cat" required>
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
                        } if($tipo == "usuario"){
                            echo "<option value='$nome' class='categorias' data-id='$id'>$nome</option>";
                        }

                        }
                    }
                ?>
            </select>
        </div>
        <input type="submit" class="btn" value="Excluir" form="form-excluir-cat"></input>
        </form>
    </div>
    


</div>