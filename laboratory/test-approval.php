<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
$get_usertype = $app->getusertype();
$test_resp = $app->test_responsibility();
$id = $_REQUEST['id'];
// print_r($get_usertype);
?>
<!-- <style>
  #qrD img{
    width:100px;
  }
</style> -->
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
      <form method="POST" action="test_approve_submit" id="testApprove">
        <div class="col-md-12">
          <a href="javascript:;" onclick="history.back()" class="btn btn-outline-primary mt-4" style="float:right"><i data-feather="arrow-left" class="me-2 icon-md"></i>Back</a>
        </div>
        <?php
        $data = $app->test_lib($id);
        if ($data) {
          // print_r($id);
          // $product_id = $app->fetchDetailsSelect('tbl_product_category','id',isset($get_tbl_testing['product_id']) ? $get_tbl_testing['product_id'] : '');
          // $test_category_id = $app->fetchDetailsSelect('tbl_test_category','id',$get_tbl_testing['test_category_id']);
          // $test_grp_id = $app->fetchDetailsSelect('tbl_test_group','id',$get_tbl_testing['test_grp_id']);
          // $standard_test_id = $app->fetchDetailsSelect('tbl_standard_test_type','id',$get_tbl_testing['standard_test_id']);
          // $material_grp_id = $app->fetchDetailsSelect('tbl_material_category','id',$get_tbl_testing['material_grp_id']);
          // $sample_id = $app->fetchDetailsSelect('tbl_material_item','id',$get_tbl_testing['sample_id']);
          // $i=0;
          // array_sum($data);
          foreach ($data as $test_lib) {
            $sample_id = $app->fetchDetailsSelect('tbl_material_item', 'id', $test_lib['sample_id']);
            $test_category_id = $app->fetchDetailsSelect('tbl_test_category', 'id', $test_lib['test_category_id']);
            $test_grp_id = $app->fetchDetailsSelect('tbl_test_group', 'id', $test_lib['test_grp_id']);
            $standard_test_id = $app->fetchDetailsSelect('tbl_standard_test_type', 'id', $test_lib['standard_test_id']);
            $material_grp_id = $app->fetchDetailsSelect('tbl_material_category', 'id', $test_lib['material_grp_id']);
            $sample_method_id = $app->fetchDetailsSelect('tbl_sampling_method', 'id', $test_lib['sample_method_id']);
            echo '
              <div class="card-body">
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-7 ps-0">
                    <a href="#" class="noble-ui-logo d-block mt-3">Issued To</a>                 
                    <p class="mb-2 text-muted">' . $test_lib['issued_to'] . '</b></p>
                    <p class="mb-2"><b>Sample Name : </b> ' . $sample_id . '<br>
                    <b class="mb-2">Sample Code : </b>' . $test_lib['sample_code'] . '<br>
                    <b class="mb-4">Sample Quantity : </b>' . $test_lib['sample_quantity'] . '<br>
                    <b class="mt-2">Environmental Condition </b>' . $test_lib['env_condition'] . '<br/>
                    <div class="mt-2">
										<label for="exampleInputUsername1" class="form-label"><b>i) Room Temperature</b> :</label>
                    <span>' . $test_lib['temp'] . '</span>&#8451;<br>
										<label for="exampleInputUsername1" class="form-label"><b>ii) Room Humidity</b> :</label>
                    <span>' . $test_lib['humidity'] . '</span>%
                    </div>
                    <b>Sampling Condition : </b>' . $test_lib['sampling_condition'] . '</p>
                    <h5 class="mt-5 mb-2 text-muted">Sample Details : </h5>
                    <p>
                        Test Category : ' . $test_category_id . '<br> 
                        Test Group : ' . $test_grp_id . '<br> 
                        Standard Test Type : ' . $standard_test_id . '<br> 
                        Material Category :  ' . $material_grp_id . '<br>
                        Sampling Method :  ' . $sample_method_id . '<br>
                    </p>
                  </div>
                  <div class="col-lg-3 pe-0">
                  <!--<div id="qrD"></div></br>-->
                   <h6 class="text-end mb-5 pb-4"><span class="text-muted">Report No:</span> </br>
                    <span class="text-muted">Date:</span>
                  </h6>
                    <p class="text-end mb-1">
                    <b>Sample Received on : </b>' . date("d-m-Y", strtotime($test_lib['sampling_receive_date'])) . '<br>
                    <b>Test No : </b>' . $test_lib['test_number'] . '<br>
                    <b >Test Start Date : </b>' . date("d-m-Y", strtotime($test_lib['test_start_date'])) . '<br>
                    <b>Test End Date : </b>' . date("d-m-Y", strtotime($test_lib['test_end_date'])) . '<br>
                    
                </p>
                    <!-- <h4 class="text-end fw-normal">$ 72,420.00</h4> -->
                    <!-- <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date :</span> 25rd Jan 2022</h6> -->
                    <!-- <h6 class="text-end fw-normal"><span class="text-muted">Due Date :</span> 12th Jul 2022</h6> -->
                  </div>
                </div>
                ';
          }
        }
        ?>
        <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <?php
                    $otherlabel = json_decode($test_lib['otherlabel'], true);
                    $othervalue = json_decode($test_lib['othervalue'], true);
                    //  print_r($otherlabel[0]);
                    if (!empty($otherlabel[0])) {
                      foreach ($otherlabel as $key => $value) {
                        echo '<tr>
  <td>' . $value . '</td>
  <td class="text-end">' . $othervalue[$key] . '</td>
</tr>';
                        // $out[] = array_merge((array)$othervalue[$key], (array)$value);
                      }
                    }
                    // echo '<pre>';
                    // print_r($out);
                    //  print_r($othervalue);
                    // foreach()
                    ?>
                    <!-- <tr>
                                  <td>Approve Status</td>
                                  <td class="text-end">23</td>
                  </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
            <table class="table-bordered" width="100%">
              <thead>
                <tr>
                  <th width="auto">Sno</th>
                  <th width="auto">Test Parameters</th>
                  <th width="auto">Testing Protocol</th>
                  <th width="auto">Specification</th>
                  <th width="auto">Text/Value</th>
                  <th width="auto">Unit</th>
                  <th width="auto">Result</th>
                  <th width="auto">Status</th>
                  <th width="auto">Remark</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $data = $app->test_lib_table_data($id);
                $i = 1;
                $grpname = [];
                if ($data) {
                  $pass = $fail = 0;
                  // Initialize an empty result array
                  // $resultArray = array();
                  foreach ($data as $test_lib_table_data) {
                    // echo '<pre>';
                    if (!empty($test_lib_table_data['head_id'])) {
                      $groupname = $app->groupname($test_lib_table_data['head_id']);
                      // $grpname = array('group_name' => $groupname['group_name']);
                      $grpname[$groupname['group_name']][] = $test_lib_table_data;
                      //  $mergedArray = array_merge($test_lib_table_data, $grpname);
                      // $groupname['group_name'] = $mergedArray;
                      //print_r($grpname);
                      //  exit;
                    } else {
                      // $grpname['empty-text'][]=$test_lib_table_data;
                      $grpname['-'][] = $test_lib_table_data;
                    }
                    // switch($test_lib_table_data['specification']){
                    //   case 'min':
                    //     if($test_lib_table_data['text']<=$test_lib_table_data['value']){
                    //       $remarks='Pass';
                    //     }else{
                    //       $remarks='Fail';
                    //     }
                    //     break;
                    //   case 'max':
                    //     if($test_lib_table_data['text']>=$test_lib_table_data['value']){
                    //       $remarks='Pass';
                    //     }else{
                    //       $remarks='Fail';
                    //     }
                    //     break;
                    //   default;
                  }
                  foreach ($grpname as $key => $grpnamedata) {
                    $order_by = array_column($grpnamedata, 'order_by');
                    // Sort the main array based on 'order_by' values
                    array_multisort($order_by, SORT_ASC, $grpnamedata);
                    // echo '<pre>';
                    echo '<tr style="background:#C8E6C9,text-transform: uppercase;">
<td colspan="9" style="text-transform: uppercase;"><b>' . $key . '</b></td>
</tr>';
                    foreach ($grpnamedata as $grpkey => $grpnamevalue) {
                      $remarks = $grpnamevalue['remark'];
                      if (strtoupper($remarks) == 'PASS') {
                        $pass++;
                    }
                    
                    if (strtoupper($remarks) == 'FAIL') {
                        $fail++;
                    }
                      echo '
<tr>
<input class="col form-control" type="hidden" name="mattest_id[]" value="' . $grpnamevalue['id'] . '">
  <td class="text-start" width="auto">' . $i++ . '</td>
  <td class="text-start" width="auto">' . $grpnamevalue['parameters'] . '</td>
  <td class="text-start" width="auto">' . $grpnamevalue['protocols'] . '</td>
  <td width="auto">' . $grpnamevalue['specification'] . '</td>
  <td width="auto">' . $grpnamevalue['text'] . '</td>
  <td width="auto">' . $grpnamevalue['unit'] . '</td>
  <td width="auto">' . $grpnamevalue['value'] . '</td>
  <td width="auto">' . strtoupper($remarks) . '</td>
  <td width="auto">
  <select class="form-control mattest_status" id="mattest_status" name="mattest_status[]">
  <option value="1">Select</option>
  <option value="2">Re-Test</option>
  <option value="3">Re-Sample</option>
  </select>
  </td>
</tr>';
                    }
                  }
                }
                // echo'<pre>';
                // print_r($grpname);
                // echo ($count);
                ?>
              </tbody>
            </table>
            <p style="float:right">
              <span style="color:red">Fail Count : </span> <?= $fail; ?>
              ||
              <span style="color:green">Pass Count : </span> <?= $pass; ?>
            </p>
          </div>
        </div>
        <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6 ms-auto">
              <!-- <b>Remarks:</b><input type="text" class="form-control" value="" name="remarks" id="remarks"> -->
              <b>Notes:</b>
              <p>
                <?php
                $notes = json_decode($test_lib['notes']);
                $i = 1;
                foreach ($notes as $value) {
                  // echo $value;
                  $notes_Symbol = $app->getDetails('tbl_notes', 'name', 'id', $value);
                  $notes_result = $app->getDetails('tbl_notes', 'description', 'id', $value);
                  // print_r($notes_result);
                  echo $i++ . ') ' . $notes_Symbol . '  ' . $notes_result . '</br>';
                }
                ?>
              </p>
            </div>
            <div class="col-md-6 ms-auto">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Prepared and Verified By</td>
                      <?php $assignfrom = $app->test_assign_from($test_lib['created_by']);
                      ?>
                      <!-- $test_resp = $app->test_responsibility(); -->
                      <td class="text-end"><input type="hidden" name="prepared_by" value="1" required><?= $assignfrom['emp_name'] . '-' . $assignfrom['name']; ?></td>
                    </tr>
                    <tr>
                      <td>Approve Status</td>
                      <td class="text-end">
                        <select class="form-control approve_status" name="approve_status" id="approve_status" required>
                          <option value="">Select</option>
                          <option value="1">Pass</option>
                          <option value="4">Fail</option>
                          <option value="2">Re-Test</option>
                          <option value="3">Re-Sample</option>
                          <option value="5">Custom</option>
                          <!-- <option value="5">Custom</option> -->
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-bold-800">Approved By</td>
                      <td class="text-end">
                        <select class="form-control" name="approved_by" id="approve_by" required>
                          <option value="">Select</option>
                          <?php
                          foreach ($test_resp as $row) {
                            echo '
                                    <option value="' . $row["id"] . '">' . $row["emp_name"] . '-(' . $row["name"] . ')' . '</option>';
                          }
                          ?>
                        </select>
                    </tr>
                    <tr>
                      <td class="text-bold-800">Remarks</td>
                      <td class="text-bold-800 text-end"><input type="text" class="form-control" id="description" name="description" value="" required></td>
                    </tr>
                    <tr>
                      <td>Approve Date</td>
                      <td class="text-danger text-end"><input type="date" class="form-control" value="<?php echo date("Y-m-d") ?>" name="approve_date" required></td>
                    </tr>
                    <tr id="generate_report" style="display:none">
                      <td>Report Number</td>
                      <td class="text-primary text-end">
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" name="generate_report" id="ulr" value="ulr">
                          <label class="form-check-label" for="ulr">
                            Generate ULR Number
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input type="radio" class="form-check-input" name="generate_report" id="lr" value="lr">
                          <label class="form-check-label" for="lr">
                            Generate LR Number
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr id="is_notes" _style="display:none">
                      <td></td>
                      <td class="text-primary text-end">
                        <div class="form-check form-check-inline">
                          <input type="checkbox" class="form-check-input" name="is_notes" id="isNotes" value="1">
                          <label class="form-check-label" for="ulr">
                            Notes
                          </label>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
        <input type="hidden" name="form_action" id="form_action" />
        <div class="container-fluid w-100">
          <button type="submit" class="btn btn-primary float-end mt-4 ms-2" id="action-btn">Submit</button>
        </div>
    </div>
    </form>
    <form method="POST" action="reVerifyTest" id="reVerifyTest">
      <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
      <button type="submit" class="btn btn-warning float-end mt-4 ms-2 reverifysubmit" style="margin-top: -38px !important;margin-right: 114px !important;" id="action-btn">Re-Verify</button>
    </form>
  </div>
