$(function() {
  'use strict';
  /*$('#addDemo').click(function(){
		$('#demoModal').modal('show');
		$('#demoForm')[0].reset();
    $('.modal-title').html("<i class='fa fa-plus'></i> Add demo form");
		$('#action').val('Add');
		$('#form_action').val('insert');
	});*/
  $('#addDemo').click(function(){
    var url = $(this).data("url"); 
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        success: function(res) {
            
          // get the ajax response data
          var data = res.html;
          // update modal content
          $('.modal-content').html(data);
          // show modal
          $('#demoModal').modal('show');alert("test");
          submitForm();
        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });
});
  //
  var demoDatatable = $('#demoList').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax':{
			url:'ajax-query/masterTable.php',
			type:'POST',
			data:{action:'listDemo'},
			dataType:'json'
		},
    'columns': [
        { data: 'name' },
        { data: 'created_at' },
        { data: 'action' },
    ]
});
  function submitForm(){alert("sub");
  //
  /*$.validator.setDefaults({
    
  });*/
  $(function() {
      //
  
      // validate signup form on keyup and submit
      var demoForm = $("#demoForm").validate({
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
        },
        submitHandler: function(form) {
          console.log(element);
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
                  //
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
    
    });
  }
  
});