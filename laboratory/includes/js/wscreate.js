$(function() {

    'use strict';
    // date picker 
    if($('#flatpickr-date').length) {
      flatpickr("#flatpickr-date", {
        wrap: true,
        dateFormat: "d-m-Y",
      });
    }
  

    //
    $.validator.setDefaults({
      submitHandler: function(form) {
        // console.log(form);
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
              console.log(odata);
              // alert(odata.status);
              if(odata.status=="success"){
                successAlert(odata.title,odata.message);
                //  location.reload();
                var id=odata.testingId;
                window.location.href="work-sheet.php?testingId="+id+""

                $('#userForm')[0].reset();
                $('#userModal').modal('hide');        
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
        $("#wsCreate").validate({
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
              $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
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
//
$(document).ready(function(){
  $("#sample_id").on("change",function(){
    var sampleID = $(this).val();
    var action = 'parametersList';
    $.ajax({
      url: "ajax-query/masterSubmit.php",
      type:"POST",
      cache:false,
      data:{sampleId:sampleId, action:action},
      success:function(data){
        $("#getParmList").html(data);
      }
    });     
  });
  });
   //
   $(function() {
    // validate signup form on keyup and submit
    $("#createws").validate({
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
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
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