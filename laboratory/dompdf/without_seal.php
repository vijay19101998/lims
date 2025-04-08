<?php
require_once('autoload.inc.php');
include_once("../includes/includes.php");
use Dompdf\Dompdf;
$id = $_REQUEST['id'];
// print_r($id);
// exit;
$sql = "SELECT * FROM `tbl_testing` WHERE `id` = $id";
        $result = $db->getCustomRows($sql);
  $dompdf = new Dompdf();
  // Load HTML content
  $html = '
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <html>
  <head>
    <style>
            @page {
                margin: 100px 25px;
            }
            header {
                position: fixed;
                top: -75px;
                left: 0px;
                right: 0px;
                height: -55px;
                width: 900px;
                margin-left: -25px;
                /** Extra personal styles **/
                background-color: white;
                color: white;
                text-align: center;
                line-height: 35px;
                border-bottom: 4px solid red;
            }
            footer {
                position: fixed; 
                bottom: -40px; 
                left: 0px; 
                right: 0px;
                height: 10px;
                /** Extra personal styles **/
                background-color: white;
                color: black;
                text-align: center;
                line-height: 35px;
                border-top: 4px solid red;
            }
             .table {
                border-collapse: collapse;
                width: 100%;
            }
            .table th, .table td {
                border: 1px solid #e0e0e0;
                padding: 8px;
                text-align: left;
                font-size: 14px;
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
        </style>
  </head>
  <body>
    <!-- Define header and footer blocks before your content -->
    <footer>
            <p style="font-family: times; font-size: 15px; padding-top: -25px; background-color: yellow;">
              <b style="color: red;">Address:</b>
              A-2 & A-3 , SIDCO Industrial Estate, Andipalyam, Tiruchengode - 637 214, Namakkal Dt., Tamilnadu.
            </p>
        </footer>
        
       <header>
        <img src="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,f_auto,q_auto:eco,dpr_1/nh85c2jyg7wtizaumb6a" style="position: absolute; top: -10px; left: 20px; height: 60px; width: 65px;">
        <div style="display: inline-block; margin-left: 120px;">
            <p style="margin: 0; padding: 0; margin-left: -250px; text-align: left; color: red; line-height: 1.5;"><b>FOOD SAFETY AND ANALYTICAL QUALITY CONTROL LABORATORY</b></p>
           <p style="margin: 0; padding: 0; margin-left: -250px; text-align: left; color: black; line-height: 1.5;">
            <b>CHRISTY FRIEDGRAM INDUSTRY <br>
              <i class="fas fa-phone"></i>
              <span class="phone-number">+91 4288 288900-99</span>
              <i class="far fa-envelope-open"></i>
              <span class="email-address">lab@christyfoods.in</span>
            </b>
          </p>
        </div>
    </header>
        <br>
        <h2 style="text-align: center;"><em>Test Certificate<em></h2>';
        $sql = "SELECT * FROM `tbl_testing` WHERE `id` = $id";
        $result = $db->getCustomRows($sql,'single');
        $sample_method_id = $app->fetchDetailsSelect('tbl_sampling_method','id',$result['sample_method_id']);
        $test_grp_id = $app->fetchDetailsSelect('tbl_test_group','id',$result['test_grp_id']);
        $standard_test_id = $app->fetchDetailsSelect('tbl_standard_test_type','id',$result['standard_test_id']);
        $material_group = $app->fetchDetailsSelect('tbl_material','id',$result['material_id']);
        $material_cat_id = $app->fetchDetailsSelect('tbl_material_category','id',$result['material_grp_id']);
        $sample_id = $app->fetchDetailsSelect('tbl_material_item','id',$result['sample_id']);
        $otherLabelArr = $otherValueArr = array();
        $otherlabel = $result["otherlabel"];
        $othervalue = $result["othervalue"];
        if($otherlabel!=""){
        $otherLabelArr=json_decode($otherlabel);
        }
        if($othervalue !=""){
        $otherValueArr =json_decode($othervalue );
        }
        $html .= '<p style="font-family: times; font-size: 15px; padding-top: 5px; margin-bottom: -13px;">Name of the Sample:<b>'.$sample_id.'</b></p>

       
        <table style="width: 100%;">
          <tr>
            <td style="width: 50%;">
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Sample code:<b style="margin-left: 55px;">'.$result['sample_code'].'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Unit & Shift:<b style="margin-left: 53px;"> Production & I</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Test Starting Date:<b style="margin-left: 23px;">'.date("d-m-Y", strtotime($result["test_start_date"])).'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Sample Quantity:<b style="margin-left: 30px;">'.$result['sample_quantity'].'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Issued To:<b style="margin-left: 73px;">'.$result['issued_to'].'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Discipline:<b style="margin-left: 69px;">'.$test_grp_id.'</b></p>
            </td>
            <td style="width: 50%;">
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Report No:<b style="margin-left: 100px;">'.$result['report_number'].'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Report Date:<b style="margin-left: 92px;">'.date("d-m-Y", strtotime($result['report_date'])).'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Sample Received On:<b style="margin-left: 40px;">'.date("d-m-Y", strtotime($result['sampling_receive_date'])).'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Test Ending Date:<b style="margin-left:61px;">'.date("d-m-Y", strtotime($result['test_end_date'])).'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Sampling Method:<b style="margin-left: 54px;"> '.$sample_method_id.'</b></p>
            <p style="font-family: times; font-size: 15px; margin-bottom: -13px;">Group:<b style="margin-left: 100px;"></br>'.$material_group.'</b></p>
            </td>
          </tr>
        </table>
        <div style="font-family: times; font-size: 15px;">
          <p style="padding-top: 10px;">Environmental Condition:</p>
          <div style="margin-bottom: 10px;">
            <span style="font-weight: bold;">i) Room Temperature:</span>
            <span style="margin-left: 10px;">'.$result['temp'].'°C</span>
          
          
            <span style="font-weight: bold;">ii) Relative Humidity:</span>
            <span style="margin-left: 10px;">'.$result['humidity'].'%</span>
          </div>
        </div>
        <div style="font-family: times; font-size: 15px;">
        <span style="font-weight: bold;">OTHER INFORMATION</span>
        <br>
        <span style="font-weight: bold;">Details/Information given by the customer</span>
          <div style="margin-bottom: 10px;">';
          $otherSno = 0;
          foreach($otherLabelArr as $lKey => $displayLabel){
            if($displayLabel!=''){
            $displayValue = $otherValueArr[$lKey]; 
            $otherSno++;
                      $html.='<span style="font-weight: bold;">'.$otherSno.') '.$displayLabel.':</span>
                      <span style="margin-left: 10px;">'.$displayValue.'</span><br>';
            }
          }
                  $html.='</div>
        
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">S.No</th>
                    <th style="width: 15%;">Test Parameters</th>
                    <th style="width: 15%;">Testing Protocol </th>
                    <th style="width: 15%;">Specification</th>
                    <th style="width: 15%;">Unit</th>
                    <th style="width: 15%;">Result</th>
                </tr>
            </thead>
            <tbody>';
            $sql = "SELECT * FROM `tbl_test_material_format` WHERE `testing_id` = $id";
            $result1 = $db->getCustomRows($sql);
            $i=1;
                foreach ($result1 as $row) {
                  if($row['specification']=='text'){
                    $specification = $row['text'];
                  }else{
                    $specification = $row['specification'].'-'.$row['text'];
                  }
                $html .= '
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$row['parameters'].'</td>
                    <td>'.$row['protocols'].'</td>
                    <td>'.$specification.'</td>
                    <td>'.$row['unit'].'</td>
                    <td>'.$row['value'].'</td>
                </tr>
                 ';
             }
             $remarks = $app->getDetails('tbl_testing_logs', 'description', 'testing_id', $id);
             $approved_id = $app->getDetails('tbl_testing_logs', 'approved_by', 'testing_id', $id);
             $approved_by = $app->getDetails('users', 'emp_name', 'id', $approved_id);
             $user_type_id = $app->getDetails('users', 'user_type_id', 'id', $approved_id);
             $approved_role = $app->getDetails('tbl_user_type', 'name', 'id', $user_type_id);
             
                 $html .='                   
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <p style="font-family: times; font-size: 15px; padding-top: 10px;">Note:<br>';
        $notes = json_decode($result['notes']);
        $i=1;
        foreach($notes as $value){
          // echo $value;
          $notes_result = $app->getDetails('tbl_notes', 'description', 'id', $value);
          // print_r($notes_result);
          $html .=  $i++.') '.$notes_result .'</br>';
         
        }
       $html .= '</p>
        
        <p style="font-family: times; font-size: 15px; padding-top: 10px;">Remark:<b>'.$remarks.'
        </b></p>
        <div style="text-align: right; padding: 15px;" ><b>'.$approved_by.'</b></div>
        <div style="text-align: right; padding-right: 10px;" >('.$approved_role.')</div>
        <div style="text-align: center; padding: 30px;" ><b>**End of the Report**</b></div>
        <br>
        <p style="font-family: times; font-size: 15px; padding-top: 10px;">Note:<br>
        1) Test Results refer only to the sample(s) and parameter(s) tested.<br>
        2) The remnant sample(s) will be disposed after 15 days for chemical testing & 7 days for microbiological testing from the date of issue of this 
        report.<br>
        3) Total liability of this laboratory is limited to the invoice amount only.<br>
        4) This report is not to be reproduced wholly or in part, is not to be used as an evidence in the court of law & is not valid for any legal purposes.<br>
        5) This report should not be used in any advertising media without our prior permission / consent in writing.</b></p>
        
  
  </body>
</html>
  ';
  $dompdf->loadHtml($html);
  // Set paper size and orientation
  $dompdf->setPaper('A4', 'portrait');
  // Enable DOMPDF's internal PDF rendering
  $dompdf->set_option('isRemoteEnabled', true);
  // Render the HTML to PDF
  $dompdf->render();
  // Output the PDF as a file (downloadable)
  $dompdf->stream('sample.pdf', ['Attachment' => false]);
// }
?>
