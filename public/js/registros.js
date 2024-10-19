function waitForElement(querySelector, callback){
    let poops = setInterval(() => {
        if(document.querySelector(querySelector)){
            callback();
        }
    }, 100);
}

waitForElement("#form-saida", () => {
    const formGasto = document.querySelector("#form-saida");
    const categoriaNome = document.querySelector("#categoriaNome");

    let interval = setInterval(() => {
        if(categoriaDespesa.value === "Outros"){
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

            await ajaxCreateCategoria(categoriaDespesa).then(data => {
                console.log(data);
                idCategoria = data;
            });
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

        clearInterval();

});

waitForElement("#form-entrada", () => {

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

    clearInterval();
})

//criar categoria ao escolher outros em categoria e retorna o id da categoria criada
async function ajaxCreateCategoria(categoriaNome){
    let response = await fetch("/../src/controllers/controle_categoria.php?" + new URLSearchParams({nome_categoria: categoriaNome,}).toString());

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

    if(!response.ok){
        console.log(response.status);
    }
    
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

    if(!response.ok){
        console.log(response.status);
    }
    
    document.querySelector(".sucesso-entrada").hidden = false;  
    setTimeout(() => {
    document.querySelector(".sucesso-entrada").hidden = true;
    }, 3000);
    
}

async function excluirEntrada(id, valor) {
    let response = await fetch("/../src/controllers/excluir.php?entrada="+id+"&valor="+valor);
    let data = await response.text();

    if(data = "ok") {
        let response = await fetch("/../src/controllers/controle_tabela.php");
        let data = await response.text();

        document.querySelector(".table-registros").innerHTML = data;
    }
}

async function excluirSaida(id, valor) {
    let response = await fetch("/../src/controllers/excluir.php?saida="+id+"&valor="+valor);
    let data = await response.text();

    if(data = "ok") {
        let response = await fetch("/../src/controllers/controle_tabela.php");
        let data = await response.text();

        document.querySelector(".table-registros").innerHTML = data;
    }
}


