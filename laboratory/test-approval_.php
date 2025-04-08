<?php
include_once("includes/includes.php");
//Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
$get_usertype = $app->getusertype();
// print_r($get_usertype);
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Records</li>
        <li class="breadcrumb-item active" aria-current="page">Test Approval</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12">
    <div class="card">
              <div class="card-body">
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-7 ps-0">
                    <a href="#" class="noble-ui-logo d-block mt-3">Issued To</a>                 
                    <p class="mt-1 mb-1 text-muted">Quality Manager</b></p>
                    <p><b>Sample Name : </b> ICDS FOOD SUPPLEMENT(SATHU MAVU) FOR CHILDREN
IN THE AGE GROUP OF 2 YEARS TO 6 YEARS(WITH
CARDAMOM FLAVOUR)<br>
                    <b>Sample Code : </b>IQC-01<br>
                    <b>Sample Quantity : </b>250 g<br>
                    <b>Unit & Shift : </b>Production & Day<br>
                    <b>Environmental Condition : </b>Ambient Temperature</p>
                    <b>Sampling Condition : </b>Samp Temperature</p>
                    <h5 class="mt-5 mb-2 text-muted">Sample Details : </h5>
                    <p>
                        Test Group : Biological Testing<br> 
                        Standard Test Type : In House<br> 
                        Material Group :  Intermediate products<br>
                        Sampling Method :  SOP-03<br>
                    </p>

                    <p style="float:right">
                        <span style="color:red">Fail Count : </span> 0
                        ||
                        <span style="color:green">Pass Count : </span> 4
                    </p>
                  </div>


                  <div class="col-lg-3 pe-0">
                    <h6 class="text-end mb-5 pb-4"><span class="text-muted">Report No:</span> 00001</br>
                    <span class="text-muted">Date:</span> 04-01-2023
</h6>
                    <p class="text-end mb-1">
                    <b class="mb-2">Sample Received on : </b>22-04-2023<br>
                    <b class="mb-2">Test No : </b>123456789767676<br>
                    <b class="mb-2" >Test Start Date : </b>28-04-2023<br>
                    <b>Test End Date : </b>28-04-2023<br>
                    <!-- <b>Test No : </b>123456789767676<br> -->
                    <!-- <b>Test No : </b>123456789767676<br> -->
                </p>
                    <!-- <h4 class="text-end fw-normal">$ 72,420.00</h4> -->
                    <!-- <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date :</span> 25rd Jan 2022</h6> -->
                    <!-- <h6 class="text-end fw-normal"><span class="text-muted">Due Date :</span> 12th Jul 2022</h6> -->
                  </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                  <div class="table-responsive w-100">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                              <th>#</th>
                              <th>Test Parameters</th>
                              <th class="text-end">Testing Protocol</th>
                              <th class="text-end">Specification</th>
                              <th class="text-end">Text/Value</th>
                              <th class="text-end">Unit</th>
                              <th class="text-end">Value</th>
                              <th class="text-end">Result</th>
                              <th class="text-end">ReCheck/Retest</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr class="text-end">
                            <td class="text-start">1</td>
                            <td class="text-start">Description</td>
                            <td>SOP NO:156</td>
                            <td>Text</td>
                            <td>14.0</td>
                            <td>% by mass</td>
                            <td>110</td>
                            <td>Pass</td>
                            <td><select class="form-control"><option>Select</option><option>Retest</option><option>Recheck</option></select></td>
                          </tr>
                          
                          <tr class="text-end">
                            <td class="text-start">2</td>
                            <td class="text-start">Moisture</td>
                            <td>SOP NO:157</td>
                            <td>Text</td>
                            <td>5.27</td>
                            <td>% by mass</td>
                            <td>110</td>
                            <td>Pass</td>
                            <td><select class="form-control"><option>Select</option><option>Retest</option><option>Recheck</option></select></td>
                          </tr>
                          <tr class="text-end">
                            <td class="text-start">3</td>
                            <td class="text-start">Foreign Matter</td>
                            <td>SOP NO:153</td>
                            <td>Text</td>
                            <td>1.9</td>
                            <td>% by mass</td>
                            <td>110</td>
                            <td>Pass</td>
                            <td><select class="form-control"><option>Select</option><option>Retest</option><option>Recheck</option></select></td>
                          </tr>
                          <tr class="text-end">
                            <td class="text-start">4</td>
                            <td class="text-start">Impurities From Animal origin</td>
                            <td>SOP NO:158</td>
                            <td>Text</td>
                            <td>4.0</td>
                            <td>% by mass</td>
                            <td>11</td>
                            <td>Pass</td>
                            <td><select class="form-control"><option>Select</option><option>Retest</option><option>Recheck</option></select></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="container-fluid mt-5 w-100">
                  <div class="row">
                    <div class="col-md-6 ms-auto">
                        <div class="table-responsive">
                          <table class="table">
                              <tbody>
                                <tr>
                                  <td>Prepared By</td>
                                  <td class="text-end">Dhanasekar-Analyst(Microbiologist)</td>
                                </tr>
                                <tr>
                                  <td>Approve Staus</td>
                                  <td class="text-end"><select class="form-control approve_status">
                                    <option>Select</option>
                                    <option>Pass</option>
                                    <option>Fail</option>
                                    <option>Re-Test</option>
                                    <option>Re-Sample</option>
                                    <option>Custom</option>
                                </select>
                            </td>
                                </tr>
                                <tr>
                                  <td class="text-bold-800">Description</td>
                                  <td class="text-bold-800 text-end"> <textarea class="form-control">The Above Sample confirms To The Given Specification</textarea></td>
                                </tr>
                                <tr>
                                  <td>Approve Date</td>
                                  <td class="text-danger text-end"><input type="date" class="form-control" value="<?php echo date("Y-m-d") ?>"></td>
                                </tr>
                              </tbody>
                          </table>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="container-fluid w-100">
                  <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Submit</a>
                  <a href="javascript:;" onclick="history.back()" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer" class="me-2 icon-md"></i>Back</a>
                </div>
              </div>
            </div>
    </div>
</div>
</div>
<?php include_once(filePath."/footer.php"); ?>

<?php include_once(filePath."/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/user.js"></script>
</body>

</html>