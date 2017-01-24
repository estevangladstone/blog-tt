<!DOCTYPE html>
<html>
<head>
	<title>Criar Postagem</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1>Criar Post</h1>
		<hr>
		<form id='form' action='{{ route("createPost") }}' method='POST'>
			
			<div id="messages"></div>

			{!! csrf_field() !!}
			<div class="form-group">
				<label class="control-label">Titulo:</label>
				<input type="text" name="titulo" class='form-control'>
			</div>
			<div class="form-group">
				<label class="control-label">Conteudo:</label>
				<textarea name="conteudo" class='form-control'></textarea>
			</div>
			<div class="form-group">
				<input type="submit" value='enviar' class='btn btn-success form-control'>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="{{ asset('js/create-post.js') }}"></script>
</body>
</html>