</div>
</div>
<!-- <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Submit</a> -->
<?php include_once(filePath . "/footer.php"); ?>
<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/test-approval.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script> -->
<script>
  $(document).ready(function() {
    $(".reverifysubmit").on("click", function() {
      $('input').prop('required', false);
      $('select').prop('required', false);
    });
    //
    $(".mattest_status").on("change", function() {
      var mattest_status = $(this).val();
      // alert(mattest_status);
      if (mattest_status == '2' || mattest_status == '3') {
        $('.approve_status option[value=' + mattest_status + ']').attr('selected', 'selected');
        $('#description').val('THE ABOVE SAMPLE NOT CONFORMED.');
      } else {
        $('.approve_status option[value=1]').attr('selected', 'selected');
        $('#description').val('THE ABOVE SAMPLE CONFORMS TO THE GIVEN SPECIFICATION.');
      }
    });
    //
    $("#approve_status").on("change", function() {
      var status = $(this).val();
      // alert(mattest_status);
      if (status == '1') {
        $('.approve_status option[value=1]').attr('selected', 'selected');
        $('#description').val('THE ABOVE SAMPLE CONFORMS TO THE GIVEN SPECIFICATION.');
        $('#generate_report').show();
        $("input[type=radio]").prop('required', true);
      } else if (status == '5') {
        $('#generate_report').show();
        $('#description').val('-');
        $("input[type=radio]").prop('required', true);
      } else if (status == '4') {
        $('.approve_status option[value=' + status + ']').attr('selected', 'selected');
        $('#description').val('THE ABOVE SAMPLE DOES NOT CONFIRMED TO THE GIVEN SPECIFICATION');
        $('#generate_report').hide();
        $("input[type=radio]").prop('required', false);
      } else {
        $('.approve_status option[value=' + status + ']').attr('selected', 'selected');
        $('#description').val('-');
        $('#generate_report').hide();
        $("input[type=radio]").prop('required', false);
      }
    });
    //
    // window.addEventListener("load", () => {
  });
  //     window.addEventListener('load', 
  // function() { 
  //   var sample_id = '<-?=$sample_id?>';
  //   var sample_code = '<-?=$test_lib['sample_code']?>';
  //     // (C1) WEBSITE
  //     // new QRCode(document.getElementById("qrA"), "https://code-boxx.com/");
  //     // // (C2) TEL
  //     // new QRCode(document.getElementById("qrB"), "tel:+12345678");
  //     // // (C3) SMS
  //     // new QRCode(document.getElementById("qrC"), "sms:+12345678");
  //     // (C4) VCARD
  //     let card = "SAMPLE CODE="+sample_code+"";
  //     card += "Sample Name="+sample_id+"";
  //     new QRCode(document.getElementById("qrD"), card);
  //   });
</script>
</body>
</html>