function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {lat: -0.023559, lng: 37.90619300000003},
          zoom: 7,
          mapTypeId: 'hybrid'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            var marker = new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              draggable:true,
              animation: google.maps.Animation.DROP,
              position: place.geometry.location
            });

            markers.push(marker);

            google.maps.event.addListener(marker, 'dragend', function()
            {
                geocodePosition(marker.getPosition());
            });

            $('#projectlocation').val(place.name);
            $('#latlng').val(place.geometry.location);

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      };

function geocodePosition(pos)
{
   geocoder = new google.maps.Geocoder();
   geocoder.geocode
    ({
        latLng: pos
    },
        function(results, status)
        {
            if (status == google.maps.GeocoderStatus.OK)
            {
            $('#projectlocation').val( results[0].formatted_address );
            $('#latlng').val(pos);
            console.log(pos);
            }
            else
            {
             console.log('Cannot determine address at this location.'+status);
            }
        }
    );
}
