<?php
//============================================================+
// File name   : example_014.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 014 for TCPDF class
//               Javascript Form and user rights (only works on Adobe Acrobat)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+
/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Javascript Form and user rights (only works on Adobe Acrobat)
 * @author Nicola Asuni
 * @since 2008-03-04
 */
include_once('../includes/includes.php');
$id = $_REQUEST['id'];
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
require_once('tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// // set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO1, PDF_HEADER_LOGO_WIDTH1);
// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// IMPORTANT: disable font subsetting to allow users editing the document
$pdf->setFontSubsetting(false);
// set font
$pdf->SetFont('times', '', 11, '', false);
// add a page
$pdf->AddPage();
$sql = "SELECT `id`, `product_id`, `sample_code`, `sampling_date`, `sampling_receive_date`, `sample_quantity`, `test_category_id`, `test_start_date`, `test_end_date`, `env_condition`, `sampling_condition`, `report_date`, `report_number`, `test_grp_id`, `standard_test_id`, `material_grp_id`, `sample_id`, `sample_method_id`, `assign_from`, `chemical_test_res`, `micro_test_res`, `is_active`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at` FROM `tbl_testing` WHERE `id`='" . $id . "'";
$data = $db->getCustomRows($sql);
foreach ($data as $key => $pdfdata) {
    $product_id = $pdfdata['product_id'];
    $sample_code = $pdfdata['sample_code'];
    $sampling_date = $pdfdata['sampling_date'];
    $sampling_receive_date = $pdfdata['sampling_receive_date'];
    $sample_quantity = $pdfdata['sample_quantity'];
    $test_category_id = $pdfdata['test_category_id'];
    $test_start_date = $pdfdata['test_start_date'];
    $test_end_date = $pdfdata['test_end_date'];
    $env_condition = $pdfdata['env_condition'];
    $sampling_condition = $pdfdata['sampling_condition'];
    $report_number = $pdfdata['report_number'];
    $standard_test_id = $pdfdata['standard_test_id'];
    $material_grp_id = $pdfdata['material_grp_id'];
    $sample_id = $pdfdata['sample_id'];
    $sample_method_id = $pdfdata['sample_method_id'];
    $assign_from = $pdfdata['assign_from'];
    $chemical_test_res = $pdfdata['chemical_test_res'];
    $micro_test_res = $pdfdata['micro_test_res'];
    // $unit = $pdfdata['unit'];
    // $shift = $pdfdata['shift'];
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Name of the Sample:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, 'THE SUBMITTED SAMPLE CONFORMS TO THE SPECIFICATION AS PER CUSTOMER REQUIREMENTS FOR THE PARAMETERS TESTED ABOVE.', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(10);
    $left_column = $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Sample code:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $sample_code, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Sample Quantity:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $sample_quantity, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Unit:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, '$unit', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Shift:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, '$shift', 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(45, 5, 'Environmental Condition:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $env_condition, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(45, 5, 'Sampling Condition:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $sampling_condition, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $right_column = $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Sample Received on:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $sampling_receive_date, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Report No:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $report_number, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Test Starting Date:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $test_start_date, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $pdf->SetFont('times', '', 11);
    $pdf->Cell(35, 5, 'Test Starting Date:');
    $pdf->SetFont('times', 'B', 11);
    $pdf->MultiCell(0, 0, $test_end_date, 0, 'L', 0, 0, '', '', true);
    $pdf->Ln(6);
    $y = $pdf->getY();
    $pdf->writeHTMLCell(80, '', '', $y, $left_column, 0, 0, 0, true, 'R', true);
    $pdf->writeHTMLCell(100, '', '', '', $right_column, 0, 0, 0, true, 'l', true);
    $pdf->lastPage();
}
$pdf->Ln(10);
$sql = "SELECT `testing_id`, `parameters`, `protocols`, `specification`, `unit` FROM `tbl_test_material_format` WHERE `testing_id`='" . $id . "'";
$data = $db->getCustomRows($sql);
if ($data) {
    // Start building the HTML table
    $html = '<table border="1" cellpadding="2" cellspacing="1" align="center">';
    $html .= '<tr>';
    $html .= '<th>Test Parameters</th>';
    $html .= '<th>Testing Protocol</th>';
    $html .= '<th>Specification</th>';
    $html .= '<th>Unit</th>';
    $html .= '</tr>';
    // Fetch the data and populate the table rows dynamically
    foreach ($data as $key => $pdftable) {
        $parameters = $pdftable['parameters'];
        $protocols = $pdftable['protocols'];
        $specification = $pdftable['specification'];
        $unit = $pdftable['unit'];
        $html .= '<tr nobr="true">';
        $html .= '<td>' . $parameters . '</td>';
        $html .= '<td>' . $protocols . '</td>';
        $html .= '<td>' . $specification . '</td>';
        $html .= '<td>' . $unit . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Output the HTML table to PDF
    $pdf->writeHTML($html, true, false, false, false, '');
} else {
    echo "No data found.";
}
$pdf->Ln(10);
$pdf->SetFont('times', '', 11);
$pdf->Cell(20, 5, 'Remarks:');
$pdf->SetFont('times', 'B', 11);
$pdf->MultiCell(0, 0, 'THE ABOVE SAMPLE CONFORMS TO THE GIVEN SPECIFICATION..', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(12);
$pdf->SetFont('times', '', 11);
$pdf->Cell(20, 5, 'Notes:');
$pdf->SetFont('times', 'B', 11);
$pdf->MultiCell(0, 0, '$ BDL:Below Detection Limit, LOD:Limit of Detection , : <10 cfu/g can be considered as absent in 0.1g.', 0, 'L', 0, 0, '', '', true);
$pdf->Ln(16);
$pdf->SetFont('times', 'B', 11);
$pdf->MultiCell(0, 0, 'S.AMUDHA:', 0, 'R', 0, 0, '', '', true);
$pdf->Ln(6);
$pdf->SetFont('times', '', 11);
$pdf->MultiCell(0, 0, 'CHIEF ANALYST
', 0, 'R', 0, 0, '', '', true);
$pdf->Ln(12);
$pdf->SetFont('times', 'B', 11);
$pdf->MultiCell(0, 0, '**End of the Report**', 0, 'C', 0, 0, '', '', true);
$pdf->setFooterData(PDF_FOOTER_TITLE);
// -----------------------------------------------------------------------------
// Form validation functions
$js = <<<EOD
function CheckField(name,message) {
    var f = getField(name);
    if(f.value == '') {
        app.alert(message);
        f.setFocus();
        return false;
    }
    return true;
}
function Print() {
    if(!CheckField('firstname','First name is mandatory')) {return;}
    if(!CheckField('lastname','Last name is mandatory')) {return;}
    if(!CheckField('gender','Gender is mandatory')) {return;}
    if(!CheckField('address','Address is mandatory')) {return;}
    print();
}
EOD;
// Add Javascript code
$pdf->IncludeJS($js);
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('example_014.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+