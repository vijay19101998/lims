<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
// $gettestcat = $app->get_testcat();
// $gettestgroup = $app->get_testgroup();
// $getmatgroup = $app->get_matgroup();
// $getsamplename = $app->get_samplename();
// $getspec = $app->get_spec();
$get_usertype = $app->getusertype();
// print_r($get_usertype);
$get_test_category = $app->get_test_category();
$get_test_group = $app->gettest_group();
$get_material_category = $app->get_material_category();
// print_r($get_material_category);
// exit;
$get_material_item = $app->get_material_item();
?>
<head>
<style>
    /* .go {
        margin-top: 28px;
    }

    .table {
        color: black;
    }
    #content{
        margin-top: 10px;;
    } */
    .btn1 {
        color: black;
        background-color: #D0EBEA;
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.2), 0 1px 30px 0 rgba(0, 0, 0, 0.1);
    }
    table.dataTable th:nth-child(2) ,table.dataTable td:nth-child(2){
  width: 200px;
  max-width: 200px;
  word-break: break-all;
  white-space: pre-line;
}
</style>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
</head>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Approvals</li>
        <li class="breadcrumb-item active" aria-current="page">Test Approval</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
            <button type="button" class="btn btn1 btn-success rounded-pill" id="addfilter">Filter<i class="fa fa-filter" aria-hidden="true"></i></button>

                <!-- <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Notes Creation</h6>
                    <button class="btn btn-sm btn-primary btn-icon-text" id="addfilter">
                        <i data-feather="edit" class="btn-icon-prepend"></i> Add
                    </button>
                </div> -->

            </div>
            <div class="card-body">

                <div id="content">
                <div class="table-responsive-md">
                    <table id="sampleTestingList" class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Sample Name</th>
                                <th>Sample Code</th>
                                <th>Assigned To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- <tbody>
                        <tr>
                            <th>27-04-2023</th>
                            <td>Drinking Water</td>
                            <td>00001</td>
                            <td>R.Madhuja</td>
                            <td><a href="test-approval.php"><button class="btn-info">Action</button></a><button class="btn-danger">Delete</button></td>
                        </tr>
                    </tbody> -->
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
<?php include_once(filePath."/footer.php"); ?>
<div class="modal fade" id="filterModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" action="" id="userForm" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #26A69A;color:#fff">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                    </button>
                </div>
                <div class="modal-body" style="background-color: #D0EBEA;">
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="username" id="username" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" name="password" id="password" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Test Category</label>
                                    <select class="js-example-basic-single form-select" data-width="100%" id="testCategory">
                                        <option value="">Select</option>
                                        <?php
                                    if($get_test_category){
									foreach ($get_test_category as $row) {
									echo '
                                    <option value="' . $row["id"] . '">' . $row["name"] . '</option>';
									}
									}
									?>                                  
                                      </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Test Group</label>
									<select class="js-example-basic-single form-select" data-width="100%" id="testGroup">
										<option value="">Select</option>
                                       <?php
                                        if($get_test_group){
										foreach ($get_test_group as $row) {
											echo '
										<option value="' . $row["id"] . '" >' . $row["name"] . '</option>';
										}
									}  
                                    ?>
									</select>                                
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Material Group</label>
                                    <select class="js-example-basic-single form-select" data-width="100%" id="materialGroup">
										<option value="">Select</option>
										<?php
                                        if($get_material_category){
                                            foreach ($get_material_category as $row) {
                                                echo '
                                            <option value="' . $row["id"] . '" >' . $row["name"] . '</option>';
                                            }
                                        }
									?>	
									</select>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sample Name</label>
                                    <select class="js-example-basic-single form-select" data-width="100%" id="materialItem">
                                        <option value="">Select</option>
                                        <?php 
                                        if($get_material_item){
										foreach ($get_material_item as $row) {
											echo '
										<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
										}
									}  
                                    ?>
                            </select>
                                             </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Specification</label>
                                    <select class="form-control" id="user_type" name="user_type">
                                        <option value="">--Select--</option>
          <!--  -->
                                    </select>
                                 </div>
                            </div>
                           
      
                        <!--
            <div class="form-group">
                <label>Date</label>
                <div class="input-group flatpickr" id="flatpickr-date">
                  <input type="text" class="form-control" placeholder="Select date" data-input>
                  <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                </div>
            </div>  
            <div class="form-group">
              <label>Demo Area</label>
              <textarea class="form-control" name="area" id="area"  ></textarea>
            </div> -->
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="form_action" id="form_action" />
                        <button type="button" class="btn btn-primary master-test filter " id="search-action-btn">Search</button>

                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
            </div>
        </form>

    </div>
</div>
<?php include_once(filePath."/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/test-lib.js"></script>
<script>
            $('#addfilter').click(function(){
            // $("#filterModal").modal({backdrop: false}).modal("show");

          $('#filterModal').modal('show');
            	$(".js-example-basic-single").select2({
                    dropdownParent: $('#filterModal'),
		            tags: true
	});
      });
</script>
</body>

</html>