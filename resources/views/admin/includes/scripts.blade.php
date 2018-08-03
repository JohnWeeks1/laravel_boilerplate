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
        $('.image-editor').cropit();

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
</script>
@stop