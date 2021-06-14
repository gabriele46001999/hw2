<?php
use Illuminate\Routing\Controller as BaseController;
class ControllerApiRest extends BaseController{

  function apiGet($pagina){
    $json=Http::get('https://pixabay.com/api',[
      //'key'=>env("IMG_APIKEY"),//
      'key'=>getenv("IMG_APIKEY"),
      'q'=>$pagina,
      'image_type'=>'photo'
    ]);
    echo $json;
}
  

  function RequestToken(){
    //INIZIALIZZO CURL//
    $curl = curl_init();
    //SETTO OPTION=URL//
    curl_setopt($curl, CURLOPT_URL, "https://api.vimeo.com/oauth/authorize/client");
    //SETTO IL METODO POST//
    curl_setopt($curl, CURLOPT_POST, 1);
    //METTO QUI I CAMPI CHE METTEVO IN BODY//
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    //METTO QUI I CAMPI CHE METTEVO IN HEADERS//
   $headers = array("Authorization: Basic ".base64_encode(getenv("CLIENT_ID").":".getenv("CLIENT_SECRET")),
                      "Content-Type:application/x-www-form-urlencoded",
                      "Accept:application/vnd.vimeo.*+json;version=3.4");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //ESEGUO IL CURL//
    $result = curl_exec($curl);
    echo $result;  //RITORNO IL  JSON CON DENTRO IL TOKEN//
    curl_close($curl);
    }
    

function apiOauth($token,$tipologia){
  // Utilizzo il token,PRIMA ESEGUO JSON_DECODE CHE LO FA PASSARE DA JSON AD OGGETTO SENNO NON POSSO ACCEDERVI//
  $curl = curl_init();
  $data = http_build_query(array("query" =>$tipologia));
  curl_setopt($curl, CURLOPT_URL, "https://api.vimeo.com/videos?".$data); //FACCIO RICHIESTA GET ACCODANDO I DATI//
   //AGGIUGNO HEADERS//
   $headers = array("Authorization: Bearer ".$token);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);
   //DA LATO JAVASCRIPT HO BISOGNO DI UN OGGETTO JSON,PER RITORNARE QUALCOSA BASTA FARE ECHO DI QUALCOSA,RESULT E GIA UN JSON,SE NON LO ERA USAVO (JSON_ENCODE($RESULT)
   echo $result;
   curl_close($curl);
  }

}
?>