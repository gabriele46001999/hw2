<?php
use Illuminate\Routing\Controller as BaseController;
class ControllerProduct extends BaseController{

function AccessoriGet(){
    return view('Accessori')
    ->with("id_utente",Session::get('user_id'));
}

function ComputerGet(){
    return view('Computer')
    ->with("id_utente",Session::get('user_id'));
}

function SmartphoneGet(){
    return view('Smartphone')
    ->with("id_utente",Session::get('user_id'));
}

function AggiornaProdotti($parametro){
    $res=Prodotto::where('tipologia',$parametro)->get();
    echo $res;
}


function AggiornaPreferiti($pagina){
$id_utente=Session::get('user_id');
//IN TAL MODO OTTENGO TUTTI I PREFERITI DI UN UTENTE CHE HANNO COME TIPOLOGIA(QUERY SULLA CLASSE PRODOTTO) TALE PAGINA//
$preferiti=Utente::find($id_utente)->preferiti()->where("tipologia",$pagina)->get();
echo $preferiti;
}

function InserisciPreferiti($id_prodotto){
    //PER QUEL DETERMINATO UTENTE LOGGATO ATTACH(INSERISCO IN PREFERITI) UN  NODO CHE HA TALE ID_PRODOTTO
    $id_utente=Session::get('user_id');
    //VEDO SE E GIA PRESENTE UN PREFERITO//
    /*SELECT FROM PREFERITI WHERE ID_PRODOTTO=X E UTENTE_ID=Y*/
    $preferito=Utente::find($id_utente)->preferiti()->wherePivot("prodotto_id",$id_prodotto)->first();
    if($preferito==null)
    /*INSERT INTO PREFERITI BLA BLA*/
    Utente::find($id_utente)->preferiti()->attach($id_prodotto);
}

function RimuoviPreferiti($id_prodotto){
//PER QUEL DETERMINATO UTENTE LOGGATO DETACH(ELIMINO) IL NODO CHE HA TALE ID_PRODOTTO
$id_utente=Session::get('user_id');
Utente::find($id_utente)->preferiti()->detach($id_prodotto);
}


function ShowProduct($id_prodotto){
    $prodotto=Prodotto::find($id_prodotto);
    echo json_encode($prodotto);
}


function searchBar($tipologia,$filtro){
    if($filtro=="vuoto"){
        $prodotto=Prodotto::where('tipologia',$tipologia)->get();
    }
    else{
    $prodotto=Prodotto::where('tipologia',$tipologia)->where('titolo','like','%'.$filtro.'%')->get();
    }
    echo $prodotto;
}
}
?>