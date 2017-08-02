<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Inicio de sesión -  CPDV</title>
  <link rel="stylesheet" href="{{ url('/frontend/login/css/style.css') }}">
</head>

<body>
  <div class="wrapper">
  	<center><h1 class="CompanyName">Sistema de Tickets</h1></center>
	<div class="container">
		<img src="{{ url('/frontend/login/img/logo2.png') }}" />
		<form class="form-horizontal" role="form" method="post" action="{{url('/login/ValidarForm')}}">
			<input type="text" name="username" placeholder="Usuario" required>
			<input type="password" name="password" placeholder="Contraseña" required>
			<button type="submit" id="login-button">Ingresar</button>
			 {{csrf_field()}}
		</form>
			<div class="text-danger">
            @if(Session::has('message'))
                {{Session::get('message')}}
            @endif
            @if(isset($message)){{$message}}@endif
      </div>
	</div>
	<ul class="bg-bubbles">
		<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
	</ul>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
