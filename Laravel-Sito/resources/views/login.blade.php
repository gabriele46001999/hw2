<html>
<head>
<link rel='stylesheet' href='{{url("css/loginform.css")}}'>
<script src='{{url("js/login.js")}}'defer></script>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@1,300&display=swap" rel="stylesheet">
</head>
<body>
@if(isset($old_username))
<div class='errore'>Credenziali non valide</div>
@endif
<div class='FieldVuoti'></div>
<h1>EFFETTUA IL LOGIN</h1>
<form id="formlogin" method="post">
<input type='hidden' name='_token' value='{{$csrf_token}}'>
<label>Username<input id="username" type='text' name='username' value='{{$old_username}}'></label>
<label>Password<input id="password" type='password' name='password'></label>
<label>&nbsp; <input class="button" type="submit"></label>
<a href='{{url("register")}}'>Registrati</a>
</body>
</html>
