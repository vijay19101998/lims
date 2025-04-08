<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
//
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'usertype');
?>
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item">User Configuration</li>
			<li class="breadcrumb-item active" aria-current="page">Roles</li>
		</ol>
	</nav>

  <!--<div class="row">-->
  <!--<div class="col-xl-9 main-content ps-xl-4 pe-xl-5">-->

	<div class="row">
		<div class="col-md-12">
      <div class="card">
      	<div class="card-header">

      		<div class="d-flex justify-content-between align-items-baseline">
            <h6 class="card-title mb-0">Roles List</h6>
            <?php if($hasPermission["create"]=='true') { ?>
            <button class="btn btn-xs btn-primary btn-icon-text" id="addType">
							<i  class="mdi mdi-plus-box"></i> Create
						</button>
            <?php } ?>
          </div>

      	</div>	
      	
        <div class="card-body">
          <div id="content">
            
                <div class="table-responsive-md">
                  <table id="userList" class="table">
                    <thead>
                      <tr>
                        <th>User Types</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
          </div>
        </div>
      </div>
		</div>
		</div>
	<!--</div>-->

	<!--<-?php include_once(filePath."/sidemenu.php"); ?>-->

  <div class="modal fade" id="typeModal">
    <div class="modal-dialog modal-lg">
      <form method="post" action="typeSubmit" id="typeForm" autocomplete="off">
        <div class="modal-content">
    
          <div class="modal-header">
            <h5 class="modal-title h4" id="myLargeModalLabel">Add user type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>User Type</label>
              <input type="text" name="name" id="name"  class="form-control" required />
            </div>
            
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="form_action" id="form_action" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="action-btn" >Submit</button>
          </div>
        </div>
        </div>
      </form>  
    </div>
  </div>
  <?php include_once(filePath . "/footer.php"); ?>
	<?php include_once(filePath."/js.php"); ?>
  <script src="<?php echo BASE_URL; ?>includes/js/usertype.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
</body>
</html>