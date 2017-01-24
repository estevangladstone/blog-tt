@extends('templates.blog')

@section('title', 'Página Inicial')

@section('styles')
@endsection

@section('content')
	<section id="posts">
		<h1>Últimas postagens</h1>
		<hr>
		@foreach($posts as $post)
			<article class="post">
				<header>
					<h3>{{ $post->title }} <small>{{ $post->created_at->format('Y-m-d') }}</small></h3>
					<br>
					<p>{{ $post->content }}</p>
				</header>
			</article>
		@endforeach
	</section>
@endsection

@section('scripts')
@endsection