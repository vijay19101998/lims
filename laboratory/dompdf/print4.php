<?php
require_once('autoload.inc.php');
include_once("../includes/includes.php");
include "../vendor/phpqrcode/qrlib.php";
use Dompdf\Dompdf;
$id = $_REQUEST['id'];
// $sql = "SELECT * FROM `tbl_testing` WHERE `id` = $id";
// $result = $db->getCustomRows($sql);
$dompdf = new Dompdf();
// Load HTML content
$sql = "SELECT * FROM `tbl_testing` WHERE `id` = $id";
$result = $db->getCustomRows($sql, 'single');
$rep = $app->fetchallDetails('tbl_testing_logs', 'testing_id', $result['id']);
$sample_method_id = $app->fetchDetailsSelect('tbl_sampling_method', 'id', $result['sample_method_id']);
$test_grp_id = $app->fetchDetailsSelect('tbl_test_group', 'id', $result['test_grp_id']);
$standard_test_id = $app->fetchDetailsSelect('tbl_standard_test_type', 'id', $result['standard_test_id']);
$material_group = $app->fetchDetailsSelect('tbl_material', 'id', $result['material_id']);
$material_cat_id = $app->fetchDetailsSelect('tbl_material_category', 'id', $result['material_grp_id']);
$sample_id = $app->fetchDetailsSelect('tbl_material_item', 'id', $result['sample_id']);
$approved_id = $app->getDetails('tbl_testing_logs', 'approved_by', 'testing_id', $id);
$approved_by = $app->getDetails('users', 'emp_name', 'id', $approved_id);
$user_type_id = $app->getDetails('users', 'user_type_id', 'id', $approved_id);
$approved_role = $app->getDetails('tbl_user_type', 'name', 'id', $user_type_id);
$is_notes = $result['is_notes'];
//
if ($result['temp'] == "NA") {
  $temp = $result['temp'];
} else {
  $temp = $result['temp'] . '°C';
}
if ($result['humidity'] == "NA") {
  $humidity = $result['humidity'];
} else {
  $humidity = $result['humidity'] . '°C';
}
$isnotesreport = '';
  // if($is_notes == '1'){ 
$isnotesreport = '<p style="font-family: times; font-size: 10px; padding-top: 10px;line-height: 1.2;">Notes:
1) Test Results refer only to the sample(s) and parameter(s) tested.
2) The remnant sample(s) will be disposed after 15 days for chemical testing & 7 days for microbiological testing from the date of issue of this 
report.
3) Total liability of this laboratory is limited to the invoice amount only.
4) This report is not to be reproduced wholly or in part, is not to be used as an evidence in the court of law & is not valid for any legal purposes.
5) This report should not be used in any advertising media without our prior permission / consent in writing.</p>';
  // }
$sampleName = strlen($sample_id);
$issuedTo = strlen($result['issued_to']);

$otherlabel = $result["otherlabel"];
//__||__\\
  //__\\
// if ($otherlabel != "") {
  // $bodyTop = (($sampleName+$issuedTo)/(5)+10);
// }else{
  $bodyTop = (($sampleName+$issuedTo));

  // $bodyTop = (($sampleName+$issuedTo)/5);
// }
    if ($bodyTop <= 25) {
      $bt = 10;
    }elseif($bodyTop <= 50){
      $bt = 21;
    }elseif($bodyTop <= 75){//
      $bt = 23;
    }elseif($bodyTop <= 100){//
      $bt = 24;
    }elseif($bodyTop <= 125){//
      $bt = 25;
    }elseif($bodyTop <= 150){//
      $bt = 28;
    }elseif($bodyTop <= 175){//
      $bt = 30;
    }elseif($bodyTop <= 200){//31
      $bt = 28;
    }elseif($bodyTop <= 225){//
      $bt = 32;
    }elseif($bodyTop <= 250){//
      $bt = 35;
    }elseif($bodyTop <= 275){
      $bt = 36;
    }elseif($bodyTop <= 300){//
      $bt = 33;
    }elseif($bodyTop <= 325){
      $bt = 35;
    }elseif($bodyTop <= 350){//
      $bt = 35;
    }elseif($bodyTop <= 375){
      $bt = 35;
    }elseif($bodyTop <= 400){
      $bt = 36;
    }elseif($bodyTop <= 425){
      $bt = 36;
    }elseif($bodyTop <= 475){
      $bt = 38;
    }elseif($bodyTop <= 500){
      $bt = 40;
    }elseif($bodyTop <= 525){
      $bt = 41;
    }elseif($bodyTop <= 550){
      $bt = 40;
    }elseif($bodyTop <= 575){
      $bt = 42;
    }
