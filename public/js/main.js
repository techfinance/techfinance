const loading = document.querySelector(".spinner-border");
const main = document.querySelector("#main");
const loginMessage = document.querySelector(".incorreto");

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const login = urlParams.get('login');
const senha = urlParams.get('senha');
const email = urlParams.get('email');

// mensagens erro login-cadastro
if(login == 'false')
    loginMessage.hidden = false; 
else if(senha == 'false')
    getMessage("#notEqual");
else if(email == 'false')
    getMessage("#notEmail");
else if(email == 'true')
    getMessage("#cadastro-ok");

function getMessage(element){
    const page = getPage('cadastro');
    page.finally(() => document.querySelector(element).hidden = false);
}

// ajax view pages
async function getPage(page, callbacks = []) {
    if(main) {
        main.innerHTML = "";
        loading.hidden = false;
    }

    const response = await fetch(`../src/views/${page}.php`);
    if(!response.ok){
        console.log(response.status);
        return;
    }
        
    const text = await response.text();
    main ? main.innerHTML = text : document.body.innerHTML = text;
    if(loading) loading.hidden = true;

    callbacks.forEach(callback => callback());
}


