<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");


$testingId = isset($_REQUEST['testingId']) ? $_REQUEST['testingId'] : '';

// $get_tbl_testing = $app->fetchDetails('tbl_work_sheet_log', $testingId);
$get_tbl_testing = $app->fetchDetails('tbl_testing', $testingId);
$sample_name = $sample_code = $sampling_receive_date = $test_start_date = $test_end_date = '';
//
if ($get_tbl_testing) {
    $sample_name = $app->fetchDetailsSelect('tbl_material_item', 'id', $get_tbl_testing['sample_id']);
    $sample_code = $get_tbl_testing['sample_code'];
    $sampling_receive_date = $get_tbl_testing['sampling_receive_date'];
    $test_start_date = $get_tbl_testing['test_start_date'];
    $test_end_date = $get_tbl_testing['test_end_date'];
}
$parametersList = $app->fetchallDetails('tbl_test_material_format','testing_id',$testingId);

// $parametersList = $app->parametersList();
// print_r($parametersList);
// exit;
$tbl_sub_heading = $app->tbl_sub_heading();
// $testingId = $_REQUEST['testingId'];
$get_material_item = $app->get_material_item();
// if(isset($testingId) || !empty($testingId)){
//     echo 12345;
// }
// $parametersList = $app->parametersList();
// $cal = array();
// $cal[1] = $parametersList[0]['calculation'];
// $cal[2] = "(sample_weight-drying_weight)*100";
//$_SESSION["cal"] = '';
//  print_r($_SESSION);
// exit;
?>
<style>
    .color {
        background-color: #43A49B;
        color: white;
    }
    /* 
    .color1 {
        background-color: #cdfaf6;
    } */
    .btn1 {
        background-color: #D0EBEA;
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.2), 0 1px 30px 0 rgba(0, 0, 0, 0.1);
    }
    .result {
        padding-left: 100px;
        color: #43A49B;
    }
    /* .modal{
    display: block !important;
} */
    /* .modal-dialog{
      overflow-y: initial !important
} */
    .modal-body {
        height: 500px;
        overflow-y: auto;
    }
</style>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Work Sheet</li>
        <li class="breadcrumb-item active" aria-current="page">Work Sheet Pending</li>
    </ol>
</nav>
<div class="card color1">
    <div class="text-center mt-2">
        <h3 style="color: #26A69A;">Work Card for Finished Products</h3>
    </div>
    
	<form method="POST" action="worksheetSubmit" id="submitcreateworksheet">
    <div class="col my-2 mx-3">
        <div class="card-body overflow-hidden position-relative color">
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sample Code</label>
                    <input type="text" name="sample_code" class="form-control" value="<?= $sample_code; ?>">
                </div>
                <!-- <div class="col-md-2">
                    <label class="form-label">Sample Name</label>
                    <select required="required" class="form-control js-example-tags" id="sample_name" name="sample_id">
                        <option value=""> Select Sample</option>
                    <-?php
									if($get_material_item){
										foreach ($get_material_item as $row) {
											echo '
										<option value="' . $row["id"] . '" '.(($row["name"] == $sample_id) ? 'selected' : '').'>' . $row["name"] . '</option>';
										} 
									} 
                                        ?>
                                        </select>
                </div> -->
                <div class="col-md-2">
                    <label class="form-label">Received Date</label>
                    <input type="datetime-local" name="sampling_receive_date" id="" class="form-control datepicker-basic-time" value="<?= $sampling_receive_date; ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Test Start Date</label>
                    <input type="datetime-local" name="test_start_date" id="" class="form-control datepicker-basic-time" value="<?= $test_start_date; ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Test End Date</label>
                    <input type="datetime-local" name="test_end_date" id="" class="form-control datepicker-basic-time" value="<?= $test_end_date; ?>">
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
    </div>


                                </form>

    <div class="text-center">
        <h4>Test Report Forms</h4>
    </div>
    <!-- <div class="modal-dialog" _style="overflow-y: scroll; max-height:30%;"> -->
    <!-- <div class="col mx-5 mb-3"> -->
    <div class="card-body  position-relative">
        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive-md">
          <table id="table_1" class="table">
            <thead>
              <tr>
                <th>Sno</th>
                <th>headid</th>
                <th>Testing Parameters</th>
                <th>Testing Protocols</th>
                <th>Result</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                foreach ($parametersList as $key => $value) {
                    // $headId = $app->getDetails($table, $column, $where1, $value)
                    $sno = $i++;
                    // if()
                    $newfuction = $app->getFinalresult($value['head_id'], $testingId);
                    //                     $data = json_decode($newfuction);

                    // $last_key = end(array_keys($data));
                    // $last_value = end($data);
                    // print_r($data);
// exit;
                    // $test = json_decode($newfuction['result']);
                    
                    // $x = end($test) ?? 0;
                    echo '<tr>
                    <td>'.$sno.'</td>
                    <td>'.$value['head_id'].'</td>
                    <td>'.$value['parameters'].'</td>
                    <td>'.$value['protocols'].'</td>
                    <td>'.$newfuction.'</td>
                    <td><button type="button" id="' . $value['head_id'] . '" text="' . $value['parameters'] . '" class="btn btn1 btn-xs col-6 mb-2 usertype">Action</button></td>
                    </tr>
                    ';

                    // $sno = $i++;
                    // $newfuction = $app->getFinalresult($value['id'], $testingId);
                    // $test = json_decode($newfuction['result']);
                    // $x = end($test) ?? 0;

                    // echo '<button type="button" id="' . $value['id'] . '" text="' . $value['test_parameters'] . '" class="btn btn1 col-6 mb-2 usertype"><span style="float:left;" class="text-primary">' . $sno . ')</span>' . $value['test_parameters'] .'('.$value['testing_protocols'].')'. '<span style="float:right;"><span class="result" >Result</span> ' . $x . '</span></button>';
                }

                ?>
                                                </tbody>
          </table>
        </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <!-- </div> -->
    <form method="post" action="wsConfirm" id="wsConfirm" autocomplete="off">
        <input type="hidden" name="testId" id="testId" value="<?= $testingId; ?>" />
        <div class="text-center m-2">
            <a href="test-form.php?testingId=<?= $testingId; ?>" target="_blank"><button type="button" class="btn btn-xs btn-info"
                    id="">View</button></a>
            <a href="entertest.php?id=<?= $testingId; ?>&&edit=edit"><button type="button" class="btn btn-xs btn-success"
                    id="">Confirm</button></a>
            <!-- <button type="submit" id="" class="btn btn-xs btn-warning test">Submit</button> -->
            <!-- <a href="#" onclick="window.close()"><button type="button" class="btn btn-xs btn-secondary">Close</button></a> -->
        </div>
    </form>
