<?php
include_once("includes/includes.php");
//Session::checkSession();
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
// print_r($get_usertype);
?>
<style>
    .go {
        margin-top: 25px;
    }

    .table {
        color: black;
    }
    #content{
        margin-top: 10px;;
    }
</style>
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
            <!-- <div class="card-header">

                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Notes Creation</h6>
                    <button class="btn btn-sm btn-primary btn-icon-text" id="adduser">
                        <i data-feather="edit" class="btn-icon-prepend"></i> Add
                    </button>
                </div>

            </div> -->

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">From & To Date</label>
                            <input type="date" name="fromdate" id="flatpickr-date" class="form-control">
                        </div>
                       
                        <div class="col-md-3">
                            <label class="form-label">Test Group</label>
                            <select class="form-control form-select" name="discipline" id="discipline">
                            <option>select</option>
                                <option>Chemical Testing</option>
                                <option>Biological Testing</option>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sample Name</label>
                            <select class="form-control form-select" name="sample" id="sample">
                                <option>select</option>
                                <option>Drinking Water</option>
                                <option>Ground Water</option>
                               
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Type</label>
                            <select class="form-control form-select" name="type" id="type">
                                <option>Test</option>
                                <option>Test</option>
                                <option>Test</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-control form-select" name="status" id="status">
                                <option>Select</option>
                                <option>Pass</option>
                                <option>Fail</option>
                                <option>Custom</option>
                                
                            </select>
                        </div>
                        <div class="col">
                            <button class="btn btn-secondary go" type="submit" name="submit">Search</button>
                        </div>
                    </div>
                </form>
                <div id="content">
                    <table id="testlist_" class="table table-bordered table-striped table-hover mt-6">
                        <thead>
                            <tr>
                                <th class="col-2">Sample code</th>
                                <th class="col-2">Report Date</th>
                                <th class="col-2">Report Number</th>
                                <th class="col-2">Test Group</th>
                                <th class="col-3">Sample Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>00001</th>
                            <td>27-04-2023</td>
                            <td>ULR-TC1234568756765</td>
                            <td>Chemical Testing</td>
                            <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="javascript:;" class="btn btn-outline-success float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>  
                            <a href="javascript:;" class="btn btn-outline-danger float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>  
                            <a href="javascript:;" class="btn btn-outline-primary float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>  
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

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once(filePath . "/footer.php"); ?>
<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/testing-report.js"></script>
</body>

</html>