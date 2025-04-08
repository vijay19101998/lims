$(function () {
  'use strict';
  // date picker 
  if ($('#flatpickr-date').length) {
    flatpickr("#flatpickr-date", {
      wrap: true,
      dateFormat: "d-m-Y",
    });
  }

  $('#addType').click(function () {
    $('#typeModal').modal('show');
    $('#typeForm')[0].reset();
    $('.modal-title').html("<i class='fa fa-plus'></i> Add user type");
    $('#action').val('Add');
    $('#form_action').val('insert');
    $("form").each(function () {
      $(this).find(':input,textarea,select').removeClass('is-valid'); //<-- Should return all input elements in that specific form.
      $(this).find(':input,textarea,select').removeClass('is-invalid'); //<-- Should return all input elements in that specific form.
    });
  });
  //
  var demoDatatable = $('#userList').DataTable({
    dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      url: 'ajax-query/masterTable.php',
      type: 'POST',
      data: { action: 'listType' },
      dataType: 'json'
    },
    'columns': [
      { data: 'name' },
      { data: 'action' },
    ]
  });
  //
  $.validator.setDefaults({
    submitHandler: function (form) {
      //console.log(form);
      var actionFun = $(form).attr('action');
      //
      var formData = new FormData(form);
      //formData.push({ name: "action", value: actionFun });
      formData.append("action", actionFun);
      $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "ajax-query/masterSubmit.php",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        dataType: "json",
        beforeSend: function () {
          $('#action-btn').prop('disabled', true);
        },
        success: function (odata) {
          // console.log(odata);
          // alert(odata.status);
          if (odata.status == "success") {
            successAlert(odata.title, odata.message);
            $('#typeForm')[0].reset();
            $('#typeModal').modal('hide');
            $('#action-btn').attr('disabled', false);
          } else {
            $('#action-btn').prop('disabled', false);
            failedAlert(odata.title, odata.message);
          }
          $('#userList').DataTable().ajax.reload();
          // location.reload();
        }

      })
      //

    }
  });
  $(function () {
    // validate signup form on keyup and submit
    $("#typeForm").validate({
      rules: {
      },
      messages: {
      },
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");

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
      highlight: function (element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $(element).addClass("is-invalid").removeClass("is-valid");
        }
      },
      unhighlight: function (element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $(element).addClass("is-valid").removeClass("is-invalid");
        }
      }
    });
    //
  });

  $(document).on('click', '.update', function () {
    var id = $(this).attr("id");
    var form_action = 'tbl_user_type';
    var action = 'getFormEdit';
    $.ajax({
      url: 'ajax-query/masterSubmit.php',
      method: "POST",
      data: { id: id, action: action, form_action: form_action },
      dataType: "json",
      success: function (data) {
        console.log(data);
        $('#typeModal').modal('show');
        $('#name').val(data.name);
        $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit user type ");
        $('#id').val(id);
        $('#form_action').val('update');
        $('#action-btn').html('Update');
      }
    })
  });
  
  
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
          var form_action = 'tbl_user_type';
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


    // function deletee(tsid) {
    // Swal.fire({
    //   text: " Delete Timesheet?",
    //   icon: "warning",
    //   showCancelButton: true,
    //   buttonsStyling: false,
    //   confirmButtonText: "Yes, delete it!",
    //   cancelButtonText: "No, return",
    //   customClass: {
    //     confirmButton: "btn btn-primary",
    //     cancelButton: "btn btn-active-light"
    //   }
    // }).then(function(result) {
    //   if (result.value) {
    //     // deleteconfirm(tsid);
    //     arg.event.remove()
    //   } else if (result.dismiss === "cancel") {
    //     Swal.fire({
    //       text: "Event was not deleted!.",
    //       icon: "error",
    //       buttonsStyling: false,
    //       confirmButtonText: "Ok, got it!",
    //       customClass: {
    //         confirmButton: "btn btn-primary",
    //       }
    //     });
    //   }
    // });
  // }

});