// print_r($bt);
// exit;


// echo $bodyTop; 
// echo $sampleName+$issuedTo; 
// exit;
$html = '
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    .ff {
       font-family: DejaVu Sans, sans-serif;
      font-size:10px !important;
      }
            @page {
                margin:310px 45px;
                // margin:270px 45px;
            }
            #header {
              position: -webkit-fixed;
              position: fixed;
              top: -35px;
              left: 0px;
              padding: 5px;
              right: -3px;
              height: auto;
              overflow: auto;
              font-size: 10px !important;
              // background-color:red;
          }
          .myFormat tr td{
            font-size:7px;
          }
          
body {
  //  margin-top: 210px;
  //  margin-top:20%;
   margin-top:'.$bt.'%;
   
  //  margin-top: auto;
  //  background-color:green;
}
             .table {
              wmargin-top:-70px;
                border-collapse: collapse;
                width: 100%;
                
            }
            .table th, .table td {
                border: 1px solid black;
                padding: 5px;//1
                text-align: left;
                //font-size: 11px !important;
            }
            .specification{
              font-size: 9px !important;
            }
            .table th {
                background-color: #f0f0f0;
            }
            .phone-number {
              margin-right: 10px; /* Adjust this value as needed */
            }
            .email-address {
              margin-left: 0px; /* Adjust this value as needed */
            }
            footer {
              position: fixed; 
              bottom: -150px; 
              left: 0px; 
              right: 0px;
              height: 60px;
              background-color: white;
              color: black;
          }
          table.myFormat tr td { font-size: 12px; }
          table.table tr td { font-size: 12px; }
          .bold{ font-weight: bold; };
        </style>
  </head>
  <body>
  <header id="header">
<div class="row">
<div class="col-md-6">
  <table style="width: 100%" class="myFormat">
  <tr>
    <td class="bold" style="white-space: nowrap;">Name of the Sample</td>
    <td>' . $sample_id . '</td>
  </tr>
  <tr>
    <td class="bold">Sample Code</td>
    <td>' . $result['sample_code'] . '</td>
    <td class="bold">Report No</td>
    <td>' . $result['report_number'] . '</td>
  </tr>
  <tr>
    <td class="bold">Issued To</td>
    <td>' . $result['issued_to'] . '</td>
    <td class="bold">Report Date</td>
    <td>' . date("d-m-Y", strtotime($rep[0]['approve_date'])) . '</td>
  </tr>
  <tr>
    <td class="bold">Test Starting Date</td>
    <td>' . date("d-m-Y", strtotime($result["test_start_date"])) . '</td>
    <td class="bold" style="white-space: nowrap;">Sample Received On</td>
    <td>' . date("d-m-Y", strtotime($result['sampling_receive_date'])) . '</td>
  </tr>
  <tr>
    <td class="bold">Sample Quantity</td>
    <td>' . $result['sample_quantity'] . '</td>
    <td class="bold" style="white-space: nowrap;">Test Ending Date</td>
    <td>' . date("d-m-Y", strtotime($result['test_end_date'])) . '</td>
  </tr>
  <tr>
    <td class="bold">Discipline</td>
    <td>' . $test_grp_id . '</td>
    <td class="bold">Sampling Method</td>
    <td>' . $sample_method_id . '</td>
  </tr>
  <tr>
    <td class="bold">Sample Condition</td>
    <td>' . $result['sampling_condition'] . '</td>
    <td class="bold">Group</td>
    <td style="white-space: nowrap;">' . $material_group . '</td>
  </tr>
</table>
</div>
</div>
  <div style="font-family: times; font-size: 12px;">
    <div>
    <p>Environmental Condition:<span style="font-weight: bold;">i)Room Temperature:</span>
      <span style="margin-left: 10px;">' . $temp . '</span>
    
    
      <span style="font-weight: bold;">ii) Relative Humidity:</span>
      <span style="margin-left: 10px;">' . $humidity . '</span></p>
    </div>
  </div>
</header>';

