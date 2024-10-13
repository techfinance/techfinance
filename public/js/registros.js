
waitForElement("#form-saida", () => {
    const formGasto = document.querySelector("#form-saida");
    const categoriaDespesa = document.querySelector("#categoriaDespesa");
    const categoriaNome = document.querySelector("#categoriaNome");

    const interval = setInterval(() => {
        if(categoriaDespesa.value === "Outros"){
            categoriaNome.hidden = false;
        } else {
            categoriaNome.hidden = true;
        }
    }, 50);

    formGasto.addEventListener("submit", (e) => {
        e.preventDefault();
        
        let nomeDespesa = document.querySelector("#nomeDespesa").value;
        let categoriaDespesa = document.querySelector("#categoriaDespesa").value;
        let valor = document.querySelector("#valor").value;
        let nomeCategoria = document.querySelector("#textCategoria")

        if(categoriaDespesa === "Outros"){
            categoriaDespesa = nomeCategoria.value;
        }

        document.querySelector("#nomeDespesa").value = "";
        document.querySelector("#categoriaDespesa").value = "";
        document.querySelector("#valor").value = "";
        categoriaNome.value = "";

        ajaxGastos(nomeDespesa, categoriaDespesa, valor);

        });

});

waitForElement("#form-entrada", () => {

    const formEntrada = document.querySelector("#registro-entrada");

    formEntrada.addEventListener("click", (e) => {
        e.preventDefault();

        const nomeEntrada = document.querySelector("#nomeEntrada").value;
        const valorEntrada = document.querySelector("#valorEntrada").value;
        document.querySelector("#nomeEntrada").value = "";
        document.querySelector("#valorEntrada").value = "";

        ajaxEntrada(nomeEntrada, valorEntrada);
    });
})


async function ajaxGastos(nomeDespesa, categoriaDespesa, valor) {
    let response = await fetch("/../src/controllers/controle_gasto.php?" + new URLSearchParams({
        nome: nomeDespesa,
        categoria: categoriaDespesa,
        valor: valor
    }).toString());

    if(!response.ok){
        console.log(response.status);
    }
    let data = await response.text();
    
    console.log(data);
    document.querySelector(".sucesso-registro").hidden = false;
    setTimeout(() => {
        document.querySelector(".sucesso-registro").hidden = true;
    }, 5000);
}


async function ajaxEntrada(nomeEntrada, valor) {
    let response = await fetch("/../src/controllers/controle_entrada.php?" + new URLSearchParams({
        nome: nomeEntrada,
        valor: valor
    }).toString());

    if(!response.ok){
        console.log(response.status);
    }
    let data = await response.text();
    
    if(data === "Preencha todos os campos!"){
        document.querySelector(".negado-entrada").hidden = false;
        setTimeout(() => {
            document.querySelector(".negado-entrada").hidden = true;
        }, 2000);
    } else {
        document.querySelector(".sucesso-entrada").hidden = false;
        setTimeout(() => {
        document.querySelector(".sucesso-entrada").hidden = true;
        }, 5000);
    }   
    
}


function waitForElement(querySelector, callback){
    let poops = setInterval(() => {
        if(document.querySelector(querySelector)){
            callback();
        }
    }, 100);
}

