<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
$get_discipline = $app->getdiscipline();
$get_sample = $app->getsample();
$get_type = $app->gettype();
$get_status = $app->getstatus();
//
$get_test_category = $app->get_test_category();
$get_test_group = $app->gettest_group();
$get_material_category = $app->get_material_category();
$get_material_item = $app->get_material_item();
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'worksheet_list');
// print_r($get_usertype);
?>
<style>
    /*.go {*/
    /*    margin-top: 25px;*/
    /*}*/

    /*.table {*/
    /*    color: black;*/
    /*}*/
    /*#content{*/
    /*    margin-top: 10px;;*/
    /*}*/
    .btn1 {
        color: black;
        background-color: #D0EBEA;
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.2), 0 1px 30px 0 rgba(0, 0, 0, 0.1);
    }
</style>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Work sheet</li>
        <li class="breadcrumb-item active" aria-current="page">Work Sheet List</li>
    </ol>
</nav>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- <div class="card-header">

                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Notes Creation</h6>
                    <button class="btn btn-sm btn-primary btn-icon-text" id="adduser">
                        <i data-feather="edit" class="btn-icon-prepend"></i> Add
                    </button>
                </div>

            </div> -->
            <div class="card-header">
            <button type="button" class="btn btn1 btn-success rounded-pill" id="addfilter">Filter<i class="fa fa-filter" aria-hidden="true"></i></button>
            <?php if($hasPermission["create"]=='true') { ?>
            <a href="wscreate.php">
                <button class="btn btn-xs btn-primary btn-icon-text float-right" style="float: right;" id="addtestGroup" >
							<i class="mdi mdi-plus-box"></i> Create
						</button></a>                    <?php } ?>

            </div>


            <div class="card-body">
                <div id="content">
                <div class="table-responsive-md">
                    <table id="samplelibrary" class="table table-bordered table-striped table-hover mt-6">
                        <thead>
                            <tr>
                                <th class="col-2">Sample code</th>
                                <th class="col-2">Received Date</th>
                                <th class="col-2">Test Start Date</th>
                                <th class="col-2">Test End Date</th>
                                <th class="col-3">Action</th>
                            </tr>
                        </thead>
                        <!-- <tbody>
                        <tr>
                            <th>00001</th>
                            <td>27-04-2023</td>
                            <td>ULR-TC1234568756765</td>
                            <td>Chemical Testing</td>
                            <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="javascript:;" class="btn btn-outline-success float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print 1</a>  
                            <a href="javascript:;" class="btn btn-outline-danger float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print 2</a>  
                            <a href="javascript:;" class="btn btn-outline-primary float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print 3</a>  
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <th>00002</th>
                            <td>30-04-2023</td>
                            <td>ULR-TC1234568756769</td>
                            <td>Biological Testing</td>
                            <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="javascript:;" class="btn btn-outline-success float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>  
                            <a href="javascript:;" class="btn btn-outline-danger float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>  
                            <a href="javascript:;" class="btn btn-outline-primary float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>  
                            </div>
                            </td>
                        </tr>
              
                    </tbody>
 -->
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<?php include_once(filePath . "/footer.php"); ?>
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
<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/work-sheet.js"></script>
</body>

</html>
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