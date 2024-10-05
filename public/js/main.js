const main = document.querySelector("#main");

async function getPage(page) {
    const response = await fetch(`../src/views/${page}.php`, {
        method: 'GET',
    })
    if(!response.ok){
        console.log(response.status);
    }
    const text = await response.text();
    main.innerHTML = text;
}