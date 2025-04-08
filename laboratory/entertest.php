<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
$get_usertype = $app->getusertype();
$get_test_category = $app->get_test_category();
// $get_test_group = $app->gettest_group();
$get_material_group = $app->get_material_group();
$get_standard_test_type = $app->get_standard_test_type();
//
$get_material_category = $app->get_material_category();
// $get_material_item = $app->get_material_item();
//
$get_sampling_method = $app->get_sampling_method();
$get_product_category = $app->get_product_category();
$get_users = $app->get_users();
$test_resp = $app->test_responsibility();
// print_r($test_responsibility);
$get_notes = $app->get_notes_dropdown();
// exit;
// $get_standard_test_type = $app->get_standard_test_type();
// print_r($get_test_group);
// if(isset($_POST['submit'])){
// 	echo $_POST['test'];
// }
$snoid = 0;
$id = isset($_GET['id']) ? $_GET['id'] : '';
// print_r($get_usertype);
$get_tbl_testing = $app->fetchDetails('tbl_testing', $id);
$product_id = $test_category_id = $test_grp_id = $standard_test_id = $material_grp_id = $sample_id = $sample = $sample_method_id = $material_group = '';
$id = $sample_code = $sampling_date = $sampling_receive_date = $sample_quantity = $test_start_date = $test_end_date = $env_condition = $sampling_condition = $notes = '';
if ($get_tbl_testing) {
	// $product_id = $app->fetchDetailsSelect('tbl_product_category','id',isset($get_tbl_testing['product_id']) ? $get_tbl_testing['product_id'] : '');
	$product_id = $get_tbl_testing['product_id'];
	$test_category_id = $app->fetchDetailsSelect('tbl_test_category', 'id', $get_tbl_testing['test_category_id']);
	$test_grp_id = $app->fetchDetailsSelect('tbl_test_group', 'id', $get_tbl_testing['test_grp_id']);
	$standard_test_id = $app->fetchDetailsSelect('tbl_standard_test_type', 'id', $get_tbl_testing['standard_test_id']);
	// $material_group = $app->fetchDetailsSelect('tbl_material','id',$get_tbl_testing['material_id']);
	$material_group = $get_tbl_testing['material_id'];
	$material_grp_id = $app->fetchDetailsSelect('tbl_material_category', 'id', $get_tbl_testing['material_grp_id']);
	$sample_id = $app->fetchDetailsSelect('tbl_material_item', 'id', $get_tbl_testing['sample_id']);
	$sample = $get_tbl_testing['sample_id'];
	$sample_method_id = $app->fetchDetailsSelect('tbl_sampling_method', 'id', $get_tbl_testing['sample_method_id']);
	$notes = json_decode($get_tbl_testing['notes'], true);
	// $assign_from = $app->fetchDetailsSelect('users','id',$get_tbl_testing['assign_from']);
	// print_r($product_id);
	$id = $get_tbl_testing['id'];
	// $product_id = $get_tbl_testing['product_id'];
	$sample_code = $get_tbl_testing['sample_code'];
	$sampling_date = date("d-m-Y H:i", strtotime($get_tbl_testing["sampling_date"]));
	$sampling_receive_date = date("d-m-Y H:i", strtotime($get_tbl_testing["sampling_receive_date"]));
	$sample_quantity = $get_tbl_testing['sample_quantity'];
	// $test_category_id = $get_tbl_testing['test_category_id'];
	$test_start_date = date("d-m-Y H:i", strtotime($get_tbl_testing["test_start_date"]));
	$test_end_date = date("d-m-Y H:i", strtotime($get_tbl_testing["test_end_date"]));
	$temp = $get_tbl_testing['temp'];
	$humidity = $get_tbl_testing['humidity'];
	$test_responsibility = $get_tbl_testing['test_responsibility'];
	$sampling_condition = $get_tbl_testing['sampling_condition'];
	$issued_to = $get_tbl_testing['issued_to'];
	// $test_grp_id = $get_tbl_testing['test_grp_id'];
	// $standard_test_id = $get_tbl_testing['standard_test_id'];
	// $material_grp_id = $get_tbl_testing['material_grp_id'];
	// $sample_id = $get_tbl_testing['sample_id'];
	// $sample_method_id = $get_tbl_testing['sample_method_id'];
	$assign_from = $get_tbl_testing['assign_from'];
	$chemical_test_res = $get_tbl_testing['chemical_test_res'];
	$micro_test_res = $get_tbl_testing['micro_test_res'];
	$otherlabel = json_decode($get_tbl_testing['otherlabel'], true);
	$othervalue = json_decode($get_tbl_testing['othervalue'], true);
	// print_r($otherlabel);
	// exit;
}
// $report_date = $get_tbl_testing['report_date'];
// $report_number = $get_tbl_testing['report_number'];
// $reference_id = $get_tbl_testing['reference_id'];
// $reference_id = $get_tbl_testing['reference_id'];
// $reference_id = $get_tbl_testing['reference_id'];
// echo $get_tbl_testing['test_grp_id'];
$status = $is_retest = $is_resample = '0';
if (isset($_REQUEST['status'])) {
	$status = $_REQUEST['status'];
	if ($status == 2) {
		$is_retest = 1;
		$is_resample = 0;
	} else {
		$is_retest = 0;
		$is_resample = 1;
	}
	$testing_id = $_REQUEST['id'];
} else {
	$status = 0;
	$is_retest = 0;
	$is_resample = 0;
	$testing_id = 0;
}
?>
<style>
	.input-group-text {
		padding: 5px;
	}
	/* tr td input{
		color: red;
	} */
	.form-label {
		font-size: 16px !important;
		font-weight: 3px;
	}
	input,
	select {
		background: #fff;
		color: #525865;
		border-radius: 4px;
		border: 1px solid #d1d1d1;
		box-shadow: inset 1px 2px 8px rgba(0, 0, 0, 0.07);
		font-family: inherit;
		font-size: 1em;
		line-height: 1.45;
		outline: none;
		padding: 0.6em 1.45em 0.7em;
		-webkit-transition: .18s ease-out;
		-moz-transition: .18s ease-out;
		-o-transition: .18s ease-out;
		transition: .18s ease-out;
	}
	.required-field::after {
		content: "*";
		color: red;
	}
