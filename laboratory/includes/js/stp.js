$(function () {
    'use strict';
    // date picker 
    if ($('#flatpickr-date').length) {
        flatpickr("#flatpickr-date", {
            wrap: true,
            dateFormat: "d-m-Y",
        });
    }
    $('#adddoc').click(function () {
        $('#docModal').modal('show');
        $('#docForm')[0].reset();
        $('.clear').html('');
        $('#removefile').hide();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Standard Test Procedure");
        $('#action').val('Add');
        $('#form_action').val('insert');
        $("form").each(function () {
            $(this).find(':input,textarea,select').removeClass('is-valid'); //<-- Should return all input elements in that specific form.
            $(this).find(':input,textarea,select').removeClass('is-invalid'); //<-- Should return all input elements in that specific form.
        });
    });
    //
    var demoDatatable = $('#stpList').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            url: 'ajax-query/masterTable.php',
            type: 'POST',
            data: {
                action: 'stpList'
            },
            dataType: 'json'
        },
        'columns': [{
                data: 'test_parameters'
            },
            {
                data: 'testing_protocols'
            },
            {
                data: 'document'
            },
            {
                data: 'action'
            },
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
                    if (odata.status == "success") {
                        successAlert(odata.title, odata.message);
                        //location.reload();
                        $('#docForm')[0].reset();
                        $('#docModal').modal('hide');
                        $('#action-btn').attr('disabled', false);
                    } else {
                        $('#action-btn').prop('disabled', false);
                        failedAlert(odata.title, odata.message);
                    }
                 $('#stpList').DataTable().ajax.reload();
                }
            })
            //
        }
    });
    $(function () {
        // validate signup form on keyup and submit
        $("#docForm").validate({
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
    /* $(document).on('click', '.view', function(){
        $('#docModal').modal('show');
        $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> STP Details");
       var id = $(this).attr("id");
       //alert(id);
       //var form_action = 'users';
       var action = 'get_stp';
       $.ajax({
         url:'ajax-query/application.php',
         method:"POST",
         data:{id:id, action:action},
         dataType:"html",
         success:function(data){
         //  console.log(data);
             
           //$('#docModal').html(data);
           // $('#').val(data.id);
          
           // $('#photo').val(data.photo);
           // $('#comment').val(data.comment);
          
           //$('#id').val(id);
          // $('#form_action').val('update');
           //$('#action-btn').html('Update');
         }
       })
     });*/
    $(document).on('click', '.view', function () {
        $('#datadocModal').modal('show');
        $('.modal-title').html("<i class='fa fa-plus'></i> View Standard Test Procedure");
        var id = $(this).attr("id");
        var action = 'get_stp';
        $.ajax({
            url: 'ajax-query/application.php',
            method: "POST",
            data: {
                id: id,
                action: action
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                var count = data[0];
                var files = data[1];
                var count2 = data[2];
                var files2 = data[3];
                $('#datadocModal').modal('show');
                $('#count').html(count);
                $('#count2').val(count2);
                $("#dname").html('');
                $("#dname2").html('');
                for (var i = 0; i < files.length; i++) {
                    $('#dname').append('<a href="#">' + files[i] + '</a></br>');
                }
                for (var j = 0; j < files2.length; j++) {
                    $('#dname2').append('<a href="#">' + files2[j] + '</a></br>');
                }
            }
        })
    });
    $(document).on('click', '.update', function () {
        $('#docForm')[0].reset();
        $('.clear').html('');
        var id = $(this).attr("id");
        var form_action = 'tbl_stp';
        var action = 'getFormEdit';
        $.ajax({
            url: 'ajax-query/masterSubmit.php',
            method: "POST",
            data: {
                id: id,
                action: action,
                form_action: form_action
            },
            dataType: "json",
            success: function (data) {
                // console.log(data);
                var para = data[0];
                var proto = data[1];
                var files = data[2];
                var files2 = data[3];
                //alert(files);
                //alert(files2);
                $('#docModal').modal('show');
                // $('#fupload').show();
                $('#parameter').val(para);
                $('#protocol').val(proto);
                $("#test").html('');
                $("#test2").html('');
                var x = 0;
                for (var i = 0; i < files.length; i++) {
                 if(!empty(files[i])){
                    $("#test").append('<a id="remove_' + x + '" href="assets/upload2/' + files[i] + '" class="">' + files[i] + '</a>&nbsp;<button type="submit" id="remove1_' + x + '" style="height:20px; line-height:5px;" onclick="remove(' + x + ',' + i + ')" class="btn btn-warning remove" value="' + x + '">Remove</button></br>');
                 }
                    x++;
                }
                var y = 0;
                for (var j = 0; j < files2.length; j++) {
                    if(!empty(files2[j])){
                    $("#test2").append('<a id="remove2_' + y + '" href="assets/upload2/' + files2[j] + '" class="">' + files2[j] + '</a>&nbsp;<button type="submit" id="remove3_' + y + '" style="height:20px; line-height:5px;" onclick="remove2(' + y + ',' + j + ')" class="btn btn-warning remove2" value="' + y + '">Remove-2</button></br>');
                    }
                    y++;
                }
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit STP");
                $('#id').val(id);
                $('#form_action').val('update');
                $('#action-btn').html('Update');
            }
        })
    });
    $("body").on('click', '.remove', function (e) {
        e.preventDefault();
        var id = $(this).val();
        $("#remove_" + id).remove();
        $("#remove1_" + id).remove();
    });
    $("body").on('click', '.remove2', function (e) {
        e.preventDefault();
        var id = $(this).val();
        $("#remove2_" + id).remove();
        $("#remove3_" + id).remove();
    });
    function delayedRedirect() {
        location.reload();
    }
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
              var form_action = 'tbl_stp';
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
                  $('#stpList').DataTable().ajax.reload();
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
});
function remove(i) {
    //alert(x);
    var r_id = $('#removefile').val();
    //alert(id);
    if (r_id == '') {
        $('#removefile').val(i);
    } else {
        $('#removefile').val(r_id + ',' + i);
    }
}
function remove2(j) {
    var re_id = $('#removefile2').val();
    if (re_id == '') {
        $('#removefile2').val(j);
    } else {
        $('#removefile2').val(re_id + ',' + j);
    }
}
/*var action = 'getRemovedata';
   $.ajax({
     url:'ajax-query/application.php',
     method:"POST",
     data:{id:id,action:action},
     dataType:"json",
     success:function(result){
       console.log(result);
      // alert(result.status);
         //failedAlert(result.status,result.message);
    }
   })*/
   $("body").on('change', '.parameters', function (e) {
    // $(".parameters").on("change",function(){
    var parameters = $(this).val();
    var pr = $(this).attr('data');
    // alert(pr)
    var action = 'getprotocols';
    $.ajax({
      url: "ajax-query/application.php",
      type: "POST",
      cache: false,
      data: {
        parameters: parameters,
        action: action
      },
      success: function (data) {
        // console.log(data);
        $("#protocol").html(data);
        
        
      }
    });
  });