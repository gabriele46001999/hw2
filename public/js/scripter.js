//CHIAMO CHECKUSER CHE CONTROLLA SE SIAMO REGISTRATI O MENO ED ESEGUE LE FUNZIONI AL CARICAMENTO DELLA PAGINA//
const testosearchbox=document.querySelector(".searchbox h1");
const searchbox=document.querySelector("#searchbox-item input");
searchbox.addEventListener('keyup',showsearch);
const parametro=testosearchbox.textContent;
//OTTENGO IN TAL MODO LA PAGINA DOVE SONO//
const pagina=parametro.substr(15,10);
const preferiti=document.querySelector(".preferiti");
preferiti.classList.add("hidden");
const MAP={};
let access_token=null;
let usernameUser=null;
  //FACCIO LA FETCH RICHIEDNO API GET//
  fetch("ajax_apiGET/"+pagina).then(onResponseApiKey).then(onJsonApiKey);
  //RICHIEDO IL TOKEN//
  fetch("ajax_apiPostRequestToken").then(onSuccessToken).then(onJsonToken);
  checkUser();
 //All'apertura della pagina, richiediamo L'ACCESSO TRAMITE APIKEY A PIXELBAY
//RICHIEDO IL TOKEN AL CARICAMENTO DELLA PAGINA//



  function usernameJson(json){
  usernameUser=json;
  //CARICA INIZIALMENTE LA LISTA DI PRODOTTI CHE ABBIAMO DAL DB//
  aggiornaProdotti();
  queryDBprefer();
  //OGNI 3 SECONDI ESEGUO refreshQuantity SE SI E REGISTRATI//
  if(usernameUser){
  window.setInterval("refreshQuantity()", 1000);
}
}

  function sessionResponse(response){
    return response.json();
  }



  //VEDO SE L'UTENTE E REGISTRATO AL CARICAMENTO DELLA PAGINA//
  function checkUser(){
    fetch("check_sessione").then(sessionResponse).then(usernameJson);
  }








  function refreshJson(json){
    let quantitaNuova;
    const caselle=document.querySelectorAll(".flex-itemsection");
    //PER OGNI ELEMENTO NEL JSON OTTENGO QUANTITA E MODIFICO QUELLA VISUALIZZATA//
      for(const casella of caselle){
          const  quantita=casella.querySelector("#quantita");
          const divnew=casella.querySelector(".information div");
          const scelta=casella.querySelector("#scelta");
            if(quantita!=null &&divnew!=null && scelta!=null ){   //METTO TALE RIGA PERCHE NON SEMPRE SARANNO VISIBILI MA SOLO QUANDO CLICCO SU SHWOMORE//
            const index=casella.dataset.element;
             for(const elemento of json){
              if(elemento.id==index){
               quantitaNuova=elemento.quantita;
              }
            }
            if(quantitaNuova==0){
              quantita.textContent="Prodotto non Disponbile";
              scelta.classList.add("hidden");
              divnew.classList.add("hidden");
            }
            if(quantitaNuova>0){
              quantita.textContent="Quantita:"+quantitaNuova;
              scelta.classList.remove("hidden");
              divnew.classList.remove("hidden");
            }
          }
            }
}


  function refreshResponse(response){
    return response.json();
  }


  //OGNI 3 SECODNI AGGIORNO LA VISUALIZZAZIONE DELLA QUANTITA DISPONIBILE ED IN CASO FACCIO SPUNTARE PRODOTTO NON DISPONIBILE//
  function refreshQuantity(){
  fetch("ajax_AggiornaProdotti/"+pagina).then(refreshResponse).then(refreshJson);
  }




//IN BASE AL TIME PASSATO ESEGUIRA QUELLO DENTRO THEN//
  function sleep (time) {
    return new Promise((resolve) => setTimeout(resolve, time));
  }

