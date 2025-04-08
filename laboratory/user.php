<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
// $user_type_id = $app->getDetails("tbl_user_type","name","id",'1');
// echo $user_type_id;
$get_usertype = $app->getusertype();
$hasPermission = $app->hasPermission($_SESSION['roleId'], 'user');
// print_r($get_usertype);
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">User Configuration</li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">USERS LIST</h6>
                    <?php if($hasPermission["create"]=='true') { ?>
                    <button class="btn btn-xs btn-primary btn-icon-text" id="adduser">
                        <i class="mdi mdi-plus-box"></i> Create
                    </button>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <div id="content">
                    <div class="table-responsive-md">
                    <table id="userList" class="table">
                        <thead>
                            <tr>
                                <th data-searchable="true">Name</th>
                                <th data-searchable="true">User Type</th>
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
<!--</div>-->
<?php include_once(filePath."/footer.php"); ?>
<div class="modal fade" id="userModal">
    <div class="modal-dialog modal-lg">
        <form method="post" action="userSubmit" id="userForm" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Add user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>UserName</label>
                                    <input type="text" name="username" id="username" class="form-control" required="required"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PASSWORD</label>
                                    <input type="text" name="password" id="password" class="form-control" required="required"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" id="user_type" name="user_type" required="required">
                                        <option value="">--Select--</option>
                                        <?php                                        
                                  
                                            foreach ($get_usertype as $row){
                                                echo'
                                                    <option value="'. $row["id"].'">'. $row["name"].'</option>';                           
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMP_NO</label>
                                    <input type="text" name="emp_no" id="emp_no" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>COMPANY NAME</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMPLOYEE NAME</label>
                                    <input type="text" name="emp_name" id="emp_name" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMAIL</label>
                                    <input type="email" name="email" id="email" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>GENDER</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">--Select--</option>
                                        <option value="male">MALE </option>
                                        <option value="female">FEMALE</option>
                                        <option value="others">OTHERS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PHONE NUMBER</label>
                                    <input type="number" name="phone_no" id="phone_no" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>MOBILE NUMBER</label>
                                    <input type="number" name="mobile_no" id="mobile_no" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>COMMUNICATION ADDRESS</label>
                                    <input type="text" name="communication_address" id="communication_address"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PERMANENT ADDRESS</label>
                                    <input type="text" name="permanent_address" id="permanent_address"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="form_action" id="form_action" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once(filePath."/js.php"); ?>
<script src="<?php echo BASE_URL; ?>includes/js/user.js"></script>
</body>

</html>