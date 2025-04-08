<?php
include_once("includes/includes.php");

$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
$get_category = $app->get_group();
// print_r($masterFormatList);
// exit;
$masterFormatList = $app->masterFormatList();
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'material-test-format');

?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item">Masters</li>
    <li class="breadcrumb-item active" aria-current="page">Sample Master</li>
  </ol>
</nav>
<style>
    table.dataTable th ,table.dataTable td{
  width: 200px;
  max-width: 200px;
  word-break: break-all;
  white-space: pre-line;
  font-size:13px;
}

</style>
<!--<div class="row">-->
<!--<div class="col-xl-9 main-content ps-xl-4 pe-xl-5">-->

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">

        <div class="d-flex justify-content-between align-items-baseline">
          <h6 class="card-title mb-0">Material Test Format List</h6>
          <?php if($hasPermission["create"]=='true') { ?>
          <a href="material-format.php"><button class="btn btn-xs btn-primary btn-icon-text">
            <i class="mdi mdi-plus-box"></i> 
          </button></a>
          <?php } ?>
        </div>

      </div>

      <div class="card-body">
        <div id="content">
        <div class="table-responsive-md">
          <table id="masterFormatList" class="table">
            <thead>
              <tr>
                <th>Test Category</th>
                <th>Disipline</th>
                <th>Group</th>
                <th>Material Category</th>
                <th>Sample Name</th>
                <th>Standard Test Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                                    <?php
 if ($masterFormatList) {
    foreach ($masterFormatList as $row) {
            $test_category_id = $app->fetchallDetails('tbl_test_group', 'id', $row['test_grp_id']);
            $material_category_id = $app->fetchallDetails('tbl_material_item', 'id', $row['sample_id']);
            $material_id = $app->fetchallDetails('tbl_material_category', 'id', $material_category_id[0]['mateial_category_id']);
      echo '<tr>
      <td>'.$app->fetchDetailsSelect('tbl_test_category', 'id',$test_category_id[0]['test_category_id']).'</td>
      <td>'.$app->fetchDetailsSelect('tbl_test_group', 'id', $row['test_grp_id']).'</td>
      <td>'.$app->fetchDetailsSelect('tbl_material', 'id', $material_id[0]['material_id']).'</td>
      <td>'.$app->fetchDetailsSelect('tbl_material_category', 'id',$material_category_id[0]['mateial_category_id']).'</td>
      <td>'.$app->fetchDetailsSelect('tbl_material_item', 'id', $row['sample_id']).'</td>
      <td>'.$app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row['standard_test_id']).'</td>
      <td><a href="material-format.php?id='.$row['id'].'"><button class="btn btn-xs btn-warning btn-icon-text update" id="'.$row["id"].'" ><span class="fa fa-edit"></span></button></a>
       <button class="btn btn-xs btn-danger btn-icon-text delete" id="'.$row["id"].'" ><span class="fa fa-trash"></span></button></td>
           </tr>';


  }

}


                                    ?>

                                </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--  -->
  <!--  -->

  <!--<-?php include_once(filePath."/sidemenu.php"); ?>-->


  <?php include_once(filePath . "/footer.php"); ?>

	<?php include_once(filePath."/js.php"); ?>
  <script src="<?php echo BASE_URL; ?>includes/js/materialformatList.js"></script>
<script>
$('#masterFormatList').DataTable({

});
</script>
  </body>

  </html>