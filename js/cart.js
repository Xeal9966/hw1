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
document.querySelector('.overlay').addEventListener('click',nascondi);

const a1=document.querySelector('.scroll1');
const a2=document.querySelector('.scroll2');
const a3=document.querySelector('.blocchi');
const totale=document.querySelector('.tot');
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
const im=document.createElement('img');
im.src=json[0].img
const nome=document.createElement('h3');
nome.textContent=json[0].nome;
primo.appendChild(im);
primo.appendChild(nome);
}
function onResponse1(response) {
    return response.json();
}
function onJSON1(json) {
console.log(json);
if(json!=0){
    fetch("returnavatar.php").then(onResponseA).then(onJSONA);
}
else     location.href = 'login.php';
}
const primo=document.querySelector('#account_info');

/*loadgame*/
const giochi=document.querySelector('.box_giochi');
fetch("loadcart.php").then(onResponse6).then(onJSON6);

function onResponse8(response) {
    return response.json();
}

function onJSON8(json) {
console.log(json);
const spa=document.createElement('span');
spa.classList.add('tota');
spa.textContent="Totale: "+"\u20AC "+json[0].tot;
totale.appendChild(spa);
}

function onResponse6(response) {
    return response.json();
}
function onJSON6(json) {
    console.log(json);
    if(json.length==0){
        const c = document.createElement('div');
        c.classList.add('nobody');
        const tit=document.createElement('span');
        tit.textContent="Non ci sono articoli nel carrello";
        const link=document.createElement('a');
        link.href="allgames.html";
        link.textContent="Vedi Tutti i Giochi";
        giochi.appendChild(c);
        c.appendChild(tit);
        c.appendChild(link);
    }
    else{
    for(let i=0;i<json.length;i++){
        const a = document.createElement('div');
        a.classList.add('card');
        const img=document.createElement('img');
        img.classList.add('pic');
        const gg = document.createElement('div');
        gg.classList.add('sistema');
        const title=document.createElement('span');
        title.classList.add('title');
        const prezzo=document.createElement('span');
        prezzo.textContent="\u20AC "+json[i].prezzo;
        img.src=json[i].imm;
        title.textContent=json[i].nome;
        const second = document.createElement('div');
        const add = document.createElement('div');
        add.classList.add('modifica');
        const meno=document.createElement('img');
        meno.src="img/icons/meno.png";
        meno.classList.add('meno');
        const n=document.createElement('span');
        n.textContent=json[i].n_aggiunti;
        const piu=document.createElement('img');
        piu.src="img/icons/piu.png";
        piu.classList.add('piu');

        giochi.appendChild(a);
        a.appendChild(img);
        a.appendChild(gg);
        gg.appendChild(title);
        gg.appendChild(second);
        second.appendChild(prezzo);
        second.appendChild(add);
        add.appendChild(meno);
        add.appendChild(n);
        add.appendChild(piu);
    }

    for(let key of document.querySelectorAll('.meno')) key.addEventListener('click', RemoveToCart); 
    for(let key of document.querySelectorAll('.piu')) key.addEventListener('click', AddToCart); 
    for(let key of document.querySelectorAll('.pic')) key.addEventListener('click', vediDettagli);
    fetch("tot.php").then(onResponse8).then(onJSON8);
    }
}


function onResponse4(response) {
    return response.json();
}

async function onJSON4(json) {
document.querySelector('.box_giochi').innerHTML='';
totale.innerHTML='';
fetch("loadcart.php").then(onResponse6).then(onJSON6);
}

function RemoveToCart(e){
        const gioco=e.currentTarget.parentNode.parentNode.parentNode.querySelector('.title');
        const a=gioco.textContent;
        fetch("rimuovi.php?titolo="+a).then(onResponse4).then(onJSON4);
}

function AddToCart(e){
        const gioco=e.currentTarget.parentNode.parentNode.parentNode.querySelector('.title');
        const a=gioco.textContent;
        fetch("aggiungi.php?titolo="+a).then(onResponse4).then(onJSON4);
}

function vediDettagli(e){
    const gioco=e.currentTarget.parentNode.querySelector('.title');
    const a=gioco.textContent;
    location.href = 'gamedetails.php?titolo='+a;
}