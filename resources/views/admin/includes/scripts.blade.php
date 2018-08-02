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

.image-editor {
   text-align: center;
}

.cropit-preview {
  background-color: #f8f8f8;
  background-size: cover;
  border: 5px solid #ccc;
  border-radius: 3px;
  margin-top: 7px;
  width: 250px;
  height: 250px;
   display: inline-block;
}

.cropit-preview-image-container {
  cursor: move;
}

.cropit-preview-background {
  opacity: .2;
  cursor: auto;
}

.image-size-label {
  margin-top: 10px;
}

input, .export {
  /* Use relative position to prevent from being covered by image background */
  position: relative;
  z-index: 10;
  display: block;
}

button {
  margin-top: 10px;
}
/* image crop END*/
</style>
@stop

@section('js')
{{-- #############################################
Profile Section
############################################# --}}

{{-- image crop --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropit/0.5.1/jquery.cropit.js"></script>
<script>
    $('#image-cropper').cropit();

    // When user clicks select image button,
    // open select file dialog programmatically
    $('.select-image-btn').click(function() {
      $('.cropit-image-input').click();
    });
</script>
@stop