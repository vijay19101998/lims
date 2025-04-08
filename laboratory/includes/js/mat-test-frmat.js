$(function() {
  'use strict';
  // date picker 
  if($('#flatpickr-date').length) {
    flatpickr("#flatpickr-date", {
      wrap: true,
      dateFormat: "d-m-Y",
    });
  }

$('#mattest-form').click(function(){ 
  // alert("action");
  // $('#action').val('Add'); 
  $('#form_action').val('insert');
  alert()
  $("form").each(function(){
    $(this).find(':input,textarea,select').removeClass('is-valid'); //<-- Should return all input elements in that specific form.
    $(this).find(':input,textarea,select').removeClass('is-invalid'); //<-- Should return all input elements in that specific form.
  });
});


var Datatable = $('#mattestList ').DataTable({
  'processing': true,
  'serverSide': true,
  'serverMethod': 'post',
  'ajax':{
          url:'ajax-query/masterTable.php',
          type:'POST',
          data:{action:'listmatTest'},
          dataType:'json'
      },
  'columns': [
      
      { data: 'discipline' },
      { data: 'group' },
      { data: 'matcat' },        
      { data: 'matitem' },
      { data: 'standard' },          
      { data: 'created_at' },
      { data: 'action' }
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
            console.log(odata);
            alert(odata.status);
            if(odata.status=="success"){
              successAlert(odata.title,odata.message);
              location.reload();

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
  $("#userForm").validate({
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

  $("#testcategory").on("change",function(){
    var test_category_id = $(this).val();
    var action = 'gettestcat';
    $.ajax({
      url: "ajax-query/masterSubmit.php",
      type:"POST",
      cache:false,
      data:{test_category_id:test_category_id, action:action},
      success:function(data){
        console.log(data);
        $("#group").html(data);
      }
    });     
  });
});

$(document).ready(function(){

  $("#matcat").on("change",function(){
    //alert('matcat');
    var mateial_category_id = $(this).val();
    var action = 'getmatcat';
    console.log(mateial_category_id);
    $.ajax({
      url: "ajax-query/masterSubmit.php",
      type:"POST",
      cache:false,
      data:{mateial_category_id:mateial_category_id, action:action},
      success:function(data){
        console.log(data);
        $("#matitem").html(data);
      }
    });     
  });

 // multi add
  var x = $("#snoid").val();
  $("body").on('click', '.addMoreData', function(e) {
      e.preventDefault();
      x++;
      $("#snoid").val(x);
    $('#additionalContiner').append('<tr id="additionalContinerId'+x+'"><td><input class="col form-control" type="text" name="test['+x+']"></td> <td><input class="col form-control" type="text" name="proto['+x+']"></td><td><select class="col-12 form-control" name="spec['+x+']"><option value="">--Select--</option><option value="1">Select1</option></select></td>  <td><input class="col form-control" type="text" name="value['+x+']"></td>  <td><input class="col form-control" type="text" name="unit['+x+']"></td>  <td><input class="col-12 form-control" type="file" multiple id="file" name="file['+x+']" ></td> <td><button type="button" class="btn btn-danger btn-xs additionalContinerRemove" value="' + x + '">Remove</button></td></tr>');
  });

  $("body").on('click', '.additionalContinerRemove', function(e) {
    e.preventDefault();
    var id = $(this).val();
    $("#additionalContinerId" + id).remove();
  });

});
});

