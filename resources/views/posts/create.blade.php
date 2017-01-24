@extends('templates.blog')

@section('title', 'Criar nova Postagem')

@section('content')
	<h1>Criar nova Postagem</h1>
	<hr>
	<form id="form" action='{{ route("createPost") }}' method='post'>
		{!! csrf_field() !!}
		<div class="status">
		</div>

		@if(Session::has('status'))
			<p class="alert alert-success">{{ Session::get('status') }}</p>
		@endif
		<div class="form-group">
			<label class="control-label" for='title'>Título:</label>
			<input type="text" name='title' class='form-control'>
		</div>
		<div class="form-group">
			<label class="control-label" for='content'>Conteúdo:</label>
			<textarea name='content' class='form-control' rows='14'></textarea>
		</div>
		<div class="form-group">
			<input type='submit' value='salvar' class='form-control btn btn-success'>
		</div>
	</form>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/create-post.js') }}"></script>
@endsection