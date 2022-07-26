console.log("hello");
$("#demo").spartanMultiImagePicker({
    fieldName:  'fileUpload[]'
  });
  $("#demo").spartanMultiImagePicker({
    fieldName:  'fileUpload[]',
    maxCount : 10
  });
  $("#demo").spartanMultiImagePicker({
    rowHeight : '200px',
    groupClassName : 'col-md-4 col-sm-4 col-xs-6'
  });
  $("#demo").spartanMultiImagePicker({
    placeholderImage: {
      image : ADDICON,
      width : '64px'
    },
  });
  $("#demo").spartanMultiImagePicker({
    allowedExt: 'png|jpg|jpeg|gif'
  });
  $("#demo").spartanMultiImagePicker({
    maxFileSize: '',
  });
  $("#demo").spartanMultiImagePicker({
    onAddRow:          function() {},
    onRenderedPreview: function() {},
    onRemoveRow:       function() {},
    onExtensionErr:    function() {},
    onSizeErr:         function() {}
  });
  $("#demo").spartanMultiImagePicker({
    dropFileLabel:    'Drop file here',
  });
  $("#demo").spartanMultiImagePicker({
    directUpload :  {
      loaderIcon: '<i class="fas fa-sync fa-spin"></i>',
      status:       false,
      url:          '',
      success:      function() {},
      error:        function() {}
    },
  });