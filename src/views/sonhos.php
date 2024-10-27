<div class="container-fluid d-flex flex-wrap p-2">
    <div class="sonhos">
        <h1>Sonhos de Consumo</h1>
        <p>Acompanhe o progresso dos seus sonhos. Pequenas mudanças hoje podem fazer uma grande diferença amanhã!</p>

        <ol class="list-group">

                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-start">
                            
                                <div class="ms-2 me-auto">
                                <div class="fw-bold">Reduzir gastos com a R$ </div>
                                <div class="progress-stacked">

                                    <div class="progress" role="progressbar" aria-label="Segment one" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                        <div class="progress-bar fw-bold primary-green" style="font-size: 10px;">R$</div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div>
                                <span class="badge rounded-pill">% para o limite</span>
                                    <!-- trigger modal -->
                                <i class="bi bi-three-dots" data-bs-toggle="modal" data-bs-target="#detalhesModal" style="cursor: pointer;"></i>
                                    <!-- Modal status meta-->
                                <div class="modal fade" id="detalhesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content modal-metas">
                                    <div class="modal-header" style="border: none;">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel" >Detalhes</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"></li>
                                            <li class="list-group-item">Você usou <strong>%</strong> do seu limite.</li>
                                            <li class="list-group-item">Data limite: <br>
                                                Restam dias.
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
                                        
                                                        <li class="list-group-item">
                                
                                                        </li>

                    
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
                                <label for="descricao-meta" class="form-label">Título do sonho</label>
                                <textarea class="form-control form-despesa-input" id="descricao-meta" rows="2"></textarea>
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
                        <div class="sucesso-meta text-center" hidden>Sonho registrado!</div>
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

