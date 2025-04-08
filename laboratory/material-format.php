<?php
//
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
// try {
    // Attempt to divide by zero

// $get_material_item = $app->get_material_item();
$get_test_category = $app->get_test_category();
// $get_test_group = $app->gettest_group();
$get_standard_test_type = $app->get_standard_test_type();
$get_material_group = $app->get_material_group();
$parametersList = $app->parametersList();
$formatCategory = $app->formatCategory();
$get_material_category = $app->get_material_category();

// $get_material_category = $app->get_material_category();
$snoid = 0;

if(!empty($_REQUEST['id'])){
$material_format = $app->fetchallDetails('tbl_material_format', 'id', $_REQUEST['id']);

$setresult = $material_format[0];
$test_category_id = $app->fetchallDetails('tbl_test_group', 'id', $setresult['test_grp_id']);
$material_category_id = $app->fetchallDetails('tbl_material_item', 'id', $setresult['sample_id']);
$material_id = $app->fetchallDetails('tbl_material_category', 'id', $material_category_id[0]['mateial_category_id']);

$testcategory = $test_category_id[0]['test_category_id'];

$get_test_group1 = $app->gettest_group1($testcategory);
// echo 12343422;
$testgroup = $setresult['test_grp_id'];
$materialGroup = $material_id[0]['material_id'];
$get_material_category1 = $app->get_material_category1($materialGroup);
$materialCategory = $material_category_id[0]['mateial_category_id'];
$matitem = $setresult['sample_id'];
$get_material_item1 = $app->get_material_item1($materialCategory);
$standardTestId = $setresult['standard_test_id'];
}
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'sample-master');

