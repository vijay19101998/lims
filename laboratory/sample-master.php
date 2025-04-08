<?php
include_once("includes/includes.php");
//Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
include_once(filePath . "/main-navbar.php");
$get_category = $app->get_group();
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'sample-master');
?>
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item">Masters</li>
    <li class="breadcrumb-item active" aria-current="page">Sample Master</li>
  </ol>
</nav>
<style>
/* td{
    width:100%;
    max-width:50%;
} */
td {
/* td:nth-child(1) { */
    max-width: 100px;
    /* overflow: scroll;*/
      overflow: hidden;
 text-overflow: ellipsis;
 /* white-space: nowrap;   */
 white-space: normal;

 word-break: break-all;
}

</style>
<!--<div class="row">-->
<!--<div class="col-xl-9 main-content ps-xl-4 pe-xl-5">-->

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">

        <div class="d-flex justify-content-between align-items-baseline">
          <h6 class="card-title mb-0">Sample Master List</h6>
          <?php if($hasPermission["create"]=='true') { ?>
          <button class="btn btn-xs btn-primary btn-icon-text" id="addmaster">
            <i class="mdi mdi-plus-box"></i> Create
          </button>
          <?php } ?>
        </div>

      </div>

      <div class="card-body">
        <div id="content">
        <div class="table-responsive-md">
          <table id="masterList" class="table">
            <thead>
              <tr>
                <th>Sample Name</th>
                <th>Category</th>
                <th>Comment</th>
                <th>Action</th>
              </tr>
            </thead>
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


  <div class="modal fade" id="masterModal">
    <div class="modal-dialog modal-lg">
      <form method="post" action="mastersamplesubmit" id="mastersubmitform" autocomplete="off">
        <div class="modal-content">

          <div cla  s="modal-header">
            <h5 class="modal-title h4" id="myLargeModalLabel">Add Sample Master</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
            </button>
          </div>
          <div class="modal-body">
          <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="mateial_category_id" id="mateial_category_id">
                <option>Select Category</option>
                <?php
                  foreach ($get_category as $row) {
                    echo '
                <option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                  }
                ?>
              </select>
            </div>
            <div class="form-group mt-2">
              <label>Sample Name</label>
              <input type="text" name="name" id="name" class="form-control" required />
            </div>

            <div class="form-group mt-2">
              <label>Comment</label>
              <textarea class="form-control" name="comment" id="comment" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" />
            <input type="hidden" name="form_action" id="form_action" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php include_once(filePath . "/footer.php"); ?>

	<?php include_once(filePath."/js.php"); ?>
  <script src="<?php echo BASE_URL; ?>includes/js/sample-master.js"></script>
  </body>

  </html>