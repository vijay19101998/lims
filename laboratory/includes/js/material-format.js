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
$('#mattest-form').click(function(){ 
  // alert("action");
  // $('#action').val('Add'); 
  $('#form_action').val('insert');
  $("form").each(function(){
    $(this).find(':input,textarea,select').removeClass('is-valid'); //<-- Should return all input elements in that specific form.
    $(this).find(':input,textarea,select').removeClass('is-invalid'); //<-- Should return all input elements in that specific form.
  });
});

var Datatable = $('#testing1').DataTable({
  'processing': true,
  'serverSide': true,
  'serverMethod': 'post',
  'ajax':{
          url:'ajax-query/masterTable.php',
          type:'POST',
          data:{action:'listmatformat'},
          dataType:'json'
      },
  'columns': [
      
      { data: 'parameters' },
      { data: 'protocols' },
      { data: 'specification' },        
      { data: 'text' },
      { data: 'unit' },
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
          //   console.log(odata);
            if(odata.status=="success"){
              successAlert(odata.title,odata.message);
              // $('#userForm')[0].reset();
              $('#userModal').modal('hide');				
              $('#action-btn').attr('disabled', false);
            }else{
              $('#action-btn').prop('disabled', false);
              failedAlert(odata.title,odata.message);
            }
            // $("#testcategory").load("material-format.php #additionalContainer1");
            // location.reload();
            //
            //
            $('.parameters,.protocols,.text,.unit').val('');
            $('#additionalContainer1').html("");
            $('#additionalContinerIdNaN').html("");
            $('#form_action').val('insert');
            var group = $('#group').val();
            var materialId = $('#matitem').val();
            var standardTestId = $('#standardTestId').val();
            // alert(group);
            var action='get_materialFormat';
            $.ajax({
              url:'ajax-query/masterSubmit.php',
              method:"POST",
              data:{group:group,materialId:materialId,standardTestId:standardTestId,action:action},
              dataType:"html",
              success:function(data){
                  if(data ==''){
               $('#form_action').val('insert');
                  }else{
               $('#form_action').val('update');
                  }
              //   console.log(data);
               $('#additionalContainer1').html(data);
              }
            })
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

//   $("document").ready(function() {
//     $("#myButton").trigger('click');
// });
$(document).ready(function(){
  //
  $("#myButton").trigger('click');

//
$("#testcategory,#group,#matitem,#standardTestId,#myButton").on('change click', function(){
    // $('#additionalContainer1').html("");
    // $('.clear-format').html("");
    // $('#form_action').val('insert');
    // var group = $('#group').val();
    // var materialId = $('#matitem').val();
    // var standardTestId = $('#standardTestId').val();
    // // alert(group);
    // var action='get_materialFormat';
    // $.ajax({
    //   url:'ajax-query/masterSubmit.php',
    //   method:"POST",
    //   data:{group:group,materialId:materialId,standardTestId:standardTestId,action:action},
    //   dataType:"html",
    //   success:function(data){
    //       if(data ==''){
    //    $('#form_action').val('insert');
    //       }else{
    //    $('#form_action').val('update');
    //       }
    //   //   console.log(data);
    //    $('#additionalContainer1').html(data);
    //   }
    // })
  });
////
$(document).ready(function() {
// Event handler function
function eventHandler() {
  // Code to be executed on both onload and onclick events
  // console.log('Event executed');
  $('#additionalContainer1').html("");
  $('.clear-format').html("");
  $('#form_action').val('insert');
  var group = $('#group').val();
  var materialId = $('#matitem').val();
  var standardTestId = $('#standardTestId').val();
  // alert(group);
  var action='get_materialFormat';
  $.ajax({
    url:'ajax-query/masterSubmit.php',
    method:"POST",
    data:{group:group,materialId:materialId,standardTestId:standardTestId,action:action},
    dataType:"html",
    success:function(data){
        if(data ==''){
     $('#form_action').val('insert');
        }else{
     $('#form_action').val('update');
        }
    //   console.log(data);
     $('#additionalContainer1').html(data);
    }
  })    }

// Execute the event handler on page load
eventHandler();

// Bind the event handler to the element for the onclick event
$("#testcategory,#group,#matitem,#standardTestId,#myButton").on('change', eventHandler);
});
  
  
  
  




 // multi add
  var x = $("#snoid").val();
  $("body").on('click', '.addMoreData', function(e) {

      e.preventDefault();
      $("#snoid").val(x);
      $(document).ready(function() {
        x++;
        var newRow = '<tr id="additionalContinerId' + x + '">' +
            '<td hidden><input class="col form-control form-control-xs" type="hidden" name="mid[]" value=""></td>' +
            '<td style="width:5em;"><input class="col form-control form-control-xs" style="width:5em;" type="text"></td>' +
            '<td  style="width:5em;"><select class="col-12 form-control form-control-xs parameters js-example-tags" data="'+x+'" name="group_name[]" style="width:10em;"><option value="">Select</option>';
            $.each(formatCategory, function(key, formatCategoryvalue) {
              newRow += '<option value="'+formatCategoryvalue.name+'">'+formatCategoryvalue.name+'</option>';
            });
          newRow += '</select></td>' +
            '<td><select class="col-12 form-control form-control-xs parameters js-example-tags" data="'+x+'" name="parameters[]"><option value="">Select</option>';
            $.each(data, function(key, value) {
              newRow += '<option value="'+value.test_parameters+'">'+value.test_parameters+'</option>';
            });
          newRow += '</select></td>' +
            '<td><select class="col-12 form-control form-control-xs js-example-tags pr'+x+'" name="protocols[]"><option value="">Select</option></select></td>';
          newRow += '</select><input class="col form-control form-control-xs" type="text" name="protocols[]"></td>' +
            '<td><select class="col-12 form-control form-control-xs" name="specification[]">' +
            '<option value="text">Text</option>' +
            '<option value="min">Min</option>' +
            '<option value="max">Max</option>' +
            '</select></td>' +
            '<td><input class="col form-control form-control-xs" type="text" name="text[]"></td>' +
            '<td><input class="col form-control" type="text" name="unit[]"></td>' +
            '<td><button type="button" class="btn btn-danger btn-xs additionalContinerRemove" value="' + x + '" style="padding: 0.213rem 0.6rem;">' +
            '<i class="mdi mdi-close-circle m-0"></i></button></td>' +
            '</tr>';
    
        $('#additionalContiner').append(newRow);
        $(".js-example-tags").select2({
          tags: true
      });
    });
  });
  //
 
  $("body").on('click', '.additionalContinerRemove', function(e) {
    e.preventDefault();
    var id = $(this).val();
      $(this).closest('tr').remove();
      // alert(id)
  //   $("#additionalContinerId" + id).remove();
  });
  //
  $(document).ready(function(){
    // $("#testcategory").on("load",function(){
      // var test_category_id = $("#testcategory").val();
      // var action = 'gettestcat';
      // $.ajax({
      //   url: "ajax-query/masterSubmit.php",
      //   type:"POST",
      //   cache:false,
      //   data:{test_category_id:test_category_id, action:action},
      //   success:function(data){
      //     // console.log(data);
      //     $("#group").html(data);
      //   }
      // }); 
      //
 
//      
    $("#testcategory").on("change",function(){
      var test_category_id = $(this).val();
      var action = 'gettestcat';
      $.ajax({
        url: "ajax-query/masterSubmit.php",
        type:"POST",
        cache:false,
        data:{test_category_id:test_category_id, action:action},
        success:function(data){
          // console.log(data);
          $("#group").html(data);
        }
      });     
    });
    //
    $("#materialGroup").on("change",function(){
      var materialGroupId = $(this).val();
      var action = 'getMaterialCategory';
      $.ajax({
        url: "ajax-query/masterSubmit.php",
        type:"POST",
        cache:false,
        data:{materialGroupId:materialGroupId, action:action},
        success:function(data){
          // console.log(data);
          $("#materialCategory").html(data);
        }
      });     
    });
    //
    $("#materialCategory").on("change",function(){
      var materialCategoryId = $(this).val();
      var action = 'getMaterialItem';
      $.ajax({
        url: "ajax-query/masterSubmit.php",
        type:"POST",
        cache:false,
        data:{materialCategoryId:materialCategoryId, action:action},
        success:function(data){
          // console.log(data);
          $("#matitem").html(data);
        }
      });     
    });
    //
  });

});
});

function delayedRedirect(){
    location.reload();
}

function removeLevel(level)
        {
            $("#remove_"+level).html('');

        }


    function callDelete(id){
    //var id = $(this).attr("id");
    // alert(id);
    var action = 'getFormatDelete';
    $.ajax({
      url:'ajax-query/masterSubmit.php',
      method:"POST",
      data:{id:id,action:action},
      dataType:"json",
      success:function(result){
        console.log(result);
       // alert(result.status);
          failedAlert(result.status,result.message);
     }
    })
  };
  //
  $("body").on('change', '.parameters', function(e) {
      
  // $(".parameters").on("change",function(){
    var parameters = $(this).val();
    var pr = $(this).attr('data');
    // alert(pr)
    var action = 'getprotocols';
    $.ajax({
      url: "ajax-query/application.php",
      type:"POST",
      cache:false,
      data:{parameters:parameters, action:action},
      success:function(data){
        // console.log(data);
        $(".pr"+pr).html(data);
      }
    });     
  });
  //