$remarks11 = $app->getDetails('tbl_testing_logs', 'description', 'testing_id', $id);
if ($approved_id == 2) {
  $appsign = "2.jpeg";
} else {
  $appsign = "1.jpeg";
}
$path1 = '../dompdf/qrcode/' . $appsign;
$type1 = pathinfo($path1, PATHINFO_EXTENSION);
$data1 = file_get_contents($path1);
$sample1 = 'data:image/' . $type1 . ';base64,' . base64_encode($data1);
$html .= '<footer>
<div style="text-align: right; padding: 10px;" ><b>' . $approved_by . '</b></div>
        <div style="text-align: right; padding-right: 10px;" >(' . $approved_role . ')</div>
' . $isnotesreport . '
</footer>
<main>
';
$data = $sample_id . '&' . $result['report_number'];
$filename = "sampleqr.png";
$saveDirectory = "qrcode/";
if (!is_dir($saveDirectory)) {
  mkdir($saveDirectory, 0777, true);
}
$savePath = $saveDirectory . $filename;
QRcode::png($data, $savePath, QR_ECLEVEL_H, 10);
$path = '../dompdf/qrcode/sampleqr.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$sampleqr = 'data:image/' . $type . ';base64,' . base64_encode($data);
///
//
$otherLabelArr = $otherValueArr = array();
$otherlabel = $result["otherlabel"];
$othervalue = $result["othervalue"];
if ($otherlabel != "") {
  $otherLabelArr = json_decode($otherlabel);
}
if ($othervalue != "") {
  $otherValueArr = json_decode($othervalue);
}
$html .= '';
if (!empty($otherLabelArr[0])) {
  $html .= ' <div style="font-family: times; font-size: 12px;">
            <span style="font-weight: bold;font-size: 10px;">OTHER INFORMATION</span>
            <br>
            <span style="font-weight: bold;">Details/Information given by the customer</span>
              <div style="margin-bottom: 5px;">';
  $otherSno = 0;
  foreach ($otherLabelArr as $lKey => $displayLabel) {
    if ($displayLabel != '') {
      $displayValue = $otherValueArr[$lKey];
      $otherSno++;
      $html .= '<span style="font-weight: bold;">' . $otherSno . ') ' . $displayLabel . ':</span>
                      <span style="margin-left: 10px;">' . $displayValue . '</span><br>';
    }
  }
  $html .= '</div>
        
          </div>';
}
$sqlspec = "SELECT * FROM `tbl_test_material_format` WHERE `testing_id` = $id  AND is_active ='1' ORDER BY `tbl_test_material_format`.`order_by` ASC";
$dataspec = $db->getCustomRows($sqlspec);
// $specifications = array_column($dataspec, 'specification');
// $capitalizedArray = array();
$spec = '';
foreach ($dataspec as $dataspecvalue) {
  $speci = ucfirst($dataspecvalue['specification']);
  if ($speci == 'Text') {
    $specificationarr[] = $dataspecvalue['text'];
  } else {
    $specification[] = $dataspecvalue['specification'] . '-' . $dataspecvalue['text'];
  }
}
$allArraysAreHyphens = true;
foreach ($specification as $array) {
  if (count(array_unique($specification)) !== 1 || $array[0] !== "-") {
    $allArraysAreHyphens = false;
    break;
  }
}
if ($allArraysAreHyphens) {
  $hide = 'display:none;';
} else {
  $hide = '';
}
$html .= '
        <table class="table">
            <thead>
                <tr style="font-size: 11px !important">
                    <th style="width: 5%;">S.No</th>
                    <th style="width: 15%;">Test Parameters</th>
                    <th style="width: 15%;">Testing Protocol </th>
                    <th style="width: 15%;' . $hide . '">Specification</th>
                    <th style="width: 15%;">Unit</th>
                    <th style="width: 15%;">Result</th>
                </tr>
            </thead>
            <tbody>';
