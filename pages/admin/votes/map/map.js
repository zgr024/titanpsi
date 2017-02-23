var path = '/admin/votes/map/',
	map = '',
	markers = [];
	
	$(document)
	
		.ready(function(e) {
		
			var lat = parseFloat($('#lat').val());
			var lng = parseFloat($('#lng').val());
						
			map = new google.maps.Map(document.getElementById('mapCanvas'),{
				center: new google.maps.LatLng(lat,lng),
				//disableDefaultUI: true,
				zoom: 4,
				mapTypeId: google.maps.MapTypeId.HYBRID
			});
			
			var map_bounds = new google.maps.LatLngBounds();
	
			$.getJSON(path+'ajax/get-locations',function(locations) {
				
				$.each(locations, function(key, data) {
	
					if (data.lat) {
	
						var myLatLng = new google.maps.LatLng(data.lat,data.lng);								
						
						var icon = new google.maps.MarkerImage('/images/icons/'+data.vote.toLowerCase()+'-marker.png',
							new google.maps.Size(35,30),
							new google.maps.Point(0,0),
							new google.maps.Point(17,15)
						);   
						
						var marker = new google.maps.Marker({
							position: myLatLng,
							map: map,
							title: data.title + ' (' + data.vote.toUpperCase() + ')',
							ide: data.ide,
							icon: icon,
							post: data.title
						});
			
						google.maps.event.addListener(marker, 'click', function (event) {
							$.dialog({
								title: this.post,
								content: 'url:'+path+'skybox/profile/'+this.ide,
							});
						});
						
						markers.push(marker);
						
						map_bounds.extend(myLatLng);
						
					}
	
		
				});
				
				if(markers.length) {
					//map.fitBounds(map_bounds);
				}
					
			});
		
		})
		
	; // $(document)