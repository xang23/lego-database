window.onload = function() {
				if(!window.location.hash) {
				window.location = window.location + '#reload';
				window.location.reload();
				}
				}