$(function () {
  'use strict';
  // date picker 
  if ($('#flatpickr-date').length) {
    flatpickr("#flatpickr-date", {
      wrap: true,
      dateFormat: "d-m-Y",
    });
  }

  //
  $.validator.setDefaults({
    submitHandler: function (form) {
      // console.log(form);
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
            //  location.reload();
            // var testid=2;
            window.location.href = "work-sheet.php?testingId=" + odata.testingId + ""
            $('#userForm')[0].reset();
            $('#userModal').modal('hide');
            $('#action-btn').attr('disabled', false);
          } else {
            $('#action-btn').prop('disabled', false);
            failedAlert(odata.title, odata.message);
          }
        }

      })
      //

    }
  });
  $(function () {
    // validate signup form on keyup and submit
    $("#wsSubForm").validate({
      rules: {},
      messages: {},
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");

        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
          error.insertAfter(element.parent().parent());
        } else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.appendTo(element.parent().parent());
        } else {
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
          // $(element).addClass("is-valid").removeClass("is-invalid");
        }
      }
    });
    //
  });
  $(function () {
    // validate signup form on keyup and submit
    $("#wsConfirm").validate({
      rules: {},
      messages: {},
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");

        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
          error.insertAfter(element.parent().parent());
        } else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.appendTo(element.parent().parent());
        } else {
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
  //
  $(function () {
    // validate signup form on keyup and submit
    $("#submitcreateworksheet").validate({
      rules: {},
      messages: {},
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");

        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
          error.insertAfter(element.parent().parent());
        } else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.appendTo(element.parent().parent());
        } else {
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
  //
  $(document).ready(function () {
    function filterGlobal() {
      $('#samplelibrary').DataTable({
        destroy: true,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
          url: 'ajax-query/masterTable.php',
          type: 'POST',
          data: {
            action: 'worksheetLibrary',
            testCategory: $('#testCategory').val(),
            testGroup: $('#testGroup').val(),
            materialGroup: $('#materialGroup').val(),
            materialItem: $('#materialItem').val(),
            materialGroup: $('#materialGroup').val()
          },
          dataType: 'json'
        },
        'columns': [{
            data: 'sample_code'
          },
          {
            data: 'sampling_receive_date'
          },
          {
            data: 'test_start_date'
          },
          {
            data: 'test_end_date'
          },
          {
            data: 'action'
          },
        ]
      });
      $('#filterModal').modal('hide');
    }
    //
    $('#search-action-btn').on('click', function () {
      filterGlobal();
    });
    filterGlobal();
  });


});