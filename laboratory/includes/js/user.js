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
  var demoDatatable = $('#userList').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax':{
            url:'ajax-query/masterTable.php',
            type:'POST',
            data:{action:'userList'},
            dataType:'json'
        },
    'columns': [
      { data: 'username', searchable: true },
      { data: 'user_type', searchable: true },
      { data: 'action', searchable: false }
    ]
});


  //
  // let tableId = demoDatatable.attr('id'),
  // searchInput = table
  //   .parents('.dataTables_wrapper')
  //   .find('input[type=search]'),
  // ourInput = $(document.createElement('input'))
  //   .attr({
  //     type: 'search',
  //     'class': 'form-control form-control-sm',
  //     'aria-controls': tableId,
  //   });
  // alert();

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
            // console.log(odata);
            // alert(odata.status);
            if(odata.status=="success"){
              successAlert(odata.title,odata.message);
              $('#userForm')[0].reset();
              $('#userModal').modal('hide');				
              $('#action-btn').attr('disabled', false);
              $('#userList').DataTable().ajax.reload();
            }else{
              $('#action-btn').prop('disabled', false);
              failedAlert(odata.title,odata.message);
            }
            $('#userList').DataTable().ajax.reload();

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
  $(document).on('click', '.update', function(){
    var id = $(this).attr("id");
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
  
  // $(document).on('click', '.delete', function () {
  //   // alert();
  //   var id = $(this).attr("id");
  //   var form_action = 'users';
  //   var action = 'getFormDelete';
  //   $.ajax({
  //     url: 'ajax-query/masterSubmit.php',
  //     method: "POST",
  //     data: { id: id, action: action, form_action: form_action },
  //     dataType: "json",
  //     success: function (result) {
  //       // console.log(result);
  //       //  alert(result.status);
  //       failedAlert(result.status, result.message);
  //       $('#userList').DataTable().ajax.reload();
  //     }
  //   })
  // });
  //
    $(document).on('click', '.delete', function () {
    
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger me-2'
        },
        buttonsStyling: false,
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'me-2',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          //
          var id = $(this).attr("id");
          var form_action = 'users';
          var action = 'getFormDelete';
          $.ajax({
            url: 'ajax-query/masterSubmit.php',
            method: "POST",
            data: { id: id, action: action, form_action: form_action },
            dataType: "json",
            success: function (result) {
              // console.log(result);
              //  alert(result.status);
              // failedAlert(result.status, result.message);
              $('#userList').DataTable().ajax.reload();
            }
          });
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      });
  });
  //

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


        $("#profileForm").submit(function(event) {
          event.preventDefault();
          var formData = new FormData(this);
            formData.append ('action', 'updateProfile');
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
            if(odata.status=="success"){
              successAlert(odata.title,odata.message);
              $('#userForm')[0].reset();
              $('#userModal').modal('hide');				
              $('#action-btn').attr('disabled', false);
            }else{
              $('#action-btn').prop('disabled', false);
              failedAlert(odata.title,odata.message);
            }          }

        })
  });
  //
        $("#profileFormpass").submit(function(event) {
          event.preventDefault();
          var formData = new FormData(this);
            formData.append ('action', 'updateProfile');
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
            if(odata.status=="success"){
              successAlert(odata.title,odata.message);
              $('#userForm')[0].reset();
              $('#userModal').modal('hide');				
              $('#action-btn').attr('disabled', false);
            }else{
              $('#action-btn').prop('disabled', false);
              failedAlert(odata.title,odata.message);
            }
            }

        })
  });


});