<?php
use Illuminate\Routing\Controller as BaseController;
class ControllerHome extends BaseController{

//FUNZIONE SE VISUALIZZO REGISTER IN MANIERA GET//
  public function HomeGet(){
    return view('home')
    ->with("id_utente",Session::get('user_id'));
  }
}
?>
