function formMeta() {
    const formMetas = document.querySelector("#form-metas");
    const formUpdate = document.querySelector("#form-update-metas");

    formMetas.addEventListener("submit", (event) => {
        event.preventDefault();

        const categoriaMeta = document.querySelector("#categoria-meta");
        const valorMeta = document.querySelector("#valor-meta").value;
        const dataInicio = document.querySelector("#data-inicio").value;
        const dataMeta = document.querySelector("#data-meta").value;
        const descricaoMeta = document.querySelector("#descricao-meta").value;

        let tipoCategoriaMeta = categoriaMeta.options[categoriaMeta.selectedIndex]?.dataset.tipo;
        let idCategoriaMeta = categoriaMeta.options[categoriaMeta.selectedIndex]?.dataset.id;

        ajaxSetMeta(idCategoriaMeta, valorMeta, dataInicio, dataMeta, descricaoMeta, tipoCategoriaMeta).finally(async () => {
            let response = await fetch("/../src/views/lista_metas.php");
            let data = await response.text();

            document.querySelector("#list-metas").innerHTML = data;
        });

        formMetas.reset();
    });
}

async function excluirMeta(idMeta, idUsuario){
    let response = await fetch("/../src/controllers/excluir_meta.php?" + new URLSearchParams({
        id_meta: idMeta,
        id_usuario: idUsuario,
    }).toString());

    if(!response.ok){
        console.log(response.status);
    } else {
        let response = await fetch("/../src/views/lista_metas.php");
        let data = await response.text();

        document.querySelector("#list-metas").innerHTML = data;
    }
}

async function ajaxSetMeta(categoria, valor, dataInicio, data, descricao, tipo) {
    let response = await fetch("/../src/controllers/controle_meta.php?" + new URLSearchParams({
        id_categoria: categoria,
        valor: valor,
        data_inicio: dataInicio,
        data: data,
        descricao: descricao,
        tipo: tipo,
    }).toString());

    if(!response.ok){
        console.log(response.status);
    }

    let date = await response.text();

    console.log(date);

    if(date !== "error"){
        document.querySelector(".sucesso-meta").hidden = false;
        setTimeout(() => {
            document.querySelector(".sucesso-meta").hidden = true;
        }, 3000);
    } else {
        document.querySelector(".dateErro").hidden = false;
        setTimeout(() => {
            document.querySelector(".dateErro").hidden = true;
        }, 3000);
    }
}

async function formUpdateMeta(id, valor){
    let response = await fetch(`/../src/controllers/editar_meta.php?valor=${valor}&id_meta=${id}`);

    if(!response.ok)
        console.log(response.status);
    else {
        let response = await fetch("/../src/views/lista_metas.php");
        let data = await response.text();

        document.querySelector("#list-metas").innerHTML = data;
    }
}
