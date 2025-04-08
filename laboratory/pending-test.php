<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'assign-test');
?>
	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item">Settings</li>
			<li class="breadcrumb-item active" aria-current="page">Material Form</li>
		</ol>
	</nav>

 <!-- <div class="row">-->
 <!-- <div class="col-xl-9 main-content ps-xl-4 pe-xl-5">	-->
	<!--<div class="row">-->
		<div class="col-md-12">
      <div class="card">
      	<div class="card-header">

      		<div class="d-flex justify-content-between align-items-baseline">
            <h6 class="card-title mb-0">Assign Sample Test</h6>
            <?php if($hasPermission["create"]=='true') { ?>
            <a href="sample-registration2.php" ><button class="btn btn-sm btn-primary btn-icon-text">
							<i data-feather="edit" class="btn-icon-pen"></i> Create
						</button></a>
            <?php } ?>
          </div>

      	</div>	
      	
        <div class="card-body">
          <div id="content">
                  <table id="pendingTestList" class="table">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Sample code</th>
                        <th>Responsibility</th>
                        <th>Parameters Count</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
          </div>
        </div>
      </div>
		</div>
	<!--</div>-->
  <!--<-?php include_once(filePath."/sidemenu.php"); ?>-->

	<?php include_once(filePath."/footer.php"); ?>
	<?php include_once(filePath."/js.php"); ?>
  <script src="<?php echo BASE_URL; ?>includes/js/pending-test.js"></script>
</body>
</html>