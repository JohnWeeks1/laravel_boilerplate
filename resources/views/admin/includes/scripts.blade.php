@section('css')
<style>
/* #############################################
All Sections
############################################# */

.jumbotron {
  background: white;
}


/* #############################################
Profile Section
############################################# */

/* image crop */

.cropit-preview {
  background-color: #f8f8f8;
  background-size: cover;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-top: 7px;
  width: 250px;
  height: 250px;
}

.cropit-preview-image-container {
  cursor: move;
}

.cropit-image-zoom-input {
  width: 250px !important;
}

.image-size-label {
  margin-top: 10px;
}

input {
  display: block;
}

button[type="submit"] {
  margin-top: 10px;
}

#result {
  margin-top: 10px;
  width: 900px;
}

#result-data {
  display: block;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  word-wrap: break-word;
}
/* image crop END*/

/* #############################################
Event Section
############################################# */

/* map */

#map {
    height: 400px;
    width: 100%;
}
/* this is to hide map and satalite view */
.gm-style-mtc {
  display: none;
}
.controls {
    background-color: #fff;
    border-radius: 2px;
    border: 1px solid transparent;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    box-sizing: border-box;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    height: 29px;
    margin-top: 10px;
    outline: none;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 300px;
}

.controls:focus {
    border-color: #4d90fe;
}
.title {
    font-weight: bold;
}
#infowindow-content {
    display: none;
}
#map #infowindow-content {
    display: inline;
}
/* map END */
</style>
@stop

@section('js')
{{-- #############################################
Profile Section
############################################# --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="../js/cropit.js"></script>

<script>
      $(function() {

        // image crop
        $('.image-editor').cropit({ smallImage: 'allow' });

        $('form').submit(function() {
          // Move cropped image data to hidden input
          var imageData = $('.image-editor').cropit('export');
          $('.hidden-image-data').val(imageData);

          // Print HTTP request params
          var formValue = $(this).serialize();
          $('#result-data').text(formValue);

          // Prevent the form from actually submitting
          // return false;
        });
        // image crop END
        
      });

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 13
    });

    var input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(
        input, {placeIdOnly: true});
    autocomplete.bindTo('bounds', map);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var geocoder = new google.maps.Geocoder;
    var marker = new google.maps.Marker({
    map: map
    });
    marker.addListener('click', function() {
    infowindow.open(map, marker);
    });

    autocomplete.addListener('place_changed', function() {
    infowindow.close();
    var place = autocomplete.getPlace();

    if (!place.place_id) {
        return;
    }
    geocoder.geocode({'placeId': place.place_id}, function(results, status) {

        if (status !== 'OK') {
        window.alert('Geocoder failed due to: ' + status);
        return;
        }
        map.setZoom(11);
        map.setCenter(results[0].geometry.location);
        // Set the position of the marker using the place ID and location.
        marker.setPlace({
        placeId: place.place_id,
        location: results[0].geometry.location
        });
        marker.setVisible(true);
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-id'].textContent = place.place_id;
        infowindowContent.children['place-address'].textContent =
            results[0].formatted_address;
        infowindow.open(map, marker);
    });
    });
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw&libraries=places&callback=initMap"></script>
@stop