<?php
class Application
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function notification()
    {
        //
        $sql = "SELECT * FROM `tbl_testing_logs` WHERE `prepared_by` = 1 AND `is_notify` = 0 ORDER BY `tbl_testing_logs`.`id` DESC ";
        $result = $this->db->getCustomRows($sql, 'single');
        //
        if ($result) {
            //
            $updateData = array(
                "is_notify" => 1
            );
            $where = array(
                "id" => $result["id"],
            );
            $this->db->appUpdate("tbl_testing_logs", $updateData, $where);
            // test pending
            if ($result['status'] == '0' && $result['is_retest'] == '0' && $result['is_resample'] == '0') {
                $title = 'New Sample Received by ' . $result['created_by'];
                $body = 'Sample Code - ' . $result['testing_id'];
                $icon = 'assets/images/logo2.png';
                $url = 'https://vividtranstech.com/lims/laboratory';
            }
            // RetestPending
            elseif ($result['status'] == '2' && $result['is_resample'] == '0') {
                $title = 'Retest Sample Received by ' . $result['created_by'];
                $body = 'Sample Code - ' . $result['testing_id'];
                $icon = 'assets/images/logo2.png';
                $url = 'https://vividtranstech.com/lims/laboratory';
            }
            // ResamplePending
            elseif ($result['status'] == '3' && $result['is_retest'] == '0') {
                $title = 'Re-Sample Received by ' . $result['created_by'];
                $body = 'Sample Code - ' . $result['testing_id'];
                $icon = 'assets/images/logo2.png';
                $url = 'https://vividtranstech.com/lims/laboratory';
            }
        } else {
            exit;
        }
        // exit;
        $webNotificationPayload['title'] = $title;
        $webNotificationPayload['body'] = $body;
        $webNotificationPayload['icon'] = $icon;
        $webNotificationPayload['url'] = $url;
        echo json_encode($webNotificationPayload);
    }
    public function getProfile()
    {
        $sql = "SELECT `id`, `username`, `user_type_id`, `emp_no`, `company_name`, `emp_name`, `communication_address`, `permanent_address`, `gender`, `phone_no`, `mobile_no`, `email`, `photo`, `is_active`, `is_deleted`, `created_by`, `created_at` FROM `users` WHERE `id`= '" . $_SESSION['userId'] . "'";
        $result = $this->db->getCustomRows($sql, 'single');
        return $result;
    }
    public function formatCategory()
    {
        $sql = "SELECT `name` FROM `tbl_format_category` WHERE `is_active` = 1 ";
        // $sql = "SELECT * FROM `tbl_main_heading` WHERE 1";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function parametersList()
    {
        $sql = "SELECT DISTINCT `test_parameters` FROM `tbl_stp` WHERE 1 ";
        // $sql = "SELECT * FROM `tbl_main_heading` WHERE 1";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function protocolList($parameter)
    {
        $sql = "SELECT DISTINCT `testing_protocols` FROM `tbl_stp` WHERE `test_parameters`= '" . $parameter . "' ";
        // $sql = "SELECT * FROM `tbl_main_heading` WHERE 1";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function getprotocols($inputData)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT DISTINCT `testing_protocols` FROM `tbl_stp` WHERE `test_parameters`= '" . $requestData['parameters'] . "' ";
        // $sql = "SELECT * FROM `tbl_main_heading` WHERE 1";
        $result = $this->db->getCustomRows($sql);
        echo '<option value="">Select</option>';
        foreach ($result as $row) {
            echo '<option value="' . $row["testing_protocols"] . '">' . $row["testing_protocols"] . '</option>';
        }
        // return $result;
    }
    public function get_users()
    {
        $sql = "SELECT * FROM `users` WHERE `is_active` = 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function test_responsibility()
    {
        $sql = "SELECT users.id as id,`emp_name`,`name` FROM users INNER JOIN tbl_user_type ON users.user_type_id = tbl_user_type.id WHERE users.is_active =1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function test_assign_from($id)
    {
        $sql = "SELECT users.id as id,`emp_name`,`name` FROM users INNER JOIN tbl_user_type ON users.user_type_id = tbl_user_type.id WHERE users.id=" . $id . " AND users.is_active =1 ";
        $result = $this->db->getCustomRows($sql, 'single');
        return $result;
    }
    // public function getFinalresult($headId, $testingId)
    // {
    //     if (isset($headId) && !empty($headId)) {
    //         $WhereSql = " AND `mainheadid` = $headId AND `testing_id` LIKE $testingId AND `is_active`=1";
    //         $sql = "SELECT * FROM `tbl_work_sheet` WHERE 1 " . $WhereSql;
    //         $result = $this->db->getCustomRows($sql, 'single');
    //         $return = $result['name'];
    //         $data = json_decode($return);
    //         // Get the last array
    //         $last_key = end(array_keys((array) $data));
    //         $last_array = end($data);
    //         $result = $last_array[0];
    //     } else {
    //         $result = 0;
    //     }
    //     // $sql = "SELECT JSON_EXTRACT(name, '$.result') AS result FROM tbl_work_sheet WHERE `mainheadid` = $headId AND `testing_id` = $testingId ";
    //     return $result;
    // }
    //
    public function getFinalresult($headId, $testingId)
{
    if (isset($headId) && !empty($headId)) {
        $WhereSql = " AND `mainheadid` = $headId AND `testing_id` LIKE $testingId AND `is_active`=1";
        $sql = "SELECT * FROM `tbl_work_sheet` WHERE 1 " . $WhereSql;
        $result = $this->db->getCustomRows($sql, 'single');

        if ($result !== false && isset($result['name'])) { // Check if the query was successful and 'name' key exists
            $return = $result['name'];
            $data = json_decode($return);

            if (json_last_error() === JSON_ERROR_NONE) { // Check if JSON decoding was successful
                $arrayData = (array) $data; // Convert object to array
                $last_key = end(array_keys($arrayData));
                $last_array = end($arrayData);

                if (is_array($last_array) && isset($last_array[0])) {
                    $result = $last_array[0];
                } else {
                    $result = ''; // Default value if structure is not as expected
                }
            } else {
                $result = ''; // Default value if JSON decoding fails
            }
        } else {
            $result = ''; // Default value if query fails or 'name' is not set
        }
    } else {
        $result = ''; // Default value if $headId is not set or empty
    }

    return $result;
}

    public function getheadId($parameter, $protocol)
    {
        $sql = "SELECT * FROM `tbl_stp` WHERE `test_parameters` LIKE '" . $parameter . "' AND `testing_protocols` LIKE '" . $protocol . "' ";
        $result = $this->db->getCustomRows($sql, 'single');
        return $result['id'];
    }
    public function get_notes(array $inputData)
    {
        $requestData = $inputData["request"];
        $symbol = $requestData['symbol'];
        $sql = "SELECT * FROM `tbl_notes` WHERE `name` LIKE '%$symbol%' ";
        $result = $this->db->getCustomRows($sql);
        echo json_encode($result, true);
    }
    public function getDashboard()
    {
        $roleId = $_SESSION['roleId'];
        $whereSQL = '';
        $getroleAccess = $this->getroleAccess($_SESSION['roleId'], 'test-lib');
        if ($getroleAccess == 1) {
            $whereSQL = '';
        } else {
            $whereSQL = 'AND `test_responsibility` = ' . $_SESSION['userId'] . ' ';
        }
        //
        $array = array();
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active` = 1 AND `is_completed`= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $array["totalAssign"] = $result['rowNum'];
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `is_active`=1 AND `status` = 0 AND `is_retest`= 0 AND `is_resample`= 0 AND `is_completed`= 1 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $array["approvalPending"] = $result['rowNum'];
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `status` = 1 AND `is_retest`= 0 AND `is_active`= 1 AND `is_resample`= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $array["approved"] = $result['rowNum'];
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `status` = 2 AND `is_retest`= 0 AND `is_resample`= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $array["retest"] = $result['rowNum'];
        $sqlQuery = "SELECT COUNT(`id`) as `rowNum` FROM `tbl_testing` WHERE `status` = 3 AND `is_retest`= 0 AND `is_resample`= 0 " . $whereSQL;
        $result = $this->db->getCustomRows($sqlQuery, 'single');
        $array["resample"] = $result['rowNum'];
        $array["total"] = $array["sample"] + $array["approved"] + $array["retest"] + $array["resample"];
        return $array;
    }
    // public function workSheet($testing_id)
    // {
    //     $sql = "SELECT `mainheadid`,`name` FROM `tbl_work_sheet` WHERE  `testing_id` = '".$testing_id."' ";
    //     $result = $this->db->getCustomRows($sql);
    //     foreach($result as $val){
    //         $arrId[]=$val['mainheadid'];
    //         // $json[]=$val['name'];
    //         $prevWorksheet[] = json_decode($val['name'], true);
    //     }
    //     // print_r($prevWorksheet);
    //     // exit;
    //     // $json_encode = json_encode($result);
    //     // $json = $result[0]['name'];
    //     // print_r($json);
    //     // $prevWorksheet = json_decode($json, true);
    //     // $newArray = [];
    //     // foreach ($prevWorksheet as $outerkey => $outerArr) {
    //     //     foreach ($outerArr as $key => $innerArr) {
    //     //         $newArray[$key][$outerkey] = $innerArr;
    //     //     }
    //     // }
    // $array = array('newarray'=>$prevWorksheet,'mainId'=>$arrId);
    //     return $array;
    // }
    public function workSheetHead($testing_id)
    {
        $sql = "SELECT `mainheadid` FROM `tbl_work_sheet` WHERE  `testing_id` = '" . $testing_id . "' ";
        $result = $this->db->getCustomRows($sql);
        foreach ($result as $val) {
            $arrId[] = $val['mainheadid'];
            // $testId=$val['testing_id'];
        }
        return $arrId;
    }
    public function workSheet($headId, $testingId)
    {
        $sql = "SELECT `name` FROM `tbl_work_sheet` WHERE `mainheadid` = '" . $headId . "' AND `testing_id` = '" . $testingId . "' ";
        $result = $this->db->getCustomRows($sql);
        // $json_encode = json_encode($result);
        $json = $result[0]['name'];
        $prevWorksheet = json_decode($json, true);
        $newArray = [];
        foreach ($prevWorksheet as $outerkey => $outerArr) {
            foreach ($outerArr as $key => $innerArr) {
                $newArray[$key][$outerkey] = $innerArr;
            }
        }
        $tbl_field_heading = $this->tbl_field_heading($headId);
        $sql = "SELECT * FROM `tbl_stp` WHERE `id`= '" . $headId . "' ";
        // $sql = "SELECT * FROM `tbl_main_heading` WHERE `id`= '" . $headId . "' ";
        $is_multipleResult = $this->db->getCustomRows($sql, 'single');
        $is_multiple = $is_multipleResult['is_multiple'];
        //
        $outHtml = '';
        $outHtml .= '<table class="table table-bordered" style="border-collapse:collapse" border=2><tr>';
        foreach ($tbl_field_heading['mainhead'] as $key => $value) {
            $outHtml .= '<th ' . $value['span'] . ' width="50%">' . $value['head_name'] . '</th>';
        }
        //
        $outHtml .= '</tr>
    <tr>';
        foreach ($tbl_field_heading['subhead'] as $key => $value) {
            $outHtml .= '<th ' . $value['span'] . '>' . $value['head_name'] . '</th>';
        }
        //
        $outHtml .= '</tr> 
    ';
        //old data
        if (is_array($newArray)) {
            foreach ($newArray as $datakey => $datavalue) {
                $outHtml .= '<tr class="" style="background-color:#E0F2F1">';
                foreach ($datavalue as $datakey1 => $datavalue1) {
                    $outHtml .= '<td>' . $datavalue1 . '</td>';
                }
                $outHtml .= '</tr>';
            }
        }
        $outHtml .= '<tbody id="additionalContiner"></tbody>';
        $outHtml .= '</table> ';
        //
        // $parametersList = $this->parametersList();
        // $cal = $parametersList[0]['calculation'];
        // $_SESSION["cal"] = $cal
        return $outHtml;
        // $array = array("html" => $outHtml, "formula" => $jsonMainHead, "formulaColumn" => $Columnvaluearr);
        // echo json_encode($array);
    }
    public function tbl_field_heading($head_id)
    {
        $sql = "SELECT `id`,`head_name`,`span` FROM tbl_heading WHERE `head_id`='" . $head_id . "' AND `is_main`='1' ";
        $result = $this->db->getCustomRows($sql);
        $sql1 = "SELECT `id`,`head_name`,`span` FROM tbl_heading WHERE `head_id`='" . $head_id . "' AND `is_sub_heading`= 1";
        $result2 = $this->db->getCustomRows($sql1);
        $main = array('mainhead' => $result, 'subhead' => $result2);
        return $main;
    }
    public function tbl_sub_heading()
    {
        $sql = "SELECT * FROM `tbl_sub_heading` WHERE `headid`= 3 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function tbl_form_column($head_id)
    {
        $sql = "SELECT `is_formula`,`name` FROM `tbl_form_detail` WHERE `formheadid`= $head_id";
        $result = $this->db->getCustomRows($sql);
        // print_r($result2);
        return $result;
    }
    public function get_matcategory_List()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_material_category` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function getusertype()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_user_type` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function getrolemenu()
    {
        $sql = "SELECT `id`,`user_type`,`name` FROM `tbl_menu` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function getroleAccess($userRole, $requestedResource)
    {
        $sql = "SELECT `id`,`user_type`,`name` FROM `tbl_menu` WHERE `is_active`= 1 AND `user_type`= $userRole ";
        $roles_result = $this->db->getCustomRows($sql, 'single');
        $roles = json_decode($roles_result['name'], true);
        if ($_SESSION['roleId'] == 1) {
            $result = '1';
        } elseif (array_key_exists($userRole, $roles) && in_array($requestedResource, $roles[$userRole])) {
            $result = '1';
        } else {
            $result = '0';
        }
        return $result;
    }
    public function gettest_group()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_test_group` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function gettest_group1($testcategory)
    {
       $sql = "SELECT `id`, `name` FROM `tbl_test_group` WHERE `test_category_id`= $testcategory AND `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_testgroup_List()
    {
        $sql = "SELECT `id`, `test_category_id` FROM `tbl_test_group` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_test_category()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_test_category` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_product_category()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_product_category` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_standard_test_type()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_standard_test_type` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_material_group()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_material` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_material_category()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_material_category` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_material_category1($material_id)
    {
        $sql = "SELECT `id`, `name` FROM `tbl_material_category` WHERE `material_id`= $material_id AND `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_material_item()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_material_item` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_material_item1($materialCategory)
    {
        $sql = "SELECT `id`, `name` FROM `tbl_material_item` WHERE `mateial_category_id`=$materialCategory AND `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_sampling_method()
    {
        $sql = "SELECT `id`, `name` FROM `tbl_sampling_method` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function getDetails($table, $column, $where1, $value)
    {
        $con = array();
        $con["select"] = $column;
        $where = array($where1 => $value);
        $con["where"] = $where;
        $result = $this->db->getRows($table, $con);
        return $result[0][$column];
    }
    //
    public function fetchDetails($table, $value)
    {
        // echo $table;
        $con = array();
        $con["select"] = '*';
        $con["returnType"] = 'single';
        $where = array('id' => $value);
        $con["where"] = $where;
        $result = $this->db->getRows($table, $con);
        return $result;
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }
    //
    public function listmatformat()
    {
        $sql = "SELECT * FROM `tbl_material_format` WHERE 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    //
    public function fetchDetailsSelect($table, $where1, $value)
    {
        $con = array();
        $con["select"] = '*';
        $where = array($where1 => $value);
        $con["where"] = $where;
        $result = $this->db->getRows($table, $con);
        if ($result) {
            return $result[0]['name'];
        } else {
            return false;
        }
    }
    //
    public function fetchallDetails($table, $where1, $value)
    {
        $con = array();
        $con["select"] = '*';
        $where = array($where1 => $value, 'is_active' => 1);
        $con["where"] = $where;
        $result = $this->db->getRows($table, $con);
        return $result;
    }
    //
    public function getsample()
    {
        $sql = "SELECT `id`, `test_param` FROM `tbl_material_test_item` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    //
    public function gettestcat()
    {
        $sql = "SELECT `test_category_id`, `name` FROM `tbl_test_category` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function gettype()
    {
        $sql = "SELECT `id`, `testing_protocol` FROM `tbl_material_test_item` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function getstatus()
    {
        $sql = "SELECT `id`, `specification` FROM `tbl_material_test_item` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    //
    public function get_notes_dropdown()
    {
        $sql = "SELECT `id`, `name`,`description` FROM `tbl_notes` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    //
    public function getdiscipline()
    {
        $sql = "SELECT `id`, `name` FROM tbl_test_category WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_group()
    {
        $sql = "SELECT `id`,`name` FROM `tbl_material_category` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_standard()
    {
        $sql = "SELECT `id`,`name` FROM `tbl_standard_test_type` WHERE `is_active`= 1 ";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function get_specs()
    {
        $sql = "SELECT `id`,`speci_name` FROM `tbl_specification`";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    //
    public function test_lib($id)
    {
        $sql = "SELECT * FROM `tbl_testing` WHERE `id` = $id";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    public function groupname($id)
    {
        $sql = "SELECT * FROM `tbl_stp` WHERE `id` = $id AND `is_active`=1 ";
        $result = $this->db->getCustomRows($sql, 'single');
        return $result;
    }
    //
    public function test_lib_table_data($id)
    {
        $sql = "SELECT * FROM `tbl_test_material_format` WHERE `testing_id` = $id AND `is_active`= 1 ORDER BY `tbl_test_material_format`.`order_by` ASC";
        $result = $this->db->getCustomRows($sql);
        return $result;
    }
    //
    public function getRemovedata($id)
    {
        //$rid='';
        //rid=$_REQUEST['r_id'];
        //print_r($rid);
        $sql = "SELECT `id`,`uploaded_files`,`uploaded_images` FROM `tbl_stp` WHERE `id`='" . $id . "'";
        $result = $this->db->getCustomRows($sql, "single");
        $files = unserialize($result['uploaded_files']);
        foreach ($files as $key => $value) {
            $v[] = $value;
        }
        $data = $v;
        $files2 = unserialize($result['uploaded_images']);
        foreach ($files2 as $key => $value) {
            $v2[] = $value;
        }
        $data2 = $v2;
        $result = array($data, $data2);
        //echo json_encode($data);
        return $result;
    }
    //
    public function get_stp(array $requestData)
    {
        $stp_id = '';
        $stp_id = $_REQUEST['id'];
        $sql = "SELECT `id`,`test_parameters`,`testing_protocols`,`uploaded_files`,`uploaded_images` FROM `tbl_stp` where `id`='" . $stp_id . "'";
        $result = $this->db->getCustomRows($sql, "single");
        $files = unserialize($result['uploaded_files']);
        $files2 = unserialize($result['uploaded_images']);
        $count = count($files);
        $count2 = count($files2);
        foreach ($files as $key => $value) {
            $v[] = $value;
        }
        foreach ($files2 as $key => $value) {
            $v2[] = $value;
        }
        $data = array($count, $v, $count2, $v2);
        //print_r($data);
        echo json_encode($data);
    }
    //
    public function getmaterialFormat($test_category_name, $standard_test_type, $test_group_name, $sample_name)
    {
        // if (isset($_POST['mateial_category_id']) && !empty($_POST['mateial_category_id'])) {
        // `is_active`=1 AND `test_grp_id`='" . $group . "' AND `sample_id`='" . $materialId . "' AND `standard_test_id`='" . $standardTestId . "'
        $sql1 = "SELECT `id` FROM `tbl_test_category` WHERE `name` = '" . $test_category_name . "'";
        $tbl_test_category = $this->db->getCustomRows($sql1, "single");
        $sql2 = "SELECT `id` FROM `tbl_standard_test_type` WHERE `name` = '" . $standard_test_type . "'";
        $standardTypeId = $this->db->getCustomRows($sql2, "single");
        $sql3 = "SELECT `id` FROM `tbl_test_group` WHERE `test_category_id` = '" . $tbl_test_category['id'] . "' AND `name` = '" . $test_group_name . "'";
        $tbl_test_group = $this->db->getCustomRows($sql3, "single");
        $sql4 = "SELECT `id` FROM `tbl_material_item` WHERE `name` = '" . $sample_name . "'";
        $sampleResultId = $this->db->getCustomRows($sql4, "single");
        // echo $result['id'];
        $sql = "SELECT * FROM `tbl_material_format` WHERE `is_active`=1 AND `test_grp_id` = '" . $tbl_test_group['id'] . "' AND `sample_id` = '" . $sampleResultId['id'] . "' AND `standard_test_id` = '" . $standardTypeId['id'] . "'";
        $result = $this->db->getCustomRows($sql);
        return $result;
        // $i=1;
        //     if ($result) {
        //         foreach ($result as $row) {
        //             echo '<tr id="additionalContinerId">
        // <input class="col form-control" type="hidden" name="id[]" value="' . $row['id'] . '">
        // <td><input class="col form-control" type="text" value="'.$i++.'" readonly></td>
        // <td><input class="col form-control" type="text" name="parameters[]" value="' . $row['parameters'] . '" readonly></td>
        // <td><input class="col form-control" type="text" name="protocols[]" value="' . $row['protocols'] . '"
        //     fdprocessedid="3suo2o" readonly></td>
        // <td><select class="col-12 form-control" name="specification[]" fdprocessedid="effusw">
        //     <option value="text" '.(('text' == $row['specification']) ? 'selected' : '').'>Text</option>
        //     <option value="min" '.(('min' == $row['specification']) ? 'selected' : '').'>Min</option>
        //     <option value="max" '.(('max' == $row['specification']) ? 'selected' : '').'>Max</option>
        // </select></td>
        // <td><input class="col form-control" type="text" value="' . $row['text'] . '" name="text[]" readonly></td>
        // <td><input class="col form-control" type="text" name="unit[]" value="' . $row['unit'] . '" readonly></td>
        // <td><input class="col-12 form-control result" type="text" id="" name="value[]" value=""></td>
        // <td><input class="col-12 form-control" type="text" id="" name="remark[]" value=""></td>
        // <td><button type="button" class="btn btn-danger btn-xs additionalContinerRemove" value="" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td>
        // </tr>';
        //         }
        //         // foreach ($result as $row){
        //         //   echo'<option value="'. $row["id"].'">'. $row["name"].'</option>';
        //         // }
        //     }
    }
    //
    public function getmaterialFormatvalue($testing_id, $parameter_name, $protocol_name)
    {
        $sql = "SELECT `id`,`value`,`remark`,`head_id` FROM `tbl_test_material_format` WHERE `testing_id` = $testing_id AND `parameters` LIKE '%$parameter_name%' AND `protocols` LIKE '%$protocol_name%' AND `is_active`=1 ";
        $result = $this->db->getCustomRows($sql, 'single');
        return $result;
    }
    //
    public function masterFormatList()
    {
        $sqlQuery = "SELECT MIN(`id`) as id, `test_grp_id`, `sample_id`, `standard_test_id` FROM `tbl_material_format` WHERE is_active = 1 GROUP BY `test_grp_id`, `sample_id`, `standard_test_id`";
        $result = $this->db->getCustomRows($sqlQuery);
        return $result;
        //     if ($result) {
        //         $offset = 0;
        //         foreach ($result as $row) {
        //             $test_category_id = $this->app->fetchallDetails('tbl_test_group', 'id', $row['test_grp_id']);
        //             $material_category_id = $this->app->fetchallDetails('tbl_material_item', 'id', $row['sample_id']);
        //             $material_id = $this->app->fetchallDetails('tbl_material_category', 'id', $material_category_id[0]['mateial_category_id']);
        // //
        //             $offset++;
        //             $array = array(
        //                 "sno" => $offset,
        //                 "testcategory" => $this->app->fetchDetailsSelect('tbl_test_category', 'id',$test_category_id[0]['test_category_id']),
        //                 "testgroup" => $this->app->fetchDetailsSelect('tbl_test_group', 'id', $row['test_grp_id']),
        //                 "materialGroup" => $this->app->fetchDetailsSelect('tbl_material', 'id', $material_id[0]['material_id']),
        //                 "materialCategory" => $this->app->fetchDetailsSelect('tbl_material_category', 'id',$material_category_id[0]['mateial_category_id']),
        //                 "matitem" => $this->app->fetchDetailsSelect('tbl_material_item', 'id', $row['sample_id']),
        //                 "standardTestId" => $this->app->fetchDetailsSelect('tbl_standard_test_type', 'id', $row['standard_test_id']),
        //                 "action" => '<a href="material-format.php?id='.$row['id'].'"><button class="btn btn-xs btn-warning btn-icon-text update" id="'.$row["id"].'" ><span class="fa fa-edit"></span></button></a>
        //                  <button class="btn btn-xs btn-danger btn-icon-text delete" id="'.$row["id"].'" ><span class="fa fa-trash"></span></button>'
        //             );
        //             $returnData[] = $array;
        //         }
        //     }
        // return $returnData;
        // echo json_encode($returnData);
    }
    //
    public function hasPermission($role, $module)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT `name` FROM tbl_role_permission WHERE `user_type` = '" . $role . "'";
        $result = $this->db->getCustomRows($sql, "single");
        $array1 = json_decode($result['name'], true);
        if (isset($role) && $role == 1) {
            $result = [
                'create' => 'true',
                'read' => 'true',
                'edit' => 'true',
                'upload' => 'true',
                'delete' => 'true'
            ];
        } else {
            $result = $array1[$module];
        }
        // print_r($array1[$module]);
        // exit;
        // $roles = [
        //     'admin' => [
        //         'dashboard',
        //         'user_management',
        //         'report_generation',
        //     ],
        //     'manager' => [
        //         'dashboard',
        //         'report_generation',
        //     ],
        //     'employee' => [
        //         'dashboard',
        //     ],
        // ];
        // // Example user role assignment
        // $userRole = 'admin'; // Assuming the user is an admin
        // // Example resource to access
        // $requestedResource = 'report_generation';
        // // Check if the user's role has permission to access the requested resource
        // if (array_key_exists($userRole, $roles) && in_array($requestedResource, $roles[$userRole])) {
        //     // User has permission to access the resource
        //    $result = '1';
        // } else {
        //     // User does not have permission to access the resource
        //     $result = '0';
        // }
        return $result;
    }
    //
    public function getReportDetails($id)
    {

        $sql = "SELECT * FROM `tbl_testing` WHERE `id` =  $id ";
        $result = $this->db->getCustomRows($sql, "single");
        $logs_result = $this->fetchallDetails('tbl_testing_logs', 'testing_id', $result['id']);
        $logs = $logs_result[0];
        $array1 = array_filter(json_decode($result['otherlabel']));
        $array2 = array_filter(json_decode($result['othervalue']));
        $otherInfo = array_combine($array1, $array2);

        //
        $notes = json_decode($result['notes']);
        $n=1;
        foreach ($notes  as $notekey =>  $value) {
            $notes_Symbol = $this->getDetails('tbl_notes', 'name', 'id', $value);
            $notes_result = $this->getDetails('tbl_notes', 'description', 'id', $value);
            $note[] = array("sno" =>$n++ ,"notes_Symbol"=>$notes_Symbol,"notes_result"=>$notes_result);
        }
        //
        $sampleMethod = $this->fetchDetailsSelect('tbl_sampling_method', 'id', $result['sample_method_id']);
        $testGroup = $this->fetchDetailsSelect('tbl_test_group', 'id', $result['test_grp_id']);
        $standardTest = $this->fetchDetailsSelect('tbl_standard_test_type', 'id', $result['standard_test_id']);
        $material_Group = $this->fetchDetailsSelect('tbl_material', 'id', $result['material_id']);
        $materialCategory = $this->fetchDetailsSelect('tbl_material_category', 'id', $result['material_grp_id']);
        $sampleName = $this->fetchDetailsSelect('tbl_material_item', 'id', $result['sample_id']);

        $data = array("id"=>$result['id'],"sample_name"=>$sampleName,"sample_code"=>$result['sample_code'],"sampling_date"=>date("d-m-Y", strtotime($result['sampling_date'])),"sampling_receive_date"=>date("d-m-Y", strtotime($result['sampling_receive_date'])),"sample_quantity"=>$result['sample_quantity'],"test_category_id"=>$result['test_category_id'],"test_start_date"=>$result['test_start_date'],"test_end_date"=>date("d-m-Y", strtotime($result['test_end_date'])),"temp"=>$result['temp'],"humidity"=>$result['humidity'],"sampling_condition"=>$result['sampling_condition'],"test_grp_id"=>$testGroup,"standard_test_id"=>$standardTest,"material_id"=>$material_Group,"material_grp_id"=>$materialCategory,"sample_method_id"=>$sampleMethod,"assign_from"=>$result['assign_from'],"issued_to"=>$result['issued_to'],"test_number"=>$result['test_number'],"report_date"=>$result['report_date'],"report_number"=>$result['report_number'],"notes"=>$note,"otherInfo"=>$otherInfo,"is_notes"=>$result['is_notes'],"approve_date"=>date("d-m-Y", strtotime($logs['approve_date'])),"description"=>$logs['description']);

        // echo '<pre>';
        // print_r($data);
        // exit;
        return $data;
    }
    //
}
