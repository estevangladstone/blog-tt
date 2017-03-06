<html>
	<head>
		<title>CHAT</title>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<br>
			<div class="panel panel-default" id="chat">
		  		<div class="panel-heading">
		  		  	<h3 class="panel-title">Chat</h3>
		  		</div>
			  	<div class="panel-body">
			    	<div style="width:100%;height:600px;overflow:auto;">
			    		<button v-if="messages.length" v-on:click="more" class="btn btn-default btn-more">mensagens anteriores</button>
			    		<p v-for="message in messages" class="alert alert-success alert-auto" v-if="message.user == 'Eu'">
			    			@{{ message.user }} (@{{ message.created_at }}) : @{{ message.text }} [@{{ message.message_id }}]
			    		</p>
			    		<p class="alert alert-info alert-auto" v-else>
							@{{ message.user }} (@{{ message.created_at }}) : @{{ message.text }} [@{{ message.message_id }}]
			    		</p>
			    	</div>
			  	</div>
			  	<div class="panel-footer">
		  			<div class="row">
		  			  <div class="col-md-12">
		  			    <div class="input-group">
		  			      <input v-on:keyup.enter="send" type="text" class="form-control" id="messageTyped" placeholder="Escreva aqui...">
		  			      <span class="input-group-btn">
		  			        <button v-on:click="send" class="btn btn-success" type="submit" id="send">Enviar</button>
		  			      </span>
		  			    </div><!-- /input-group -->
		  			  </div><!-- /.col-lg-6 -->
		  			</div><!-- /.row -->
			  	</div>
			</div>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://unpkg.com/vue/dist/vue.js"></script>
		<script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>
	</body>
</html>