</style>
<nav class="page-breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item">Settings</li>
		<li class="breadcrumb-item active" aria-current="page">Test Creation</li>
	</ol>
</nav>
<div>
	<form method="POST" action="taskedit" id="testgroup">
		<input type="hidden" name="testing_id" id="testing_id" value="<?= $id ?>" />
		<input type="hidden" name="form_action" id="form_action" />
		<input type="hidden" name="status" id="status" value="<?= $status ?>" />
		<input type="hidden" name="is_retest" id="is_retest" value="<?= $is_retest ?>" />
		<input type="hidden" name="is_resample" id="is_resample" value="<?= $is_resample ?>" />
		<div class="row" style="display:none">
			<div class="col-md-9">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title" style="color:#43A49B">Test Creation Form</h6>
						<div class="row">
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Product Category</label>
									<!-- <select class="form-control" name="comment" id="comment" >
						  <option>Select Category</option>
						  <option>Raw Materials (RM)</option>
						  <option>Packing Materials (PM)</option>
						  <option>Finished Goods (FG)</option>
						  <option>Work In Progress (WIP)</option>
						</select> -->
									<select class="form-control js-example-tags" name="product_id" required="required">
										<option value="">Select Product Category</option>
										<?php
										foreach ($get_product_category as $row) {
											echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $product_id) ? 'selected' : '') . '>' . $row["name"] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<!-- Col -->
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Sample Code</label>
									<input required="required" type="text" class="form-control" name="sample_code" placeholder="" value="<?= $sample_code; ?>">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Sampling Date</label>
									<input required="required" type="text" class="form-control datepicker-basic-time" name="sampling_date" placeholder="" value="<?= $sampling_date; ?>">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Sample Received Date</label>
									<input required="required" type="text" class="form-control datepicker-basic-time" name="sampling_receive_date" placeholder="" value="<?= $sampling_receive_date; ?>">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Sample Quantity</label>
									<input required="required" type="text" class="form-control" name="sample_quantity" placeholder="" value="<?= $sample_quantity; ?>">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Issued To</label>
									<input required="required" type="text" class="form-control" name="issued_to" placeholder="" value="<?= $issued_to; ?>">
								</div>
							</div>
							<hr />
							<div class="col-sm-4">
								<!-- <div class="mb-3">
									<label class="form-label">Test Category</label>
									<div class="input-group mb-3">
										<select class="form-control js-example-tags" name="test_category_name">
											<option>Select Category</option>
											<-?php
									foreach ($get_test_category as $row) {
									echo '
                                    <option value="' . $row["name"] . '">' . $row["name"] . '</option>';
									}
									?>
										</select>
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">
												<input type="button" class="btn-primary" value="Create">
											</span>
										</div>
									</div>
								</div> -->
								<div class="mb-3">
									<label class="form-label required-field">Test Category</label>
									<div class="input-group mb-3">
										<select required="required" class="form-control js-example-tags" name="test_category_name" id="test_category_name">
											<option>Select Category</option>
											<?php
											foreach ($get_test_category as $row) {
												echo '
                                    <option value="' . $row["name"] . '" ' . (($row["name"] == $test_category_id) ? 'selected' : '') . '>' . $row["name"] . '</option>';
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<!-- <div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Test Start Date</label>
									<input required="required" type="text" class="form-control datepicker-basic-time" name="test_start_date" placeholder="" value="<?= $test_start_date; ?>">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Test End Date</label>
									<input required="required" type="text" class="form-control datepicker-basic-time" name="test_end_date" placeholder="" value="<?= $test_end_date; ?>">
								</div>
							</div> -->
							<label class="form-label required-field">Environmental Condition</label>
							<!-- 
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Environmental Condition</label>
									<input type="text" class="form-control" name="env_condition" placeholder="" value="<?= $env_condition; ?>">
								</div>
							</div> -->
							<div class="col-sm-4">
								<div class="mb-3">
									<div class="input-group input-group-lg">
										<div class="input-group-prepend">
											<span class="input-group-text" style="padding: 10px; !important" id="inputGroup-sizing-lg">Temperature</span>
										</div>
										<input required="required" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="temp" value="<?= $temp; ?>">
										<div class="input-group-append">
											<span class="input-group-text" style="padding: 10px; !important">&#8451;</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<div class="input-group input-group-lg">
										<div class="input-group-prepend">
											<span class="input-group-text" style="padding: 10px; !important" id="inputGroup-sizing-lg">Humidity</span>
										</div>
										<input required="required" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="humidity" value="<?= $humidity; ?>">
										<div class="input-group-append">
											<span class="input-group-text" style="padding: 10px; !important">%</span>
										</div>
									</div>
								</div>
							</div>
							<!-- Col -->
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Sample Condition</label>
									<input required="required" type="text" class="form-control" name="sampling_condition" placeholder="" value="<?= $sampling_condition; ?>">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Sample Received By</label>
									<select required="required" class="form-control" name="assign_from" id="comment">
										<option value="">Select</option>
										<?php
										foreach ($get_users as $row) {
											echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $assign_from) ? 'selected' : '') . '>' . $row["emp_name"] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<!-- Col -->
							<div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">Test Responsibility</label>
									<select required="required" class="form-control test" name="test_responsibility" id="comment" multiple>
										<option value="">Select</option>
										<?php
										foreach ($test_resp as $row) {
											echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $test_responsibility) ? 'selected' : '') . '>' . $row["emp_name"] . '-(' . $row["name"] . ')' . '</option>';
										}
										?>
									</select>
								</div>
							</div><!-- Col -->
							<!-- <div class="col-sm-4">
								<div class="mb-3">
									<label class="form-label required-field">(Micro) Test Responsibility</label>
									<select class="form-control" name="micro_test_res" id="comment">
										<option value="">Select</option>
										<option value="1">ANALYST (MICROBIOLOGIST)</option>
										<option value="2">JUNIOR ANALYST (MICROBIOLOGIST)</option>
									</select>
								</div>
							</div> -->
						</div>
						<!-- <button type="submit" class="btn btn-primary submit" name="submit">Submit form</button> -->
					</div>
				</div>
			</div>
			<!-- <div class="row-12">
			  
					</div> -->
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">&nbsp;</h6>
						<div class="row">
							<!-- <div class="col-sm-4"> -->
							<div class="mb-3">
								<label class="form-label required-field">Test Group</label>
								<select required="required" class="form-control js-example-tags" name="test_group_name" id="test_group_name">
									<!-- $get_test_group -->
									<?php
									if ($get_test_group) {
										foreach ($get_test_group as $row) {
											echo '
										<option value="' . $row["name"] . '" ' . (($row["name"] == $test_grp_id) ? 'selected' : '') . '>' . $row["name"] . '</option>';
										}
									} elseif ($test_grp_id) {
										echo '<option value="' . $test_grp_id . '" selected>' . $test_grp_id . '</option>';
									} else {
										echo '<option>Select Test Group</option>';
									}
									?>
									<!-- <option>Chemical Testing</option> -->
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label required-field">Standard Test Type</label>
								<select required="required" class="form-control js-example-tags" name="standard_test_type_name">
									<option>Select Test Type</option>
									<?php
									foreach ($get_standard_test_type as $row) {
										echo '
                                    <option value="' . $row["name"] . '" ' . (($row["name"] == $standard_test_id) ? 'selected' : '') . '>' . $row["name"] . '</option>';
									}
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label required-field">Material Group</label>
								<select required="required" class="form-control" id="material_id" name="material_id">
									<option value="">Select Material Group</option>
									<?php
									foreach ($get_material_group as $row) {
										echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $material_group) ? 'selected' : '') . '>' . $row["name"] . '</option>';
									}
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label required-field">Material Category</label>
								<select required="required" class="form-control js-example-tags" id="material_category_name" name="material_category_name">
									<option>Select Material Group</option>
									<?php
									foreach ($get_material_category as $row) {
										echo '
                                    <option value="' . $row["name"] . '" ' . (($row["name"] == $material_grp_id) ? 'selected' : '') . '>' . $row["name"] . '</option>';
									}
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label required-field">Sample Name</label>
								<select required="required" class="form-control js-example-tags" id="sample_name" name="material_sample_name">
									<!-- <option value="1">Test</option> -->
									<?php
									if ($get_material_item) {
										foreach ($get_material_item as $row) {
											echo '
										<option value="' . $row["name"] . '" ' . (($row["name"] == $sample_id) ? 'selected' : '') . '>' . $row["name"] . '</option>';
										}
									} elseif ($sample_id) {
										echo '<option value="' . $sample_id . '" selected>' . $sample_id . '</option>';
									} else {
										echo '<option>Select Sample Name</option>';
									}
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label required-field">Sampling Method</label>
								<select required="required" class="form-control js-example-tags" name="sampling_method">
									<option>Select Sampling Method</option>
									<?php
									if ($get_sampling_method) {
										foreach ($get_sampling_method as $row) {
											echo '
                                    <option value="' . $row["name"] . '" ' . (($row["name"] == $sample_method_id) ? 'selected' : '') . '>' . $row["name"] . '</option>';
										}
									}
									?>
								</select>
							</div>
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Col -->
		<div class="row">
			<div class="col-sm-4">
				<div class="mb-3">
					<label class="form-label required-field">Sample Code</label>
					<input required="required" type="text" class="form-control" name="sample_code" placeholder="" value="<?= $sample_code; ?>">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="mb-3">
					<label class="form-label required-field">Test Start Date</label>
					<input type="text" class="form-control datepicker-basic" name="test_start_date" placeholder="" value="<?= $test_start_date; ?>">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="mb-3">
					<label class="form-label required-field">Test End Date</label>
					<input type="text" class="form-control datepicker-basic" name="test_end_date" placeholder="" value="<?= $test_end_date; ?>">
				</div>
			</div>
		</div>
		<div class="table-responsive-md">
			<table class="table table-success" id="st" style="width:100%">
				<thead>
					<tr>
						<th style="color:black;" width="5%">Sno</th>
						<th style="color:black;" width="auto">Test Parameters</th>
						<th style="color:black;" width="auto">Testing Protocols</th>
						<th style="color:black;" width="auto">Specifications</th>
						<th style="color:black;" width="auto">Text/Value</th>
						<th style="color:black;" width="auto">Unit</th>
						<th style="color:black;" width="auto">Result</th>
						<th style="color:black;" width="auto">Remark</th>
					</tr>
				</thead>
				<tbody class="additionalContinerClass">
					<!--  -->
					<?php
					$result = $app->fetchallDetails('tbl_test_material_format', 'testing_id', $id);
					// print_r($result);
					foreach ($result as $val1) {
						$array[] = array('parameters' => $val1['parameters'], 'protocols' => $val1['protocols'], 'specification' => $val1['specification'], 'text' => $val1['text'], 'unit' => $val1['unit']);
					}
					// echo '<pre>';
					$i = 1;
					$color = '';
					if ($array) {
						foreach ($array as $row) {
							$result = $app->getmaterialFormatvalue($_REQUEST['id'], $row['parameters'], $row['protocols']);
							// print_r($result['value']);
							// exit;
							if ($result['value'] <> '') {
								$newfuction = $result['value'];
							} elseif ($result['head_id'] <> '') {
								$newfuction = $app->getFinalresult($result['head_id'], $_REQUEST['id']);
							} else {
								$newfuction = '';
							}
							// echo $newfuction;

							// if($result['head_id'] <> ''){
							// 	$newfuction = $app->getFinalresult($result['head_id'], $_REQUEST['id']);
							// }else{
							// 	$newfuction = '';
							// }
							if (isset($row['status'])) {
							switch ($row['status']) {
								case 1:
									$status = 'Approved';
									$color = '';
									break;
								case 2:
									$status = 'Re-Test';
									$color = 'text-warning';
									break;
								case 3:
									$status = 'Re-Sampling';
									$color = 'text-danger';
									break;
								default:
									$status = 'Pending';
									$color = 'warning';
							}
							}
							echo '<tr id="additionalContinerId">
			<input class="col form-control form-control-xs" type="hidden" name="id[]" value="' . $result['id'] . '" readonly>
			<td><input class="col form-control ' . $color . ' form-control-xs" type="text" name="order_by[]" value="' . $i . '" readonly></td>
			<td><input class="col form-control ' . $color . ' form-control-xs" type="text" name="parameters[]" value="' . $row['parameters'] . '" readonly></td>
			<td><input class="col form-control ' . $color . ' form-control-xs" type="text" name="protocols[]" value="' . $row['protocols'] . '"
					fdprocessedid="3suo2o" readonly></td>
			<td><input class="col form-control ' . $color . ' form-control-xs" type="text" name="specification[]" value="' . $row['specification'] . '"
					fdprocessedid="3suo2o" readonly></td>
			<td><input class="col form-control ' . $color . ' form-control-xs" type="text" value="' . $row['text'] . '" name="text[]" readonly></td>
			<td><input class="col form-control ' . $color . ' form-control-xs" type="text" name="unit[]" value="' . $row['unit'] . '" readonly></td>
			<td><input class="col-12 form-control ' . $color . ' form-control-xs result" type="text" id="" name="value[]" value="' . $newfuction . '" tabindex="' . $i++ . '"></td>
			<td><select class="col-12 form-control ' . $color . ' form-control-xs" name="remark[]" fdprocessedid="effusw">
			<option value="">Select</option>
			<option value="pass" ' . (('pass' == $result['remark']) ? 'selected' : '') . '>PASS</option>
			<option value="fail" ' . (('fail' == $result['remark']) ? 'selected' : '') . '>FAIL</option>
		</select></td>
			</tr>';
						}
						// foreach ($result as $row){
						//   echo'<option value="'. $row["id"].'">'. $row["name"].'</option>';
						// }
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">	
						<div class="col-md-6">
							<!-- <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" style="padding: 18px;">Notes</span>
  </div>
  <textarea class="form-control notes" aria-label="With textarea" name="notes" value="<?= $notes; ?>" ><?= $notes; ?></textarea>
</div> -->
							<label class="form-label required-field">Notes</label>
							<select class="form-control test" name="notes[]" id="notes" multiple>
								<option value="">Select</option>
								<?php

								$i = 0;
								if (!is_array($notes)) {
									$notes = [];
								}
								$notes = $notes ?? [];

								foreach ($get_notes as $row) {
									echo '<option value="' . $row["id"] . '" ' . ((in_array($row["id"], $notes)) ? 'selected' : '') . ' >' . $row["description"] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="col-md-6" style="display:none;">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Other Info</span>
								</div>
								<input type="text" class="form-control" name="otherlabel[]" value="<?= $otherlabel[0]; ?>" placeholder="Label">
								<input type="text" class="form-control" name="othervalue[]" value="<?= $othervalue[0]; ?>" placeholder="Value">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Other Info</span>
								</div>
								<input type="text" class="form-control" name="otherlabel[]" value="<?= $otherlabel[1]; ?>" placeholder="Label">
								<input type="text" class="form-control" name="othervalue[]" value="<?= $othervalue[1]; ?>" placeholder="Value">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Other Info</span>
								</div>
								<input type="text" class="form-control" name="otherlabel[]" value="<?= $otherlabel[2]; ?>" placeholder="Label">
								<input type="text" class="form-control" name="othervalue[]" value="<?= $othervalue[2]; ?>" placeholder="Value">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Other Info</span>
								</div>
								<input type="text" class="form-control" name="otherlabel[]" value="<?= $otherlabel[3]; ?>" placeholder="Label">
								<input type="text" class="form-control" name="othervalue[]" value="<?= $othervalue[3]; ?>" placeholder="Value">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary float-right mt-4" style="float:right" id="action-btn">Submit</button>
	</form>
</div>
<?php include_once(filePath . "/footer.php"); ?>
<?php include_once(filePath . "/js.php"); ?>
<!-- <script src="<?php echo BASE_URL; ?>includes/js/user.js"></script> -->
<!-- <script src="<?php echo BASE_URL; ?>includes/js/mat-test-frmat.js"></script> -->
<script src="<?php echo BASE_URL; ?>includes/js/sample-reg.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
	// 	<-?php if(isset($_REQUEST['view'])){ ?> 
	// 	$(document).ready(function()
	// {
	// $('input').attr('readonly', true);
	// $('select').prop('disabled', true);
	// $('.datepicker-basic-time').prop('disabled', true);
	// $("button").attr("disabled", true);
	// });
	// <-?php } ?>
	// $('input').attr("readonly");
	$(".js-example-tags").select2({
		tags: true
	});
	$(".test").select2({
		multiple: true,
		// width: "auto"
	});
	//
	// $(".datepicker-basic").flatpickr({
	// dateFormat: "d-m-Y",   
	// });
	//
	$(".datepicker-basic").flatpickr({
		dateFormat: "d.m.Y", // Use the same format as retrieved from the database
	});
	// $(document).ready(function() {
	//     $(".datepicker-basic").flatpickr({
	//         dateFormat: "d.m.Y",
	//         defaultDate: "today" // Set the default date to today
	//     });
	// });
	//
	$(".datepicker-basic-time").flatpickr({
		enableTime: true,
		dateFormat: "d-m-Y H:i",
		defaultDate: new Date()
	});
	//$("#notes").val(5);
	//
	// $("body").on('change', '#sample_name', function (e) {
	// 	var test = $(this).val();
	// 	if (test == '1') {
	// 		$('.additionalContinerClass').show();
	// 	} else {
	// 		$('.additionalContinerClass').hide();
	// 	}
	// });
	//
	$(document).ready(function() {
		$('table input').on("keyup", function() {
			var action = 'get_notes';
			var symbol = $(this).val();
			$.ajax({
				url: "ajax-query/application.php",
				type: "POST",
				cache: false,
				data: {
					symbol: symbol,
					action: action
				},
				dataType: 'json',
				success: function(data) {
					console.log(data);
					var dis = data[0]['description'];
					$(".notes").html(dis);
					$(".notes").val(dis);
				}
			});
		});
		//
		$("#test_category_name,#test_group_name,#sample_name").on("change", function() {
			var sample_name = $('#sample_name').val();
			var test_category_name = $('#test_category_name').val();
			var test_group_name = $('#test_group_name').val(); // alert(sample_name);
			var action = 'getmaterialFormat';
			$.ajax({
				url: "ajax-query/masterSubmit.php",
				type: "POST",
				cache: false,
				data: {
					test_category_name: test_category_name,
					test_group_name: test_group_name,
					sample_name: sample_name,
					action: action
				},
				success: function(data) {
					// console.log(data);
					$(".additionalContinerClass").html(data);
				}
			});
		});
		//
		$("#material_category_name").on('change', function() {
			// Your stuff..
			var material_category_name = $(this).val();
			var action = 'get_material_item';
			$.ajax({
				url: "ajax-query/masterSubmit.php",
				type: "POST",
				cache: false,
				data: {
					material_category_name: material_category_name,
					action: action
				},
				success: function(data) {
					// console.log(data);
					$("#sample_name").html(data);
				}
			});
		});
		//
		$("#test_category_name").on('change', function() {
			// Your stuff..
			var test_category_name = $(this).val();
			var action = 'get_test_group';
			//    alert(test_category_name)
			$.ajax({
				url: "ajax-query/masterSubmit.php",
				type: "POST",
				cache: false,
				data: {
					test_category_name: test_category_name,
					action: action
				},
				success: function(data) {
					// console.log(data);
					$("#test_group_name").html(data);
				}
			});
		});
		//
		$("input[name='value[]']").on("keyup", function(e) {
			var specification = $(this).closest('tr').find('input[name="specification[]"]').val();
			var text = parseFloat($(this).closest('tr').find('input[name="text[]"]').val());
			var value = parseFloat($(this).closest('tr').find('input[name="value[]"]').val());
			if (specification == 'min') {
				if (text <= value) {
					var remarks = 'pass';
				} else if (text > value) {
					var remarks = 'fail';
				} else {
					var remarks = '';
				}
			} else if (specification == 'max') {
				if (text >= value) {
					var remarks = 'pass';
				} else if (text < value) {
					var remarks = 'fail';
				} else {
					var remarks = '';
				}
			} else {
				remarks = '';
			}
			//
			if (remarks == '') {
				var option = '<option value="">Select</option><option value="pass">PASS</option><option value="fail">FAIL</option>';
			} else {
				var option = '<option value=' + remarks + '>' + remarks + '</option>';
			}
			$(this).closest('tr').find('select[name="remark[]"]').html(option);
		});
	});
	//
</script>
</body>
</html>