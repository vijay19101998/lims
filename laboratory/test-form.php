<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath."/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
// $get_testcat = $app->gettestcat();
// $get_discipline = $app->getdiscipline();
// $mat_group = $app->matgroup();
// $get_status = $app->getstatus();
// $get_spec = $app->getspec();
// print_r($get_usertype);
// print_r($newArray);
// exit;
$testing_id = $_REQUEST['testingId'];
?>
<style>
    td,th,tr {
        text-align: center;
    }
    h5{
        /* color: red; */
    }
    table,th,td,tr,tbody{
        border: 1px solid black;
    }
</style>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Work Sheet</li>
        <li class="breadcrumb-item active" aria-current="page">Work Sheet Completed</li>
    </ol>
</nav>
<div class="card">
    
    <div class="card-body">
    <button class="btn btn-outline-primary btn-xs float-end mb-1" target_="blank" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</button>

        <div class="card-header">
            <!-- <div class="d-flex justify-content-between align-items-baseline"> -->
                <h4 class="text-center">WORK CARD FINISHED PRODUCTS</h4>
                <!-- <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a> -->

            <!-- </div> -->
<!-- 
        <div class="container-fluid w-100">
                  <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>
                </div> -->
        </div>
            <div class="table-responsive-xl">
                <div>
                <table class="table table-bordered" style="width:100%;border-collapse:collapse" border=2>
                    <tr>
                        <th>Sample Code</th>
                        <th>Sample Name</th>
                        <th>Sample Received Date</th>
                        <th>Test Start Date</th>
                        <th>Test End Date</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>15554</td>
                            <td>Blend of critical <br> processed material</td>
                            <td>26/4/2023</td>
                            <td>26/4/2023</td>
                            <td>26/4/2023</td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <div><h5>1. Description</h5></div>
                </div>




<?php

 $workSheetHead = $app->workSheetHead($testing_id);
//  print_r($workSheetHead);
//  exit;
$i=2;
 foreach($workSheetHead as $mainvalue){
// echo $mainvalue;
$outHtml = '';
$outHtml .= ' <div class="d-flex justify-content-between mt-4">
                <div><h5>'.$i++.') '.$app->fetchDetails('tbl_main_heading',$mainvalue)['name'].'</h5></div>
                <div><h5>'.$app->fetchDetails('tbl_main_heading',$mainvalue)['protocol'].'</h5></div>
            </div>';

  $outHtml .= '<div class="container table-responsive">';
  $outHtml .= $app->workSheet($mainvalue,$testing_id);
  $outHtml .= '</div>';
echo $outHtml;
 }

// echo $newArray = $app->workSheet(3,1);

// exit;
//
// foreach($newArray['mainId'] as $mainvalue){
//     $tbl_field_heading = $app->tbl_field_heading($mainvalue);
//     // echo '<pre>';
//     // print_r($newArray);
    
//     $outHtml = '';
//     $outHtml .= ' <div class="d-flex justify-content-between mt-2">
//                     <div><h5>02. DETERMINATION OF MOISTURE</h5></div>
//                     <div><h5>IS 16072 : 2012/IS 1011:2002</h5></div>
//                 </div>';
                    
//         $outHtml .= '<table class="table table-bordered" style="width:100%" border=2>
//         <tr>';
//         foreach ($tbl_field_heading['mainhead'] as $key => $value) {
//             $outHtml .= '<th ' . $value['span'] . '>' . $value['head_name'] . '</th>';
//         }
//         //
//         $outHtml .= '</tr>
//         <tr>';
//         foreach ($tbl_field_heading['subhead'] as $key => $value) {
//             $outHtml .= '<th ' . $value['span'] . '>' . $value['head_name'] . '</th>';
//         }
//         //
//         $outHtml .= '</tr> ';
    
        
//         if (is_array($newArray['newarray'])) {
//             foreach ($newArray['newarray'] as $datakey => $datavalue) {
//                 $outHtml .= '<tr class="" style="background-color:#E0F2F1">';
//                 foreach ($datavalue as $datakey1 => $datavalue1) {
//                     $outHtml .= '<td>' . $datavalue1 . '</td>';
//                 }
//                 $outHtml .= '</tr>';
//             }
//         }
        
//         $outHtml .= '</table> ';
    
//     echo $outHtml;
// }



?>










                <!-- <table class="table table-bordered mt-4" style="width:100%">
                        <tr>
                            <th rowspan="2">Empty Dish <br> Weight (g) (M)</th>
                            <th rowspan="2">Empty Dish Weight (g) <br> + Sample Weight (g)(M)</th>
                            <th colspan="3">Oven Drying</th>
                            <th rowspan="2">M1(M1 After<br> Drying Weight(g))</th>
                            <th>Calculation</th>
                            <th rowspan="2">Result<br> % by Mass</th>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>(M1-M2)*100/(M1-M)</th>
                        </tr> 
                        <tr>
                            <td rowspan="3">19.4547</td>
                            <td rowspan="3">20.4546</td>
                            <td>2Hrs/3Hrs</td>
                            <td>10.00</td>
                            <td>12.00</td>
                            <td>19.4547</td>
                            <td rowspan="3">19.4547</td>
                            <td rowspan="3">2.05%</td>
                        </tr>  
                        <tr>                   
                            <td>2Hrs/3Hrs</td>
                            <td>10.00</td>
                            <td>12.00</td>
                            <td>19.4547</td>
                        </tr>  
                        <tr>
                            <td>2Hrs/3Hrs</td>
                            <td>10.00</td>
                            <td>12.00</td>
                            <td>19.4547</td>     
                        </tr>  
                </table> -->




               
           
                </div>
            </div>
    </div>

<?php include_once(filePath . "/footer.php"); ?>
<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/master-test.js"></script>
<script>
    $(function () {
    $('button[type="submit"]').click(function () {
        var pageTitle = 'Page Title',
            stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
            win = window.open('', 'Print', 'width=1000,height=1000');
        win.document.write('<html><head><title>' + pageTitle + '</title>' +
            '<link rel="stylesheet" href="' + stylesheet + '">' +
            '</head><body class="card">' + $('.table-responsive-xl')[0].outerHTML + '</body></html>');
        win.document.close();
        win.print();
        win.close();
        return false;
    });
});
</script>
</body>

</html>