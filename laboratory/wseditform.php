<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
$id='';
if(isset($_REQUEST['id'])){
  $id = $_REQUEST['id'];
}


?>
<nav class="page-breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item">Settings</li>
		<li class="breadcrumb-item active" aria-current="page">Test Creation</li>
	</ol>
</nav>
<form method="POST" action="test" id="test">
<div class="card">
          <div class="col-md-12">
            <div class="row mb-4">
          <div class="col-md-4">
          <div class="form-check">
  <input class="form-check-input" type="checkbox" value="1" id="is_multiple" name="is_multiple">
  <label class="form-check-label" for="flexCheckDefault">
    Is Multiple
  </label>
</div>
          </div>
          <div class="col-md-4">
          <label for="vehicle1">Formula</label>
          <input type="text" id="formula_1" class="form-control" name="formula_1" value="">

            <!--  -->
          </div>
          <!-- <div class="col-md-4">
          <label for="formula_2">Formula 1</label>
          <input type="text" id="formula_2" class="form-control" name="formula_2" value="">

          </div> -->
          </div>
          </div>
          </div>
<input type="hidden" class="form-control" name="id" value="<?= $id; ?>"  placeholder="Label">

			<div class="additionalContinerCard">
				<div class="card" id="additionalContinerId0">
          <div class="col-md-12">
            <button type="button" class="btn btn-success btn-xs addMoreData" style="float:right">Add Column</button>
          </div>

					<div class="card-body">

						<div class="row">
            <input type="hidden" class="form-control" name="headingcount[]" value=""  placeholder="Label">
              <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Field Label</span>
                    </div>
                    <input type="text" class="form-control" name="heading0[]" value=""  placeholder="Label">
                  </div>
                              </div>

                              <div class="col-md-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Field Type</span>
                    </div>
              <select class="form-control mySelect" name="fieldtype[]" id="0">
                <option value="label">Label</option>
                <option value="text">Text</option>
                <option value="select">Select</option>
              </select>
                  </div>
                              </div>
                              <div class="col-md-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Value</span>
                    </div>
              <select class="form-control mySelect" name="fieldvalue[]" id="fieldvalue">
                <option value="0">No value</option>
                <option value="m">M</option>
                <option value="m0">M0</option>
                <option value="m1">M1</option>
                <option value="m2">M2</option>
                <option value="m3">M3</option>
                <option value="m4">M4</option>
              </select>
                  </div>
                              </div>

              <div class="col-md-4" id="select0">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Field Input Value</span>
                    </div>
                    <input type="text" class="form-control" name="" value=""  placeholder="eg:-1,2,3,4 ">
                    <button class="btn btn-info btn-xs addMoreDatasub" style="padding: 0.213rem 0.6rem;" id="0"><i class="mdi mdi-plus-circle m-0"></i></button>
                  </div>
              </div>

              </div>
              <div class="row" id="additionalContinersub0">

					    </div>
				  </div>
			  </div>

      </div>

      <div class="col-md-12">
          <button type="submit" class="btn btn-primary float-right mt-4" style="float:right" id="action-btn">Submit</button>
			  </div>
        </form>
