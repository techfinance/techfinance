waitForElement("#form-saida", () => {
    const formGasto = document.querySelector("#form-saida");

    formGasto.addEventListener("submit", (e) => {
        e.preventDefault();
        
        const nomeDespesa = document.querySelector("#nomeDespesa").value;
        const categoriaDespesa = document.querySelector("#categoriaDespesa").value;
        
        console.log(nomeDespesa, categoriaDespesa);
        
        })

})





function waitForElement(querySelector, callback){
    let poops = setInterval(() => {
        if(document.querySelector(querySelector)){
            clearInterval(poops);
            callback();
        }
    }, 100);
}

