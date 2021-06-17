@extends('layouts.ciccio')
@section('h1text','Incuriosisciti di vedere  tutte le nostre novita')
@section('css')
    <link rel="stylesheet" href="{{ url('css/home.css') }}">
@endsection



@section('search')
@endsection

@section('divMore')
      <div id="paragrafer">        <!--FLEX CONTAINER-->
        <h1>Tutto ciò che desideri  <!--FLEX ITEM-->
        <br> E' alla portata di un semplice click
        </h1>
         <p>In base alle tue esigenze abbiamo i migliori prodotti dei migliori brand informatici<br>   <!--FLEX ITEM-->
         dal campo dei computer passando al campo degli smartphone,fino agli accessori
         </p>
</div>
@endsection



@section('flexsection') 
 <section class="flex-section">
           <div class="flex-itemsection"> <!--FLEX ITEM DI SECTION MA FLEX CONTAINER DI IMG,H1,P,A -->
            <img src="images/foto1.jpg">
            <h1>COMPUTER</h1>
            <p>Scopri tutti i nostri computer in vendita,sfoglia il catalogo e trova l'offerta migliore </p>
            <a href='{{url("Computer")}}' class="button">Scopri di più</a>
          </div>
          <div class="flex-itemsection">                 <!--FLEX ITEM DI SECTION MA FLEX CONTAINER DI IMG,H1,P,A -->
           <img src="images/foto2.jpg">
           <h1>SMARTPHONE</h1>
           <p>Scopri tutti gli smartphone in vendita,sfoglia il catalogo e trova l'offerta migliore</p>
           <a href='{{url("Smartphone")}}' class="button">Scopri di più</a>
         </div>
        <div class="flex-itemsection">  <!--FLEX ITEM DI SECTION MA FLEX CONTAINER DI IMG,H1,P,A -->
          <img  src="images/foto3.jpg">
          <h1>ACCESSORI</h1>
          <p>Scopri tutti i nostri accessori in vendita,sfoglia il catalogo e trova l'offerta migliore </p>
          <a href='{{url("Accessori")}}' class="button">Scopri di più</a>
       </div>
</section>
@endsection

