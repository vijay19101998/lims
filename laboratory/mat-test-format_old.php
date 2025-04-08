<?php
include_once("includes/includes.php");
//Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath."/head.php");
include_once(filePath."/main-navbar.php");
$getdiscipline = $app->getdiscipline();
$get_group= $app->get_group();
$get_standard= $app->get_standard();
$get_specs= $app->get_specs();
// print_r($getdiscipline);
$snoid = 0;
?>
<html>


<body class="bg">
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Material Test Format</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Material Test Format</h6>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3" action="mattestsubmit" id="userForm" method="POST" enctype="multipart/form-data">
                    <div class="col-3">
                        <label class="form-label">Discipline</label>
                        <select class="form-control" id="testcategory" name="discipline">
                            <option value="">--Select--</option>
                            <?php
                                foreach ($getdiscipline as $row){
                                    echo'
                                    <option value="'. $row["id"].'">'. $row["name"].'</option>';
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Group</label>
                        <select class="form-control" name="group" id="group">
                            <option value="">--Select--</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Material Category</label>
                        <select class="form-control" name="matcat" id="matcat">
                            <option value="">--Select--</option>
                            <?php
                                foreach ($get_group as $row){
                                    echo'
                                    <option value="'. $row["id"].'">'. $row["name"].'</option>';
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Material Item</label>
                        <select class="form-control" name="matitem" id="matitem">
                            <option value="">--Select--</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="form-label">Standard Test Type</label>
                        <select class="form-control" name="standard" id="standard">
                            <option value="">--Select--</option>
                            <?php
                                foreach ($get_standard as $row){
                                    echo'
                                    <option value="'. $row["id"].'">'. $row["name"].'</option>';
                                }
                                ?>
                        </select>
                    </div>
                    <div class="row-12">
                        <table class="table table-success" id="st" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="color:black;">Test Parameters</th>
                                    <th style="color:black;">Testing Protocols</th>
                                    <th style="color:black;">Specifications</th>
                                    <th style="color:black;">Text/Value</th>
                                    <th style="color:black;">Unit</th>
                                    <th style="color:black;">Doc Upload</th>
                                    <th style="color:black;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="additionalContiner" class="add-multiform">
                            <?php    
                            echo'<tr id="additionalContinerId'.$snoid.'">
                                    <td><input class="col form-control" type="text" name="test['.$snoid.']"></td>
                                    <td><input class="col form-control" type="text" name="proto['.$snoid.']"></td>
                                    <td><select class="col-12 form-control" name="spec['.$snoid.']">
                                            <option value="">--Select--</option>';
                                            foreach ($get_specs as $row){
                                                echo'
                                                <option value="'. $row["id"].'">'. $row["speci_name"].'</option>';
                                            }
                                            
                                    echo'</select></td>
                                    <td><input class="col form-control" type="text" name="value['.$snoid.']"></td>
                                    <td><input class="col form-control" type="text" name="unit['.$snoid.']"></td>
                                    <td><input class="col-12 form-control" type="file" multiple id="file" name="file['.$snoid.']" ></td>
                                    <td><button class="btn addMoreData btn-success">ADD</button>
                                    </td>
                                </tr>';
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-3">
                        <input type="text" name="snoid" id="snoid" value="0" /> 
                        <input type="hidden" name="id" id="id" /> 
                        <input type="hidden" name="form_action" id="form_action" value="insert" />
                        <button type="button" class="btn btn-secondary">reset</button>
                        <button type="submit" class="btn btn-primary" id="action-btn">Submit</button>
                    </div>
                    
                </form>
            </div>
        </div>

    </main>
    <?php include_once(filePath."/js.php"); ?>
    <script src="<?php echo BASE_URL; ?>includes/js/mat-test-frmat.js"></script>
</body>

</html>