//GESTIONE INSERIMENTO NEL CARRELLO//
  function jsonInsert(json){
    const error=document.createElement("p");
    error.textContent=json;
    divnew.appendChild(error);
    sleep(1500).then(() => {
    error.remove();
});
 }

  function responseInsertCarrello(response){
     return response.json();
  }


  function insertcarrello(event){
    const preferbutton=event.currentTarget;
    divnew=preferbutton.parentNode;
    const casella=divnew.parentNode.parentNode;
    const id_prodotto=casella.dataset.element;
    const quantita=casella.querySelector("input").value;
    if(quantita.length==0){
      const error=document.createElement("p");
      error.textContent="Inserisci un numero";
      divnew.appendChild(error);
      sleep(1500).then(() => {
        error.remove();
     });
      }
    else
    fetch("ajax_dbInsertCarrello/"+id_prodotto+"/"+quantita).then(responseInsertCarrello).then(jsonInsert);
  }
  let divnew=null;
  //PARTE CHE PERMETTE INSERIMENTO NEL CARRELLO












  //PARTE REST API KEY//
//DAL JSON OTTENGO L'SRC DELLA FOTO CHE USERO PER SETTARE LA FOTO DI BACKGROUND DEL HEADER//
function onJsonApiKey(json)
{
  //console.log(json);
  const list=json.hits;
  let numberphoto;
  let pagina=parametro.substr(15,10);
  if(pagina=="Smartphone"){
    numberphoto=14;
  }
  if(pagina=="Computer"){
    numberphoto=3;
  }
  if(pagina=="Accessori"){
    numberphoto=2;
  }
    const src=list[numberphoto].largeImageURL;
    const header=document.querySelector("header");
    header.style.backgroundImage="url("+src+")";
  }


  function onResponseApiKey(response) {
    return response.json();
  }


//PARTE REST API KEY//




//DAL JSON OTTENUTO ESTRAGGO L SRC DEL VIDEO ED CREO UN COMPONENTE IFRAME CON TALE SRC//
function onJsonTokenVideo(json){
  //console.log(json);
  const listvideo=json.data;
  const video=listvideo[videonumber];
  const link=video.link;
  //ESTRATTO DAL LINK OTTENUTO DAL JSON IL NUMERO CHE IDENTIFICA IL VIDEO//
  const linkestratto=link.substring(18);
  //OTTENGO IL LINK DA METTERE NEL SRC DEL COMPONENTE IFRAME
  const linkperfetto="https://player.vimeo.com/video/"+linkestratto;
  const videocomponent=document.createElement("iframe");
  videocomponent.src=linkperfetto;
  modalview.appendChild(videocomponent);
}


//RITORNO IL JSON CON IL TOKEN//
function onTokenVideoSuccess(response){
 return response.json();
}




//FUNZIONE CHE AL CLICK SULLA MODALE,FA RITORNARE LA PAGINA PRECEDENTE//
function onModalClick(event){
 body.classList.remove("noscroll");
 modalview.innerHTML="";
 modalview.classList.add("hidden");
}

//LA FUNZIONE onModalDisplay mostrerà la MODAL ED ESEGUIRA LA FETCH A VIMEO PER OTTENERE IL VIDEO//
function onModalDisplay(event){
 const casella=event.currentTarget.parentNode;
 //NELLA MAP  HO UN NUMBER PER OTTENERE UN VIDEO ESATTO//
 videonumber=MAP[casella.dataset.element];
 const title=casella.querySelector(".title h1").textContent;
 //ESEGUO LA FETCH PASSANDO COME PARAMETRO IL TITOLO DEL DIV CLICCATO//
 // All'apertura della pagina, richiediamo il token
 fetch("ajax_apiOauth/"+access_token+"/"+title).then(onTokenVideoSuccess).then(onJsonTokenVideo);
 modalview.style.top=window.pageYOffset+'px';
 modalview.classList.remove("hidden");
 body.classList.add("noscroll");
 const titledescript=document.createElement("h1");
 titledescript.textContent="CONTENUTO MULTIMEDIALE IN ESECUZIONE";
 modalview.appendChild(titledescript);
 //METTO UN LISTENER SULLA MODALE CHE AL CLICK LA FARA CHIUDERE//
 modalview.addEventListener('click',onModalClick);
}
let videonumber=0;
const body=document.querySelector("body");
const modalview=document.querySelector(".modal-view");
modalview.classList.add("hidden");





