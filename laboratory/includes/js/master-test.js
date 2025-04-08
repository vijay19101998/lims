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

$('#masterTest').DataTable({
  destroy: true,
  // paging: false,
  // searching: false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax':{
                url:'ajax-query/masterTable.php',
                type:'POST',
                data:{
                  action:'masterTest',
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
            { data: 'test_number' },
            { data: 'test_category' },
            { data: 'sample_id' },
            { data: 'action' }
            // { data: 'standard_test_id' },
            // { data: 'action' }
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
// $(document).ready( function () {

// filterGlobal();
// });
// function renderDemoDataTable (){



  //   return  $('#masterTest').DataTable({
  //     'processing': true,
  //     'serverSide': true,
  //     'serverMethod': 'post',
  //     'ajax':{
  //             url:'ajax-query/masterTable.php',
  //             type:'POST',
  //             data:{action:'masterTest'},
  //             dataType:'json'
  //         },
  //     'columns': [
  //         { data: 'sampling_date' },
  //         { data: 'sample_code' },
  //         { data: 'test_number' },
  //         { data: 'test_category' },
  //         { data: 'sample_id' },
  //         { data: 'action' }
  //         // { data: 'standard_test_id' },
  //         // { data: 'action' }
  //     ]
  // });
  // }

    // $('#search-action-btn').click(function(){
    //   renderDemoDataTable()
    // })

    //
    // var myvar=15;
// function init(){
//   document.getElementById('search-action-btn').onclick=function(){EditBanner(demoDatatable);};
// }
// window.onload=init;
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
        var form_action = 'tbl_testing';
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
            $('#masterTest').DataTable().ajax.reload();
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



    // $(document).on('click', '.delete', function () {
    //   // alert();
    //   var id = $(this).attr("id");
    //   var form_action = 'tbl_testing';
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
    //       $('#masterTest').DataTable().ajax.reload();
    //     }
    //   })
    // });
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
  

    

  
 
  });