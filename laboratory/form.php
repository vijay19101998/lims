<?php
include_once("includes/includes.php");
Session::checkSession();
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
            <button class="btn btn-sm btn-primary btn-icon-text" id="addDemo" >
							<i data-feather="edit" class="btn-icon-prepend"></i> Add
						</button>
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
      <form method="post" action="demoSubmit" id="demoForm" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title h4" id="myLargeModalLabel">Add demo form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Demo Name</label>
              <input type="text" name="name" id="name" class="form-control" required />
            </div>
            <div class="form-group">
              <label>Demo Select</label>
              <select class="form-control" id="select_name" name="select_name" required >
                <option value="">--Select--</option>
                <option value="1">Test </option>
                <option value="2">Test2</option>
              </select>
            </div>
            <div class="form-group">
                <label>Date</label>
                <div class="input-group flatpickr" id="flatpickr-date">
                  <input type="text" class="form-control" placeholder="Select date" data-input>
                  <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                </div>
            </div>  
            <div class="form-group">
              <label>Demo Area</label>
              <textarea class="form-control" name="area" id="area" required ></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" value=""/>
            <input type="hidden" name="form_action" id="form_action" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
          </div>
        </div>
      </form>  
    </div>
  </div>
	<?php include_once(filePath."/js.php"); ?>
  <script src="<?php echo BASE_URL; ?>includes/js/form.js"></script>
</body>
</html>