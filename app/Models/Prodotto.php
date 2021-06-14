<?php
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
  protected $table="prodotto";

  public function preferiti() {
    return $this->belongsToMany('Utente','preferiti');
}  
public function carrello() {
  return $this->belongsToMany('Utente','carrello')->withPivot("quantita")->withPivot("Acquistato");
} 
}