?>
<html>
<style>
    table.dataTable th:nth-child(1),
    table.dataTable td:nth-child(1) {
        width: 100px;
        max-width: 4px;
    }
    table.dataTable th:nth-child(2),
    table.dataTable td:nth-child(2),
    table.dataTable th:nth-child(3),
    table.dataTable td:nth-child(3) {
        width: 200px;
        max-width: 200px;
        word-break: break-all;
        white-space: pre-line;
    }
    /* table.dataTable td:nth-child(2){
  width: 100px;
  max-width: 40px;
  word-break: break-all;
  white-space: pre-line;
} */
    /* table.dataTable th{
  width: 100px;
  max-width: 10px;
  word-break: break-all;
  white-space: pre-line;
}
table.dataTable td{
  width: 100px;
  max-width: auto;
  word-break: break-all;
  white-space: pre-line;
} */
</style>
<body class="bg">
    <main id="main" class="main">
        <div class="pagetitle">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Masters</li>
                    <li class="breadcrumb-item active" aria-current="page">Material Test Format</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Material Test Format List</h6>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3" action="mattestsubmit" id="userForm" method="POST" enctype="multipart/form-data">
                    <div class="col-3">
                        <label class="form-label">Test Category</label>
                        <select class="form-control" name="testcategory" id="testcategory" required>
                            <option value="">Select Category</option>
                            <?php
                            foreach ($get_test_category as $row) {
                                echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $testcategory) ? 'selected' : '') . '>' . $row["name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- $('#group option[value="testcategory"]').prop('disabled', true);
                    $('#testcategory option[value="testcategory"]').prop('disabled', true);
                    $('#testcategory option[value="testcategory"]').prop('disabled', true); -->
                    <div class="col-3">
                        <label class="form-label">Disipline</label>
                        <select class="form-control" name="testgroup" id="group" required>
                            <option value="">--Select--</option>
                            <?php
                            foreach ($get_test_group1 as $row) {
                                echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $testgroup) ? 'selected' : '') . '>' . $row["name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Group</label>
                        <select class="form-control" name="materialGroup" id="materialGroup" required>
                            <option value="">--Select--</option>
                            <?php
                            foreach ($get_material_group as $row) {
                                echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $materialGroup) ? 'selected' : '') . '>' . $row["name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Material Category</label>
                        <select class="form-control" name="materialCategory" id="materialCategory" required>
                            <option value="">--Select--</option>
                            <?php
									foreach ($get_material_category as $row) {
										echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $materialCategory) ? 'selected' : '') . '>' . $row["name"] . '</option>';
									}
									?>
                            <!-- <-?php
                            foreach ($get_material_category1 as $row) {
                                echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $materialCategory) ? 'selected' : '') . '>' . $row["name"] . '</option>';
                            }
                            ?> -->
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Sample Name</label>
                        <select class="form-control js-example-tags" name="matitem" id="matitem">
                            <option value="">--Select--</option>
                            <?php
                            foreach ($get_material_item1 as $row) {
                                echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $matitem) ? 'selected' : '') . '>' . $row["name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Standard Test Type</label>
                        <select class="form-control" name="standardTestId" id="standardTestId">
                            <option value="">--Select--</option>
                            <?php
                            foreach ($get_standard_test_type as $row) {
                                echo '
                                    <option value="' . $row["id"] . '" ' . (($row["id"] == $standardTestId) ? 'selected' : '') . '>' . $row["name"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row-12">
                        <div class="table-responsive-md">
                            <table class="table table-success" id="example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="color:black;width:10px !important;" width="50px">Sno</th>
                                        <th style="color:black;width:10px !important;" width="10px">Category</th>
                                        <th style="color:black;" width="auto">Test Parameters</th>
                                        <th style="color:black;" width="auto">Testing Protocols</th>
                                        <th style="color:black;" width="auto">Specifications</th>
                                        <th style="color:black;" width="auto">Text/Value</th>
                                        <th style="color:black;" width="auto">Unit</th>
                                        <th style="color:black;" width="auto">Action</th>
                                    </tr>
                                </thead>
                                <!-- <tbody class="clear-format">
					<-?php
			$getmaterialFormat = $app->listmatformat();
$i=1;
if ($getmaterialFormat) {
    foreach ($getmaterialFormat as $row) {
        echo '<tr id="additionalContinerId">
<td>' . $row['parameters'] . '</td>
<td>' . $row['protocols'] . '</td>
<td>'.$row['specification'].'</td>
<td>' . $row['text'] . '</td>
<td>' . $row['unit'] . '</td>
<td></td>
</tr>';
     }
    }
?>
			</tbody> -->
                                <tbody id="additionalContiner" class="add-multiform">
                                    <?php
                                    echo '<tr id="additionalContinerId' . $snoid . '">
                                     <td hidden><input type="hidden" name="mid[]" value="" ></td>
                                    <td style="width:5em;"><input type="text" class="col-12 form-control form-control-xs" style="width:5em;" value="">
                                   
                                    <td style="width:10em;"><select class="col-12 form-control form-control-xs group_name js-example-tags" data="0" name="group_name[]" style="width:10em;">
                                    <option value="">Select</option>';
                                    foreach ($formatCategory as $row) {
                                        echo '
                                            <option value="' . $row["name"] . '" >' . $row["name"] . '</option>';
                                    }
                                    echo '</select>
                                    </td>
                                    <td><select class="col-12 form-control form-control-xs parameters js-example-tags" data="0" name="parameters[]">
                                    <option value="">Select</option>';
                                    foreach ($parametersList as $row) {
                                        echo '
                                            <option value="' . $row["test_parameters"] . '" >' . $row["test_parameters"] . '</option>';
                                    }
                                    echo '</select>
                                    </td>
                                    <td><select class="col-12 form-control form-control-xs protocols js-example-tags pr0" id="protocols" name="protocols[]">
                                    <option value="">Select</option>
                                    </select></td>
                                    <td><select class="col-12 form-control form-control-xs" name="specification[]">
                                    <option value="">Select</option>
                                            <option value="min">Min</option>
                                            <option value="max">Max</option>
                                            <option value="text">Text</option>
                                        </select></td>
                                    <td><input class="col form-control form-control-xs text" type="text" name="text[]"></td>
                                    <td><input class="col form-control form-control-xs unit" type="text" name="unit[]"></td>
                                    <td><button class="btn addMoreData btn-success btn-xs" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-plus-circle m-0"></i></button>
                                    </td>
                                </tr>';
                                    ?>
                                </tbody>
                                <tbody id="additionalContainer1"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="px-3 float-right">
                        <input type="hidden" name="snoid" id="snoid" value="0" />
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="form_action" id="form_action" value="insert" />
                        <!-- <button type="button" class="btn btn-secondary">reset</button> -->
                        <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include_once(filePath . "/footer.php"); ?>
    <?php include_once(filePath . "/js.php"); ?>
    <script>
        var data = <?php echo json_encode($parametersList); ?>;
        var formatCategory = <?php echo json_encode($formatCategory); ?>;
        // console.log(data);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <?php if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) { ?>
        <script src="<?php echo BASE_URL; ?>includes/js/material-formatedit.js"></script>
    <?php } else { ?>
        <script src="<?php echo BASE_URL; ?>includes/js/material-format.js"></script>
    <?php } ?>
    <script>
        // $(document).ready(function() {
        //   var desiredValue = "1"; // Replace with your desired value
        // Find the option with the desired value and set its 'selected' property to true
        //   $('#group option[value="' + desiredValue + '"]').attr('selected', true);
        // });
        $(document).ready(function() {
            $(".js-example-tags").select2({
                tags: true
            });
        });
        $('#example').DataTable({
        });
        //
        // $('select[name="specification[]"]').attr('disabled', 'disabled');
    </script>
</body>
</html>