<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
$get_heading = $app->getheading();
$tbl_sub_heading = $app->tbl_sub_heading();
// print_r($tbl_sub_heading);
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
    .result{
        padding-left: 100px;
        color: #43A49B;
    }
</style>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active" aria-current="page">Testing Form</li>
    </ol>
</nav>


    <?php
$tbl_heading = $app->tbl_heading();
$outHtml = '';
$outHtml .= '<table class="table table-bordered" style="width:100%">
<tr>';
 foreach($tbl_heading['mainhead'] as $key => $value){
    $outHtml .= '<th '.$value['span'].'>'.$value['head_name'].'</th>';
 }
//
 $outHtml .= '</tr>
<tr>';
foreach($tbl_heading['subhead'] as $key => $value){
    $outHtml .= '<th '.$value['span'].'>'.$value['head_name'].'</th>';
 }
//
 $outHtml .= '</tr> 
';

$outHtml .='<tr class="" style="background-color:#E0F2F1">';
$tbl_form_column = $app->tbl_form_column();
foreach($tbl_form_column as $key => $value){
    // print_r($value);
$input = '<input type="text" class="form-control" name="'.$value['name'].'" value="'.$value['name'].'">';
    $outHtml .= '
    <td '.$value['span'].'>'.$input.'</td>';
}

$outHtml .= '</tr>
</table> ';
//
echo $outHtml;   
?>
  <!---->
<?php include_once(filePath . "/footer.php"); ?>

<?php include_once(filePath . "/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/test-group.js"></script>
<script>
    $(".datepicker-basic").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y",
    });
//
    $(document).on('click', '#usertype', function() {
		$('#typeModal').modal('show');
    });
</script>
</body>

</html>