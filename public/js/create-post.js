document.getElementById('form').addEventListener('submit', function(event){
	event.preventDefault();

	var url = this.getAttribute('action');
	var token = document.querySelector("meta[name='csrf-token']").getAttribute('content');
	// var data = new FormData(this); // this faz referencia ao form
	var data = {
		token 	: this.elements["_token"].value,
		title 	: this.elements["title"].value,	
		content : this.elements["content"].value
	}
	var xhr = new XMLHttpRequest();

	xhr.open('POST', url, true);
	xhr.setRequestHeader('Content-Type', 'application/json');
	xhr.setRequestHeader('X-CSRF-TOKEN', token);
	xhr.onload = function() {
		switch (xhr.status) {
			case 200: 
	    		var response = JSON.parse(xhr.responseText);
	        	document.getElementsByClassName('status')[0].innerHTML = '<p class="alert alert-success">'+response.status+'</p>';
				break;
			case 400: 
				var response = JSON.parse(xhr.responseText);
				for (var message in response.errors){
					for (var error in response.errors[message]){
						var p = document.createElement('p');
						p.className = 'alert alert-danger';
						p.innerHTML = response.errors[message][error]
						document.getElementsByClassName('status')[0].appendChild(p);		
					}	
				}
				break;
			default: 
				alert('Algum erro ocorreu.');
				break;
		}
	};
	xhr.send(JSON.stringify(data));
});