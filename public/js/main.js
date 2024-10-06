const main = document.querySelector("#main");
const loginMessage = document.querySelector(".incorreto");

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const login = urlParams.get('login');

if(login == 'false'){
    loginMessage.hidden = false; 
}

async function getPage(page) {
    const response = await fetch(`../src/views/${page}.php`);

    if(!response.ok){
        console.log(response.status);
    }
    const text = await response.text();

    main ? main.innerHTML = text : document.body.innerHTML = text;
    
}