//ASSOCIO IL TOKEN PRELEVANDOLO DAL FILE JSON RESTITUITO NELLA RESPONSE//
function onJsonToken(json){
  //console.log(json);
  access_token=json.access_token;
  }

//RITORNO IL JSON CON IL TOKEN//
function onSuccessToken(response){
 return response.json();
}




//UNA VOLTA OTTENUTO IL JSON CHIAMO onJsonDb che è la funzione che crea contenuti dinamici//
  function onSearchResponse(response){
    return response.json();
  }

  function showsearch(event){
    const searchbox=event.currentTarget;
    let filter=searchbox.value.toUpperCase();
    lunghezza=searchbox.value.length;
    if(lunghezza==0){
        filter="vuoto";
    }
    fetch("ajax_dbsearchbar/"+pagina+"/"+filter).then(onSearchResponse).then(onJsonDb);
  }



  function showless(event){
    const bottoneless=event.currentTarget;
    const divinformation=bottoneless.parentNode;
    const casella=divinformation.parentNode;
    divinformation.innerHTML="";
    const bottonemore=casella.querySelector("span");
    bottonemore.classList.remove("hidden");
  }


  function showMoreJson(json){
    const descrizione=document.createElement("p");
    const prezzo=document.createElement("h3");
    descrizione.textContent=json.descrizione;
    prezzo.textContent="PREZZO:"+json.prezzo+".00"+" €";
    const div=flexitemcliccato.querySelector(".information");
    div.classList.remove("hidden");
    div.appendChild(descrizione);
    div.appendChild(prezzo);
    //SE L'UTENTE E REGISTRATO VIENE VISUALIZZATO LA Quantita//
    //ASSEGNO UN ID A QUANTITA COSI DOPO POSSO RECUPERARLO QUANDO DEVO MODIFICARLO//
    if(usernameUser){
    const quantita=document.createElement("h3");
    quantita.textContent="Quantita:"+json.quantita;
    /*TALE ID MI SERVE PER LA FUNZIONE PERIODICA*/
    quantita.setAttribute("id","quantita");
    div.appendChild(quantita);
    const scelta=document.createElement("p");
    /*TALE ID MI SERVE PER LA FUNZIOCHE PERIODICA*/
    scelta.setAttribute("id","scelta");
    scelta.textContent="Scegli Quantita";
    const divscelta=document.createElement("div");
    const input=document.createElement("input");
    input.setAttribute("type","text");
    const immaginecarrello=document.createElement("img");
    immaginecarrello.src="images/aggiungicarrello.jpg";
    if(json.quantita==0){
      quantita.textContent="Prodotto non Disponbile";
      scelta.classList.add("hidden");
      divscelta.classList.add("hidden");
    }
    div.appendChild(scelta);
    divscelta.appendChild(input);
    divscelta.appendChild(immaginecarrello);
    div.appendChild(divscelta);
    immaginecarrello.addEventListener('click',insertcarrello);
  }
    const bottoneless=document.createElement("span");
    bottoneless.classList.add("button");
    bottoneless.textContent="SHOW LESS";
    div.appendChild(bottoneless);
    bottoneless.addEventListener('click',showless);
  }


  function showmoreResponse(response){
    return response.json();
  }


  function showmore(event){
    const bottonemore=event.currentTarget;
    flexitemcliccato=bottonemore.parentNode;
    const id_prodotto=flexitemcliccato.dataset.element;
    console.log(id_prodotto);
    bottonemore.classList.add("hidden");
    fetch("ajax_dbShowProdotto/"+id_prodotto).then(showmoreResponse).then(showMoreJson);
  }
  let flexitemcliccato=null;




  function rimuovipreferiti(event){
    const dislike=event.currentTarget;
    const itempreferiti=dislike.parentNode.parentNode;
    const id_prodotto=itempreferiti.dataset.element;
    const flexsection=preferiti.querySelector(".preferiti-container");
    const figli=flexsection.childNodes;
  if(figli.length==1){
    preferiti.classList.add("hidden");
  }
    fetch("ajax_dbremovePreferiti/"+id_prodotto).then(queryDBprefer);
}




  function onJsonDbPreferiti(json){
   //console.log(json);
    const flexsection=preferiti.querySelector(".preferiti-container");
    flexsection.innerHTML="";
    for(preferito of json){
    preferiti.classList.remove("hidden");
    const flexitem=document.createElement("div")
    flexitem.classList.add("item-preferiti");
    flexitem.setAttribute("data-element",preferito.id);
    flexsection.appendChild(flexitem)
    const divtitlepreferiti=document.createElement("div");
    divtitlepreferiti.classList.add("title");
    flexitem.appendChild(divtitlepreferiti);
    const title=document.createElement("h1");
    title.textContent=preferito.titolo;
    const immagineunprefer=document.createElement("img");
    immagineunprefer.src='images/unliker.png';
    immagineunprefer.addEventListener("click",rimuovipreferiti);
    divtitlepreferiti.appendChild(title);
    divtitlepreferiti.appendChild(immagineunprefer);
    const imgdesc=document.createElement("img");
    imgdesc.src=preferito.immagine;
    flexitem.appendChild(imgdesc);
   }
  }


  function responsePreferiti(response){
    return response.json();
  }


  function queryDBprefer(){
    //QUESTA VERRA ESEGUITA SE L'UTENTE E REGISTRATO//
    if(usernameUser){
  fetch("ajax_dbpreferitishow/"+pagina).then(responsePreferiti).then(onJsonDbPreferiti);
  }
  if(usernameUser===null){
    //SE L'UTENTE NON E REGISTRATO VIENE VISUALIZZATO QUESTO//
    preferiti.classList.remove("hidden");
    const text=preferiti.querySelector("h1");
    text.textContent="REGISTRATI PER GESTIRE I PREFERITI E IL CARRELLO";
  }
  }




  function insertpreferiti(event){
     const preferbutton=event.currentTarget;
     const casella=preferbutton.parentNode.parentNode;
     const id_prodotto=casella.dataset.element;
     fetch("ajax_dbInsertpreferiti/"+id_prodotto).then(queryDBprefer);
  }



  //CARICAMENTO DINAMICO DEI CONTENUTI//
