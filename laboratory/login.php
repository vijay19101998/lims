<?php
include_once("includes/includes.php");
include_once(filePath . "/head.php");
?>
<style>
  .card {
    border-radius: 10px;
    box-shadow: 8px 8px 8px rgba(0, 0, 0, 0.5);
    font-family: Georgia, serif;
  }

  .login-form input[type="text"],
  .login-form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: none;
    border-bottom: 2px solid #ccc;
    background-color: transparent;
    transition: border-color 0.3s ease;
  }

  .login-form input[type="text"]:focus,
  .login-form input[type="password"]:focus {
    border-bottom-color: #43A49B;
  }

 .main-wrapper .page-wrapper .page-content  {
    background-image: url('https://static.vecteezy.com/system/resources/previews/002/130/973/original/microscope-in-a-lab-free-photo.jpg') !important;
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
  }

  .card {
    float: right;
    background-color: rgb(224 241 247);   
  }
</style>
<body>
  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100">
          <div class="col-md-12">
            <div class="card py-4">
              <div class="row">
                <div class="col-md-12">
                <div class="text-center">
                <p style="display:inline-block; font-size: x-large">
                <img src="assets/images/logo2.png" alt="logo" width="50" height="50">
                  Laboratory
                  </p>
                  </div>
                  <div class="px-4">
                    <h5 class="text-muted fw-normal mb-4 mt-2">Welcome back! Log in to your account.</h5>
                    <span id="mismatch" class="text-danger"></span>
                    <form class="login-form" id="loginForm" name="loginForm" action="loginFormSubmit">
                      <div class="mb-3">
                        <label for="username" class="form-label">Login Id</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                      </div>
                      <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                          autocomplete="current-password" placeholder="Password">
                      </div>
                      <div>
                        <button type="submit" id="action-btn" class="btn btn-block me-2 mb-2 mb-md-0 text-white"
                          style="background-color:#26A69A; float:right;">Login <i class="icon-circle-right2 ml-2"></i></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/form.js"></script>
<script>
  $(document).on('submit', '#loginForm', function (event) {
    event.preventDefault();
    //
    var form = $('#loginForm')[0];
    var formId = '#loginForm';
    var actionFun = $(formId).attr('action');
    //
    //var formData = $(form).serialize();alert(actionFun);
    var formData = new FormData(form);
    //formData.push({ name: "action", value: actionFun });
    formData.append("action", actionFun);
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "loginSubmit.php",
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
        console.log(odata);
        if (odata.status == "success") {
          var gotopage = 'index.php';
          gotolink(gotopage);
        } else {
          $('#mismatch').html("User name or Pasword Not Matching");
          $('#message').html(odata.message);
          $('#action-btn').prop('disabled', false);
        }
      }

    })
  });
  //
  gotolink = function (goto) {
    //event.stopPropagation();
    window.location.href = goto;
  }

</script>
</body>

</html>