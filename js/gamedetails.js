function mostra(){
    console.log("ciao");
    document.querySelector('.account').classList.remove('hidden');;
    document.querySelector('.overlay').classList.remove('hidden');
    document.querySelector('#log').addEventListener('click',nascondi);
}

function nascondi(){
    console.log("ciao");
    document.querySelector('.account').classList.add('hidden');
    document.querySelector('.overlay').classList.add('hidden');
    document.querySelector('#log').removeEventListener('click',nascondi);
    document.querySelector('#log').addEventListener('click',mostra);
}

function login(){
    location.href = 'login.php';
}

function mostracarrello(){
    location.href = 'cart.html';
}

document.querySelector('#log').addEventListener('click',login);
document.querySelector('#icon_cart').addEventListener('click',login);
console.log(document.querySelector('#icon_cart'));
document.querySelector('.overlay').addEventListener('click',nascondi);

const a1=document.querySelector('.scroll1');
const a2=document.querySelector('.scroll2');
const a3=document.querySelector('.blocchi');
document.querySelector('#burger').addEventListener('click',aprimenu);
document.querySelector('#delete').addEventListener('click',chiudimenu);

function aprimenu(){
    document.querySelector(".menumobile").classList.remove('hidden');
}

function chiudimenu(){
    document.querySelector(".menumobile").classList.add('hidden');
}


for(let key of document.querySelectorAll('.menumobile a')) key.addEventListener('click',chiudimenu);


/*fetch*/
/*logout*/
document.querySelector('#esci').addEventListener('click', esci);
function onResponse0(response) {
    return response.json();
}
function onJSON0(json) {
    console.log(json);
    location.href = 'homepage.html';
}
function esci(e){
    fetch("logout.php").then(onResponse0).then(onJSON0);
}

/*c'è il cookie*/
fetch("istherecookie.php").then(onResponse1).then(onJSON1);

function onResponseA(response) {
    return response.json();
}
function onJSONA(json) {
console.log(json);
document.querySelector('#log').removeEventListener('click',login);
document.querySelector('#log').addEventListener('click',mostra);
document.querySelector('#icon_cart').removeEventListener('click',login);
document.querySelector('#icon_cart').addEventListener('click',mostracarrello);
document.querySelector('#log').src=json[0].img;
document.querySelector('#log1').src=json[0].img;
document.querySelector('.account span').textContent=json[0].nome;
}
function onResponse1(response) {
    return response.json();
}
function onJSON1(json) {
console.log(json);
user=json;
if(json!=0){
    fetch("returnavatar.php").then(onResponseA).then(onJSONA);
}
}

/*aggiungi*/
async function AddToCart(e){
    console.log("eccomi");
    if(user==0) {
        console.log("users"+ user);
        location.href = 'login.php';}
    else{
        const gioco=e.currentTarget.parentNode.querySelector('h2');
        console.log(gioco);
        const a=gioco.textContent;
        const anim=e.currentTarget.querySelector('.anim');
        anim.classList.remove('hidden');
        await sleep(1200);
        anim.classList.add('hidden');
        fetch("aggiungi.php?titolo="+a).then(onResponse4).then(onJSON4);
    }
}

let user;
document.querySelector('.bottone').addEventListener('click',AddToCart);
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }