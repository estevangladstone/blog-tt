document.getElementById('form').addEventListener('submit', function(event){
	event.preventDefault();

	var data = {
		_token: this.elements['_token'].value,
		titulo: this.elements['titulo'].value,
		conteudo: this.elements['conteudo'].value
	};

	console.log(data);

	var url = this.getAttribute('action');

	console.log(url);

	xhr = new XMLHttpRequest();

	xhr.open('POST', url, true);
	xhr.onload = function(){
		switch (xhr.status) {
			case 200: 
				var form = document.getElementById('form');
				form.elements['titulo'].value = '';
				form.elements['conteudo'].value = '';
				form.elements['titulo'].focus();

				var statusMessages = document.getElementById('messages');
				var p = document.createElement('p');
				p.className = 'alert  alert-success';
				p.innerHTML = JSON.parse(xhr.responseText).status;
				statusMessages.appendChild(p);
				break;
			case 400:
				var response = JSON.parse(xhr.responseText);
				for (var message in response.errors){
					for (var error in response.errors[message]){
						var p = document.createElement('p');
						p.className = 'alert alert-danger';
						p.innerHTML = response.errors[message][error]
						document.getElementById('messages').appendChild(p);		
					}	
				}
				console.log(xhr.responseText);
				break;
			default:
				alert('Deu errooo!');
				break;
		}
	}
	xhr.setRequestHeader('Content-Type', 'application/json');

	xhr.send(JSON.stringify(data));
});