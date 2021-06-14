<?php
use Illuminate\Routing\Controller as BaseController;
class ControllerCarrello extends BaseController{

//FUNZIONE SE VISUALIZZO REGISTER IN MANIERA GET//
  public function CarrelloGet(){
    return view('Carrello')
    ->with("id_utente",Session::get('user_id'));
  }


  public function InserisciCarrello($id_prodotto,$quantita){
    $notnumber=0;
    for($i=0; $i<strlen($quantita); $i++){
       $carattere=ord(substr($quantita,-$i,1));
      if($carattere<48 || $carattere>57){
         $notnumber++; //INCREMENTO IL NUMERO DI NUMERI//
      }
    }
      if($notnumber>0){
        echo json_encode("Inserisci un numero");
      }
      else{
    /*$querySelect='SELECT * FROM PRODOTTO WHERE id_prodotto';*/
    $rowProduct=Prodotto::find($id_prodotto);
    //echo $rowProduct['quantita'];
    if($quantita>$rowProduct['quantita']){
      echo json_encode("Quantita scelta non disponibile");
    }
    else{
    //VEDO SE TALE PRODOTTO E GIA NEL CARRELLO//
    $id_utente=Session::get('user_id');
     //$querySelect='SELECT * FROM carrello WHERE id_utente="'.$utente.'" AND id_prodotto="'.$id_prodottoinput.'"';//
       $row=Utente::find($id_utente)->carrello()->wherePivot("prodotto_id",$id_prodotto)->first();
       //SE IL PRODOTTO NON CE LO CREO//
      if($row==null){
      Utente::find($id_utente)->carrello()->attach($id_prodotto,['quantita'=>$quantita,'Acquistato'=>0]);
      }
      //SE LA RIGA E PRESENTE FACCIO L'UDATE//
      else{
      $row->pivot->quantita=$quantita;
      $row->pivot->save();
      }
      echo json_encode("Elemento Inserito");
      }
  }
}


  public function VisualizzaProdotti(){
  $id_utente=Session::get('user_id');
  //VISUALIZZA TUTTI GLI ELEMENTI NEL CARRELLO DI UN DETERMINATO UTENTE//
  $prodotti=Utente::find($id_utente)->carrello()->get();
  echo $prodotti;
  }

  public function EliminaProdotto($id_prodotto){
    $id_utente=Session::get('user_id');
    Utente::find($id_utente)->carrello()->detach($id_prodotto);
  }


  public function DecQuantitaProdotto($id_prodotto){
    $id_utente=Session::get('user_id');
   //MI FACCIO UNA SELECT E MI PRENDO DAL PIVOT LA QUANTITA//
   $itemcarrello=Utente::find($id_utente)->carrello()->wherePivot("prodotto_id",$id_prodotto)->first();
   $quantitaItemCarrello=$itemcarrello->pivot->quantita;
      //SE LA QUANTITA E MAGGIORE DI 0 DECREMENTO E FACCIO UN UPDATE//
   if($quantitaItemCarrello>1){
    $itemcarrello->pivot->quantita=$quantitaItemCarrello-1;
    $itemcarrello->pivot->save();
   }
  //SE LA QUANTITA=0 FACCIO UN DELETE//
  else{
    Utente::find($id_utente)->carrello()->detach($id_prodotto);
  }
}

  //PRENDO LA QUANTITA DI QUEL ELEMENTO DAL PIVOT E FACCIO UN AGGIORNAMENTO DEL PIVOT//
  public function AggQuantitaProdotto($id_prodotto){
    $id_utente=Session::get('user_id');
    $itemcarrello=Utente::find($id_utente)->carrello()->wherePivot("prodotto_id",$id_prodotto)->first();
    $quantitaCarrello=$itemcarrello->pivot->quantita;
    $itemcarrello->pivot->quantita=$quantitaCarrello+1;
    $itemcarrello->pivot->save();
}


  public function AcquistaCarrello(){
  $errori=array();//TALE ARRAY CONTERRA TITOLO E QUANTITA DEL PRODOTTO SU CUI SI VERIFICA L'ERRORE//
  $id_utente=Session::get('user_id');
  //OTTENGO UN ARRAY CHE HA id_prodotto,titolo,quantita però dei prodotti disponibile (Ma sempre relativi agli stessi elementi del carrelo fa la join//
  $prodottiDisponibili=Utente::find($id_utente)->carrello()->get(['prodotto.id','prodotto.titolo','prodotto.quantita']);
  //CONFRONTO LA QUANTITA NEL CARRELLO (OVVERO DI PIVOT) CON QUELLA DISPONIBILE//
  foreach($prodottiDisponibili as $prodotto){
    $quantitaCarrello=$prodotto->pivot->quantita;
    $quantitaDisponibile=$prodotto["quantita"];
    if($quantitaCarrello>$quantitaDisponibile){
      $errori[]=$prodotto;
    }
  }
if(count($errori)==0){
  //SE NON CI SONO ERRORI PRIMA SETTO ACQUISTATO 1 IN TUTTI I PRODOTTI//
  foreach($prodottiDisponibili as $prodotto){
    $prodotto->pivot->Acquistato=1;
    $prodotto->pivot->save();
  }

  //ELIMINO TUTTI I PRODOTTI NEL CARRELLO DEL UTENTE//
  Utente::find($id_utente)->carrello()->detach();
  $errori=null;
}
//ALLA FINE RITORNA SEMPRE ERRORI IN FORMATO JSON//
 echo json_encode($errori);
}
}
?>