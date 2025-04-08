<?php
include_once("includes/includes.php");
//Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
?>
	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item">Settings</li>
			<li class="breadcrumb-item active" aria-current="page">Demo Form</li>
		</ol>
	</nav>

				
	<div class="row">
		<div class="col-md-12">
      <div class="card">
      	<div class="card-header">

      		<div class="d-flex justify-content-between align-items-baseline">
            <h6 class="card-title mb-0">Notes Creation</h6>
            <button class="btn btn-sm btn-primary btn-icon-text" id="addDemo" data-url="ajax-form/demo-form.php" ><i data-feather="edit" class="btn-icon-prepend"></i> Add</button>
          </div>

      	</div>	
      	
        <div class="card-body">
          <div id="content">
            
            
                  <table id="demoList" class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                


          </div>
        </div>
      </div>
		</div>
	</div>
	<?php include_once(filePath."/footer.php"); ?>
  <div class="modal fade" id="demoModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
          
          
        </div>
       
    </div>
  </div>
	<?php include_once(filePath."/js.php"); ?>
  <script src="<?php echo BASE_URL; ?>includes/js/form.js"></script>
</body>
</html>