function formMeta() {
    const formMetas = document.querySelector("#form-metas");

    formMetas.addEventListener("submit", (event) => {
        event.preventDefault();

        const categoriaMeta = document.querySelector("#categoria-meta");
        const valorMeta = document.querySelector("#valor-meta").value;
        const dataMeta = document.querySelector("#data-meta").value;
        const descricaoMeta = document.querySelector("#descricao-meta").value;

        let tipoCategoriaMeta = categoriaMeta.options[categoriaMeta.selectedIndex]?.dataset.tipo;
        let idCategoriaMeta = categoriaMeta.options[categoriaMeta.selectedIndex]?.dataset.id;

        ajaxSetMeta(idCategoriaMeta, valorMeta, dataMeta, descricaoMeta, tipoCategoriaMeta);

        formMetas.reset();

    });

}

async function ajaxSetMeta(categoria, valor, data, descricao, tipo) {
    let response = await fetch("/../src/controllers/controle_meta.php?" + new URLSearchParams({
        id_categoria: categoria,
        valor: valor,
        data: data,
        descricao: descricao,
        tipo: tipo,
    }).toString());

    if(!response.ok){
        console.log(response.status);
    }
    
    document.querySelector(".sucesso-meta").hidden = false;
    setTimeout(() => {
        document.querySelector(".sucesso-meta").hidden = true;
    }, 3000);
}