</div>
<?php include_once(filePath . "/footer.php"); ?>
<div class="modal fade" id="typeModal">
    <div class="modal-dialog modal-lg" style="max-width:1250px !important">
        <form method="post" action="worksheetSubmit" id="wsSubForm" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="headName" style="color: #26A69A;"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="worksheetform">
                        <!--  -->
                        <!--  -->
                        <!--  -->
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="testingId" id="testingId" value="<?= $testingId; ?>" />
                        <input type="hidden" name="headId" id="headId" />
                        <input type="hidden" name="form_action" id="form_action" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/work-sheet.js"></script>
<script>
    // var tbl_form_column = '<-?= json_encode($tbl_form_column); ?>';
    // var tbl_formColumn = jQuery.parseJSON(tbl_form_column);
    // console.log(tbl_formColumn);
    var x = 0;
    $("body").on('click', '.addMoreData', function (e) {
        e.preventDefault();
        var headId = $(this).val();
        x++;
        $.ajax({
            type: "POST",
            url: "ajax-query/masterSubmit.php",
            data: { action: 'tbl_form_column', headId: headId },
            dataType: "text",
            success: function (tbl_form_column) {
                // console.log(tbl_form_column);
                var tbl_formColumn = jQuery.parseJSON(tbl_form_column);
                // console.log(tbl_formColumn);
                var content = '<tr class="" style="background-color:#E0F2F1" id="additionalContinerId' + x + '">'
                $.each(tbl_formColumn, function (k, v) {
                    content += '<td><input type="text" class="form-control form-control-xs" name="' + v.name + '" value="" required="required"></td>';
                });
                content += '<td><button type="button" class="btn btn-warning btn-xs additionalContinerRemove" value="' + x + '" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td></tr>'
                $('#additionalContiner').append(content);
            }
        });
        // alert(id)
    });
    //
    var x = 0;
    $("body").on('click', '.addMoreData', function (e) {
        e.preventDefault();
        x++;
        // alert(x)
    });
    //
    // $.each(tbl_formColumn, function (k, v) {
    //
    //     console.log(v.name);
    // });
    //
    $("body").on('click', '.additionalContinerRemove', function (e) {
        e.preventDefault();
        var id = $(this).val();
        // alert(id)
        // $("#additionalContinerId" + id).parent().remove();
        $(this).closest('tr').remove();
        // $("#additionalContinerId" + id).remove();
    });
    $(document).ready(function () {
        $(".datepicker-basic-time").flatpickr({
	enableTime: true,
	dateFormat: "d-m-Y H:i",
	// dateFormat: "Y-m-d H:i",
	});
    //
        $('.usertype').on('click', function () {
            var headId = (this.id);
            // var headId = '1';
            var headName = $(this).attr('text');
            var testingId = '<?= $testingId ?>';
            // alert(testingId);
            $('#headId').val(headId);
            $('#typeModal').modal('show');
            $.ajax({
                type: "POST",
                url: "ajax-query/masterSubmit.php",
                data: { action: 'worksheetform', headId: headId, testingId: testingId },
                dataType: "json",
                success: function (response) {
                     // console.log(response);//sample_weight = 70.393;
                    //drying_weight = 70.223;
                    let formulaColumn = response.formulaColumn;
                    let formcolumn = response.column;
                    let final_result = response.finalresult.name;
                    // alert(response)
                    // $.each(formulaColumn, function(index, value) {
                    //   console.log(final_result);
                    //   value = $(this).closest('tr').find('input[name='+value+'[]]').val();
                    // });
                    //var formulaInput2 = 'newTest';  
                    //window[formulaInput2] = "Testing";  alert(newTest);
                    //Function("return var " + formulaInput)() = 'Testing';    
                    //eval('var ' + formulaInput2 + ' = Testing;');
                    //alert(newTest);
                    //alert(eval(response.formula));
                    //alert(response.formula);
                    // alert(result);
                    $('#worksheetform').html(response.html);
                    $('#headName').text(headName);
                    let formulaInput = response.formula;//alert(formulaInput);
                    $.each(formcolumn, function (index, inputKey) {
                        //window[inputKey] = 10;
                        var fieldValue = inputKey.name;
                        var field_value = inputKey.field_value;

                        // console.log(fieldValue)
                        window[field_value] = '';
                        $(":input").on("keyup", function (e) {
                            window[field_value] = $(this).closest('tr').find('input[name="' +fieldValue+'"]').val();
                            let result = Function("return " + formulaInput)();
                            // console.log(result);
                            // $(this).closest('tr').find("input[name='calculation[]']").val(formulaInput);
                            $(this).closest('tr').find("input[name='"+final_result+"']").val(result.toFixed(3));
                        });
                    });
                    //                     $(":input").on("keyup", function(e) {
                    //                                     // alert( $(this).parent().siblings('td:first').text() ); 
                    //                                     // alert($(this).closest('tr').find('td:eq(0) input').val());   // admin
                    //                                      var cal = <-?= $cal; ?>;
                    // // alert(cal)
                    //                                     alert($(this).closest('tr').find('input[name="[]"]').val());   // admin
                    // });
                }
            });
        });
        //
        //
        //
        // $('input').on('keyup', function () {
        //     var $item = $(this).closest("tr")   // Finds the closest row <tr> 
        //                .find(".nr")     // Gets a descendent with class="nr"
        //                .text();  
        //             alert($item);
        //             });
        //
    });
