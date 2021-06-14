<?php
use Illuminate\Routing\Controller as BaseController;
class ControllerRegister extends BaseController{

//FUNZIONE SE VISUALIZZO REGISTER IN MANIERA GET//
  public function RegisterGet(){
    //Verifichiamo se l'utente ha gia fatto il login e in caso reindirizziamo alla home//
    if(Session::get('user_id')!=null){
      //REINDIRIZZANDO ALLA HOME VIENE ATTIVATA LA ROUTE getHome//
      return redirect('home');
    }
    else{
    //VISUALIZZO LA VIEW REGISTER.BLADE PASSANDO UN PARAMETRO CHE E NECESSARIO PER POST//
    return view('register')
    ->with('csrf_token',csrf_token());
  }
  }

  public function RegisterPost(){
    //CREO UN OGGETTO UTENTE CON I DATI MANDATI NELLA REQUEST(CHE SAREBBE L'/ARRAY $GET E $POST DI PRIMA)//
    $utente=new Utente;
    $utente->nome=request("Nome");
    $utente->cognome=request("Cognome");
    $utente->indirizzo=request("Indirizzo");
    $utente->email=request("mail");
    $utente->username=request("Username");
    $passwordinput=password_hash(request("Password"), PASSWORD_BCRYPT);
    $utente->password=$passwordinput;
    $utente->save();
    //SETTO VARIABILE SESSIONE E REDIRECT ALLA HOME CHE ESEGUE LA ROUTE SCRITTA PER LA HOME//
    Session::put('user_id',$utente->id);
    return redirect('home');
    }

    public function check_Username($paramUsername){
      //ESEGUO LA QUERY VEDO SE C'E L'Username//
      $res=Utente::where('username',$paramUsername)->exists();
      //SE ESSO E PRESENTE RITORNO JSON//
      if($res!=null){
        echo json_encode("Username gia Presente");
      }
      else{
          echo json_encode(null);
      }
      }
      
      public function check_Email($paramEmail){
        //ESEGUO LA QUERY VEDO SE C'E L'Username//
        $res=Utente::where('email',$paramEmail)->exists();
        //SE ESSO E PRESENTE//
        if($res!=null){
        echo json_encode("Email gia Presente");
        }
        else{
            echo json_encode(null);
        }
      }
}
 ?>
