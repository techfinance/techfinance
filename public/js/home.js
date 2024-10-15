waitForElement("#valor-carteira", () => {
    const carteira = document.querySelector("#valor-carteira");

    let valor = carteira.innerText;
    if(valor.includes("-")) {
        carteira.classList.remove("positive");
        carteira.classList.add("negative");
    } else {
        carteira.classList.remove("negative");
        carteira.classList.add("positive");
    }

});