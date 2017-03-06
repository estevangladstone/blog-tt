var chat = new Vue({
	el: '#chat',
	data: {
		messages: [],
	},
	methods: {
		more: function () {
			if(this.messages.length > 0) {
				var older = this.messages[0].message_id;
				$.ajax({
					method: 'GET',
					url: 'chat/more/'+older,
					success: function (response) {
						if(response) {
							chat.messages = chat.merge(chat.messages, response, null, true);
						}
					},
					error: function () {
						console.log('Erro');
					}
				});
			}
		},
		send: function () {
			$.ajax({
				method: 'POST',
				url: 'chat/send',
				data: {
					_token: document.querySelector("meta[name='csrf-token']").getAttribute('content'),
					text: document.getElementById('messageTyped').value
				},
				success: function (response) {
					var input = document.getElementById('messageTyped');
					input.value = "";
					input.focus();
					if(response) {
						var newLength = chat.messages.length > 25 ? chat.messages.length : null;
						chat.messages = chat.merge(chat.messages, response, newLength, true);
					}
				},
				error: function () {
					console.log('Erro');
				}
			});	
		},
		update: function () {
			if(chat.messages.length > 0) {
				var last = chat.messages[chat.messages.length - 1].message_id;
			} else {
				var last = '';
			}
			$.ajax({
				method: 'GET',
				url: 'chat/update/'+last,
				cache: false,
				success: function (response) {
					if(response) {
						var newLength = chat.messages.length > 25 ? chat.messages.length : null;
						chat.messages = chat.merge(chat.messages, response, newLength, true);
					}
					setTimeout(chat.update, 1000);
				},
				error: function () {
					console.log('Erro');
					setTimeout(chat.update, 1000);
				}
			});
		},
		merge: function (array1, array2, newLength, removeDuplicates) {
			a = array1.concat(array2);
			if(removeDuplicates) {
				for(var i = 0; i < a.length; ++i) {
				    for(var j = i+1; j < a.length; ++j) {
				        if(a[i].message_id === a[j].message_id)
				            a.splice(j--, 1);
				    }
				}
			}
			a = a.sort(function (a, b) {
				return a.message_id > b.message_id ? 1 : -1;
			});
			if(newLength) {
				a = a.splice(-newLength);
			}
			return a;
		}
	} 
});

(function(){
	document.getElementById('send').addEventListener('click', chat.send);
	chat.update();
})();