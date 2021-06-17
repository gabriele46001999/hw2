function validazione(event){
  diverrore.innerHTML="";
  //form=event.currentTarget;//
  //ACCEDO HAI CAMPI TRAMITE form.name//
  const username=event.currentTarget.username;
  const usernamevalore=username.value;
  const password=event.currentTarget.password;
  const passwordvalore=password.value;
  //VERIFICO SE QUESTI 2 CAMPI NON SONO VUOTI//
  if(usernamevalore.length==0||passwordvalore.length==0){
      event.preventDefault();//COSI NON MANDA I DATI//
      const h3=document.createElement("h3");
      h3.textContent="COMPILARE TUTTI I CAMPI";
      diverrore.appendChild(h3);
      diverrore.classList.remove("hidden");
  }
}

//LEGGIAMO IL RIFERIMENTO AL FORM//
const form=document.querySelector("#formlogin");
//ASSOCIAMO UN LISTENER AL SUBMIT DEL FORM//
form.addEventListener("submit",validazione);
const diverrore=document.querySelector(".FieldVuoti");
diverrore.classList.add("hidden");