$sql = "SELECT * FROM `tbl_test_material_format` WHERE `testing_id` = $id  AND is_active ='1' ORDER BY `tbl_test_material_format`.`order_by` ASC";
$data = $db->getCustomRows($sql);
// print_r($data);
// exit;
$i = 1;
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
}
// echo '<pre>';
// print_r($grpnamedata);
foreach ($grpname as $key => $grpnamedata) {
  if ($key == '' || $key == '-') {
    $display = 'display:none;';
  } else {
    $display = '';
  }
  //
  $html .=  '<tr style="background:#C8E6C9,text-transform: uppercase;">
            <td colspan="6" style="text-transform: uppercase;' . $display . '"><b>' . $key . '</b></td>
            </tr>';
  foreach ($grpnamedata as $grpkey => $row) {
    $speci = ucfirst($row['specification']);
    if ($speci == 'Text') {
      $specification = $row['text'];
    } else {
      $specification = $row['specification'] . '-' . $row['text'];
    }

    if (preg_match_all('/[A-Za-z0-9.<>≥]/u', $row['value'], $matches)) {
      // print_r($matches);
      if ($matches[0][0] == '>') {
        $val = '&#62;';
        $result1 = str_replace('>', '&#62;', $row['value']);
      } elseif ($matches[0][0] == '<') {
        $val = '&#60;';
        $result1 = str_replace('<', '&#60;', $row['value']);
      } elseif ($matches[0][6] == '≥') {
        $val = '&#60;';
        $result1 = str_replace('≥', '&ge;', $row['value']);
      } elseif ($matches[0][6] == '≤') {
        $val = '&#60;';
        $result1 = str_replace('≤', '&le;', $row['value']);
      } else {
        $result1 = $row['value']; //≥
      }
    } else {
      $result1 = $row['value'];
    }
    $html .= '
                <tr>
                    <td class="ff">' . $i++ . '</td>
                    <td class="ff">' . $row['parameters'] . '</td>
                    <td class="ff">' . $row['protocols'] . '</td>
                    <td style="' . $hide . '" class="ff specification" >' . $specification . '</td>
                    <td class="ff">' . $row['unit'] . '</td>
                    <td class="ff">' . $result1 . '</td>
                </tr>
                 ';
  }
}
//
$remarks = $app->getDetails('tbl_testing_logs', 'description', 'testing_id', $id);
$html .= '                   
                <!-- Add more rows as needed -->
            </tbody>
        </table>
      ';
$notes = json_decode($result['notes']);
if (!empty($notes[0])) {
  $html .= '<p style="font-family: times; font-size: 11px;">Note:<br>';
  $i = 1;
  foreach ($notes as $value) {
    // echo $value;
    $notes_Symbol = $app->getDetails('tbl_notes', 'name', 'id', $value);
    $notes_result = $app->getDetails('tbl_notes', 'description', 'id', $value);
    if (preg_match_all('/[A-Za-z0-9.<>≥]/u', $notes_result, $matches)) {
      if ($matches[0][0] == '<') {
        $resultnotes = str_replace('<', '&#60;', $notes_result);
      } else {
        $resultnotes = $notes_result;
      }
    }
    // print_r($notes_result);
    $html .=  $i++ . ') ' . $notes_Symbol . '  ' . $resultnotes . '</br>';
  }
  $html .= '</p>';
}
if (!empty($remarks)) {
  $html .= '<p style="font-family: times; font-size: 11px;">';
  if ($remarks <> '-') {
    $html .= 'Remarks:' . $remarks . ' </br>';
  }
  $html .= '<img src="' . $sampleqr . '" style="max-width: 20%;max-height: 35px;min-width: 20px;">
             </p>';
}
$html .= '<div style="text-align: center;font-size:11px;" >**End of the Report**</div>';
$html .= '
        </main>
  </body>
</html>';
// echo $html;
// exit;
// $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
// $html = '&#8364;';
// $html = iconv('UTF-8','Windows-1250',$html);
$dompdf->loadHtml($html);
// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');
// Enable DOMPDF's internal PDF rendering
$dompdf->set_option('isRemoteEnabled', true);
// Render the HTML to PDF
$dompdf->render();
// add pagination
$canvas = $dompdf->getCanvas(); // get the canvas
// add the page number and total number of pages
$canvas->page_script('
    $text = "page $PAGE_NUM of $PAGE_COUNT";
    // $text = "$PAGE_NUM / $PAGE_COUNT";
    $pdf->text(530, 180, $text, \'Helvetica\', 10, array(0,0,0));
');
// Output the PDF as a file (downloadable)
$dompdf->stream('sample.pdf', ['Attachment' => false]);
  // $pdf->load_html($html);
  // $pdf->render();
  
  // }
