<?php
use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
  protected $hidden=['password'];
  protected $table="utente";
  

  public function preferiti() {
    return $this->belongsToMany('Prodotto','preferiti');
}

public function carrello() {
  return $this->belongsToMany('Prodotto','carrello')->withPivot("quantita")->withPivot("Acquistato");
}
}

