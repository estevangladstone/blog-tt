function updateMessages(text){
	var messages = document.getElementById('message-box');
	messages.innerHTML = text;
	setTimeout(requestMessages, 800); // chama a função para pediar as mensagens ao servidor a cada 0.8 segundos
	var objDiv = document.getElementById("message-box");
	objDiv.scrollTop = objDiv.scrollHeight; // mantém o scroll da caixa de mensagens sempre nas mensagens mais novas
}

function requestMessages(){
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'chat/get-messages');
	xhr.onload = function() {
	    if (xhr.status === 200) {
	        updateMessages(xhr.responseText);
	    }
	    else {
	        alert('Request of messages failed. Returned status of ' + xhr.status);
	        console.log(xhr);
	    }
	};
	xhr.send();
}

function sendMessage(){
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
   	    	alert('Não entre em pânico! Já enviamos nossa equipe de macacos treinados para resolver o seu problema.');
   	    }
   	};
   	var data = {
   		_token : token,
   		message : messageTyped.value
   	};
   	xhr.send(JSON.stringify(data));
}

(function(){
	document.getElementById('send').addEventListener('click', sendMessage);
	requestMessages();
})();
