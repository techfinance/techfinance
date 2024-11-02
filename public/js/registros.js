function createTable() {
        if($.fn.dataTable.isDataTable('#main-table')){
            $('#main-table').dataTable();
        } else {
            $('#main-table').dataTable({
                "language": {          
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        }
                },
                "pagingType": "simple_numbers",
                lengthMenu: [ 10, 15, 25, 50 ],
                ordering: false,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                  }]
            });
        }
}

function formSaida() {
    const formGasto = document.querySelector("#form-saida");
    const categoriaNome = document.querySelector("#categoriaNome");
    const categoria = document.querySelector("#categoriaDespesa");

    const interval = setInterval(() => {
        if(categoria.value === "Outros"){
            categoriaNome.hidden = false;
        } else {
            categoriaNome.hidden = true;
        }
    }, 100);

    formGasto.addEventListener("submit", async (e) => {
        e.preventDefault();

        const categoria = document.querySelector("#categoriaDespesa");
        
        let nomeDespesa = document.querySelector("#nomeDespesa").value;
        let categoriaDespesa = categoria.value;
        let valor = document.querySelector("#valor").value;
        let nomeCategoria = document.querySelector("#textCategoria");
        let tipoCategoria = categoria.options[categoria.selectedIndex]?.dataset.tipo;
        let idCategoria = categoria.options[categoria.selectedIndex]?.dataset.id;

        if(categoriaDespesa === "Outros"){
            categoriaDespesa = nomeCategoria.value;
            tipoCategoria = "usuario";
            try {
                idCategoria = await ajaxCreateCategoria(categoriaDespesa);
            } catch (error) {
                console.error('Erro ao criar categoria:', error);
                return;
            }
            
        }

        document.querySelector("#nomeDespesa").value = "";
        document.querySelector("#categoriaDespesa").value = "";
        document.querySelector("#valor").value = "";
        categoriaNome.value = "";

        await ajaxGastos(nomeDespesa, categoriaDespesa, valor, tipoCategoria, idCategoria).finally(async () => {
            let response = await fetch("/../src/controllers/controle_tabela.php");
            let data = await response.text();

            document.querySelector(".table-registros").innerHTML = data;
        })

    });
}

function formEntrada() {

    const formEntrada = document.querySelector("#form-entrada");

    formEntrada.addEventListener("submit", (e) => {
        e.preventDefault();

        const nomeEntrada = document.querySelector("#nomeEntrada").value;
        const valorEntrada = document.querySelector("#valorEntrada").value;
        document.querySelector("#nomeEntrada").value = "";
        document.querySelector("#valorEntrada").value = "";

        ajaxEntrada(nomeEntrada, valorEntrada).finally(async () => {
            let response = await fetch("/../src/controllers/controle_tabela.php");
            let data = await response.text();

            document.querySelector(".table-registros").innerHTML = data;
        })
    });

}

//criar categoria ao escolher outros em categoria e retorna o id da categoria criada
async function ajaxCreateCategoria(categoriaNome){
    let response = await fetch("/../src/controllers/controle_categoria.php?" + new URLSearchParams({nome_categoria: categoriaNome,}).toString());

    if(!response.ok){
        console.log(response.status);
        throw new Error('Falha ao criar categoria');
    }

    let data = await response.text();
    return data;
}


async function ajaxGastos(nomeDespesa, categoriaDespesa, valor, tipo, id) {
    let response = await fetch("/../src/controllers/controle_gasto.php?" + new URLSearchParams({
        nome: nomeDespesa,
        categoria: categoriaDespesa,
        valor: valor,
        tipo: tipo,
        id: id,
    }).toString());

    if(!response.ok)
        console.log(response.status);
    
    document.querySelector(".sucesso-registro").hidden = false;
    setTimeout(() => {
        document.querySelector(".sucesso-registro").hidden = true;
    }, 3000);
}


async function ajaxEntrada(nomeEntrada, valor) {
    let response = await fetch("/../src/controllers/controle_entrada.php?" + new URLSearchParams({
        nome: nomeEntrada,
        valor: valor
    }).toString());

    if(!response.ok)
        console.log(response.status);
    
    document.querySelector(".sucesso-entrada").hidden = false;  
    setTimeout(() => {
    document.querySelector(".sucesso-entrada").hidden = true;
    }, 3000);
    
}

async function excluirEntrada(id, valor) {
    let response = await fetch("/../src/controllers/excluir_registro.php?entrada="+id+"&valor="+valor);
    let data = await response.text();

    if(data = "ok") {
        let response = await fetch("/../src/controllers/controle_tabela.php");
        let data = await response.text();

        document.querySelector(".table-registros").innerHTML = data;
    }
}

async function excluirSaida(id, valor) {
    let response = await fetch("/../src/controllers/excluir_registro.php?saida="+id+"&valor="+valor);
    let data = await response.text();

    if(data = "ok") {
        let response = await fetch("/../src/controllers/controle_tabela.php");
        let data = await response.text();

        document.querySelector(".table-registros").innerHTML = data;
    }
}


