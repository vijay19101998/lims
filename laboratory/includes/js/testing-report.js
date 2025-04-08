$(function() {
    'use strict';
    // date picker 
    if($('#flatpickr-date').length) {
      flatpickr("#flatpickr-date", {
        wrap: true,
        dateFormat: "d-m-Y",
      });
    }
  
    $('#addDemo').click(function(){
          $('#demoModal').modal('show');
          $('#demoForm')[0].reset();
      $('.modal-title').html("<i class='fa fa-plus'></i> Add demo form");
          $('#action').val('Add');
          $('#form_action').val('insert');
      $("form").each(function(){
        $(this).find(':input,textarea,select').removeClass('is-valid'); //<-- Should return all input elements in that specific form.
        $(this).find(':input,textarea,select').removeClass('is-invalid'); //<-- Should return all input elements in that specific form.
      });
      });
    //
    var demoDatatable = $('#testlist').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax':{
              url:'ajax-query/masterTable.php',
              type:'POST',
              data:{action:'listtest'},
              dataType:'json'
          },
      'columns': [
          { data: 'Sample code' },
          { data: 'Report Date' },
          { data: 'Report Number' },
          { data: 'Discipline' },
          { data: 'Sample Name' },
      ]
  });
    //
    $.validator.setDefaults({
      submitHandler: function(form) {
        //console.log(form);
        var actionFun = $(form).attr('action');
        //
        var formData = new FormData(form);
          //formData.push({ name: "action", value: actionFun });
          formData.append( "action", actionFun );
          $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "ajax-query/masterSubmit.php",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            dataType:"json",
            beforeSend: function () {
              $('#action-btn').prop('disabled', true);
            },
            success:function(odata) {
              console.log(odata);alert(odata.status);
              if(odata.status=="success"){
                successAlert(odata.title,odata.message);
                $('#demoForm')[0].reset();
                $('#demoModal').modal('hide');				
                $('#action-btn').attr('disabled', false);
              }else{
                $('#action-btn').prop('disabled', false);
                failedAlert(odata.title,odata.message);
              }
            }
  
          })
        //
        
      }
    });
    $(function() {
      // validate signup form on keyup and submit
      $("#demoForm").validate({
        rules: {
        },
        messages: {
        },
        errorPlacement: function(error, element) {
          error.addClass( "invalid-feedback" );
  
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          }
          else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
            error.insertAfter(element.parent().parent());
          }
          else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
            error.appendTo(element.parent().parent());
          }
          else {
            error.insertAfter(element);
          }
        },
        highlight: function(element, errorClass) {
          if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
            $( element ).addClass( "is-invalid" ).remo
            veClass( "is-valid" );
          }
        },
        unhighlight: function(element, errorClass) {
          if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
          }
        }
      });
      //
    });
    
  });