<?php include_once(filePath . "/footer.php"); ?>
<?php include_once(filePath . "/js.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
	<?php if(isset($_REQUEST['view'])){ ?> 
	$(document).ready(function()
{
$('input').attr('readonly', true);
$('select').prop('disabled', true);
$('.datepicker-basic-time').prop('disabled', true);
$("button").attr("disabled", true);
});
<?php } ?>
			// $('input').attr("readonly");
	
	$(".js-example-tags").select2({
		tags: true
	});
	$(".test").select2({
    multiple: true,
    // width: "auto"
});
//
	$(".datepicker-basic").flatpickr({
	dateFormat: "d-m-Y",   
	});
//
	$(".datepicker-basic-time").flatpickr({
	enableTime: true,
	dateFormat: "d-m-Y H:i",
	// dateFormat: "Y-m-d H:i",
	});
//
	// $("body").on('change', '#sample_name', function (e) {
	// 	var test = $(this).val();
	// 	if (test == '1') {
	// 		$('.additionalContinerClass').show();
	// 	} else {
	// 		$('.additionalContinerClass').hide();
	// 	}
	// });
	//
	$(document).ready(function(){
    var x = 2;
  $("body").on('click', '.addMoreData', function(e) {
      e.preventDefault();
      x++;
    $('.additionalContinerCard').append('<div class="card" id="additionalContinerId'+x+'"><div class="col-md-12"><button type="button" class="btn btn-danger btn-xs additionalContinerRemove" style="float:right">Remove Column</button></div><div class="card-body"><div class="row"><input type="hidden" class="form-control" name="headingcount[]" value=""  placeholder="Label"><div class="col-md-4"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Field Label</span></div><input type="text" class="form-control" name="heading'+x+'[]" value=""  placeholder="Label"></div></div><div class="col-md-2"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Field Type</span></div><select class="form-control mySelect" name="fieldtype[]" id="'+x+'"><option value="label">Label</option><option value="text">Text</option><option value="select">Select</option></select></div></div><div class="col-md-2"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Value</span></div><select class="form-control mySelect" name="fieldvalue[]" id="fieldvalue"> <option value="0">No value</option> <option value="m">M</option><option value="m0">M0</option> <option value="m1">M1</option> <option value="m2">M2</option><option value="m3">M3</option><option value="m4">M4</option></select></div></div><div class="col-md-4"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Field Input Value</span></div><input type="text" class="form-control" name="" value=""  placeholder="eg:-1,2,3,4 "><button class="btn btn-info btn-xs addMoreDatasub" id="'+x+'" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-plus-circle m-0"></i></button></div></div></div><div class="row" id="additionalContinersub'+x+'"></div></div></div>');
  });

  $("body").on('click', '.additionalContinerRemove', function(e) {
    e.preventDefault();
    var id = $(this).val();
    // $("#additionalContinerId" + id).remove();
    $(this).closest('div').closest('.card').remove();
  });

  //
  var xsub = 1;
  $("body").on('click', '.addMoreDatasub', function(e) {
      e.preventDefault();
      var ids = $(this).attr('id');
      xsub++;
      $('#additionalContinersub'+ids).append('<div class="col-md-12"><div class="row" id="additionalContinersub'+ids+xsub+'"><div class="col-md-4"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Sub Label</span></div><input type="text" class="form-control" name="sub_heading'+ids+'[]" value="" placeholder="Label"></div></div><div class="col-md-2"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Sub Type</span></div><select class="form-control mySelect" name="fieldtype[]"><option value="text">Text</option><option value="select">Select</option></select></div></div><div class="col-md-2"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Value</span></div><select class="form-control mySelect" name="fieldvalue[]" id="fieldvalue"> <option value="0">No value</option> <option value="m">M</option><option value="m0">M0</option> <option value="m1">M1</option> <option value="m2">M2</option><option value="m3">M3</option><option value="m4">M4</option></select></div></div><div class="col-md-4"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Sub Input Value</span></div><input type="text" class="form-control" name="" value=""  placeholder="eg:-1,2,3,4"><button class="btn btn-warning btn-xs additionalContinersubRemove" value="'+ids+xsub+'" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></div></div></div></div>');
  });

  $("body").on('click', '.additionalContinersubRemove', function(e) {
    e.preventDefault();
    var id = $(this).val();
    // $("#additionalContinerId" + id).remove();
    $(this).closest("#additionalContinersub" + id).remove();
  });
  //
  $.validator.setDefaults({
    submitHandler: function(form) {
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
            // $('#action-btn').prop('disabled', true);
          },
          success:function(odata) {
            if(odata.status=="success"){
              successAlert(odata.title,odata.message);
            window.location.replace("stp.php");
            //   $('#userForm')[0].reset();
            //   $('#userModal').modal('hide');				
            //   $('#action-btn').attr('disabled', false);
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
$(function() {
  // validate signup form on keyup and submit
  $("#test").validate({
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

$(document).ready(function() {
      // Attach event listener to the select element
      // $('.mySelect').on('change', function() {
        $("body").on('change', '.mySelect', function(e) {
    e.preventDefault();
        var id = $(this).attr('id');
        var selectedValue = $(this).val();
        // alert(selectedValue);
            if (selectedValue === 'label') {
                // $(this).closest('div').closest('div').hide();
                $('#select'+id).hide();
            }
             else {
              $('#select'+id).show();
            }        
      });
    });
//
</script>
</body>
</html>