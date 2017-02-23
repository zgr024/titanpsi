$(document)
	
	.ready(function() {
		fetchVotes();
		setInterval (fetchVotes,5000);
	})
	
	function fetchVotes() {
		var lastID = $('#lastID').val();
		$.getJSON('/admin/ajax/socket/votes',{ lastID: lastID },function(data,statu,sxhr) {
			if (data.changed) {
				var html = '';
				$('#votesTable').prepend(data.html);
				$('tr.new').delay(1000).animateHighlight();
				$('#lastID').val(data.lastID);
			}
		})
	}
;