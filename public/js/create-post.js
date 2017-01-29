document.getElementById('form').addEventListener('submit', function(event){
	event.preventDefault(); // Para evitar que o envio do formulário continue com o envio da requisição

	// Dados do formulário que enviaremos para o servidor
	var data = {
		_token: this.elements['_token'].value,
		titulo: this.elements['titulo'].value,
		conteudo: this.elements['conteudo'].value
	};

	console.log(data);  // Para checar se os dados do formulário que pegamos estão corretos

	// URL para onde enviaremos a request -- pegamos da action do formulário
	var url = this.getAttribute('action');

	console.log(url); // Para checar se a URL que pegamos está correta

	xhr = new XMLHttpRequest(); // Criação do Objeto XMLHttpRequest

	xhr.open('POST', url, true); // Preparando as primeiras informações para o envio da request
	xhr.onload = function(){ // Espeficicando a função que será executada ao final da request e tratará a resposta do servidor
		switch (xhr.status) {
			case 200: // Tudo OK
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
			case 400: // Erro com os dados enviados pelo usuário
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
			default: // Para qualquer outro código de erro
				alert('Algum erro ocorreu. Por favor recarregue a página e tente novamente.');
				break;
		}
	}
	xhr.setRequestHeader('Content-Type', 'application/json'); // Especificando na request que enviaremos um dado como JSON

	xhr.send(JSON.stringify(data)); // Fazendo o envio da request que preparamos
});