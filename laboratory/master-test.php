<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
// $get_testcat = $app->gettestcat();
// $get_discipline = $app->getdiscipline();
// $mat_group = $app->matgroup();
// $get_status = $app->getstatus();
// $get_spec = $app->getspec();
// print_r($get_usertype);
$get_test_category = $app->get_test_category();
$get_test_group = $app->gettest_group();
$get_material_category = $app->get_material_category();
// print_r($get_material_category);
// exit;
$get_material_item = $app->get_material_item();

?>
<style>
    /* .go {
        margin-top: 25px;
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

    /* td:nth-child(5) {
  max-width: 100px;
  overflow: hidden;
 text-overflow: ellipsis;
 white-space: nowrap; 
} */

td:nth-child(5) {
    max-width: 100px;
    /* overflow: scroll;*/
      overflow: hidden;
 text-overflow: ellipsis;
 white-space: nowrap;  
 word-break: break-all;

}


    /* td
{
 max-width: 100px;
  overflow: hidden;
 text-overflow: ellipsis;
 white-space: nowrap; 
 
} */
    /* .modal {
  z-index: 2000;
} */

    /* .dropdown {
  z-index: 9998;
}  */


    /* .select2-container--open .select2-dropdown--below {
  position: relative;
  z-index: 3000 !important;
} */
    /* .modal-container {
  overflow: visible;
} */
</style>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Testing</li>
        <li class="breadcrumb-item active" aria-current="page">Create Test</li>
    </ol>
</nav>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn1 btn-success rounded-pill" id="addfilter">Filter<i
                        class="fa fa-filter" aria-hidden="true"></i>
                    </button>

                <!-- <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Notes Creation</h6>
                    <button class="btn btn-sm btn-primary btn-icon-text" id="addfilter">
                        <i data-feather="edit" class="btn-icon-prepend"></i> Add
                    </button>
                </div> -->

            </div>

            <div class="card-body">

                <!-- <div class="card-header mb-2"> -->

                <!-- <div class="d-flex justify-content-between align-items-baseline">
<h6 class="card-title mb-2">TEST LIST</h6> -->

                <!-- </div> -->
                <!-- <button type="button" class="btn btn1 btn-success rounded-pill" id="addfilter">Filter<i class="fa fa-filter" aria-hidden="true"></i></button> -->
                <!-- <button class="btn-info" id="addfilter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg></button> -->
                <!-- </div>            -->
                <!-- <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="fromdate" id="flatpickr-date" class="form-control">
                        </div>
                     
                        <div class="col-md-3">
                            <label class="form-label">Test Category</label>
                            <select class="form-control form-select" name="testcat" id="testcat">
                                <option>select</option>
                            
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Test Group</label>
                            <select class="form-control form-select" name="discipline" id="discipline">
                                <option>select</option>
               
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Material Group</label>
                            <select class="form-control form-select" name="matgroup" id="matgroup">
                                <option>select</option>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sample Name/mat item</label>
                            <select class="form-control form-select" name="samplename" id="samplename">
                                <option>select</option>

                            </select>
                        </div>
          
                        <div class="col-md-3">
                            <label class="form-label">Specification</label>
                            <select class="form-control form-select" name="spec" id="status">
                                <option>select</option>
                                <option>Agmark</option>
                                <option>Bis</option>
      
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-control form-select" name="status" id="status">
                                <option>select</option>
                                <option>Pending</option>
                                <option>Re-Sample</option>
                                <option>Pass</option>
                                <option>Fail</option>

                            </select>
                        </div>
                        <div class="col">
                            <button class="btn btn-secondary go" type="submit" name="submit">GO</button>
                        </div>
                            </div>
                </form> -->

                <div id="content">
                    <div class="table-responsive-md">

                        <table id="masterTest" class="table table-bordered table-striped table-hover mt-3">
                            <thead>
                                <tr>
                                    <th class="col-2">Date</th>
                                    <th class="col-2">Sample Code</th>
                                    <th class="col-2">Test No</th>
                                    <th class="col-2">Test Category</th>
                                    <th class="col-3">Name of the sample</th>
                                    <th class="col-3">Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->

<?php include_once(filePath . "/footer.php"); ?>
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <select class="js-example-basic-single form-select" data-width="100%"
                                        id="testCategory">
                                        <option value="">Select</option>
                                        <?php
                                        if ($get_test_category) {
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
                                    <select class="js-example-basic-single form-select" data-width="100%"
                                        id="testGroup">
                                        <option value="">Select</option>
                                        <?php
                                        if ($get_test_group) {
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
                                    <select class="js-example-basic-single form-select" data-width="100%"
                                        id="materialGroup">
                                        <option value="">Select</option>
                                        <?php
                                        if ($get_material_category) {
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
                                    <select class="js-example-basic-single form-select" data-width="100%"
                                        id="materialItem">
                                        <option value="">Select</option>
                                        <?php
                                        if ($get_material_item) {
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
                            <button type="button" class="btn btn-primary master-test filter "
                                id="search-action-btn">Search</button>

                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/master-test.js"></script>
<script src="<?php echo BASE_URL; ?>assets/vendors/select2/select2.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/select2.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->

</body>

</html>
<script>
    //     $( document ).ready(function() {
    //     	$(".test_category").select2({
    // 		tags: true
    // 	});
    //     	$(".js-example-basic-single").select2({
    // 		tags: true
    // 	});
    // });

    //
    $('#addfilter').click(function () {
        // $("#filterModal").modal({backdrop: false}).modal("show");

        $('#filterModal').modal('show');
        $(".js-example-basic-single").select2({
            dropdownParent: $('#filterModal'),

            tags: true
        });
    });

</script>