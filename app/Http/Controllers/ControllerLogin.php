<?php
use Illuminate\Routing\Controller as BaseController;
class ControllerLogin extends BaseController{

public function LoginGet(){
  //Verifichiamo se l'utente ha gia fatto il login//
  if(Session::get('user_id')!=null){
    return redirect('home');
  }
  else{
  //VERIFICHIAMO SE C'E STATO UN ERRORE NEL LOGIN//
 $old_username=Request::old('username');
  return view('login')
  ->with('csrf_token',csrf_token())
  ->with('old_username',$old_username);
}
}


public function LoginPost(){
  /*VERIFICO CHE I DATI SONO CORRENTI FACENDO UNA SELECT AL DATABASE*/
  $result=Utente::where('username',request('username'))->first();
  if($result){
    if (password_verify(request('password'), $result['password'])) {
    Session::put('user_id',$result->id);
    return redirect('home');
  }
  else{
    return redirect('login')->withInput();
  }
}
else{
 return redirect('login')->withInput();
}
}

public function logout(){
  //Eliminiamo i dati di Session e Reindirizzo alla Login//
  Session::flush();
  return redirect('login');
}

public function checkSessione(){
  echo json_encode(Session::get('user_id'));
}
}
?>
