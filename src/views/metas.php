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

        <ol class="list-group">
            <?php include "lista_metas.php" ?>
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

