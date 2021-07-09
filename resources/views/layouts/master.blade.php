<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>app laravel</title>
</head>
<body>
     <!--error de la sesion-->
	 @if(session()->has('error'))
		 <div class="alert alert-danger">
		 	{{session()->get('error')}}
		 </div>
	 	
	 @endif
	 <!--si encuentra un error-->
	 @if(isset($errors) && $errors->any())
	 	<div class="alert alert-danger">
	 		 <!--recorre todos los errores y los muestra en un mensaje-->
	 		<ul>
	 			@foreach($errors->all() as $error)
	 				<li>{{$error}}</li>
	 			@endforeach

	 		</ul>

	 	</div>
	 @endif

	@yield('content')
</body>
</html>