function onJsonDb(json){
    //console.log(json);
    //OGNI VOLTA CHE CHIAMO TALE FUNZIONE SVUOTO LA SECTION//
    const section=document.querySelector(".flex-section");
    section.innerHTML="";
     for(evento of json){
       index=evento.id;
       MAP[index]=evento.numbervideo;
       const div=document.createElement("div");
       div.setAttribute("data-element",index);
       div.classList.add("flex-itemsection");
       section.appendChild(div);
       const divtitle=document.createElement("div");
       divtitle.classList.add("title");
       const title=document.createElement("h1");
       title.textContent=evento.titolo;
       const immaginelike=document.createElement("img");
       immaginelike.src="images/liker.png";
       divtitle.appendChild(title);
       divtitle.appendChild(immaginelike);
       //SE L'UTENTE REGISTRATO AGGIUNGE IL LISTENER DEI PREFERITI//
       if(usernameUser!=null){
       immaginelike.addEventListener('click',insertpreferiti);
     }
       div.appendChild(divtitle);
       const immaginedesc=document.createElement("img");
       immaginedesc.src=evento.immagine;
       div.appendChild(immaginedesc);
       immaginedesc.addEventListener('click',onModalDisplay);
       const p1=document.createElement("p");
       p1.textContent="Clicca sulla foto per vedere il video";
       div.appendChild(p1);
       const divinformation=document.createElement("div");
       divinformation.classList.add("information");
       divinformation.classList.add("hidden");
       div.appendChild(divinformation);
       const bottonemore=document.createElement("span");
       bottonemore.textContent="SHOW MORE";
       bottonemore.classList.add("button");
       div.appendChild(bottonemore);
      bottonemore.addEventListener('click',showmore);
   }
   }



 function responseAggiorna(response){
   return response.json();
 }

 function aggiornaProdotti(){
   //RICHIEDE LA LISTA DEGLI EVENTI AD UNA PAGINA PHP TRAMITE ajax
   fetch("ajax_AggiornaProdotti/"+pagina).then(responseAggiorna).then(onJsonDb);
 }
