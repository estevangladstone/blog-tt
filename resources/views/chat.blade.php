<html>
	<head>
		<title>CHAT</title>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style type="text/css">
			.alert-auto {
				display: inline-block;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<br>
			<div class="panel panel-default">
		  		<div class="panel-heading">
		  		  	<h3 class="panel-title">Chat</h3>
		  		</div>
			  	<div class="panel-body">
			    	<div id="message-box" style="width:100%;height:600px;overflow:auto;"></div>
			  	</div>
			  	<div class="panel-footer">
		  			<div class="row">
		  			  <div class="col-md-12">
		  			    <div class="input-group">
		  			      <input type="text" class="form-control" id="messageTyped" placeholder="Escreva aqui...">
		  			      <span class="input-group-btn">
		  			        <button class="btn btn-success" type="submit" id="send">Enviar</button>
		  			      </span>
		  			    </div><!-- /input-group -->
		  			  </div><!-- /.col-lg-6 -->
		  			</div><!-- /.row -->
			  	</div>
			</div>
		</div>
		<script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>
	</body>
</html>









