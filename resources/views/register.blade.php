<html>
<head>
<link rel='stylesheet' href='{{url("css/registerform.css")}}'>
<script src='{{url("js/registerform.js")}}'defer></script>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@1,300&display=swap" rel="stylesheet">
</head>
<body>
<!--ABBIAMO UN DIV ERRORE NASCOSTO CHE COMPARE IN CASO DI ERRORE-->
<div class="errore"></div>
<!--IL FORM AL CLICK MANDA I DATI POST-->
<form id="form1" method="post">
<h1>CREA IL TUO ACCOUNT</h1>
<input type='hidden' name='_token' value='{{$csrf_token}}'>
<label>Nome<input id="Nome" type="text" name="Nome"></label>
<div id="NomeError">
</div>
<label>Cognome<input id="Cognome"  type="text" name="Cognome"></label>
<div id="CognomeError">
</div>
<label>Email<input id="Email" type="text" name="mail"></label>
<div id="EmailError">
</div>
<label>Indirizzo<input id="indirizzo"  type="text" name="Indirizzo"></label>
<div id="IndirizzoError">
</div>
<label>Username<input id="Username" type="text" name="Username"></label>
<div id="UsernameError">
</div>
<label>Password<input id="Password" type="password" name="Password"></label>
<div id="PasswordError">
</div>
<input id="Accept" type="radio" name="Accept" value="true">Acconsento al furto dei dati personali
<div id="AcceptError">
</div>
<label>&nbsp;<input class="button" type="submit" name="invio" value="invia"></label>
<a href='{{url("login")}}'>SEI GIA REGISTRATO EFFETTUA IL LOGIN</a>
</form>
</body>
</html>
