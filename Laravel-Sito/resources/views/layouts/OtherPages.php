<html>
  <head>
        <meta charset="utf-8">
        <title>ELECTROLUS</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0"> <!--SI METTE PER IL MOBILE-->
        @section('css')
        <link rel="stylesheet" href="{{ url('css/mhw2otherpage.css')}}">
        @show
        @section('js')
        <script src='{{url("js/scriptMenuMobile.js")}}' defer></script>
        @show
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@545&display=swap" rel="stylesheet">
  </head>
  <body>
      <header> <!--FLEX CONTAINER--->
        <div id="overlay"></div>
         <nav>  <!--FLEX ITEM DI HEAD MA FLEX CONTAINER DI LOGO E FLEX ITEM NAV -->
		     <span id="logo">ELECTROLUS</span>
             <div class="flex-itemnav">
               <a href='{{url("home")}}'>Home</a>
               <a  href='{{url("Computer")}}'>Computer</a>
               <a  href='{{url("Smartphone")}}'>Smartphone</a>
               <a  href='{{url("Accessori")}}'>Accessori</a>
               @if($id_utente)
               <a href='{{url("Carrello")}}'>Carrello</a>
               <a href='{{url("Acquisti")}}'>Acquisti</a>
               <a href='{{url("logout")}}'>Logout</a>
               @elseif($id_utente==null)
              <a href='{{url("register")}}'>Registrati</a>
               @endif
              </div>
              <div id="menu">
                <div class="linemobile"></div>
                <div class="linemobile"></div>
                <div class="linemobile"></div>
              </div>
                <div class="linkmobile">
               </div>
         </nav>
         <h1>@yield('h1text')</h1><br/>  <!--FLEX ITEM DI HEADER-->
      </header>







@section('search')
<div class="searchbox">
   <h1>@yield('text')</h1>
</div>
@show

@section('divMore')
@show



   <!--DIV CHE CONTERRA TUTTI GLI ELEMENTI-->
@section('flexsection')
<section class="flex-section">
</section>
@show

<footer>
     <h1>ELECTROLUS</h1>
     <p>Electrolus S.P.A</p>
     <p>Sede Legale e Operativa:Via de Brance 26 Roma</p>
     <p>95131 Roma (RM)</p>
     <p>Edited by Leotta Gabriele O46001999</p>
</footer>
</body>
</html>