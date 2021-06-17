aggiornaAcquisti();
const testosearchbox=document.querySelector(".searchbox h1");
const parametro=testosearchbox.textContent;
const parametroquery=parametro.substr(9,10);
console.log(parametroquery);
//All'apertura della pagina, richiediamo L'ACCESSO TRAMITE APIKEY A PIXELBAY PASSANDO COME PARAMETRO CARRELLO//
fetch("ajax_apiGET/"+parametroquery).then(onResponseApi).then(onJsonApi);


function onJsonApi(json)
{
  const list=json.hits;
  const src=list[14].largeImageURL;
  const header=document.querySelector("header");
  header.style.backgroundImage="url("+src+")";
  }


  function onResponseApi(response) {
    return response.json();
  }



//CREO DINAMICAMENTE I DIV IN BASE AL CONTENUTO DEL FILE PHP//
function onJsonDb(json){
    console.log(json);
    let valueprice=0;
    const section=document.querySelector(".flex-section");
    section.innerHTML="";
    if(json.length==0){
      const testo=document.createElement("h1");
      testo.textContent="NON HAI FATTO NESSUN ACQUISTO";
      section.appendChild(testo);
    }
    else{
      for(evento of json){
        const index=evento.id;
        const div=document.createElement("div");
        div.setAttribute("data-element",index);
        div.classList.add("flex-itemsection");
        section.appendChild(div);
        const immaginedesc=document.createElement("img");
        immaginedesc.src=evento.immagine;
        div.appendChild(immaginedesc);
        const divtitle=document.createElement("div");
        divtitle.classList.add("title");
        const title=document.createElement("p");
        title.textContent=evento.descrizione;
        const immagineadd=document.createElement("img");
        divtitle.appendChild(title);
        const prezzo=document.createElement("h3");
        valueprice=valueprice+(parseInt(evento.prezzo)*parseInt(evento.pivot.quantita));
        prezzo.textContent="PREZZO "+valueprice+".00 €";
        const quantita=document.createElement("h3");
        quantita.textContent="Quantita:"+evento.pivot.quantita;
        const data=document.createElement("h3");
        data.textContent="DATA ACQUISTO: "+evento.created_at.substring(0,10);
        //CALCOLO IL PREZZO TOTALE DEI PRODOTTI NEL CARRELLO//
        divtitle.appendChild(data);
        divtitle.appendChild(quantita);
        divtitle.appendChild(prezzo);
        div.appendChild(divtitle);
    }
  }
  }
  
  
  
  function responseAggiorna(response){
    return response.json();
  }
  
  function aggiornaAcquisti(){
    //RICHIEDE LA LISTA DEGLI EVENTI AD UNA PAGINA PHP TRAMITE ajax
    fetch("ajax_dbshowAcquisti").then(responseAggiorna).then(onJsonDb);
  }
  