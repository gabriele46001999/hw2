<?php
use Illuminate\Routing\Controller as BaseController;
class ControllerAcquisti extends BaseController{

//FUNZIONE SE VISUALIZZO REGISTER IN MANIERA GET//
  public function AcquistiGet(){
    return view('Acquisti')
    ->with("id_utente",Session::get('user_id'));
  }

  public function MostraAcquisti(){
    $id_utente=Session::get('user_id');
    //VISUALIZZA TUTTI GLI ELEMENTI NEL CARRELLO DI UN DETERMINATO UTENTE//
    $prodotti=Utente::find($id_utente)->acquisto()->get();
    echo $prodotti;
  }
}
?>
