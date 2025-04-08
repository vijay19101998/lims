<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'product-category');
?>
	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item">Masters</li>
			<li class="breadcrumb-item active" aria-current="page">Product Category</li>
		</ol>
	</nav>


				
	<div class="row">
		<div class="col-md-12">
      <div class="card">
      	<div class="card-header">

      		<div class="d-flex justify-content-between align-items-baseline">
            <h6 class="card-title mb-0">Product Category List</h6>
            <?php if($hasPermission["create"]=='true') { ?>
            <button class="btn btn-xs btn-primary btn-icon-text" id="addprocat" >
							<i class="mdi mdi-plus-box"></i> Create
						</button>
            <?php } ?>
          </div>

      	</div>	
      	
        <div class="card-body">
          <div id="content">
                <div class="table-responsive-md">
                  <table id="procatList" class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Comments</th>
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
<!--  -->
<!--  -->



	<?php include_once(filePath."/footer.php"); ?>
  <div class="modal fade" id="procatModal">
    <div class="modal-dialog modal-lg">
      <form method="post" action="productCatogorySubmit" id="procatForm" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title h4" id="myLargeModalLabel">Add Product Category form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" name="name" id="name" class="form-control" required />
            </div>
            <div class="form-group">
              <label>Comment</label>
              <textarea class="form-control" name="comment" id="comment"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="form_action" id="form_action" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="action-btn" >Submit</button>
          </div>
        </div>
      </form>  
    </div>
  </div>
	<?php include_once(filePath."/js.php"); ?>
  <script src="<?php echo BASE_URL; ?>includes/js/product-category.js"></script>
</body>
</html>