//
// <-?php $tbl_form_column = $app->tbl_form_column(1); ?>
        // var x = 0;
        // $("body").on('click', '.addMoreData', function(e) {
        //     e.preventDefault();
        //     x++;
        //     $('#additionalContiner').append('<thead id="additionalContinerId'+x+'"><tr class="" style="background-color:#E0F2F1"><td rowspan="4"><input type="text" class="form-control" name="empty_dish_weight" value="empty_dish_weight"></td><td rowspan="4"><input type="text" class="form-control" name="sample_weight" value="sample_weight"></td><td><input type="text" class="form-control" name="od_time" value="od_time"></td><td><input type="text" class="form-control" name="od_start" value="od_start"></td><td><input type="text" class="form-control" name="od_end" value="od_end"></td><td><input type="text" class="form-control" name="drying_weight" value="drying_weight"></td><td rowspan="4"><input type="text" class="form-control" name="calculation" value="calculation"></td><td rowspan="4"><input type="text" class="form-control" name="result" value="result"></td><td><button type="button" class="btn btn-warning additionalContinerRemove" value="' + x + '" _style="margin-top: 1.8rem;">-</button></td></tr></thead>');
        // });
        // $("body").on('click', '.additionalContinerRemove', function(e) {
        //     e.preventDefault();
        //     var id = $(this).val();
        //     $("#additionalContinerId" + id).remove();
        // });
    // $(document).on('click', '#usertype', function() {
    //     alert()
    // 	// $('#typeModal').modal('show');
    // });
    // var sample_weight = 70.393;
    // var drying_weight = 70.223;
    // alert()
    // var cal = <-?= $cal; ?>;
    // alert(cal);
    // console.log(cal);
    $('#table_1').DataTable({

});
</script>
</body>
</html>