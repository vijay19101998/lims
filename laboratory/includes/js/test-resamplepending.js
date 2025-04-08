$(function() {
    'use strict';
    // date picker 
    if($('#flatpickr-date').length) {
      flatpickr("#flatpickr-date", {
        wrap: true,
        dateFormat: "d-m-Y",
      });
    }
  
    $('#adduser').click(function(){
          $('#userModal').modal('show');
          $('#userForm')[0].reset();
      $('.modal-title').html("<i class='fa fa-plus'></i> Add User");
          $('#action').val('Add');
          $('#form_action').val('insert');
      $("form").each(function(){
        $(this).find(':input,textarea,select').removeClass('is-valid'); //<-- Should return all input elements in that specific form.
        $(this).find(':input,textarea,select').removeClass('is-invalid'); //<-- Should return all input elements in that specific form.
      });
      });
    //
    $(document).ready( function () {
      function filterGlobal () {
     $('#testResample').DataTable({
        destroy: true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax':{
                url:'ajax-query/masterTable.php',
                type:'POST',
                data:{
                  action:'testResamplePending',
                  testCategory:$('#testCategory').val(),
                  testGroup:$('#testGroup').val(),
                  materialGroup:$('#materialGroup').val(),
                  materialItem:$('#materialItem').val(),
                  materialGroup:$('#materialGroup').val()
                },
                dataType:'json'
            },
        'columns': [
            { data: 'sampling_date' },
            { data: 'sample_code' },
            { data: 'sample_id' },
            { data: 'standard_test_id' },
            { data: 'action' },
        ]
    });
    $('#filterModal').modal('hide');
  }

//
$('#search-action-btn').on( 'click', function () {
  filterGlobal();
});
filterGlobal();

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
  
    $(document).on('click', '.update', function(){
      var id = $(this).attr("id");
      // alert(id);
      var form_action = 'users';
      var action = 'getFormEdit';
      $.ajax({
        url:'ajax-query/masterSubmit.php',
        method:"POST",
        data:{id:id, action:action,form_action:form_action},
        dataType:"json",
        success:function(data){
          console.log(data);
          $('#userModal').modal('show');
          // $('#').val(data.id);
          $('#username').val(data.username);
          $('#password').val(data.password);
          $('#user_type').val(data.user_type_id);
          $('#emp_no').val(data.emp_no);
          $('#company_name').val(data.company_name);
          $('#emp_name').val(data.emp_name);
          $('#email').val(data.email);
  
          $('#gender').val(data.gender);
           
          $('#phone_no').val(data.phone_no);
          $('#mobile_no').val(data.mobile_no);
          $('#communication_address').val(data.communication_address);
          $('#permanent_address').val(data.permanent_address);
          // $('#photo').val(data.photo);
          // $('#comment').val(data.comment);
          $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit user");
          $('#id').val(id);
          $('#form_action').val('update');
          $('#action-btn').html('Update');
        }
      })
    });
    
    $(document).on('click', '.delete', function(){
      var id = $(this).attr("id");
      // alert(id);
      var form_action = 'users';
      var action = 'deleteData';
      $.ajax({
        url:'ajax-query/masterSubmit.php',
        method:"POST",
        data:{id:id, action:action,form_action:form_action},
        dataType:"json",
        success:function(data){
          console.log(data);
          successAlert('Delete','Success!');
          // location.reload();
         
        }
      })
    });
  
    $(document).on('change', '#usertype', function() {
      var stateID = $(this).val();
  //  alert(stateID);
      if(stateID) {
          
          $.ajax({
              type: 'POST',
              url: 'material_test_format1.php',
              data: {'StCode': stateID},
              success: function(response) {
                  // console.log(function);
                  $('#district').html(response);
  
              }
          });
      } else {
          $('#district').html('<option value="">district</option>');
          // $('#city').html('<option value=""> State </option>');
      }
  });
  });