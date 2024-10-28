function formSonho() {
    const formSonho = document.querySelector("#form-sonho");

    formSonho.addEventListener("submit", (event) => {
        event.preventDefault();

        const valorSonho = document.querySelector("#valor-sonho").value;
        const dataSonho = document.querySelector("#data-sonho").value;
        const descricaoSonho = document.querySelector("#descricao-sonho").value;

        ajaxSetSonho(valorSonho, dataSonho, descricaoSonho);

        formSonho.reset();

    });

}

async function ajaxSetSonho(valor, data, descricao) {
    let response = await fetch("/../src/controllers/controle_sonho.php?" + new URLSearchParams({
        valor: valor,
        data: data,
        descricao: descricao,
    }).toString());

    if(!response.ok){
        console.log(response.status);
    }
    
    document.querySelector(".sucesso-sonho").hidden = false;
    setTimeout(() => {
        document.querySelector(".sucesso-sonho").hidden = true;
    }, 3000);
}