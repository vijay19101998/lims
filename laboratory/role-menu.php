<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
// $gettestcat = $app->get_testcat();
// $gettestgroup = $app->get_testgroup();
// $getmatgroup = $app->get_matgroup();
// $getsamplename = $app->get_samplename();
// $getspec = $app->get_spec();
// $get_usertype = $app->getusertype();
// print_r($get_usertype);
$get_usertype = $app->getusertype();
unset($get_usertype[0]);
?>
<head>
    <style>
.example {
    font-size: 0.875rem;
    letter-spacing: normal;
    padding: 10px;
    background-color: #fff;
    border: 4px solid #e9ecef;
    position: relative;
}
    </style>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
</head>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">User Config</li>
        <li class="breadcrumb-item active" aria-current="page">Role Permission</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12">
    <div class="example">
    <div class="accordion" id="accordionExample">
    <form method="POST" action="rolemenu" id="rolemenu">
    <div class="col-md-6 mb-4">
    <select class="form-control js-example-tags" name="userTypeID" id="userTypeID" required="required">
    <option value="">--Select--</option>
                                        <?php                                        
                                            foreach ($get_usertype as $row){
                                                echo'
                                                    <option value="'. $row["id"].'">'. $row["name"].'</option>';                           
                                            }
                                        ?>
									</select>
</div>
<hr>
<div id="showMenu">
 

  </div>

  </form>
</div>
</div>
    </div>
    </div>
    <!-- </div>
</div> -->
<!--</div>-->
<?php include_once(filePath . "/footer.php"); ?>
<?php include_once(filePath . "/js.php"); ?>
<script>
// function SelectAll_Dynamic(){
  $(".parent_chk").click(function() {
var classes = $(this).attr('id');
// alert(t);
    if($('.parent_chk').is(':checked')){
        //alert('if');
        // $('#abcd').text("ID = " + t);
        $("."+classes).prop( "checked", true );
    } else {
        //alert('else');
        $("."+classes).prop( "checked", false );
    }
});

</script>
<script src="<?php echo BASE_URL; ?>includes/js/test-lib.js"></script>
<script>
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
$.validator.setDefaults({
  submitHandler: function(form) {
    // console.log(form);
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
    $("#rolemenu").validate({
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

  $(document).ready(function(){
  $("#userTypeID").on("change",function(){
    $("#showMenu").html('');
    var userTypeID = $(this).val();
    var action = 'getRoleMenu';
    $.ajax({
      url: "ajax-query/masterSubmit.php",
      type:"POST",
      cache:false,
      data:{userTypeID:userTypeID, action:action},
      success:function(data){
        $("#showMenu").html(data);
      }
    });     
  });
});


});
</script>
</body>
</html>