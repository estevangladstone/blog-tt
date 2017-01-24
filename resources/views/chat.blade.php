<html>
	<head>
		<title>CHAT</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
		<script type="text/javascript">

			function updateMessages(text){
				var messages = document.getElementById('message-box');
				messages.innerHTML = text;
				setTimeout(requestMessages, 800);
				var objDiv = document.getElementById("message-box");
				objDiv.scrollTop = objDiv.scrollHeight;
			}

			function requestMessages(){
				var xhr = new XMLHttpRequest();
				xhr.open('GET', 'chat/get-messages');
				xhr.onload = function() {
				    if (xhr.status === 200) {
				        updateMessages(xhr.responseText);
				    }
				    else {
				        alert('Request failed.  Returned status of ' + xhr.status);
				        console.log(xhr);
				    }
				};
				xhr.send();
			}

			function sendMessage(){
				console.log('oi');
				var messageTyped = document.getElementById('messageTyped');
			   	var token = document.querySelector("meta[name='csrf-token']").getAttribute('content');

			   	var xhr = new XMLHttpRequest();
			   	xhr.open('post', 'chat/send-message');
			   	xhr.setRequestHeader('Content-Type', 'application/json');
			   	xhr.onload = function() {
			   	    if (xhr.status === 200) {
			   	        messageTyped.value = "";
			   	        messageTyped.focus();
			   	        console.log('oi');
			   	    }
			   	    else {
			   	    	alert('Deu errrrrroooo!');
			   	    }
			   	};
			   	var data = {
			   		_token : token,
			   		message : messageTyped.value
			   	};
			   	xhr.send(JSON.stringify(data));
			}

			(function(){
				document.getElementById('send').addEventListener('click', function (){
					sendMessage();	
				});
				requestMessages();
			})();

		</script>
	</body>
</html>









