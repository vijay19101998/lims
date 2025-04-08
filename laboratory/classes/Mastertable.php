<?php
/**
 * Report Class
 */
class Mastertable
{
    private $db;
    private $fm;
    private $app;
    private $loginUserId;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
        $this->app = new Application();
        $this->now = date("Y-m-d H:i:s");
        $this->loginUserId = Session::get("userId");
    }
    //
    public function listDemo(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_demo` ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_demo` ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "name" => $row["name"],
                    "created_at" => date("d-m-Y H:i", strtotime($row["created_at"])),
                    "action" => '<button class="btn btn-sm btn-primary btn-icon-text update" id="' . $row["id"] . '" >Edit</button>
                    <button class="btn btn-sm btn-danger btn-icon-text delete" id="' . $row["id"] . '" >Delete</button>'
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listType(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_user_type` Where `is_active`= 1";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_user_type` where `is_active`= 1 ";
        if (!empty($_POST["search"]["value"])) {
            echo $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'usertype');
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "name" => $row["name"],
                    "action" => $row["id"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listmatcat(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_material_category` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_material_category` WHERE `is_active` = 1 ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'material-category');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = ' <button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "material_id" => $this->app->fetchDetailsSelect('tbl_material', 'id', $row["material_id"]),
                    "name" => $row["name"],
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function pendingTestList(array $requestData)
    {
        // print_r($requestData);
        $rowsPerPage = $requestData['request']['length'];
        $currentPage = $requestData['request']['currentPage'];
        $serialNumber = ($currentPage - 1) * $rowsPerPage + 1; // Calculate starting serial number //
        // $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active` = 1 AND `test_responsibility`= ".$this->loginUserId." ";
        $getroleAccess = $this->app->getroleAccess($_SESSION['roleId'], 'test-lib');
        if ($getroleAccess == 1) {
            $whereSQL = '';
        } else {
            $whereSQL = 'AND `test_responsibility` = ' . $_SESSION['userId'] . ' ';
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active` = 1 AND `is_completed`= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        //
        // $sqlQuery = "SELECT users.*, tbl_testing.* FROM users INNER JOIN tbl_testing ON users.username LIKE CONCAT('%', tbl_testing.username, '%') WHERE tbl_testing.is_active = 1 AND bl_testing.is_completed = 0" . $whereSQL;
        
        // SELECT users.*, tbl_testing.* FROM users INNER JOIN tbl_testing ON users.username LIKE '%la%' WHERE tbl_testing.is_active = 1 AND tbl_testing.is_completed = 0 LIMIT 0, 25;


        
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active` = 1 AND `is_completed`= 0 " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'AND sample_code LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        //
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'assign-test');
        if ($result) {
            $offset = 0;

            // $serialNumber = 1; // Initialize a counter for serial number //

            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<!--<a href="editsample.php?id=' . $row["id"] . '&&edit=edit">
                    <button class="btn btn-xs btn-warning btn-icon-text update" id=' . $row["id"] . '><span class="fa fa-pen"></span></button></a>-->';
                }
                if ($hasPermission["edit"] == 'true') {
                    $update = '<a href="editassign.php?id=' . $row["id"] . '&&edit=edit">
                <button class="btn btn-xs btn-warning btn-icon-text update" id=' . $row["id"] . '><span class="fa fa-pen"></span></button></a>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $sqlQuerycount = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_test_material_format` WHERE `is_active` = 1 AND `testing_id`= '" . $row["id"] . "' ";
                $resultcount = $this->db->getCustomRows($sqlQuerycount, 'single');
                $test_responsibility = $this->app->test_assign_from($row["test_responsibility"]);
                // print_r($test_responsibility);
                $offset++;
                $array = array(
                    "sno" => $serialNumber,
                    "sample_code" => $row["sample_code"],
                    "test_responsibility" => $test_responsibility['emp_name'] . '-' . $test_responsibility['name'],
                    "count" => $resultcount['rowNum'],
                    "action" => $update . '<a href="entertest.php?id=' . $row["id"] . '&&edit=edit">
                    <button class="btn btn-xs btn-info btn-icon-text update" id=' . $row["id"] . '><span class="mdi mdi-book-open-variant"></span></button></a> ' . $delete
                );
                $returnData[] = $array;
                $serialNumber++; // Increment the serial number counter

            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listmat(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_material` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_material` WHERE `is_active` = 1 ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'material');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = ' <button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "name" => $row["name"],
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listtestcategory(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_test_category` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_test_category` WHERE `is_active` = 1  ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'test-category');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "name" => $row["name"],
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listmatitem(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_material_item` ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_material_item` ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'sample-master');
        // print_r($hasPermission);
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "mateial_category_id" => $row["mateial_category_id"],
                    "name" => $row["name"],
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // mateial_category_id
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    //
    public function userList(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `users` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `users` WHERE `is_active`= 1 ";
        if (!empty($_POST["search"]["value"])) {
            // SELECT * FROM `tbl_user_type` WHERE `name` LIKE 'admin'
            $matrix = array(
                array('tbl_user_type', 'name', 'user_type_id')
            );
            //
            foreach ($matrix as $key => $value) {
                $sqlQuerySearch = "SELECT `id` FROM $value[0] WHERE `is_active`= 1 AND `$value[1]` LIKE '%" . $_POST["search"]["value"] . "%'  ";
                $resultSearch = $this->db->getCustomRows($sqlQuerySearch, 'single');
                if($resultSearch['id'] <> ''){
                    $sqlQuery .= 'AND username LIKE "%' . $_POST["search"]["value"] . '%" OR `'.$value[2].'` LIKE "%' . $resultSearch['id'] . '%" ';
                }else{
                    $sqlQuery .= ' AND username LIKE "%' . $_POST["search"]["value"] . '%"';
                }
            }
            // $sqlQuery .= ' AND username LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
       
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'user');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '"><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = ' <button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $user_type_id = $this->app->getDetails("tbl_user_type", "name", "id", $row["user_type_id"]);
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "username" => $row["emp_name"],
                    "user_type" => $user_type_id,
                    "created_at" => date("d-m-Y H:i", strtotime($row["created_at"])),
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listtest(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_material_test` ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_material_test` ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $offset++;
                $array = array(
                    "Sample code" => $row["sample_code"],
                    "Report Date" => $row["report_date"],
                    "Report Number" => $row["report_no"],
                    "Discipline" => $row["discipline"],
                    "Sample Name" => $row["sample_name"],
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function sampleTestingList(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 0 AND `is_retest`= 0 AND `is_resample`= 0 AND `is_completed`= 1 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 0 AND `is_retest`= 0 AND `is_resample`= 0 AND `is_completed`= 1 " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'AND sample_code LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $test_responsibility = $this->app->test_assign_from($row["test_responsibility"]);
                $offset++;
                $array = array(
                    // "sno" => $offset,
                    "date" => date("d-m-Y", strtotime($row["sampling_date"])),
                    "sample_id" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row["sample_id"]),
                    "sample_code" => $row["sample_code"],
                    "prepared_by" => $test_responsibility['emp_name'] . '-' . $test_responsibility['name'],
                    "action" => '<a href="test-approval.php?id=' . $row["id"] . '"><button class="btn btn-sm btn-primary btn-icon-text update" id="' . $row["id"] . '"><span class="mdi mdi-check-circle"></span> Approve</button></a>'
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listprocat(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_product_category` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_product_category` WHERE `is_active` = 1 ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'product-category');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "name" => $row["name"],
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function trackSample(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $getroleAccess = $this->app->getroleAccess($_SESSION['roleId'], 'test-lib');
        if ($getroleAccess == 1) {
            $whereSQL = '';
        } else {
            $whereSQL = 'AND `test_responsibility` = ' . $_SESSION['userId'] . ' ';
        }
        //
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `status`!=5 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active`=1 AND `status`!=5 " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'AND sample_code LIKE "%' . $_POST["search"]["value"] . '%"  or test_category_id LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $offset++;
                $assign_by = $this->app->test_assign_from($row["created_by"]);
                $assign_to = $this->app->test_assign_from($row["test_responsibility"]);
                if ($row["status"] == 0) {
                    $action = 'SAMPLE NOT TAKEN';
                } else {
                    $action = 'SAMPLE TAKEN BY TESTING';
                }
                // $test_responsibility['emp_name'].'-'.$test_responsibility['name'],
                $array = array(
                    "sno" => $offset,
                    "sample_code" => $row["sample_code"],
                    "sampling_receive_date" => $row["sampling_receive_date"],
                    "assign_from" => $assign_by['emp_name'] . '-' . $assign_by['name'],
                    "test_responsibility" => $assign_to['emp_name'] . '-' . $assign_to['name'],
                    "action" => '<button class="btn btn-xs btn-' . $color . ' btn-icon-text update" id="' . $row["id"] . '" >' . $action . '</button>'
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function sampleLibrary(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        // print_r($requestData);
        $getroleAccess = $this->app->getroleAccess($_SESSION['roleId'], 'test-lib');
        if ($getroleAccess == 1) {
            $whereSQL = '';
        } else {
            $whereSQL = 'AND `test_responsibility` = ' . $_SESSION['userId'] . ' ';
        }
        if (isset($requestData['input_data']) && !empty($requestData['selectType']) && !empty($requestData['input_data'])) {
            $whereSQL .= " AND `" . $requestData['selectType'] . "` ='" . $requestData['input_data'] . "'";
        }
        //
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `status`=1 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE(`is_active`=1 AND `status`=1 OR `is_active`=1 AND `status`=5) " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'AND (sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%") ';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        // echo $sqlQuery;
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
    //  echo  $sqlQuery;
    
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($_SESSION['roleId'] == 1) {
                    $action = '
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <a target="_blank" href="dompdf/print2.php?id=' . $row["id"] . '" class="btn btn-outline-success btn-xs float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>View Pdf</a>  
                    <a target="_blank" href="dompdf/print3.php?id='.$row["id"].'" class="btn btn-outline-danger btn-xs float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>PDF</a>  
                    <a target="_blank" href="dompdf/print4.php?id='.$row["id"].'" class="btn btn-outline-secondary btn-xs float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>PDF 2</a>  
                    </div>  ';
                } else {
                    $action = '<div class="btn-group" role="group" aria-label="Basic example">
                    <a target="_blank" href="dompdf/print2.php?id=' . $row["id"] . '" class="btn btn-outline-success btn-xs float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>View Pdf</a>  
                    <a target="_blank" href="dompdf/print3.php?id='.$row["id"].'" class="btn btn-outline-danger btn-xs float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>PDF</a>  
                    <a target="_blank" href="dompdf/print4.php?id='.$row["id"].'" class="btn btn-outline-secondary btn-xs float-end"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>PDF 2</a>  
                    </div>';
                }
                $offset++;
                $adt = $this->app->fetchallDetails('tbl_testing_logs', 'testing_id', $row['id']);
                $approveDate =  date("d-m-Y", strtotime($adt[0]['approve_date']));
                $array = array(
                    "sno" => $offset,
                    "sample_code" => $row["sample_code"],
                    "report_date" => $approveDate,
                    "report_number" => $row["report_number"],
                    "Test Group" => $this->app->fetchDetailsSelect('tbl_test_group', 'id', $row['test_grp_id']),
                    "action" => $action
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function worksheetLibrary(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active` = 1 AND `is_completed`= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active` = 1 AND `is_completed`= 0 " . $whereSQL ." ORDER BY `tbl_testing`.`id` DESC ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        // print_r($result);
        // exit;
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'worksheet_list');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_work_sheet` WHERE `testing_id`='" . $row["id"] . "' AND `is_completed`=1 ";
                $countData = $this->db->getCustomRows($sql, "single");
                // if ($countData['total'] <> '0') {
                //     $btnsts = 'Completed';
                //     $color = 'success';
                // $action = '<a href="test-form.php?testingId=' . $row["id"] . '" class="btn btn-' . $color . ' btn-sm" float-end">' . $btnsts . '</a>';
                // } else {
                if ($hasPermission["edit"] == 'true') {
                    $btnsts = 'Pending';
                    $color = 'primary';
                    $action = '<a href="work-sheet.php?testingId=' . $row["id"] . '" class="btn btn-' . $color . ' btn-sm" float-end">' . $btnsts . '</a>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '';
                }
                // }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "sample_code" => $row["sample_code"],
                    "sampling_receive_date" => $row["sampling_receive_date"],
                    "test_start_date" => $row["test_start_date"],
                    "test_end_date" => $row["test_end_date"],
                    "action" => $action
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    // public function worksheetLibrary(array $inputData)
    // {
    //     $requestData = $inputData["request"];
    //     $whereSQL = '';
    //     if (!empty($requestData['testCategory'])) {
    //         $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
    //     }
    //     if (!empty($requestData['testGroup'])) {
    //         $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
    //     }
    //     if (!empty($requestData['materialGroup'])) {
    //         $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
    //     }
    //     if (!empty($requestData['materialItem'])) {
    //         $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
    //     }
    //     $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `status`= 1 " . $whereSQL;
    //     $result = $this->db->getCustomRows($sqlQuery, 'single');
    //     $numRows = $result["rowNum"];
    //     $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `status`=1 " . $whereSQL;
    //     if (!empty($_POST["search"]["value"])) {
    //         $sqlQuery .= 'WHERE sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
    //     }
    //     if (!empty($_POST["order"])) {
    //         //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
    //     } else {
    //         $sqlQuery .= 'ORDER BY id DESC ';
    //     }
    //     if ($_POST["length"] != -1) {
    //         $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    //     }
    //     $result = $this->db->getCustomRows($sqlQuery);
    //     // print_r($result);
    //     // exit;
    //     $html = '';
    //     $returnData = array();
    //     if ($result) {
    //         $offset = 0;
    //         foreach ($result as $row) {
    //             $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_work_sheet` WHERE `testing_id`='" . $row["id"] . "' AND `is_completed`=1 ";
    //             $countData = $this->db->getCustomRows($sql, "single");
    //             if ($countData['total'] <> '0') {
    //                 $btnsts = 'Completed';
    //                 $color = 'success';
    //                 $action = '<a href="test-form.php?testingId=' . $row["id"] . '" class="btn btn-' . $color . ' btn-sm" float-end">' . $btnsts . '</a>';
    //             } else {
    //                 $btnsts = 'Pending';
    //                 $color = 'primary';
    //                 $action = '<a href="work-sheet.php?testingId=' . $row["id"] . '" class="btn btn-' . $color . ' btn-sm" float-end">' . $btnsts . '</a>';
    //             }
    //             $offset++;
    //             $array = array(
    //                 "sno" => $offset,
    //                 "sample_code" => $row["sample_code"],
    //                 "report_date" => $row["report_date"],
    //                 "report_number" => $row["report_number"],
    //                 "Test Group" => $this->app->fetchDetailsSelect('tbl_test_group', 'id', $row['test_grp_id']),
    //                 "action" => $action
    //             );
    //             $returnData[] = $array;
    //         }
    //     }
    //     // 
    //     //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
    //     //echo $paginationLink;
    //     //echo json_encode($data, true);
    //     $output = array(
    //         "draw" => intval($_POST["draw"]),
    //         "recordsTotal" => $numRows,
    //         "recordsFiltered" => $numRows,
    //         "data" => $returnData,
    //         "query" => $sqlQuery
    //     );
    //     echo json_encode($output);
    // }
    public function listmaster(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_material_item` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_material_item` WHERE `is_active` = 1 ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'AND name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            // $sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'sample-master');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "name" => $row["name"],
                    "category" => $this->app->fetchDetailsSelect('tbl_material_category', 'id', $row['mateial_category_id']),
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    //     public function masterFormatList(array $requestData)
    //     {
    //         $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_material_format`  WHERE is_active = 1 GROUP BY `test_grp_id`, `sample_id`, `standard_test_id`";
    //         $result = $this->db->getCustomRows($sqlQuery, 'single');
    //         $numRows = $result["rowNum"];
    //         $sqlQuery = "SELECT `id`, `test_grp_id`, `sample_id`, `standard_test_id` FROM `tbl_material_format` WHERE is_active = 1 GROUP BY `test_grp_id`, `sample_id`, `standard_test_id`";
    //         if (!empty($_POST["search"]["value"])) {
    //             $sqlQuery .= 'WHERE test_category_id LIKE "%' . $_POST["search"]["value"] . '%"';
    //         }
    //         if (!empty($_POST["order"])) {
    //             //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
    //         } else {
    //             $sqlQuery .= 'ORDER BY id DESC ';
    //         }
    //         if ($_POST["length"] != -1) {
    //             $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    //         }
    //         $result = $this->db->getCustomRows($sqlQuery);
    //         $html = '';
    //         $returnData = array();
    //         if ($result) {
    //             $offset = 0;
    //             foreach ($result as $row) {
    //                 $test_category_id = $this->app->fetchallDetails('tbl_test_group', 'id', $row['test_grp_id']);
    //                 $material_category_id = $this->app->fetchallDetails('tbl_material_item', 'id', $row['sample_id']);
    //                 $material_id = $this->app->fetchallDetails('tbl_material_category', 'id', $material_category_id[0]['mateial_category_id']);
    // //
    //                 $offset++;
    //                 $array = array(
    //                     "sno" => $offset,
    //                     "testcategory" => $this->app->fetchDetailsSelect('tbl_test_category', 'id',$test_category_id[0]['test_category_id']),
    //                     "testgroup" => $this->app->fetchDetailsSelect('tbl_test_group', 'id', $row['test_grp_id']),
    //                     "materialGroup" => $this->app->fetchDetailsSelect('tbl_material', 'id', $material_id[0]['material_id']),
    //                     "materialCategory" => $this->app->fetchDetailsSelect('tbl_material_category', 'id',$material_category_id[0]['mateial_category_id']),
    //                     "matitem" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row['sample_id']),
    //                     "standardTestId" => $this->app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row['standard_test_id']),
    //                     "action" => '<a href="material-format.php?id='.$row['id'].'"><button class="btn btn-xs btn-warning btn-icon-text update" id="'.$row["id"].'" ><span class="fa fa-edit"></span></button></a>
    //                      <button class="btn btn-xs btn-danger btn-icon-text delete" id="'.$row["id"].'" ><span class="fa fa-trash"></span></button>'
    //                 );
    //                 $returnData[] = $array;
    //             }
    //         }
    //         // 
    //         //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
    //         //echo $paginationLink;
    //         //echo json_encode($data, true);
    //         $output = array(
    //             "draw" => intval($_POST["draw"]),
    //             "recordsTotal" => $numRows,
    //             "recordsFiltered" => $numRows,
    //             "data" => $returnData,
    //             "query" => $sqlQuery
    //         );
    //         echo json_encode($output);
    //     }
    //
    //
    public function testResample(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `status`= 3 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active`=1 AND `status`= 3 " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $offset++;
                $array = array(
                    // "sno" => $offset,
                    "sampling_date" => $row["sampling_date"],
                    "sample_code" => $row["sample_code"],
                    "old_report_no" => $row["report_number"],
                    "report_number" => $row["report_number"],
                    "sample_id" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row["sample_id"]),
                    "standard_test_id" => $this->app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row["standard_test_id"]),
                    "action" => '<a href="sample-registration.php?id=' . $row["id"] . '"><button class="btn btn-xs btn-info btn-icon-text update"><span class="fa fa-edit"></span></button></a>  <a href="sample-registration.php?id=' . $row["id"] . '"><button class="btn btn-xs btn-warning btn-icon-text update" id="1"><span class="mdi mdi-check-circle"></span> Approve</button></a>'
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function testRetestPending(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $getroleAccess = $this->app->getroleAccess($_SESSION['roleId'], 'test-lib');
        if ($getroleAccess == 1) {
            $whereSQL = '';
        } else {
            $whereSQL = 'AND `test_responsibility` = ' . $_SESSION['userId'] . ' ';
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `is_completed`=1 AND `status` = 2  AND `is_resample`= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 2 AND `is_completed`=1 AND `is_resample`= 0 " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        // echo $sqlQuery;
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($row["status"] = 2 && $row["is_retest"] == 0) {
                    $action = '<a href="sample-registration.php?id=' . $row["id"] . '&status=2"><button class="btn btn-xs btn-info btn-icon-text update"><span class="mdi mdi-redo"> Pending-Retest</span></button></a>';
                } elseif ($row["status"] = 2 && $row["is_retest"] == 1) {
                    $action = 'edit';
                }
                $offset++;
                $array = array(
                    // "sno" => $offset,
                    "sampling_date" => $row["sampling_date"],
                    "sample_code" => $row["sample_code"],
                    "sample_id" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row["sample_id"]),
                    "standard_test_id" => $this->app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row["standard_test_id"]),
                    "action" => $action
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    public function testResamplePending(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $getroleAccess = $this->app->getroleAccess($_SESSION['roleId'], 'test-lib');
        if ($getroleAccess == 1) {
            $whereSQL = '';
        } else {
            $whereSQL = 'AND `test_responsibility` = ' . $_SESSION['userId'] . ' ';
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `is_completed`=1 AND `status` = 3  " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active`=1 AND `is_completed`=1 AND `status` = 3  " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        // echo $sqlQuery;
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $offset++;
                if ($row["status"] = 3 && $row["is_resample"] == 0) {
                    $action = '<a href="sample-registration.php?id=' . $row["id"] . '&status=3"><button class="btn btn-sm btn-info btn-icon-text update"><span class="mdi mdi-redo-variant"> Pending-ReSample</span></button></a>';
                } elseif ($row["status"] = 3 && $row["is_resample"] == 1) {
                    $action = '';
                }
                $array = array(
                    // "sno" => $offset,
                    "sampling_date" => $row["sampling_date"],
                    "sample_code" => $row["sample_code"],
                    "sample_id" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row["sample_id"]),
                    "standard_test_id" => $this->app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row["standard_test_id"]),
                    "action" => $action
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function testRetestApp(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 2 AND `is_completed`=1 AND `is_retest`= 1 AND `reference_id`!= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 2 AND `is_completed`=1 AND `is_retest`= 1 AND `reference_id`!= 0 " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        // echo $sqlQuery;
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $offset++;
                if ($row["status"] = 2 && $row["is_retest"] == 1) {
                    $action = '<a href="test-approval.php?id=' . $row["id"] . '&status="retest""><button class="btn btn-xs btn-warning btn-icon-text update" id="1"><span class="mdi mdi-checkbox-marked-circle"> Approve</span></button></a>';
                } elseif ($row["status"] = 2 && $row["is_retest"] == 0) {
                    $action = 'edit';
                }
                $array = array(
                    // "sno" => $offset,
                    "sampling_date" => $row["sampling_date"],
                    "sample_code" => $row["sample_code"],
                    "sample_id" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row["sample_id"]),
                    "standard_test_id" => $this->app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row["standard_test_id"]),
                    "action" => $action
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function testResampleApp(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 3 AND `is_completed`=1 AND `is_resample`= 1 AND `reference_id`!= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 3  AND `is_completed`=1 AND `is_resample`= 1 AND `reference_id`!= 0 " . $whereSQL;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        // echo $sqlQuery;
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                $offset++;
                if ($row["status"] = 3 && $row["is_resample"] == 1) {
                    $action = '<a href="test-approval.php?id=' . $row["id"] . '&status="retest""><button class="btn btn-xs btn-warning btn-icon-text update" id="1"><span class="mdi mdi-check-circle"></span> Approve</button></a>';
                } elseif ($row["status"] = 3 && $row["is_resample"] == 0) {
                    $action = '<a href="sample-registration.php?id=' . $row["id"] . '&status=2"><button class="btn btn-xs btn-info btn-icon-text update"><span class="fa fa-edit"></span></button></a>';
                }
                $array = array(
                    // "sno" => $offset,
                    "sampling_date" => $row["sampling_date"],
                    "sample_code" => $row["sample_code"],
                    "sample_id" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row["sample_id"]),
                    "standard_test_id" => $this->app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row["standard_test_id"]),
                    "action" => $action
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listtestGroup(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_test_group` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_test_group` WHERE `is_active` = 1 ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'test-group');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger btn-icon-text delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "test_category_id" => $this->app->fetchDetailsSelect('tbl_test_category', 'id', $row["test_category_id"]),
                    "name" => $row["name"],
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // mateial_category_id
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    //
    public function masterTest(array $inputData)
    {
        $requestData = $inputData["request"];
        $whereSQL = '';
        if (!empty($requestData['testCategory'])) {
            $whereSQL .= " AND `test_category_id`='" . $requestData['testCategory'] . "'";
        }
        if (!empty($requestData['testGroup'])) {
            $whereSQL .= " AND `test_grp_id`='" . $requestData['testGroup'] . "'";
        }
        if (!empty($requestData['materialGroup'])) {
            $whereSQL .= " AND `material_grp_id`='" . $requestData['materialGroup'] . "'";
        }
        if (!empty($requestData['materialItem'])) {
            $whereSQL .= " AND `sample_id`='" . $requestData['materialItem'] . "'";
        }
        $getroleAccess = $this->app->getroleAccess($_SESSION['roleId'], 'test-lib');
        if ($getroleAccess == 1) {
            $whereSQL = '';
        } else {
            $whereSQL = 'AND `test_responsibility` = ' . $_SESSION['userId'] . ' ';
        }
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active` = 1 AND `status` = 0 AND `is_retest`= 0 AND `is_resample`= 0 AND `is_completed`= 1 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_testing` WHERE `is_active` = 1 AND `status` = 0 AND `is_retest`= 0 AND `is_resample`= 0 AND `is_completed`= 1 " . $whereSQL ;
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'AND sample_code LIKE "%' . $_POST["search"]["value"] . '%" or report_number LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
      
        if ($_POST["length"] != -1) {
         
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'master-test');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["read"] == 'true') {
                    $read = '<a href="sample-registration.php?id=' . $row["id"] . '&&view=view">
                    <button class="btn btn-xs btn-success btn-icon-text update" id=' . $row["id"] . '><span class="fa fa-eye"></span></button></a>';
                }
                if ($hasPermission["edit"] == 'true') {
                    $update = '<a href="editsample.php?id=' . $row["id"] . '&&edit=edit">
                    <button class="btn btn-xs btn-warning btn-icon-text update" id=' . $row["id"] . '><span class="fa fa-pen"></span></button></a>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger btn-icon-text delete" id=' . $row["id"] . '><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    // "sno" => $offset,
                    "sampling_date" => date("d-m-Y", strtotime($row["sampling_date"])),
                    "sample_code" => $row["sample_code"],
                    "test_number" => $row["test_number"],
                    "test_category" => $this->app->fetchDetailsSelect('tbl_test_category', 'id', $row["test_category_id"]),
                    "sample_id" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row["sample_id"]),
                    "action" => $read . ' ' . $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function stpList(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_stp` WHERE `is_active` = 1 AND `is_deleted`=0 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_stp` WHERE `is_active` = 1 AND `is_deleted`= 0 ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'AND  test_parameters LIKE "%' . $_POST["search"]["value"] . '%" OR testing_protocols LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        //
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'standard-test-procedure');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["read"] == 'true') {
                    $read = '<button class="btn btn-xs btn-primary btn-icon-text view" data-toggle="modal"  data-target="#datadocModal" id="' . $row["id"] . '" ><span class="mdi mdi-eye"> View</span></button>';
                }
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-success btn-icon-text update" data-toggle="modal"  data-target="#docModal" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                // if ($hasPermission["edit"] == 'true') {
                //     $update = '<button class="btn btn-xs btn-primary btn-icon-text upload" data-toggle="modal"  data-target="#docModalUpload" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                // }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $editReport = '<a href="wseditform.php?id='.$row["id"] .'"><button class="btn btn-xs btn-warning" id="' . $row["id"] . '" >Edit Form</button></a>';

                $workSheet = '<a href="ws-form.php?id=' . $row["id"] . '"><button class="btn btn-xs btn-info" id="' . $row["id"] . '" >Work Form</button></a>';

                $viewform = '<button type="button" id="' . $row['id'] . '" text="' . $row['test_parameters'] . '" class="btn btn1 btn-xs btn-success usertype">View Form</button>';
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "test_parameters" => $row["test_parameters"],
                    "testing_protocols" => $row["testing_protocols"],
                    "document" => $read,
                    "action" => $update . ' ' . $workSheet . ' ' . $editReport . ' ' . $viewform . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function testtypelist(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_standard_test_type` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_standard_test_type` WHERE `is_active` = 1  ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'standard-test-type');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-warning btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    // "sno" => $offset,
                    "name" => $row["name"],
                    "comment" => $row["comment"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    public function listNotes(array $requestData)
    {
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_notes` WHERE `is_active`=1 ";
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $numRows = $result["rowNum"];
        $sqlQuery = "SELECT * FROM `tbl_notes` WHERE `is_active`= 1 ";
        if (!empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE name LIKE "%' . $_POST["search"]["value"] . '%"';
        }
        if (!empty($_POST["order"])) {
            //$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        } else {
            $sqlQuery .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
            $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->getCustomRows($sqlQuery);
        $html = '';
        $returnData = array();
        $hasPermission = $this->app->hasPermission($_SESSION['roleId'], 'notes');
        if ($result) {
            $offset = 0;
            foreach ($result as $row) {
                if ($hasPermission["edit"] == 'true') {
                    $update = '<button class="btn btn-xs btn-primary btn-icon-text update" id="' . $row["id"] . '" ><span class="fa fa-edit"></span></button>';
                }
                if ($hasPermission["delete"] == 'true') {
                    $delete = '<button class="btn btn-xs btn-danger delete" id="' . $row["id"] . '" ><span class="fa fa-trash"></span></button>';
                }
                $offset++;
                $array = array(
                    "sno" => $offset,
                    "name" => $row["name"],
                    "description" => $row["description"],
                    "action" => $update . ' ' . $delete
                );
                $returnData[] = $array;
            }
        }
        // 
        //$data = array("d"=>$returnData,"paginationLink"=>$paginationLink);
        //echo $paginationLink;
        //echo json_encode($data, true);
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $numRows,
            "recordsFiltered" => $numRows,
            "data" => $returnData,
            "query" => $sqlQuery
        );
        echo json_encode($output);
    }
    //
    // listmatformat
}
