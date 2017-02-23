var path = '/admin/votes/map/ajax/',
	map,
	marker;

	$(document)
	
		.ready(function(e) {
		
			var lat = parseFloat($('#lat').val());
			var lng = parseFloat($('#lng').val());
			var post = $('#title').val();
			var post_ide = $('#post_ide').val();
			
			var position = new google.maps.LatLng(lat,lng)
			
			map = new google.maps.Map(document.getElementById('mapCanvas'),{
				center: position,
				//disableDefaultUI: true,
				zoom: 6,
				mapTypeId: google.maps.MapTypeId.HYBRID
			});
			
			marker = new google.maps.Marker({
				position: position,
				map: map,
				title: post
			});
			
		})
		
			
	; // $(document)
	