//ASSOCIO UN SELETTORE E INIZIALMENTE LO NASCODO A LINKMBOILE IL DIV CHE CONTERRA IL MENU VERSIONE MOBILE//
let divlink=document.querySelector(".linkmobile");
divlink.classList.add("hidden");
//ASSOCIAMO AL CLICK SUL DIV CON ID MENU LA FUNZIONE SHOWLINK//
const menu=document.querySelector("#menu");
menu.addEventListener("click",showlink);
//OTTENGO TUTTI I SELETTORI CON CLASSE LINEMOBILE LE 3 RIGHE BIANCHE//
const linemob=document.querySelectorAll(".linemobile");
//OTTENGO IL SELETTORE RELATIVO AL DIV CHE CONTIENE MENU VERSIONE WEB//
let linkweb=document.querySelector(".flex-itemnav");
//CHIAMO UNA FUNZIONE CHE TRAMITE UNA ROUTE VEDE SE SIAMO REGISTRATI O MENO//
let username=null;
session();



function closemenuMobile(event){
  //TRAMITE PARENT NODE RISALIAMO AL CONTENITORE DIVLINK//
  const divlinkmobile=event.currentTarget.parentNode;
  //NASCONDIAMO TUTTO IL CONTENITORE CHE CONTIENE IL MENU MOBILE//
  divlinkmobile.classList.add("hidden");
  //FACCIAMO RITORNARE VISIBILE CONTENITORE CHE CONTIENE LE 3 LINEE BIANCHE//
  menu.classList.remove("hidden");
  //FACCIAMO RITORNARE VISIBILE LE 3 RIGHE BIANCHE//
  for(linea of linemob){
  linea.classList.remove("hidden");
}
}

function showlink(event){
  // RENDO VISIBILE(IL DIV CHE CONTERRA IL MENU SU MOBILE) E POI LO SVUOTO ESSENDO CHE OGNI VOLTA ESEGUO APPEND//
  divlink.classList.remove("hidden");
  divlink.innerHTML="";
  //NASCONDO IL DIV CON ID MENU//
  menu.classList.add("hidden");
  //NASCONDO LE 3 RIGHE BIANCHE//
  for(linea of linemob){
  linea.classList.add("hidden");
}
//CREO UN ELEMENTO A(UN LINK) E SETTO IL SUO ATTRIBUTO HREF(NOME DELLA ROUTE) E IL SUO TESTO E LO APPENDO ALL' INTERNO CONTENITORE DIVLINK//
const linkHome=document.createElement("a");
linkHome.setAttribute("href","home");
linkHome.textContent="Home";
divlink.appendChild(linkHome);
//CREO UN ELEMENTO A(UN LINK) E SETTO IL SUO ATTRIBUTO HREF(NOME DELLA ROUTE) E IL SUO TESTO E LO APPENDO ALL' INTERNO DEL CONTENITORE DIVLINK//
const linkComputer=document.createElement("a");
linkComputer.setAttribute("href","Computer");
linkComputer.textContent="Computer";
divlink.appendChild(linkComputer);
//CREO UN ELEMENTO A(UN LINK) E SETTO IL SUO ATTRIBUTO HREF(NOME DELLA ROUTE) E IL SUO TESTO E LO APPENDO ALL' INTERNO DEL  CONTENITORE DIVLINK//
const linkSmartphone=document.createElement("a");
linkSmartphone.setAttribute("href","Smartphone");
linkSmartphone.textContent="Smartphone";
divlink.appendChild(linkSmartphone);
//CREO UN ELEMENTO A(UN LINK) E SETTO IL SUO ATTRIBUTO HREF(NOME DELLA ROUTE) E IL SUO TESTO E LO APPENDO ALL' INTERNO DEL  CONTENITORE DIVLINK//
const linkAccessori=document.createElement("a");
linkAccessori.setAttribute("href","Accessori");
linkAccessori.textContent="Accessori";
divlink.appendChild(linkAccessori);
const linkcarrello=document.createElement("a");
const linkIfSession=document.createElement("a");
//SE SIAMO LOGGATI VIENE CREATO CARRELLO E LOGOUT,SENNO VIENE CREATO REGISTRATI//
if(username!=null){
  linkcarrello.setAttribute("href","Carrello");
  linkcarrello.textContent="Carrello";
  divlink.appendChild(linkcarrello);
  linkIfSession.setAttribute("href","logout");
  linkIfSession.textContent="Logut";
  divlink.appendChild(linkIfSession);
}
else{
  linkIfSession.setAttribute("href","register");
  linkIfSession.textContent="Registrati";
  divlink.appendChild(linkIfSession);
}
//VIENE CREATO UN ELEMENTO SPAN CON SCRITTO CHIUDI MENU CHE AL SUO CLICK FA ESEGUIRE CLOSEMENUMOBILE//
const closespan=document.createElement("span");
closespan.textContent="Chiudi Menu";
divlink.appendChild(closespan);
closespan.addEventListener("click",closemenuMobile);
}




//OTTENGO NEL USERNAME LA VARIABILE DI SESSIONE//
function usernameJson(json){
username=json;
}


function sessionResponse(response){
  return response.json();
}



//VEDO SE L'UTENTE E REGISTRATO AL CARICAMENTO DELLA PAGINA//
function session(){
  fetch("http://localhost/yourPrj/public/check_sessione").then(sessionResponse).then(usernameJson);
}

