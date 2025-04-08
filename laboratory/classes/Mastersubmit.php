<?php
/**
 * Report Class
 */
class Mastersubmit
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
    public function demoSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_demo` WHERE `name`='" . $requestData["name"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"]
                    );
                    $runQuery = $this->db->appInsert("tbl_demo", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_demo` WHERE `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"]
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_demo", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    // getDemoFormEdit
    public function getFormEdit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "tbl_demo":
                $sql = "SELECT `id`, `name` FROM `tbl_demo` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_user_type":
                $sql = "SELECT `id`, `name` FROM `tbl_user_type` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_material_category":
                $sql = "SELECT `id`, `name`, `comment`, `material_id` FROM `tbl_material_category` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_test_category":
                $sql = "SELECT `id`, `name`, `comment` FROM `tbl_test_category` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_material_item":
                $sql = "SELECT `id`, `mateial_category_id`, `name`, `comment` FROM `tbl_material_item` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "users":
                $sql = "SELECT `id`, `username`, `user_type_id`, `emp_no`, `company_name`, `emp_name`,`email`,`gender`,`phone_no`,`mobile_no`,`communication_address`,`permanent_address`,`photo` FROM `users` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_product_category":
                $sql = "SELECT `id`, `name`, `comment` FROM `tbl_product_category` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_material":
                $sql = "SELECT `id`, `name`, `comment` FROM `tbl_material` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_stp":
                $sql = "SELECT `id`, `test_parameters`, `testing_protocols`,`uploaded_files`,`uploaded_images` FROM `tbl_stp` WHERE `id`='" . $requestData["id"] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $para = $result['test_parameters'];
                $proto = $result['testing_protocols'];
                $files = unserialize($result['uploaded_files']);
                $v = [];
                foreach ($files as $key => $value) {
                    $v[] = $value;
                }
                $filesnew = unserialize($result['uploaded_images']);
                $v2 = [];
                foreach ($filesnew as $key => $value) {
                    $v2[] = $value;
                }
                $row = array($para, $proto, $v, $v2);
                break;
            case "gettype":
                $sql = "SELECT `id`, `name`,`comment` FROM `tbl_standard_test_type` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_test_group":
                $sql = "SELECT `id`, `name`,`test_category_id`,`comment` FROM `tbl_test_group` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            case "tbl_notes":
                $sql = "SELECT `id`, `name`, `description` FROM `tbl_notes` WHERE `id`='" . $requestData["id"] . "'";
                $row = $this->db->getCustomRows($sql, "single");
                break;
            default:
                $row = array();
        }
        echo json_encode($row);
    }
    //
    public function getFormDelete(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        $conditions = array(
            "id" => $requestData["id"],
        );
        switch ($form_action) {
            case "tbl_demo":
                $row = $this->db->appDelete('tbl_demo', $conditions);
                break;
            case "tbl_user_type":
                $row = $this->db->appDelete('tbl_user_type', $conditions);
                break;
            case "users":
                $row = $this->db->appDelete('users', $conditions);
                break;
            case "tbl_testing":
                $row = $this->db->appDelete('tbl_testing', $conditions);
                break;
            case "tbl_test_category":
                $row = $this->db->appDelete('tbl_test_category', $conditions);
                break;
            case "tbl_test_group":
                $row = $this->db->appDelete('tbl_test_group', $conditions);
                break;
            case "tbl_material_category":
                $row = $this->db->appDelete('tbl_material_category', $conditions);
                break;
            case "tbl_material_item":
                $row = $this->db->appDelete('tbl_material_item', $conditions);
                break;
            case "tbl_standard_test_type":
                $row = $this->db->appDelete('tbl_standard_test_type', $conditions);
                break;
            case "tbl_stp":
                $row = $this->db->appDelete('tbl_stp', $conditions);
                break;
            case "tbl_product_category":
                $row = $this->db->appDelete('tbl_product_category', $conditions);
                break;
            case "notes_delete":
                $row = $this->db->appDelete('tbl_notes', $conditions);
                break;
            case "tbl_material":
                $row = $this->db->appDelete('tbl_material', $conditions);
                break;
                // case "tbl_testing":
                //     $row = $this->db->appDelete('tbl_testing', $conditions);
                //     break;
            default:
                $row = array();
        }
        if ($row) {
            $outStatus = 'success';
            $outTitle = 'Form Delete';
            $outMessage = 'Data Deleted successfully.';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function typeSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        // print_r($loginUserId);
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_user_type` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "created_by" => 1
                    );
                    $runQuery = $this->db->appInsert("tbl_user_type", $insertData);
                    // print_r($runQuery);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_user_type` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_user_type", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    //
    public function reVerifyTest(array $inputData)
    {
        $requestData = $inputData["request"];
        $updateData = array(
            "is_completed" => 0
        );
        $where = array(
            "id" => $requestData["id"],
        );
        $runQuery = $this->db->appUpdate("tbl_testing", $updateData, $where);
        if ($runQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data Updated successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function matcatSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_category` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "' AND `material_id`='" . $requestData["mat"] . "' ";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "material_id" => $requestData["mat"],
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $runQuery = $this->db->appInsert("tbl_material_category", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_category` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "material_id" => $requestData["mat"],
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_material_category", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function matSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $runQuery = $this->db->appInsert("tbl_material", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_material", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function testcategorySubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_category` WHERE `is_active`=1 AND  `name`='" . $this->db->sqlescape($requestData["name"]) . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $runQuery = $this->db->appInsert("tbl_test_category", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_category` WHERE `is_active`=1 AND `name`='" . $this->db->sqlescape($requestData["name"]) . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_test_category", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
        //echo 'true';
    }
    //
    public function matitemSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "mateial_category_id" => $requestData["select_name"],
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $runQuery = $this->db->appInsert("tbl_material_item", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "mateial_category_id" => $requestData["select_name"],
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_material_item", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function userSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        // $fileData = $inputData["file"]['photo'];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `users` WHERE `is_active`=1 AND `username`='" . $requestData["username"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    // $attachmentFileTypes = array('jpeg', 'jpg', 'png', 'pdf');
                    // $attachmentFileSize = 1024*1024*5;
                    // $dataResult =  $this->documentUpload($fileData,'upload', $attachmentFileTypes, $attachmentFileSize, $fileData['name']);
                    // // print_r($dataResult);
                    $insertData = array(
                        // "id" => $requestData["select_name"],
                        "username" => $requestData["username"],
                        "password" => $this->db->hash_password($requestData["password"]),
                        "user_type_id" => $requestData["user_type"],
                        "emp_no" => $requestData["emp_no"],
                        // "company_name" => $requestData["company_name"],
                        "emp_name" => $requestData["emp_name"],
                        "communication_address" => $requestData["communication_address"],
                        "permanent_address" => $requestData["permanent_address"],
                        "gender" => $requestData["gender"],
                        "phone_no" => $requestData["phone_no"],
                        "mobile_no" => $requestData["mobile_no"],
                        "email" => $requestData["email"]
                    );
                    // $insertData = array_filter($insertDataArray);
                    $runQuery = $this->db->appInsert("users", $insertData);
                    // print_r($runQuery);
                    // exit;
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `users` WHERE `is_active`=1 AND `username`='" . $requestData["username"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        // "id" => $requestData["id"],
                        "username" => $requestData["username"],
                        "password" => $this->db->hash_password($requestData["password"]),
                        "user_type_id" => $requestData["user_type"],
                        "emp_no" => $requestData["emp_no"],
                        "company_name" => $requestData["company_name"],
                        "emp_name" => $requestData["emp_name"],
                        "communication_address" => $requestData["communication_address"],
                        "permanent_address" => $requestData["permanent_address"],
                        "gender" => $requestData["gender"],
                        "phone_no" => $requestData["phone_no"],
                        "mobile_no" => $requestData["mobile_no"],
                        "email" => $requestData["email"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("users", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function updateProfile(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData['form_action'];
        switch ($form_action) {
            case 'updatePassword':
                $sql = "SELECT `password` FROM `users` WHERE `is_active`=1 AND `id`= '" . $_SESSION['userId'] . "'";
                $userData = $this->db->getCustomRows($sql, "single");
                $hash = $userData["password"];
                $password = $requestData["oldPassword"];
                if ($this->db->verifyPasswordHash($password, $hash)) {
                    $updateData = array(
                        "password" => $this->db->hash_password($requestData["newPassword"])
                    );
                    $where = array(
                        "id" => $_SESSION['userId'],
                    );
                    $runQuery = $this->db->appUpdate("users", $updateData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Password Changed successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                } else {
                    $outStatus = 'failed';
                    $outTitle = "Form Detail";
                    $outMessage = 'Password Mismatching';
                }
                break;
            default;
                $sql = "SELECT COUNT(`id`) as `total` FROM `users` WHERE `is_active`=1 AND `username`='" . $requestData["username"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $updateData = array(
                        // "id" => $requestData["id"],
                        "emp_name" => $requestData["username"],
                        // "password" => $requestData["password"],
                        // "user_type_id" => $requestData["user_type"],
                        // "emp_no" => $requestData["emp_no"],
                        // "company_name" => $requestData["company_name"],
                        // "emp_name" => $requestData["emp_name"],
                        // "communication_address" => $requestData["communication_address"],
                        // "permanent_address" => $requestData["permanent_address"],
                        // "gender" => $requestData["gender"],
                        // "phone_no" => $requestData["phone_no"],
                        "mobile_no" => $requestData["mobile_no"],
                        "username" => $requestData["email"],
                        "email" => $requestData["email"]
                    );
                    $where = array(
                        "id" => $_SESSION['userId'],
                    );
                    $runQuery = $this->db->appUpdate("users", $updateData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function documentUpload($uploadFile, $assetFolder, $attachmentFileTypes, $attachmentFileSize, $documentName)
    {
        $error = "";
        $data = "";
        if (isset($uploadFile) && !empty($uploadFile)) {
            if (!file_exists("../assets/$assetFolder")) {
                mkdir("../assets/$assetFolder", 0755, true);
            }
            $files = $uploadFile;
            if ($files['name']) {
                // $files = $filesarr['name'];
                $file = array(
                    'name' => $files['name'],
                    'type' => strtolower(pathinfo($files['name'], PATHINFO_EXTENSION)),
                    'tmp_name' => $files['tmp_name'],
                    'error' => $files['error'],
                    'size' => $files['size']
                );
                $attachmentResult = $this->attachmentValidation($file, $attachmentFileTypes, $attachmentFileSize);
                if ($attachmentResult == "") {
                    //  move_uploaded_file($file["tmp_name"], "../$assetFolder/".$file["name"]);
                    if (!move_uploaded_file($file["tmp_name"], "../assets/$assetFolder/" . $file["name"])) {
                        $error .= $documentName . ' ' . $file["error"] . "<br>";
                    } else {
                        $data = $file["name"];
                    }
                } else {
                    $error .= $documentName . '' . $attachmentResult . "<br>";
                }
            } else {
                $error .= $documentName . ' is missing';
            }
        } else {
            $error .= $documentName . ' is missing';
        }
        return array($error, $data);
    }
    //
    public function attachmentValidation($file, $fileTypesAllowed, $fileSizeAllowed)
    {
        $error = "";
        if (!in_array($file["type"], $fileTypesAllowed)) {
            $error .= "type should be either " . implode(", ", $fileTypesAllowed) . "<br>";
        }
        if ($file["size"] >= $fileSizeAllowed) {
            $error .= "size should be less than " . ($fileSizeAllowed / (1024 * 1024)) . " MB<br>";
        }
        return $error;
    }
    //
    public function gettestcat(array $inputData)
    {
        if (isset($_POST['test_category_id']) && !empty($_POST['test_category_id'])) {
            $sql = "SELECT * FROM tbl_test_group WHERE test_category_id = " . $_POST['test_category_id'];
            $result = $this->db->getCustomRows($sql);
            echo '<option value="">Select Group</option>';
            foreach ($result as $row) {
                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
        }
    }
    //
    public function getmatcat(array $inputData)
    {
        if (isset($_POST['mateial_category_id']) && !empty($_POST['mateial_category_id'])) {
            $sql = "SELECT * FROM tbl_material_item WHERE `is_active`=1 AND mateial_category_id = " . $_POST['mateial_category_id'];
            $result = $this->db->getCustomRows($sql);
            echo '<option value="">Select Item</option>';
            foreach ($result as $row) {
                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
        }
    }
    public function getMaterialCategory(array $inputData)
    {
        $sql = "SELECT * FROM tbl_material_category WHERE `is_active`=1 AND material_id = " . $_POST['materialGroupId'];
        $result = $this->db->getCustomRows($sql);
        echo '<option value="">---Select---</option>';
        foreach ($result as $row) {
            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
    }
    //
    public function getMaterialItem(array $inputData)
    {
        $sql = "SELECT * FROM `tbl_material_item` WHERE `is_active`=1 AND `mateial_category_id` = " . $_POST['materialCategoryId'];
        $result = $this->db->getCustomRows($sql);
        echo '<option value="">--Select--</option>';
        foreach ($result as $row) {
            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
    }
    //
    // public function mattestsubmit(array $inputData)
    // {
    //     $requestData = $inputData["request"];
    //     $form_action = $requestData["form_action"];
    //     switch ($form_action) {
    //         case "insert":
    //             /*$sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_test` WHERE `discipline_id`='".$requestData["discipline"]."';";
    //             $countData = $this->db->getCustomRows($sql, "single");
    //             if($countData["total"]>0){
    //                 $outStatus = 'failed';
    //                 $outTitle = "Exists";
    //                 $outMessage = 'Already Exists!';
    //             }
    //             else{ */
    //             $insertData = array(
    //                 "discipline_id" => $requestData["discipline"],
    //                 "group_id" => $requestData["group"],
    //                 "material_category_id" => $requestData["matcat"],
    //                 "material_item_id" => $requestData["matitem"],
    //                 "standard_id" => $requestData["standard"],
    //                 "created_by" => 1
    //             );
    //             $runQuery = $this->db->appInsert("tbl_material_test", $insertData);
    //             if (!file_exists("../assets/uploads")) {
    //                 mkdir("../assets/uploads", 0755, true);
    //             }
    //             /*$countfiles = count($_FILES['file']['name']);
    //             $totalFileUploaded = 0;
    //             for($i=0;$i<$countfiles;$i++){
    //                 $filename = 'document_'.$i. '.pdf';
    //                 //  echo 'doc_'.$i. '.pdf';
    //                 //  $filename = $_FILES['file']['name'][$i];
    //                 ## Location
    //                 $location = "../assets/uploads/".$filename;
    //                 $extension = pathinfo($location,PATHINFO_EXTENSION);
    //                 $extension = strtolower($extension);
    //                 ## File upload allowed extensions
    //                 $valid_extensions = array("jpg","jpeg","png","pdf","docx");
    //                 $response = 0;
    //                 ## Check file extension
    //                 if(in_array(strtolower($extension), $valid_extensions)) {
    //                     ## Upload file
    //                     if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$location)){
    //                         $totalFileUploaded++;
    //                     }
    //                 }
    //             }*/
    //             //
    //             if ($runQuery) {
    //                 if (is_array($requestData['test'])) {
    //                     $insid = $this->db->sqlinsertid();
    //                     foreach ($requestData['test'] as $key => $value) {
    //                         $insertFormData = array(
    //                             "material_test_id" => $insid,
    //                             "test_param" => $value,
    //                             "testing_protocol" => $requestData["proto"][$key],
    //                             "text_value" => $requestData["value"][$key],
    //                             "unit" => $requestData["unit"][$key],
    //                             "specification" => $requestData["spec"][$key]
    //                         );
    //                         if (isset($_FILES)) {
    //                             if (isset($_FILES['file']['name'][$key])) {
    //                                 $fileName = $_FILES['file']['name'][$key];
    //                                 $tmp = explode('.', $fileName);
    //                                 $file_ext = end($tmp);
    //                                 $filename = 'document_' . $key . '_' . date("YmdHis") . '_' . rand(0000, 1111) . '.' . $file_ext;
    //                                 $location = "../assets/uploads/" . $filename;
    //                                 ## File upload allowed extensions
    //                                 $valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");
    //                                 $extension = pathinfo($location, PATHINFO_EXTENSION);
    //                                 $extension = strtolower($extension);
    //                                 $response = 0;
    //                                 ## Check file extension
    //                                 if (in_array(strtolower($extension), $valid_extensions)) {
    //                                     ## Upload file
    //                                     if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $location)) {
    //                                         $insertFormData["doc"] = $filename;
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                         $formQuery = $this->db->appInsert("tbl_material_test_item", $insertFormData);
    //                         if ($formQuery) {
    //                             $outStatus = 'success';
    //                             $outTitle = 'Form Detail';
    //                             $outMessage = 'Data added successfully.';
    //                         } else {
    //                             $outStatus = 'failed';
    //                             $outTitle = "Form Detail";
    //                             $outMessage = 'Data failed';
    //                         }
    //                     }
    //                 } else {
    //                     $outStatus = 'failed';
    //                     $outTitle = "Form Detail";
    //                     $outMessage = 'Data failed: test_param is not an array';
    //                 }
    //             } else {
    //                 $outStatus = 'failed';
    //                 $outTitle = "Form Detail";
    //                 $outMessage = 'Data failed';
    //             }
    //             //}
    //             break;
    //         default:
    //             $outStatus = 'failed';
    //             $outTitle = "Form Detail";
    //             $outMessage = 'Datassss failed';
    //     }
    //     $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
    //     echo json_encode($data, true);
    // }
    //
    public function mattestsubmit(array $inputData)
{
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    try {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];

        switch ($form_action) {
            case "insert":
                $id = $requestData["mid"];
                $testgroup = $requestData["testgroup"];
                $sample_id = $requestData["matitem"];
                $standardTestId = $requestData["standardTestId"];
                $group_name = $requestData["group_name"];
                $parameters = $requestData["parameters"];
                $protocol = $requestData["protocols"];
                $specification = $requestData["specification"];
                $text = $requestData["text"];
                $unit = $requestData["unit"];

                $temArry_iss = $itemArray_iss = [];
                foreach ($parameters as $key => $value) {
                    $temArry_iss['mid'] = $id[$key];
                    $temArry_iss['testgroup'] = $testgroup;
                    $temArry_iss['s_id'] = $sample_id;
                    $temArry_iss['standardTestId'] = $standardTestId;
                    $temArry_iss['group_name'] = $group_name[$key];
                    $temArry_iss['parameters'] = $value;
                    $temArry_iss['protocols'] = $protocol[$key];
                    $temArry_iss['specification'] = $specification[$key];
                    $temArry_iss['text'] = $text[$key];
                    $temArry_iss['unit'] = $unit[$key];
                    $itemArray_iss[$key] = $temArry_iss;
                }
                //
                foreach ($itemArray_iss as $value) {
                    $insertData = array(
                        "test_grp_id" => $testgroup,
                        "sample_id" => $sample_id,
                        "standard_test_id" => $standardTestId,
                        "group_name" => $value['group_name'],
                        "parameters" => $value['parameters'],
                        "protocols" => $value["protocols"],
                        "specification" => $value["specification"],
                        "text" => $value["text"],
                        "unit" => $value["unit"]
                    );

                    $getgrpcountstp = "SELECT COUNT(*) as count FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "' AND `testing_protocols`='" . $value['protocols'] . "' AND `is_active`=1";
                    $grprowcountstp = $this->db->getCustomRows($getgrpcountstp, "single");
                    if ($grprowcountstp['count'] == 0) {
                        $insertgrpstp = array(
                            "group_name" => $value['group_name']
                        );
                        $grpwherestp = array(
                            "test_parameters" => $value['parameters'],
                            "testing_protocols" => $value['protocols']
                        );
                        $runQuerygrp = $this->db->appUpdate("tbl_stp", $insertgrpstp, $grpwherestp);
                    }

                    $getgrpcount = "SELECT COUNT(*) as count FROM `tbl_format_category` WHERE `name`='" . $value['group_name'] . "' AND `is_active`=1";
                    $grprowcount = $this->db->getCustomRows($getgrpcount, "single");
                    if ($grprowcount['count'] == 0 && !empty($value['group_name'])) {
                        $insertgrp = array(
                            "name" => $value['group_name']
                        );
                        $this->db->appInsert("tbl_format_category", $insertgrp);
                    }

                    if (!empty($value['parameters'])) {
                        $runQuery = $this->db->appInsert("tbl_material_format", $insertData);

                        $sqlcount = "SELECT COUNT(*) as COUNT FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "' AND `testing_protocols`='" . $value['protocols'] . "' AND `is_active`=1";
                        $rowcount = $this->db->getCustomRows($sqlcount, "single");
                        if ($rowcount['count'] == 0) {
                            $insertData2 = array(
                                "test_parameters" => $value['parameters'],
                                "testing_protocols" => $value['protocols']
                            );
                            $runQueryinsert = $this->db->appInsert("tbl_stp", $insertData2);
                        }
                    }
                }

                if ($runQuery) {
                    $outStatus = 'success';
                    $outTitle = 'Form Detail';
                    $outMessage = 'Data added successfully.';
                } else {
                    $outStatus = 'failed';
                    $outTitle = "Form Detail";
                    $outMessage = 'Data failed';
                }
                break;

            case "update":
                $id = $requestData["mid"];
                $mid = $requestData["mid"];
                $testgroup = $requestData["testgroup"];
                $sample_id = $requestData["matitem"];
                $standardTestId = $requestData["standardTestId"];
                $group_name = $requestData["group_name"];
                $parameters = $requestData["parameters"];
                $protocol = $requestData["protocols"];
                $specification = $requestData["specification"];
                $text = $requestData["text"];
                $unit = $requestData["unit"];

                $id = array_filter($id);
                $arr = implode(',', $id);

                // $arr = substr($tags, 1);
                $sqll = "UPDATE `tbl_material_format` SET `is_active`='0',`is_deleted`='1' WHERE id NOT IN($arr) AND `test_grp_id` = $testgroup AND `sample_id` = $sample_id AND `standard_test_id` = $standardTestId";
                $resultl = $this->db->getCustomRows($sqll);

                $temArry_iss = $itemArray_iss = [];
                foreach ($parameters as $key => $value) {
                    $temArry_iss['mid'] = $mid[$key];
                    $temArry_iss['testgroup'] = $testgroup;
                    $temArry_iss['s_id'] = $sample_id;
                    $temArry_iss['standardTestId'] = $standardTestId;
                    $temArry_iss['group_name'] = $group_name[$key];
                    $temArry_iss['parameters'] = $value;
                    $temArry_iss['protocols'] = $protocol[$key];
                    $temArry_iss['specification'] = $specification[$key];
                    $temArry_iss['text'] = $text[$key];
                    $temArry_iss['unit'] = $unit[$key];
                    $itemArray_iss[$key] = $temArry_iss;
                }


                foreach ($itemArray_iss as $value) {
                    if (!empty($value['mid']) && !empty($value['parameters'])) {
                        $updateData = array(
                            "test_grp_id" => $testgroup,
                            "sample_id" => $sample_id,
                            "standard_test_id" => $standardTestId,
                            "group_name" => $value['group_name'],
                            "parameters" => $value['parameters'],
                            "protocols" => $value["protocols"],
                            "specification" => $value["specification"],
                            "text" => $value["text"],
                            "unit" => $value["unit"]
                        );

                        $where = array(
                            "id" => $value['mid'],
                            "is_active" => 1
                        );

                        if (!empty($value['parameters'])) {
                            $runQueryUpdate = $this->db->appUpdate("tbl_material_format", $updateData, $where);
                            $sqlcount = "SELECT COUNT(*) as COUNT FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "' AND `testing_protocols`='" . $value['protocols'] . "'";
                            $rowcount = $this->db->getCustomRows($sqlcount, "single");

                            if ($rowcount['COUNT'] == 0) {
                                $insertData2 = array(
                                    "test_parameters" => $value['parameters'],
                                    "testing_protocols" => $value['protocols']
                                );
                                $runQueryinsert = $this->db->appInsert("tbl_stp", $insertData2);
                            }
                        }

                        $getgrpcountstp = "SELECT COUNT(*) as count FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "' AND `testing_protocols`='" . $value['protocols'] . "' AND `is_active`=1";
                        $grprowcountstp = $this->db->getCustomRows($getgrpcountstp, "single");
                        if ($grprowcountstp['count'] == 0) {
                            $insertgrpstp = array(
                                "group_name" => $value['group_name']
                            );
                            $grpwherestp = array(
                                "test_parameters" => $value['parameters'],
                                "testing_protocols" => $value['protocols']
                            );
                            $this->db->appUpdate("tbl_stp", $insertgrpstp, $grpwherestp);
                        }

                        $getgrpcount = "SELECT COUNT(*) as count FROM `tbl_format_category` WHERE `name`='" . $value['group_name'] . "' AND `is_active`=1";
                        $grprowcount = $this->db->getCustomRows($getgrpcount, "single");
                        if ($grprowcount['count'] == 0 && !empty($value['group_name'])) {
                            $insertgrp = array(
                                "name" => $value['group_name']
                            );
                            $this->db->appInsert("tbl_format_category", $insertgrp);
                        }
                    }

                    if (empty($value['mid'])) {
                        $insertData = array(
                            "test_grp_id" => $testgroup,
                            "sample_id" => $sample_id,
                            "standard_test_id" => $standardTestId,
                            "group_name" => $value['group_name'],
                            "parameters" => $value['parameters'],
                            "protocols" => $value["protocols"],
                            "specification" => $value["specification"],
                            "text" => $value["text"],
                            "unit" => $value["unit"]
                        );
                        $where = array(
                            "id" => $value['mid'],
                            "is_active" => 1
                        );

                        $runQueryinsert = null; // Initialize the variable to avoid undefined variable warning

                        if (!empty($value['parameters'])) {
                            $runQueryinsert = $this->db->appInsert("tbl_material_format", $insertData);
                            $sqlcount = "SELECT COUNT(*) as COUNT FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "' AND `testing_protocols`='" . $value['protocols'] . "'";
                            $rowcount = $this->db->getCustomRows($sqlcount, "single");
                            if ($rowcount['COUNT'] == 0) {
                                $insertData2 = array(
                                    "test_parameters" => $value['parameters'],
                                    "testing_protocols" => $value['protocols']
                                );
                                $runQueryinsert = $this->db->appInsert("tbl_stp", $insertData2);
                            }
                        }
                        
                    }
                }

                if ($runQueryUpdate || $runQueryinsert || $resultl) {
                    $outStatus = 'success';
                    $outTitle = 'Form Detail';
                    $outMessage = 'Data added successfully.';
                } else {
                    $outStatus = 'failed';
                    $outTitle = "Form Detail";
                    $outMessage = 'Data failed';
                }
                break;

            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Invalid form action';
        }
    } catch (Exception $e) {
        $outStatus = 'failed';
        $outTitle = "Form Detail";
        $outMessage = 'Error: ' . $e->getMessage();
    }

    $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
    echo json_encode($data, true);
}

//     public function mattestsubmit(array $inputData)
//     {
//         $requestData = $inputData["request"];

//         $form_action = $requestData["form_action"];
//         switch ($form_action) {
//             case "insert":
//                 $id = $requestData["mid"];
//                 $testgroup = $requestData["testgroup"];
//                 $sample_id = $requestData["matitem"];
//                 $standardTestId = $requestData["standardTestId"];
//                 $group_name = $requestData["group_name"];
//                 $parameters = $requestData["parameters"];
//                 $protocol = $requestData["protocols"];
//                 $specification = $requestData["specification"];
//                 $text = $requestData["text"];
//                 $unit = $requestData["unit"];
//                 // $remark = $requestData["remark"];
//                 $temArry_iss = $itemArray_iss = [];
//                 foreach ($parameters as $key => $value) {
//                     $temArry_iss['mid'] = $id[$key];
//                     //$temArry_iss['mid'] = $id[$key];
//                     $temArry_iss['testgroup'] = $testgroup;
//                     $temArry_iss['s_id'] = $sample_id;
//                     $temArry_iss['standardTestId'] = $standardTestId;
//                     $temArry_iss['group_name'] = $group_name[$key];
//                     $temArry_iss['parameters'] = $value;
//                     $temArry_iss['protocols'] = $protocol[$key];
//                     $temArry_iss['specification'] = $specification[$key];
//                     $temArry_iss['text'] = $text[$key];
//                     $temArry_iss['unit'] = $unit[$key];
//                     // $temArry_iss['remark'] = $remark[$key];
//                     $itemArray_iss[$key] = $temArry_iss;
//                 }
//                 foreach ($itemArray_iss as $value) {
//                     $insertData = array(
//                         "test_grp_id" => $testgroup,
//                         "sample_id" => $sample_id,
//                         "standard_test_id" => $standardTestId,
//                         "group_name" => $value['group_name'],
//                         "parameters" => $value['parameters'],
//                         "protocols" => $value["protocols"],
//                         "specification" => $value["specification"],
//                         "text" => $value["text"],
//                         "unit" => $value["unit"]
//                         // "remark" => $value["remark"]
//                     );
//                     //
//                     $getgrpcountstp = "SELECT COUNT(*) as count FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "'  AND `testing_protocols`='" . $value['protocols'] . "' AND `is_active`=1  ";
//                     $grprowcountstp = $this->db->getCustomRows($getgrpcountstp, "single");
//                     if($grprowcountstp['count'] == 0){
//                         $insertgrpstp = array(
//                             "group_name" => $value['group_name']
//                         );
//                         $grpwherestp = array(
//                             "test_parameters" => $value['parameters'],
//                             "testing_protocols" => $value['protocols']
//                         );
//                             $runQuerygrp = $this->db->appUpdate("tbl_stp", $insertgrpstp, $grpwherestp);
//                     }
//                     //
//                     $getgrpcount = "SELECT COUNT(*) as count FROM `tbl_format_category` WHERE `name`='" . $value['group_name'] . "' AND `is_active`=1  ";
//                     $grprowcount = $this->db->getCustomRows($getgrpcount, "single");
//                     if($grprowcount['count'] == 0 && !empty($value['group_name'])){
//                         $insertgrp = array(
//                             "name" => $value['group_name']
//                         );
                    
//                              $this->db->appInsert("tbl_format_category", $insertgrp);
//                     }
// //
//                     if (!empty($value['parameters'])) {
//                         $runQuery = $this->db->appInsert("tbl_material_format", $insertData);
// // // // // // // //
//                         $sqlcount = "SELECT COUNT(*) as COUNT FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "'  AND `testing_protocols`='" . $value['protocols'] . "' AND `is_active`=1 ";
//                         $rowcount = $this->db->getCustomRows($sqlcount, "single");
//                         if($rowcount['count'] == 0){
//                             $insertData2 = array(
//                                 "test_parameters" => $value['parameters'],
//                                 "testing_protocols" => $value['protocols']
//                             );
//                                 $runQueryinsert = $this->db->appInsert("tbl_stp", $insertData2);
//                                 }
//                             }
//                             }
//                 if ($runQuery) {
//                     $outStatus = 'success';
//                     $outTitle = 'Form Detail';
//                     $outMessage = 'Data added successfully.';
//                 } else {
//                     $outStatus = 'failed';
//                     $outTitle = "Form Detail";
//                     $outMessage = 'Data failed';
//                 }
//                 break;
//             case "update":
//                 $id = $requestData["mid"];
//                 $testgroup = $requestData["testgroup"];
//                 $sample_id = $requestData["matitem"];
//                 $standardTestId = $requestData["standardTestId"];
//                 $group_name = $requestData["group_name"];
//                 $parameters = $requestData["parameters"];
//                 $protocol = $requestData["protocols"];
//                 $specification = $requestData["specification"];
//                 $text = $requestData["text"];
//                 $unit = $requestData["unit"];
//                 //
//                 $tags = implode(', ', $id);
//                 $arr = substr($tags, 1);
//                 $sqll = "UPDATE `tbl_material_format` SET `is_active`='0',`is_deleted`='1' WHERE id NOT IN($arr) AND `test_grp_id` = $testgroup AND `sample_id` = $sample_id AND `standard_test_id` = $standardTestId ";
//                 $resultl = $this->db->getCustomRows($sqll);
//                 // print_r($arr);
//                 //
//                 // $remark = $requestData["remark"];
//                 $temArry_iss = $itemArray_iss = [];
//                 foreach ($parameters as $key => $value) {
//                     // exit;
//                     $temArry_iss['mid'] = $id[$key];
//                     //$temArry_iss['mid'] = $id[$key];
//                     $temArry_iss['testgroup'] = $testgroup;
//                     $temArry_iss['s_id'] = $sample_id;
//                     $temArry_iss['standardTestId'] = $standardTestId;
//                     $temArry_iss['group_name'] = $group_name[$key];
//                     $temArry_iss['parameters'] = $value;
//                     $temArry_iss['protocols'] = $protocol[$key];
//                     $temArry_iss['specification'] = $specification[$key];
//                     $temArry_iss['text'] = $text[$key];
//                     $temArry_iss['unit'] = $unit[$key];
//                     // $temArry_iss['remark'] = $remark[$key];
//                     $itemArray_iss[$key] = $temArry_iss;
//                 }
//                 foreach ($itemArray_iss as $value) {
//                     if (!empty($value['mid']) && !empty($value['parameters'])) {
//                         $updateData = array(
//                             "test_grp_id" => $testgroup,
//                             "sample_id" => $sample_id,
//                             "standard_test_id" => $standardTestId,
//                             "group_name" => $value['group_name'],
//                             "parameters" => $value['parameters'],
//                             "protocols" => $value["protocols"],
//                             "specification" => $value["specification"],
//                             "text" => $value["text"],
//                             "unit" => $value["unit"]
//                             // "remark" => $value["remark"]
//                         );
                        
//                         $where = array(
//                             "id" => $value['mid'],
//                             "is_active" => 1
//                         );
//                         if (!empty($value['parameters'])) {
//                             $runQueryUpdate = $this->db->appUpdate("tbl_material_format", $updateData, $where);
//                             $sqlcount = "SELECT COUNT(*) as COUNT FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "'  AND `testing_protocols`='" . $value['protocols'] . "' ";
//                             $rowcount = $this->db->getCustomRows($sqlcount, "single");
//                             if($rowcount['count'] == 0){
//                                 $insertData2 = array(
//                                     "test_parameters" => $value['parameters'],
//                                     "testing_protocols" => $value['protocols']
//                                 );
//                                     $runQueryinsert = $this->db->appInsert("tbl_stp", $insertData2);
//                                     }
//                         }
//  //
//                 $getgrpcountstp = "SELECT COUNT(*) as count FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "'  AND `testing_protocols`='" . $value['protocols'] . "' AND `is_active`=1  ";
//                 $grprowcountstp = $this->db->getCustomRows($getgrpcountstp, "single");
//                 if($grprowcountstp['count'] == 0){
//                     $insertgrpstp = array(
//                         "group_name" => $value['group_name']
//                     );
//                     $grpwherestp = array(
//                         "test_parameters" => $value['parameters'],
//                         "testing_protocols" => $value['protocols']
//                     );
//                        $this->db->appUpdate("tbl_stp", $insertgrpstp, $grpwherestp);
//                 }
//                 //
//                 $getgrpcount = "SELECT COUNT(*) as count FROM `tbl_format_category` WHERE `name`='" . $value['group_name'] . "' AND `is_active`=1  ";
//                 $grprowcount = $this->db->getCustomRows($getgrpcount, "single");
//                 if($grprowcount['count'] == 0 && !empty($value['group_name'])){
//                     $insertgrp = array(
//                         "name" => $value['group_name']
//                     );
                
//                         $this->db->appInsert("tbl_format_category", $insertgrp);
//                 }
     
//                     }
//                     //
//                     if (empty($value['mid'])) {
//                         $insertData = array(
//                             "test_grp_id" => $testgroup,
//                             "sample_id" => $sample_id,
//                             "standard_test_id" => $standardTestId,
//                             "group_name" => $value['group_name'],
//                             "parameters" => $value['parameters'],
//                             "protocols" => $value["protocols"],
//                             "specification" => $value["specification"],
//                             "text" => $value["text"],
//                             "unit" => $value["unit"]
//                             // "remark" => $value["remark"]
//                         );
//                         $where = array(
//                             "id" => $value['mid'],
//                             "is_active" => 1
//                         );
//                         if (!empty($value['parameters'])) {
//                             $runQueryinsert = $this->db->appInsert("tbl_material_format", $insertData);
//                             $sqlcount = "SELECT COUNT(*) as COUNT FROM `tbl_stp` WHERE `test_parameters`='" . $value['parameters'] . "'  AND `testing_protocols`='" . $value['protocols'] . "' ";
//                             $rowcount = $this->db->getCustomRows($sqlcount, "single");
//                             if($rowcount['count'] == 0){
//                                 $insertData2 = array(
//                                     "test_parameters" => $value['parameters'],
//                                     "testing_protocols" => $value['protocols']
//                                 );
//                              $runQueryinsert = $this->db->appInsert("tbl_stp", $insertData2);
//                                     }
//                         }
//                     }
//                 }
//                 if ($runQueryUpdate || $runQueryinsert || $resultl) {
//                     $outStatus = 'success';
//                     $outTitle = 'Form Detail';
//                     $outMessage = 'Data added successfully.';
//                 } else {
//                     $outStatus = 'failed';
//                     $outTitle = "Form Detail";
//                     $outMessage = 'Data failed';
//                 }
//                 break;
//                 //
//             default:
//                 $outStatus = 'failed';
//                 $outTitle = "Form Detail";
//                 $outMessage = 'Data failed';
//         }
//         $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
//         echo json_encode($data, true);
//     }
    //
    // public dateformat($inputData){
    //     $return = date("Y-m-d H:i", strtotime($inputData) );
    //     return $return;
    // }
    //
    public function delete_material_format(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        $sql = "SELECT `id`, `test_grp_id`, `sample_id`, `standard_test_id` FROM `tbl_material_format` WHERE `id`='" . $requestData["id"] . "'";
        $row = $this->db->getCustomRows($sql, "single");
        $updateData = array(
            "is_active" => 0,
            "is_deleted" => 1
        );
        $where = array(
            "test_grp_id" => $row['test_grp_id'],
            "sample_id" => $row['sample_id'],
            "standard_test_id" => $row['standard_test_id']
        );
        $formQuery = $this->db->appUpdate("tbl_material_format", $updateData, $where);
        if ($formQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data Deleted successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    // public function createworksheet(array $inputData)
    // {
    //     $requestData = $inputData["request"];
    //     $form_action = $requestData["form_action"];
    //     $insertFormData = array(
    //         //
    //         "sample_code" => $requestData["sample_code"],
    //         "sampling_receive_date" => date("Y-m-d H:i", strtotime($requestData["sampling_receive_date"])),
    //         "test_start_date" => date("Y-m-d H:i", strtotime($requestData["test_start_date"])),
    //         "test_end_date" => date("Y-m-d H:i", strtotime($requestData["test_end_date"])),
    //         "sample_id" => $requestData['sample_id']
    //     );
    //     $formQuery = $this->db->appInsert("tbl_testing", $insertFormData);
    //     if ($formQuery) {
    //         $outStatus = 'success';
    //         $outTitle = 'Form Detail';
    //         $outMessage = 'Data added successfully.';
    //     } else {
    //         $outStatus = 'failed';
    //         $outTitle = "Form Detail";
    //         $outMessage = 'Data failed';
    //     }
    //     $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
    //     echo json_encode($data, true);     
    // }
    //
    public function testgroup(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        // 15-06-2023 12:00
        // $var = "15-06-2023 12:00";
        // echo date("Y-m-d H:i", strtotime($var) );
        // print_r($requestData);
        // exit;
        //tbl_material
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material` WHERE `is_active`=1 AND `name`='" . $requestData["material_id"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material WHERE `name` = '" . $requestData['material_id'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_id = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_id"]
            );
            $runQuery = $this->db->appInsert("tbl_material", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material WHERE `name` = '" . $requestData['material_id'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_id = $result['id'];
            }
        }
        //tbl_test_category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_category` WHERE `is_active`=1 AND `name`='" . $requestData["test_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_category WHERE `name` = '" . $requestData['test_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["test_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_category WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_category_name = $result['id'];
            }
        }
        //tbl_test_group
        // $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `name`='".$requestData["test_group_name"]."'";
        // $countData = $this->db->getCustomRows($sql, "single");
        // if($countData["total"]>0){
        //    $sql = "SELECT `id` FROM tbl_test_group WHERE `name` = '".$requestData['test_group_name']."'";
        //     $result = $this->db->getCustomRows($sql, "single");
        //     $test_group_name = $result['id'];
        // }else{
        //     $insertData = array(
        //         "name" => $requestData["test_group_name"]
        //     );
        //     $runQuery = $this->db->appInsert("tbl_test_group", $insertData);
        //     if($runQuery){
        //         $sql = "SELECT `id` FROM tbl_test_group WHERE `name` = '".$requestData['test_group_name']."'";
        //         $result = $this->db->getCustomRows($sql, "single");
        //         $test_group_name = $result['id'];
        //      }
        // }
        //tbl_test_category//tbl_test_group//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `is_active`=1 AND  `test_category_id`='" . $test_category_name . "' AND `name`='" . $requestData["test_group_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_group WHERE `name` = '" . $requestData['test_group_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_group_name = $result['id'];
        } else {
            $insertData = array(
                "test_category_id" => $test_category_name,
                "name" => $requestData["test_group_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_group", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_group WHERE `is_active`=1 AND `test_category_id`='" . $test_category_name . "' AND `name` = '" . $requestData['test_group_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_group_name = $result['id'];
            }
        }
        // echo $test_group_name;
        // print_r($test_group_name);
        // exit;
        //Standard Test Type
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_standard_test_type` WHERE `name`='" . $requestData["standard_test_type_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $standard_test_type_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["standard_test_type_name"]
            );
            $runQuery = $this->db->appInsert("tbl_standard_test_type", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $standard_test_type_name = $result['id'];
            }
        }
        //Material Category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_category` WHERE `name`='" . $requestData["material_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_category WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_category WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_category_name = $result['id'];
            }
        }
        //Material Category//Material Item//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name`='" . $requestData["material_sample_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_item WHERE `name` = '" . $requestData['material_sample_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_sample_name = $result['id'];
        } else {
            $insertData = array(
                "mateial_category_id" => $material_category_name,
                "name" => $requestData["material_sample_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_item", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_item WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name` = '" . $requestData['material_sample_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_sample_name = $result['id'];
            }
        }
        //sampling_method
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_sampling_method` WHERE `is_active`=1 AND `name`='" . $requestData["sampling_method"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_sampling_method WHERE `name` = '" . $requestData['sampling_method'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $sampling_method = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["sampling_method"]
            );
            $runQuery = $this->db->appInsert("tbl_sampling_method", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_sampling_method WHERE `is_active`=1 AND `name` = '" . $requestData['sampling_method'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $sampling_method = $result['id'];
            }
        }
        //  $test_category_name;
        //  $test_group_name;
        //  $standard_test_type_name;
        //  $material_category_name;
        //  $material_sample_name;
        //  $sampling_method;
        $otherlabel = json_encode($requestData["otherlabel"], true);
        $othervalue = json_encode($requestData["othervalue"], true);
        // $temArry_iss1 = $itemArray_iss1 = [];
        // foreach ($otherlabel as $key => $value) {
        //     $temArry_iss1['other_label'] = $value;
        //     $temArry_iss1['protocols'] = $othervalue[$key];
        //     // $itemArray_iss1[$key] = $temArry_iss1;
        // }
        // print_r($otherlabel);
        // exit;
        $insertFormData = array(
            //
            "sample_code" => $requestData["sample_code"],
            "sampling_date" => date("Y-m-d H:i", strtotime($requestData["sampling_date"])),
            "sampling_receive_date" => date("Y-m-d H:i", strtotime($requestData["sampling_receive_date"])),
            "sample_quantity" => $requestData["sample_quantity"],
            "issued_to" => $requestData["issued_to"],
            "test_start_date" => date("Y-m-d H:i", strtotime($requestData["test_start_date"])),
            "test_end_date" => date("Y-m-d H:i", strtotime($requestData["test_end_date"])),
            "temp" => $requestData["temp"],
            "humidity" => $requestData["humidity"],
            "sampling_condition" => $requestData["sampling_condition"],
            "assign_from" => $requestData["assign_from"],
            // "chemical_test_res" => $requestData["chemical_test_res"],
            // "micro_test_res" => $requestData["micro_test_res"],
            "test_responsibility" => $requestData["test_responsibility"],
            "test_category_id" => $test_category_name,
            "test_grp_id" => $test_group_name,
            "standard_test_id" => $standard_test_type_name,
            "material_id" => $material_id,
            "material_grp_id" => $material_category_name,
            "sample_id" => $material_sample_name,
            "sample_method_id" => $sampling_method,
            "status" => $requestData["status"],
            "is_retest" => $requestData["is_retest"],
            "is_resample" => $requestData["is_resample"],
            "reference_id" => $requestData["testing_id"],
            "notes" => json_encode($requestData["notes"], true),
            "otherlabel" => $otherlabel,
            "othervalue" => $othervalue,
            "is_completed" => 1,
            "test_number" => "TEST" . -rand(1000, 9999) . -rand(1000, 9999),
            "created_by" => $_SESSION['userId']
        );
        $formQuery = $this->db->appInsert("tbl_testing", $insertFormData);
        if ($formQuery) {
            //
            $sqlmaxid = "SELECT MAX(id) as maxtesting_id FROM tbl_testing";
            $maxid = $this->db->getCustomRows($sqlmaxid, "single");
            $insertDatalog = array(
                "testing_id" => $maxid['maxtesting_id'],
                "prepared_by" => $requestData["assign_from"]
            );
            $runQuery = $this->db->appInsert("tbl_testing_logs", $insertDatalog);
            $sql = "SELECT `id` FROM tbl_testing WHERE `id`='" . $requestData["testing_id"] . "' ";
            $refPrevId = $this->db->getCustomRows($sql, "single");
            //
            $updateData = array(
                "status" => 5
            );
            $where = array(
                "id" => $refPrevId['id'],
            );
            $runQuery = $this->db->appUpdate("tbl_testing", $updateData, $where);
        }
        //
        $id = $requestData["id"];
        $order_by = $requestData["order_by"];
        $parameters = $requestData["parameters"];
        $protocol = $requestData["protocols"];
        $specification = $requestData["specification"];
        $text = $requestData["text"];
        $unit = $requestData["unit"];
        $value1 = $requestData["value"];
        $remark = $requestData["remark"];
        $temArry_iss = $itemArray_iss = [];
        foreach ($parameters as $key => $value) {
            $temArry_iss['id'] = $id[$key];
            // $temArry_iss['id'] = $id[$key];
            $temArry_iss['order_by'] = $order_by[$key];
            $temArry_iss['parameters'] = $value;
            $temArry_iss['protocols'] = $protocol[$key];
            $temArry_iss['specification'] = $specification[$key];
            $temArry_iss['text'] = $text[$key];
            $temArry_iss['unit'] = $unit[$key];
            $temArry_iss['value'] = $value1[$key];
            $temArry_iss['remark'] = $remark[$key];
            $itemArray_iss[$key] = $temArry_iss;
        }
        //
        foreach ($itemArray_iss as $valueitemArray_iss) {
            // if(!empty($value['id'])){
            //     $updateData = array(
            //         "parameters" => $value['parameters'],
            //         "protocols" => $value["protocols"]
            //     );
            //     $where = array(
            //         "id" => $value['id'],
            //         "is_active" => 1                                  
            //     );
            //     $runQuery = $this->db->appUpdate("tbl_material_format",$updateData, $where);
            // }elseif(!empty($value['parameters'])){
            //     $insertData = array(
            //         "parameters" => $value['parameters'],
            //         "protocols" => $value["protocols"]
            //     );
            //     $formQuery = $this->db->appInsert("tbl_material_format", $insertData);
            // }
            if (!empty($valueitemArray_iss['parameters']) && !empty($valueitemArray_iss['value'])) {
                $sql = "SELECT MAX(id) as testing_id FROM tbl_testing WHERE `is_active`=1 ";
                $countData = $this->db->getCustomRows($sql, "single");
                $insertData = array(
                    "testing_id" => $countData['testing_id'],
                    "order_by" => $valueitemArray_iss['order_by'],
                    "parameters" => $valueitemArray_iss['parameters'],
                    "protocols" => $valueitemArray_iss["protocols"],
                    // "head_id" => $this->app->getheadId($valueitemArray_iss['parameters'], $valueitemArray_iss["protocols"]),
                    // "head_id" => '',
                    "specification" => $valueitemArray_iss["specification"],
                    "text" => $valueitemArray_iss["text"],
                    "unit" => $valueitemArray_iss["unit"],
                    "value" => $valueitemArray_iss["value"],
                    "remark" => $valueitemArray_iss["remark"],
                    "created_by" => $_SESSION['userId']
                );
                $formQuery = $this->db->appInsert("tbl_test_material_format", $insertData);
            }
        }
        if ($formQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function getmaterialFormat(array $inputData)
    {
        // if (isset($_POST['mateial_category_id']) && !empty($_POST['mateial_category_id'])) {
        $requestData = $inputData["request"];
        $sql2 = "SELECT `id` FROM `tbl_test_category` WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
        $tbl_test_category = $this->db->getCustomRows($sql2, "single");
        $sql1 = "SELECT `id` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type'] . "'";
        $standardTypeId = $this->db->getCustomRows($sql1, "single");
        $sql1 = "SELECT `id` FROM `tbl_test_group` WHERE `is_active`=1 AND `test_category_id` = '" . $tbl_test_category['id'] . "' AND `name` = '" . $requestData['test_group_name'] . "'";
        $tbl_test_group = $this->db->getCustomRows($sql1, "single");
        $sql = "SELECT `id` FROM `tbl_material_item` WHERE `is_active`=1 AND `name` = '" . $requestData['sample_name'] . "'";
        $sampleResultId = $this->db->getCustomRows($sql, "single");
        // echo $result['id'];
        $sql = "SELECT * FROM `tbl_material_format` WHERE `is_active`=1 AND `test_grp_id` = '" . $tbl_test_group['id'] . "' AND `sample_id` = '" . $sampleResultId['id'] . "' AND `standard_test_id` = '" . $standardTypeId['id'] . "'";
        $result = $this->db->getCustomRows($sql);
        $i = 1;
        if ($result) {
            foreach ($result as $row) {
                echo '<tr id="additionalContinerId">
<input class="col form-control" type="hidden" name="id[]" value="' . $row['id'] . '">
<td><input class="col form-control" type="text" name="order_by[]" value="' . $i . '" readonly></td>
<td><input class="col form-control" type="text" name="parameters[]" value="' . $row['parameters'] . '" readonly></td>
<td><input class="col form-control" type="text" name="protocols[]" value="' . $row['protocols'] . '"
        fdprocessedid="3suo2o" readonly></td>
<td><input class="col form-control" type="text" name="specification[]" value="' . $row['specification'] . '"
        fdprocessedid="3suo2o" readonly></td>
<td><input class="col form-control" type="text" value="' . $row['text'] . '" name="text[]" readonly></td>
<td><input class="col form-control" type="text" name="unit[]" value="' . $row['unit'] . '" readonly></td>
<td><input class="col-12 form-control result" type="text" id="" name="value[]" value="" tabindex="' . $i++ . '"></td>
<td><select id="remark" class="col-12 form-control form-control-xs" name="remark[]" fdprocessedid="effusw">
<option value="">Select</option>
<option value="pass" ' . (('pass' == $row['remark']) ? 'selected' : '') . '>PASS</option>
<option value="fail" ' . (('fail' == $row['remark']) ? 'selected' : '') . '>FAIL</option>
</select></td>
<td><button disabled type="button" class="btn btn-danger btn-xs additionalContinerRemove" value="" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td>
</tr>';
            }
            // foreach ($result as $row){
            //   echo'<option value="'. $row["id"].'">'. $row["name"].'</option>';
            // }
        }
    }
    //
    function get_special_characters($string)
    {
        preg_match_all('/[^A-Za-z0-9\s]/', $string, $matches);
        return $matches[0];
    }
    //
    public function getnotes(array $inputData)
    {
        // if (isset($_POST['mateial_category_id']) && !empty($_POST['mateial_category_id'])) {
        $requestData = $inputData["request"];
        $sql2 = "SELECT `id` FROM `tbl_test_category` WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
        $tbl_test_category = $this->db->getCustomRows($sql2, "single");
        $sql1 = "SELECT `id` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND`name` = '" . $requestData['standard_test_type'] . "'";
        $standardTypeId = $this->db->getCustomRows($sql1, "single");
        $sql1 = "SELECT `id` FROM `tbl_test_group` WHERE `is_active`=1 AND `test_category_id` = '" . $tbl_test_category['id'] . "' AND `name` = '" . $requestData['test_group_name'] . "'";
        $tbl_test_group = $this->db->getCustomRows($sql1, "single");
        $sql = "SELECT `id` FROM `tbl_material_item` WHERE `is_active`=1 AND `name` = '" . $requestData['sample_name'] . "'";
        $sampleResultId = $this->db->getCustomRows($sql, "single");
        // echo $result['id'];
        $sql = "SELECT `parameters` FROM `tbl_material_format` WHERE `is_active`=1 AND `test_grp_id` = '" . $tbl_test_group['id'] . "' AND `sample_id` = '" . $sampleResultId['id'] . "' AND `standard_test_id` = '" . $standardTypeId['id'] . "'";
        $result = $this->db->getCustomRows($sql);
        // $i=1;
        if ($result) {
            foreach ($result as $input_string) {
                $special_chars[] = $this->get_special_characters($input_string['parameters'])[0];
            }
        }
        foreach ($special_chars as $special_chars_result) {
            $sqlnoteId = "SELECT `id` FROM `tbl_notes` WHERE `is_active`=1 AND `name` = '" . $special_chars_result . "' ";
            $notesId[] = $this->db->getCustomRows($sqlnoteId, 'single');
        }
        // print_r($notesId);
        // exit;
        echo json_encode($notesId, true);
        // print_r($special_chars);
        //             $html = '<label class="form-label required-field">Notes</label>
        //             <select class="form-control test" name="notes[]" id="notes" multiple>
        //                 <option value="">Select</option>';
        //                 $get_notes = $this->app->get_notes_dropdown();
        //                 $i=0;
        //             foreach ($get_notes as $row) {
        //                 // print_r($notes);
        //                 $html .= '<option value="' . $row["id"] . '" '.((in_array($row["name"], $special_chars)) ? 'selected' : '').' >' . $row["description"] .'</option>';
        //             }
        //             $html .= '</select>';
        //             echo $html;
        // }
    }
    public function get_material_item(array $inputData)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT `id` FROM `tbl_material_category` WHERE `name` = '" . $requestData['material_category_name'] . "' AND `is_active`=1 ";
        $result1 = $this->db->getCustomRows($sql, "single");
        $sql = "SELECT `id`,`name` FROM `tbl_material_item` WHERE `mateial_category_id` = '" . $result1['id'] . "'";
        $result = $this->db->getCustomRows($sql);
        echo '<option value="">Select sample</option>';
        foreach ($result as $row) {
            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
        }
    }
    //
    public function get_test_group(array $inputData)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT `id` FROM `tbl_test_category` WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
        $result1 = $this->db->getCustomRows($sql, "single");
        //
        $sql = "SELECT `id`,`name` FROM `tbl_test_group` WHERE `is_active`=1 AND `test_category_id` = '" . $result1['id'] . "'";
        $result = $this->db->getCustomRows($sql);
        //
        echo '<option value="">Select Test Group</option>';
        foreach ($result as $row) {
            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
        }
    }
    //
    public function gettest_group(array $inputData)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT `id` FROM `tbl_material_category` WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
        $result1 = $this->db->getCustomRows($sql, "single");
        $sql = "SELECT `id`,`name` FROM `tbl_material_item` WHERE `is_active`=1 AND `mateial_category_id` = '" . $result1['id'] . "'";
        $result = $this->db->getCustomRows($sql);
        echo '<option value="">Select sample</option>';
        foreach ($result as $row) {
            echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
        }
    }
    //
    public function productCatogorySubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_product_category` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $runQuery = $this->db->appInsert("tbl_product_category", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_product_category` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_product_category", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    function certificateNumFormat($id = 1)
    {
        $num_padded = sprintf("%09d", $id);
        $defaultVar = "7537";
        $year = (string)date("y");
        $format = $defaultVar . $year . $num_padded;
        return $format;
    }
    //
    public function test_approve_submit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        ///////////
        $id = $requestData["id"];
        $mattest_id = $requestData["mattest_id"];
        $mattest_status = $requestData["mattest_status"];
        $is_notes = $requestData["is_notes"];
        if(isset($is_notes)==1){
            $is_notesreport = 1; 
        }else{
            $is_notesreport = 0; 
        }
        $temArry_iss = $itemArray_iss = [];
        foreach ($mattest_id as $key => $value) {
            $temArry_iss['id'] = $value;
            $temArry_iss['status'] = $mattest_status[$key];
            $itemArray_iss[$key] = $temArry_iss;
        }
        foreach ($itemArray_iss as $value) {
            $updateData = array(
                "status" => $value["status"]
            );
            $where = array(
                "id" => $value["id"],
            );
            $runQuery = $this->db->appUpdate("tbl_test_material_format", $updateData, $where);
            // $formQuery = $this->db->appInsert("tbl_test_material_format", $insertData);
        }
        // switch($form_action){
        //     case "insert":
        //         $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_product_category` WHERE `name`='".$requestData["name"]."';";
        //         $countData = $this->db->getCustomRows($sql, "single");
        //         if($countData["total"]>0){
        //             $outStatus = 'failed';
        //             $outTitle = "Exists";
        //             $outMessage = 'Already Exists!';
        //         }
        //         else{
        //             $insertData = array(
        //                 "name" => $requestData["name"],
        //                 "comment" => $requestData["comment"]
        //             );
        //             $runQuery = $this->db->appInsert("tbl_product_category", $insertData);
        //             if($runQuery){
        //                 $outStatus = 'success';
        //                 $outTitle = 'Form Detail';
        //                 $outMessage = 'Data added successfully.';
        //             }else{
        //                 $outStatus = 'failed';
        //                 $outTitle = "Form Detail";
        //                 $outMessage = 'Data failed';        
        //             }
        //         }
        //     break;
        // case "update":
        // $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_product_category` WHERE `name`='".$requestData["name"]."'";
        // $countData = $this->db->getCustomRows($sql, "single");
        // if($countData["total"]>1){
        //     $outStatus = 'failed';
        //     $outTitle = "Exists";
        //     $outMessage = 'Already Exists!';
        // }
        // else{
        //pass
        // if($requestData["approve_status"]!='1' || $requestData["approve_status"]!='4'){
        //     $insertData = array(
        //         "status" => $requestData["approve_status"],
        //         "sample_code" => 'insert depend',
        //         "reference_id" => $requestData["id"]
        //     );
        //     $runQuery = $this->db->appInsert("tbl_testing",$insertData);
        // }else{
        //
        $updateData = array(
            "status" => $requestData["approve_status"]
        );
        if ($requestData["approve_status"] == 1 || $requestData["approve_status"] == 5) {
            //     $getLastCountResult= "SELECT `random_number` FROM `tbl_certificate_no` WHERE `is_active`='1' ORDER BY `tbl_certificate_no`.`random_number` DESC";
            //     $countDatarandom = $this->db->getCustomRows($getLastCountResult, "single");
            //             $var = $this->certificateNumFormat($countDatarandom['random_number']);
            // //
            // $addprev = $countDatarandom['random_number']+1;
            // $testrandom = $var+1;
            switch ($requestData["generate_report"]) {
                case 'ulr':
                    // $getLastCountResult = "SELECT `random_number` FROM `tbl_certificate_no` WHERE `is_active`='1' ORDER BY `tbl_certificate_no`.`random_number` DESC LIMIT 1";
                    $getLastCountResult = "SELECT MAX(`random_number`) AS count FROM tbl_certificate_no;";
                    $countDatarandom = $this->db->getCustomRows($getLastCountResult, "single");
                    $var = $this->certificateNumFormat($countDatarandom['count']);
                    //
                    $addprev = $countDatarandom['count'] + 1;
                    $testrandom = $var + 1;
                    $updateData['report_number'] = "ULR-TC" . $testrandom . "F";
                    break;
                case 'lr':
                    $getLastCountResult = "SELECT `lr_random_number` FROM `tbl_certificate_no` WHERE `is_active`='1' ORDER BY `tbl_certificate_no`.`lr_random_number` DESC";
                    $countDatarandom = $this->db->getCustomRows($getLastCountResult, "single");
                    $var = $this->certificateNumFormat($countDatarandom['lr_random_number']);
                    //
                    $addlr_random_number = $countDatarandom['lr_random_number'] + 1;
                    $testrandom = $var + 1;
                    $updateData['report_number'] = "LR-TC" . $testrandom;
                    break;
            }
      
            //
            // $var = $this->certificateNumFormat($countDatarandom['random_number']);
            //
            // $updateData['report_number'] = "LR" . -rand(0000, 9999) . -rand(0000, 9999);
            $updateData['report_date'] = date('Y-m-d H:i:s');
            $updateData['is_notes'] = $is_notesreport;
        }
        $insertRandom = array(
            "random_number" => $addprev,
            "lr_random_number" => $addlr_random_number
        );
        $this->db->appInsert("tbl_certificate_no", $insertRandom);
        //
        // TRN-2005-0044
        $where = array(
            "id" => $requestData["id"],
        );
        $runQuery = $this->db->appUpdate("tbl_testing", $updateData, $where);
        // }
        unset($updateData['is_notes']);

        //Testing Logs
        $updateData = array(
            "status" => $requestData["approve_status"],
            "approve_status" => $requestData["approve_status"],
            "approved_by" => $requestData["approved_by"],
            "description" => $requestData["description"],
            "approve_date" => $requestData["approve_date"],
            "is_notify" => 0,
            "created_by" => 1
        );
        $where = array(
            "testing_id" => $requestData["id"],
        );
        // $runQuery = $this->db->appInsert("tbl_testing_logs", $insertData);
        $runQuery = $this->db->appUpdate("tbl_testing_logs", $updateData, $where);
        // if($runQuery){
        // }
        //
        if ($runQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        // }
        // break;
        // default:
        // $outStatus = 'failed';
        // $outTitle = "Form Detail";
        // $outMessage = 'Data failed';
        // }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function mastersamplesubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];

        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "' AND `mateial_category_id`='" . $requestData["mateial_category_id"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "mateial_category_id" => $requestData["mateial_category_id"]
                    );
                    $runQuery = $this->db->appInsert("tbl_material_item", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "' ";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "comment" => $requestData["comment"],
                        "mateial_category_id" => $requestData["mateial_category_id"]
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_material_item", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function testGroupSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `is_active`= 1 AND `test_category_id`='" . $requestData["cat"] . "' AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "test_category_id" => $requestData["cat"],
                        "comment" => $requestData["comment"]
                        // "name" => $requestData["name"]
                    );
                    $runQuery = $this->db->appInsert("tbl_test_group", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `is_active`= 1 AND `test_category_id`='" . $requestData["cat"] . "' AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "test_category_id" => $requestData["cat"],
                        "comment" => $requestData["comment"]
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_test_group", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    ///
    ////
    public function worksheetform(array $inputData)
    {
        $requestData = $inputData["request"];
        $headId = $requestData['headId'];
        $testingId = $requestData['testingId'];
        $sql = "SELECT `name` FROM `tbl_work_sheet` WHERE `mainheadid` = '" . $headId . "' AND `testing_id` = '" . $testingId . "' ";
        $result = $this->db->getCustomRows($sql);
        // print_r($result);
        // exit;
        // $json_encode = json_encode($result);
        $json = $result[0]['name'];
        $prevWorksheet = json_decode($json, true);
        $newArray = [];
        foreach ($prevWorksheet as $outerkey => $outerArr) {
            foreach ($outerArr as $key => $innerArr) {
                $newArray[$key][$outerkey] = $innerArr;
            }
        }
        // echo '<pre>';
        // echo $outHtml;
        // exit;
        $headId = $requestData['headId'];
        $tbl_field_heading = $this->app->tbl_field_heading($headId);
        $sql = "SELECT * FROM `tbl_stp` WHERE `id`= '" . $headId . "' ";
        $is_multipleResult = $this->db->getCustomRows($sql, 'single');
        $is_multiple = $is_multipleResult['is_multiple'];
        // echo $is_multiple;
        // exit;
        //
        $outHtml = '';
        $outHtml .= '<table class="table table-bordered" _style="width:100%"><tr>';
        foreach ($tbl_field_heading['mainhead'] as $key => $value) {
            $outHtml .= '<th ' . $value['span'] . ' width="auto">' . $value['head_name'] . '</th>';
        }
        if ($is_multiple == '1') {
            $outHtml .= '<th rowspan="2">Action</th>';
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
        if (is_array($result)) {
            $action = 'update';
        } else {
            $action = 'insert';
        }
        if ($action == 'insert') {
            $outHtml .= '<tr class="" style="background-color:#E0F2F1">';
            $tbl_form_column = $this->app->tbl_form_column($headId);
            foreach ($tbl_form_column as $key => $value) {
                $input = '<input type="text" class="form-control form-control-xs" name="' . $value['name'] . '" value="" >';
                $outHtml .= '<td ' . $value['span'] . '>' . $input . '</td>';
            }
        } elseif ($action == 'update' && $is_multiple == '1') {
            $outHtml .= '<tr class="" style="background-color:#E0F2F1">';
            $tbl_form_column = $this->app->tbl_form_column($headId);
            foreach ($tbl_form_column as $key => $value) {
                $input = '<input type="text" class="form-control form-control-xs" name="' . $value['name'] . '" value="" >';
                $outHtml .= '<td ' . $value['span'] . '>' . $input . '</td>';
            }
        }
        if ($is_multiple == '1') {
            $outHtml .= '<td><button type="button" class="btn btn-success btn-xs addMoreData" style="padding: 0.213rem 0.6rem;" value="' . $headId . '"><i class="mdi mdi-plus-circle m-0"></i></button></td>
    ';
        }
        $outHtml .= '</tr>';
        //old data
        if (is_array($newArray)) {
            foreach ($newArray as $datakey => $datavalue) {
                $outHtml .= '<tr class="" style="background-color:#E0F2F1">';
                foreach ($datavalue as $datakey1 => $datavalue1) {
                    $outHtml .= '<td><input type="text" class="form-control form-control-xs check" name="' . $datakey1 . '[]" value="' . $datavalue1 . '" required="required" ></td>';
                }
                if ($is_multiple == '1') {
                    $outHtml .= '<td><button type="button" class="btn btn-xs btn-warning additionalContinerRemove" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td>';
                }
                $outHtml .= '</tr>';
            }
        }
        $outHtml .= '<tbody id="additionalContiner"></tbody>';
        $outHtml .= '</table> ';
        //
        // $parametersList = $this->app->parametersList();
        // $cal = $parametersList[0]['calculation'];
        // $_SESSION["cal"] = $cal;
         $sql = "SELECT `calculation` FROM `tbl_stp` WHERE `id` = '" . $headId . "'  ";
        $resultMainHead = $this->db->getCustomRows($sql ,'single');
       $jsonMainHead = $resultMainHead['calculation'];

        $formulaColumn = array_filter($tbl_form_column, function ($var) {
            return ($var['is_formula'] == '1');
        });
        foreach ($formulaColumn as $Columnkey => $Columnvalue) {
            $Columnvaluearr[] = substr_replace($Columnvalue['name'], "", -2);
        }
        $sqlre = "SELECT `name`,`field_value` FROM `tbl_form_detail` WHERE `formheadid` = '" . $headId . "'  AND `field_value` IS NOT NULL  ";
        $resultMainHeadre = $this->db->getCustomRows($sqlre);
       $jsonMainHeadre[] = $resultMainHeadre['name'];
       $sqlresult = "SELECT `name` FROM `tbl_form_detail` WHERE `formheadid` = '" . $headId . "' ORDER BY `tbl_form_detail`.`name` DESC";
       $finalresult = $this->db->getCustomRows($sqlresult,'single');
        $array = array("html" => $outHtml, "formula" => $jsonMainHead, "formulaColumn" => $jsonMainHead, "column" => $resultMainHeadre,"finalresult" => $finalresult);
        // $array = array("html" => $outHtml, "formula" => $jsonMainHead, "formulaColumn" => $Columnvaluearr);
        echo json_encode($array);
    }
    //
    ////
    public function worksheetform1(array $inputData)
    {
        $requestData = $inputData["request"];
        $headId = $requestData['headId'];
        $json = $result[0]['name'];
        $prevWorksheet = json_decode($json, true);
        $newArray = [];
        foreach ($prevWorksheet as $outerkey => $outerArr) {
            foreach ($outerArr as $key => $innerArr) {
                $newArray[$key][$outerkey] = $innerArr;
            }
        }
        // // // // // // // // 
        $headId = $requestData['headId'];
        $tbl_field_heading = $this->app->tbl_field_heading($headId);
        $sql = "SELECT * FROM `tbl_stp` WHERE `id`= '" . $headId . "' ";
        $is_multipleResult = $this->db->getCustomRows($sql, 'single');
        $is_multiple = $is_multipleResult['is_multiple'];
        // echo $is_multiple;
        // exit;
        //
        $outHtml = '';
        $outHtml .= '<table class="table table-bordered" _style="width:100%"><tr>';
        foreach ($tbl_field_heading['mainhead'] as $key => $value) {
            $outHtml .= '<th ' . $value['span'] . ' width="auto">' . $value['head_name'] . '</th>';
        }
        if ($is_multiple == '1') {
            $outHtml .= '<th rowspan="2">Action</th>';
        }
        //
        $outHtml .= '</tr>
    <tr>';
        foreach ($tbl_field_heading['subhead'] as $key => $value) {
            $outHtml .= '<th ' . $value['span'] . '>' . $value['head_name'] . '</th>';
        }
        //
        $outHtml .= '</tr>';

        $outHtml .= '</tr>';
        //old data
        if (is_array($newArray)) {
            foreach ($newArray as $datakey => $datavalue) {
                $outHtml .= '<tr class="" style="background-color:#E0F2F1">';
                foreach ($datavalue as $datakey1 => $datavalue1) {
                    $outHtml .= '<td><input type="text" class="form-control form-control-xs check" name="' . $datakey1 . '[]" value="' . $datavalue1 . '" required="required" ></td>';
                }
                if ($is_multiple == '1') {
                    $outHtml .= '<td><button type="button" class="btn btn-xs btn-warning additionalContinerRemove" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td>';
                }
                $outHtml .= '</tr>';
            }
        }
        $outHtml .= '<tbody id="additionalContiner"></tbody>';
        $outHtml .= '</table> ';
        //
        $array = array("html" => $outHtml);
        echo json_encode($array);
    }
    //
    public function tbl_form_column(array $inputData)
    {
        $requestData = $inputData["request"];
        $data = $this->app->tbl_form_column($requestData['headId']);
        echo json_encode($data, true);
    }
    //
    public function worksheetSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $headId = $requestData['headId'];
        $testingId = $requestData['testingId'];
        $sql1 = "SELECT count(*) as count FROM `tbl_work_sheet` WHERE `mainheadid` = '" . $headId . "' AND `testing_id` = '" . $testingId . "' ";
        $prevResultCount = $this->db->getCustomRows($sql1, 'single');
        if ($prevResultCount['count'] == 0) {
            $form_action = 'insert';
        } else {
            $form_action = 'update';
        }
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    unset($requestData['action']);
                    unset($requestData['headId']);
                    unset($requestData['testingId']);
                    unset($requestData['form_action']);
                    // print_r($requestData);
                    //                     // $datarequest = array_filter($requestData);
                    //This array will hold the filtered response
                    $datarequest = [];
                    //Iterates over the tech like PHP, Java, ...
                    $cntArr = 0;
                    foreach ($requestData as $key => $requestArray) {
                        $cntArr = count($requestArray);
                        break;
                    }
                    for ($i = 0; $i < $cntArr; $i++) {
                        $retData = true;
                        $retArr = array();
                        foreach ($requestData as $key => $requestArray) {
                            if ($requestArray[$i] == '') {
                                $retData = false;
                            }
                            $retArr[$key] = $requestArray[$i];
                        }
                        if ($retData) {
                            foreach ($retArr as $rKey => $rValue) {
                                $datarequest[$rKey][] = $rValue;
                            }
                        }
                    }
                    $data = json_encode($datarequest);
                    //
                    // print_r($data);
                    // exit;
                    $insertData = array(
                        "mainheadid" => $headId,
                        "testing_id" => $testingId,
                        "name" => $data
                    );
                    // }
                    $runQuery = $this->db->appInsert("tbl_work_sheet", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    unset($requestData['action']);
                    unset($requestData['headId']);
                    unset($requestData['testingId']);
                    $datarequest = array_filter($requestData);
                    // exit;
                    $data = json_encode($datarequest);
                    // print_r($data);
                    $updateData = array(
                        "name" => $data
                    );
                    $where = array(
                        "mainheadid" => $headId,
                        "testing_id" => $testingId
                    );
                    $runQuery = $this->db->appUpdate("tbl_work_sheet", $updateData, $where);
                    // print_r($runQuery);
                    // exit;
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage, "testingId" => $testingId);
        echo json_encode($data, true);
    }
    public function wsConfirm(array $inputData)
    {
        $requestData = $inputData["request"];
        $testingId = $requestData['testId'];
        // print_r($data);
        $updateData = array(
            "is_completed" => '1'
        );
        $where = array(
            "testing_id" => $testingId
        );
        $runQuery = $this->db->appUpdate("tbl_work_sheet", $updateData, $where);
        // print_r($runQuery);
        // exit;
        if ($runQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function wsCreate(array $inputData)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_work_sheet_log` WHERE `sample_code`='" . $requestData["sample_code"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] == 0) {
            $insertData = array(
                "sample_code" => $requestData['sample_code'],
                "sampling_receive_date" => date("Y-m-d H:i", strtotime($requestData["sampling_receive_date"])),
                "test_start_date" => date("Y-m-d H:i", strtotime($requestData["test_start_date"])),
                "test_end_date" => date("Y-m-d H:i", strtotime($requestData["test_end_date"])),
            );
            // }
            $runQuery = $this->db->appInsert("tbl_work_sheet_log", $insertData);
        }
        if ($runQuery) {
            $sqlId = "SELECT max(`id`) as `maxId` FROM `tbl_work_sheet_log` WHERE `sample_code`='" . $requestData["sample_code"] . "' ";
            $countDataId = $this->db->getCustomRows($sqlId, "single");
            //
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
            $id = $countDataId['maxId'];
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
            $id = '';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage, "testingId" => $id);
        echo json_encode($data, true);
    }
    // get_materialFormat //
    public function get_materialFormat(array $inputData)
    {
        $requestData = $inputData["request"];
        $group = $requestData['group'];
        $materialId = $requestData['materialId'];
        $standardTestId = $requestData['standardTestId'];
        $sql = "SELECT *FROM `tbl_material_format` WHERE `is_active`=1 AND `test_grp_id`='" . $group . "' ";
        $result2 = $this->db->getCustomRows($sql);
        // $result = $this->app->fetchallDetails('tbl_material_format', 'sample_id', $materialId);
        $parametersList = $this->app->parametersList();
        $formatCategory = $this->app->formatCategory();
        // if (empty($materialId) && empty($standardTestId) && $result2) {
        //     $i = 1;
        //     foreach ($result2 as $row) {
        //         echo '<tr id="additionalContinerId" class="clear-format">
        //     <td hidden><input class="col form-control" type="" name="mid[]" value="' . $row['id'] . '"></td>
        //     <td  style="width:5em;">' . $i++ . '</td>
        //     <td><input class="col form-control warning" type="text" name="parameters[]" value="' . $row['parameters'] . '"></td>
        //     <td style="width:5em;"><input class="col form-control warning" type="text" name="protocols[]" value="' . $row['protocols'] . '" fdprocessedid="3suo2o" style="width:5em;"></td>
        //     <td><select class="col-12 form-control warning" name="specification[]" fdprocessedid="effusw">
        //     <option value="">Select</option>
        //     <option value="min" ' . (('min' == $row['specification']) ? 'selected' : '') . '>Min</option>
        //     <option value="max" ' . (('max' == $row['specification']) ? 'selected' : '') . '>Max</option>
        //     <option value="text" ' . (('text' == $row['specification']) ? 'selected' : '') . '>Text</option>
        //         </select></td>
        //     <td><input class="col form-control warning" type="text" value="' . $row['text'] . '" name="text[]"></td>
        //     <td><input class="col form-control warning" type="text" name="unit[]" value="' . $row['unit'] . '"></td>
        //     <td><button type="button" class="btn btn-danger btn-xs additionalContinerRemove" value="' . $row['id'] . '" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td>
        //     </tr>';
        //     }
        // }
        //
        $sql = "SELECT * FROM `tbl_material_format` WHERE `is_active`=1 AND `test_grp_id`='" . $group . "' AND `sample_id`='" . $materialId . "' AND `standard_test_id`='" . $standardTestId . "'";
        $result = $this->db->getCustomRows($sql);

        if (!empty($materialId) && !empty($standardTestId) && $result) {
            $i = 1;
            foreach ($result as $row) {
                $rand = rand(10,100);
                $protocolList = $this->app->protocolList($row['parameters']);
                echo '<tr id="additionalContinerId">
            <td hidden><input class="col form-control" type="" name="mid[]" value="' . $row['id'] . '"></td>
            <td  style="width:5em;">' . $i++ . '</td>
            
			<td style="width:10em;"><select class="col-12 form-control form-control-xs js-example-tags" name="group_name[]">
            <option value="">Select</option>';
                foreach ($formatCategory as $formatCategoryrow) {
                    echo '
                    <option value="' . $formatCategoryrow["name"] . '" ' . (($formatCategoryrow["name"] == $row['group_name']) ? 'selected' : '') . ' >' . $formatCategoryrow["name"] . '</option>';
                }
                echo '</select></td>
			<td><select class="col-12 form-control form-control-xs parameters js-example-tags" data="'.$rand.'" name="parameters[]">
            <option value="">Select</option>';
                foreach ($parametersList as $parametersListrow) {
                    echo '
                    <option value="' . $parametersListrow["test_parameters"] . '" ' . (($parametersListrow["test_parameters"] == $row['parameters']) ? 'selected' : '') . ' >' . $parametersListrow["test_parameters"] . '</option>';
                }
                echo '</select></td>
			
            <td style="width:15em;"><select class="col-12 form-control form-control-xs js-example-tags  protocols pr'.$rand.'" data="'.$rand.'" name="protocols[]" style="width:15em;">
           
            <option value="">Select</option>';
                foreach ($protocolList as $protocolListrow) {
                    echo '
                    <option value="' . $protocolListrow["testing_protocols"] . '" ' . (($protocolListrow["testing_protocols"] == $row['protocols']) ? 'selected' : '') . ' >' . $protocolListrow["testing_protocols"] . '</option>';
                }
                echo ' </select>
            </td>
			<td><select class="col-12 form-control warning" name="specification[]" fdprocessedid="effusw">
            <option value="">Select</option>
			<option value="min" ' . (('min' == $row['specification']) ? 'selected' : '') . '>Min</option>
			<option value="max" ' . (('max' == $row['specification']) ? 'selected' : '') . '>Max</option>
			<option value="text" ' . (('text' == $row['specification']) ? 'selected' : '') . '>Text</option>
				</select>
            </td>
			<td><input class="col form-control warning" type="text" value="' . $row['text'] . '" name="text[]"></td>
			<td><input class="col form-control warning" type="text" name="unit[]" value="' . $row['unit'] . '"></td>
			<td><button type="button" class="btn btn-danger btn-xs additionalContinerRemove" value="' . $row['id'] . '" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td>
			</tr>';
            }
        }
    }
    //
    public function docSubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_stp` WHERE `is_active`=1 AND`test_parameters`='" . $requestData["parameter"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "test_parameters" => $requestData["parameter"],
                        "testing_protocols" => $requestData["protocol"],
                    );
                    //
                    if (isset($_FILES)) {
                        // print_r($_FILES);
                        $fileCount = count($_FILES['file']['name']);
                        $targetdir = "../assets/upload2";
                        //$tdir="..assets/upload3";
                        if (!file_exists($targetdir)) {
                            mkdir($targetdir, 0755, true);
                        }
                        /* if (!file_exists($tdir)) {
                       mkdir($tdir, 0755, true);
                        }*/
                        $fName = [];
                        foreach ($_FILES['file']['name'] as $key => $value) {
                            $fileName = $_FILES['file']['name'][$key];
                            //print_r($fileName);
                            move_uploaded_file($_FILES['file']['tmp_name'][$key], $targetdir . '/' . $fileName);
                            $fName[] = array($fileName);
                            $fileUpload = serialize($fName);
                        }
                        $fNamenew = [];
                        foreach ($_FILES['filenew']['name'] as $key => $value) {
                            $filename2 = $_FILES['filenew']['name'][$key];
                            move_uploaded_file($_FILES['filenew']['tmp_name'][$key], $targetdir . '/' . $filename2);
                            $fNamenew[] = array($filename2);
                            $fupload = serialize($fNamenew);
                        }
                        $insertData['uploaded_files'] = $fileUpload;
                        $insertData['uploaded_images'] = $fupload;
                    }
                    $runQuery = $this->db->appInsert("tbl_stp", $insertData);
                    // print_r($runQuery);
                    // exit;
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_stp` WHERE `is_active`=1 AND `test_parameters`='" . $requestData["parameter"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 1) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "test_parameters" => $requestData["parameter"],
                        "testing_protocols" => $requestData["protocol"]
                    );
                    $get_removedata = $this->app->getRemovedata($requestData['id']);
                    // print_r($get_removedata);
                    if (isset($_FILES)) {
                        //  print_r($_FILES);
                        $fileCount = count($_FILES['file']['name']);
                        $targetdir = "../assets/upload2";
                        if (!file_exists($targetdir)) {
                            mkdir($targetdir, 0755, true);
                        }
                        $fName = [];
                        $rdata = $requestData["removefile"];
                        //print_r($rdata);
                        $rarray = array();
                        if ($rdata != '') {
                            $rarray = explode(",", $rdata);
                        }
                        foreach ($get_removedata[0] as $key => $value) {
                            if (!in_array($key, $rarray)) {
                                $fName[] = $value;
                            }
                        }
                        // print_r($return);
                        foreach ($_FILES['file']['name'] as $key => $value) {
                            $fileName = $_FILES['file']['name'][$key];
                            //print_r($fileName);
                            if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $targetdir . '/' . $fileName)) {
                                $fName[] = array($fileName);
                                //  print_r($fName);
                            }
                        }
                        $fileUpload = serialize($fName);
                        $fName2 = [];
                        $rdata2 = $requestData["removefile2"];
                        //print_r($rdata);
                        $rarray2 = array();
                        if ($rdata2 != '') {
                            $rarray2 = explode(",", $rdata2);
                        }
                        foreach ($get_removedata[1] as $key => $value) {
                            if (!in_array($key, $rarray2)) {
                                $fName2[] = $value;
                            }
                        }
                        // print_r($return);
                        foreach ($_FILES['filenew']['name'] as $key => $value) {
                            $fileName2 = $_FILES['filenew']['name'][$key];
                            //print_r($fileName);
                            if (move_uploaded_file($_FILES['filenew']['tmp_name'][$key], $targetdir . '/' . $fileName2)) {
                                $fName2[] = array($fileName2);
                                //  print_r($fName);
                            }
                        }
                        $fUpload = serialize($fName2);
                        $insertData['uploaded_files'] = $fileUpload;
                        $insertData['uploaded_images'] = $fUpload;
                    }
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_stp", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function testtype(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        // "test_category_id" => $requestData["cat"],
                        "comment" => $requestData["comment"]
                        // "name" => $requestData["name"]
                    );
                    $runQuery = $this->db->appInsert("tbl_standard_test_type", $insertData);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        // "test_category_id" => $requestData["cat"],
                        "comment" => $requestData["comment"]
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_standard_test_type", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function notessubmit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        // print_r($loginUserId);
        switch ($form_action) {
            case "insert":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_notes` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "';";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "description" => $requestData["description"],
                        "created_by" => 1
                    );
                    $runQuery = $this->db->appInsert("tbl_notes", $insertData);
                    // print_r($runQuery);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            case "update":
                $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_notes` WHERE `is_active`=1 AND `name`='" . $requestData["name"] . "'";
                $countData = $this->db->getCustomRows($sql, "single");
                if ($countData["total"] > 0) {
                    $outStatus = 'failed';
                    $outTitle = "Exists";
                    $outMessage = 'Already Exists!';
                } else {
                    $insertData = array(
                        "name" => $requestData["name"],
                        "description" => $requestData["description"],
                        "created_by" => 1
                    );
                    $where = array(
                        "id" => $requestData["id"],
                    );
                    $runQuery = $this->db->appUpdate("tbl_notes", $insertData, $where);
                    if ($runQuery) {
                        $outStatus = 'success';
                        $outTitle = 'Form Detail';
                        $outMessage = 'Data added successfully.';
                    } else {
                        $outStatus = 'failed';
                        $outTitle = "Form Detail";
                        $outMessage = 'Data failed';
                    }
                }
                break;
            default:
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    public function testgroupedit(array $inputData)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        $testing_id = $requestData["testing_id"];
        //
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material` WHERE `is_active`=1 AND `name`='" . $requestData["material_id"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material WHERE `name` = '" . $requestData['material_id'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_id = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_id"]
            );
            $runQuery = $this->db->appInsert("tbl_material", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material WHERE `is_active`=1 AND `name` = '" . $requestData['material_id'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_id = $result['id'];
            }
        }
        //tbl_test_category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_category` WHERE `is_active`=1 AND `name`='" . $requestData["test_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_category WHERE `name` = '" . $requestData['test_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["test_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_category WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_category_name = $result['id'];
            }
        }
        //tbl_test_category//tbl_test_group//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `is_active`=1 AND `test_category_id`='" . $test_category_name . "' AND `name`='" . $requestData["test_group_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_group WHERE `is_active`=1 AND `name` = '" . $requestData['test_group_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_group_name = $result['id'];
        } else {
            $insertData = array(
                "test_category_id" => $test_category_name,
                "name" => $requestData["test_group_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_group", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_group WHERE `is_active`=1 AND `test_category_id`='" . $test_category_name . "' AND `name` = '" . $requestData['test_group_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_group_name = $result['id'];
            }
        }
        //Standard Test Type
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND `name`='" . $requestData["standard_test_type_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `name` = '" . $requestData['standard_test_type_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $standard_test_type_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["standard_test_type_name"]
            );
            $runQuery = $this->db->appInsert("tbl_standard_test_type", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $standard_test_type_name = $result['id'];
            }
        }
        //Material Category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_category` WHERE `is_active`=1 AND `name`='" . $requestData["material_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_category WHERE `name` = '" . $requestData['material_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_category WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_category_name = $result['id'];
            }
        }
        //Material Category//Material Item//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name`='" . $requestData["material_sample_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_item WHERE `is_active`=1 AND `name` = '" . $requestData['material_sample_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_sample_name = $result['id'];
        } else {
            $insertData = array(
                "mateial_category_id" => $material_category_name,
                "name" => $requestData["material_sample_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_item", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_item WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name` = '" . $requestData['material_sample_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_sample_name = $result['id'];
            }
        }
        //sampling_method
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_sampling_method` WHERE `name`='" . $requestData["sampling_method"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_sampling_method WHERE `is_active`=1 AND `name` = '" . $requestData['sampling_method'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $sampling_method = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["sampling_method"]
            );
            $runQuery = $this->db->appInsert("tbl_sampling_method", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_sampling_method WHERE `is_active`=1 AND `name` = '" . $requestData['sampling_method'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $sampling_method = $result['id'];
            }
        }
        $otherlabel = json_encode($requestData["otherlabel"], true);
        $othervalue = json_encode($requestData["othervalue"], true);
        $updateFormData = array(
            "sample_code" => $requestData["sample_code"],
            "sampling_date" => date("Y-m-d H:i", strtotime($requestData["sampling_date"])),
            "sampling_receive_date" => date("Y-m-d H:i", strtotime($requestData["sampling_receive_date"])),
            "sample_quantity" => $requestData["sample_quantity"],
            "issued_to" => $requestData["issued_to"],
            "test_start_date" => date("Y-m-d H:i", strtotime($requestData["test_start_date"])),
            "test_end_date" => date("Y-m-d H:i", strtotime($requestData["test_end_date"])),
            "temp" => $requestData["temp"],
            "humidity" => $requestData["humidity"],
            "sampling_condition" => $requestData["sampling_condition"],
            "assign_from" => $requestData["assign_from"],
            "test_responsibility" => $requestData["test_responsibility"],
            "test_category_id" => $test_category_name,
            "test_grp_id" => $test_group_name,
            "standard_test_id" => $standard_test_type_name,
            "material_id" => $material_id,
            "material_grp_id" => $material_category_name,
            "sample_id" => $material_sample_name,
            "sample_method_id" => $sampling_method,
            "status" => $requestData["status"],
            "is_retest" => $requestData["is_retest"],
            "is_resample" => $requestData["is_resample"],
            "reference_id" => $requestData["testing_id"],
            "notes" => isset($requestData["notes"]) ? json_encode($requestData["notes"], true) : null,
            "otherlabel" => $otherlabel,
            "othervalue" => $othervalue,
            "test_number" => "TEST" . -rand(1000, 9999) . -rand(1000, 9999)
        );
        $where = array(
            "id" => $testing_id
        );
        $formQuery1 = $this->db->appUpdate("tbl_testing", $updateFormData, $where);

        if ($formQuery1) {
            //
            $sqlmaxid = "SELECT MAX(id) as maxtesting_id FROM tbl_testing WHERE `is_active`=1 ";
            $maxid = $this->db->getCustomRows($sqlmaxid, "single");
            $updateDatalog = array(
                "prepared_by" => $requestData["assign_from"]
            );
            $where = array(
                "testing_id" => $testing_id
            );
            $runQuery = $this->db->appUpdate("tbl_testing_logs", $updateDatalog, $where);
        }
        //

        $id = $requestData["id"];
        $order_by = $requestData["order_by"];
        $parameters = $requestData["parameters"];
        $protocol = $requestData["protocols"];
        $specification = $requestData["specification"];
        $text = $requestData["text"];
        $unit = $requestData["unit"];
        $value1 = $requestData["value"];
        $remark = $requestData["remark"];
        $temArry_iss = $itemArray_iss = [];
        foreach ($parameters as $key => $value) {
            // echo $key;
            // $temArry_iss['id'] = $id[$key];
            $temArry_iss['id'] = $id[$key];
            $temArry_iss['order_by'] = $order_by[$key];
            $temArry_iss['parameters'] = $value;
            $temArry_iss['protocols'] = $protocol[$key];
            $temArry_iss['specification'] = $specification[$key];
            $temArry_iss['text'] = $text[$key];
            $temArry_iss['unit'] = $unit[$key];
            $temArry_iss['value'] = $value1[$key];
            $temArry_iss['remark'] = $remark[$key];
            $itemArray_iss[$key] = $temArry_iss;
        }


        //
        foreach ($itemArray_iss as $value) {
            if (!empty($value['id']) && !empty($value['parameters']) && !empty($value['value'])) {
                $updatematData = array(
                    // "testing_id" => $requestData['testing_id'],
                    "order_by" => $value['order_by'],
                    "parameters" => $value['parameters'],
                    "protocols" => $value["protocols"],
                    "head_id" => $this->app->getheadId($value['parameters'], $value["protocols"]),
                    "specification" => $value["specification"],
                    "text" => $value["text"],
                    "unit" => $value["unit"],
                    "value" => $value["value"],
                    "remark" => $value["remark"],
                    "created_by" => 1
                );
                $wheremat = array(
                    "id" => $value['id'],
                    "testing_id" => $requestData['testing_id']
                );
                $formQuery2 = $this->db->appUpdate("tbl_test_material_format", $updatematData, $wheremat);
            }
            //
            if (empty($value['id']) && !empty($value['parameters']) && !empty($value['value'])) {
                $insertmatData = array(
                    "testing_id" => $requestData['testing_id'],
                    "order_by" => $value['order_by'],
                    "parameters" => $value['parameters'],
                    "protocols" => $value["protocols"],
                    "specification" => $value["specification"],
                    "text" => $value["text"],
                    "unit" => $value["unit"],
                    "value" => $value["value"],
                    "remark" => $value["remark"],
                    "created_by" => 1
                );
                // print_r($value);
                $insertrunQuery = $this->db->appInsert("tbl_test_material_format", $insertmatData);
            }
        }
        //
        if ($formQuery1 || $runQuery || $formQuery2 || $insertrunQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    // listmatformat
    public function getRoleMenu(array $inputData)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT `name` FROM tbl_menu WHERE `user_type` = '" . $requestData['userTypeID'] . "'";
        $result = $this->db->getCustomRows($sql, "single");
        $array1 = json_decode($result['name'], true);
        // echo '<pre>';
        $notes = array('1' => 'Show', '0' => 'Hide');
        // print_r($json_decode[2]);'.((in_array($row["id"], $notes)) ? 'selected' : '').' 
        // $array = $json_decode;
        // echo '<pre>';
        foreach ($array1 as $key => $value) {
            // print_r($key);
            $roles[] = $value;
        }
        $array = $roles[0];
        // print_r($array);
        // exit;
        echo ' <div class="accordion-item">
<h2 class="accordion-header" id="headingOne">
  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
  User Configuration
  </button>
</h2>
<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
  <!--  -->
  <div class="accordion-body">
  <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Show/Hide</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>User Type</td>
                                            <td style="text-align: center;vertical-align: middle;">
                                            <select class="form-control" name="usertype">';
        foreach ($notes as $key => $value) {
            if (in_array('usertype', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . ' >' . $value . '</option>';
        }
        echo '</select>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Role Menu</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="role-menu">';
        foreach ($notes as $key => $value) {
            if (in_array('role-menu', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Role Permissions</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="role-permission">';
        foreach ($notes as $key => $value) {
            if (in_array('role-permission', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>User Registration</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="user">';
        foreach ($notes as $key => $value) {
            if (in_array('user', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                            </tr>
        
                                    </tbody>
                                </table>
                            </div>
</div>
<!--  -->
     
</div>
</div>
<!--  -->
<div class="accordion-item">
<h2 class="accordion-header" id="headingTwo">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
    Testing
  </button>
</h2>
<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
  <div class="accordion-body">
  <div class="table-responsive pt-3">
  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Show/Hide</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Assign Test</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="pending-test">';
        foreach ($notes as $key => $value) {
            if (in_array('pending-test', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Create Test</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="sample-registration">';
        foreach ($notes as $key => $value) {
            if (in_array('sample-registration', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                        <td>3</td>
                                        <td>Pending-Test</td>
                                        <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="pending-test">';
        foreach ($notes as $key => $value) {
            if (in_array('pending-test', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                    </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Approval Pending</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="master-test">';
        foreach ($notes as $key => $value) {
            if (in_array('master-test', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Re-Testing</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="test-retesting">';
        foreach ($notes as $key => $value) {
            if (in_array('test-retesting', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Re-Sampling</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="test-resampling">';
        foreach ($notes as $key => $value) {
            if (in_array('test-resampling', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                            </tr>
        
                                    </tbody>
                                </table>
                            </div>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingThree">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Approval Testing
  </button>
</h2>
<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
  <div class="accordion-body">
  <div class="table-responsive pt-3">
  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Show/Hide</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Test Approval</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="test-lib">';
        foreach ($notes as $key => $value) {
            if (in_array('test-lib', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Re-Test Approval</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="test-retest">';
        foreach ($notes as $key => $value) {
            if (in_array('test-retest', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Re-Sample Approval</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="test-resample">';
        foreach ($notes as $key => $value) {
            if (in_array('test-resample', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
        
                                    </tbody>
                                </table>
                            </div>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingFour">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
  Records
  </button>
</h2>
<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
  <div class="accordion-body">
  <div class="table-responsive pt-3">
  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Show/Hide</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sample Library</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="testing-report">';
        foreach ($notes as $key => $value) {
            if (in_array('testing-report', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Track Sample</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="track-sample">';
        foreach ($notes as $key => $value) {
            if (in_array('track-sample', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingFive">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
Masters      </button>
</h2>
<div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
  <div class="accordion-body">
  <div class="table-responsive pt-3">
  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Show/Hide</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Test Category</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="test-category">';
        foreach ($notes as $key => $value) {
            if (in_array('test-category', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Discipline</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="test-group">';
        foreach ($notes as $key => $value) {
            if (in_array('test-group', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Material Group</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="material">';
        foreach ($notes as $key => $value) {
            if (in_array('material', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Material Category</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="material-category">';
        foreach ($notes as $key => $value) {
            if (in_array('material-category', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Sample Master</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="sample-master">';
        foreach ($notes as $key => $value) {
            if (in_array('sample-master', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Material Test Format</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="materiallist">';
        foreach ($notes as $key => $value) {
            if (in_array('materiallist', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Standard Test Type</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="stt">';
        foreach ($notes as $key => $value) {
            if (in_array('stt', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Standard Test Procedure</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="stp">';
        foreach ($notes as $key => $value) {
            if (in_array('stp', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Product Category</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="product-category">';
        foreach ($notes as $key => $value) {
            if (in_array('product-category', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Notes</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="notes">';
        foreach ($notes as $key => $value) {
            if (in_array('notes', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
        
                                    </tbody>
                                </table>
                            </div>
</div>
</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="headingSix">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
Work Sheet      </button>
</h2>
<div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
  <div class="accordion-body">
  <div class="table-responsive pt-3">
  <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Show/Hide</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Work Sheet</td>
                                            <td style="text-align: center;vertical-align: middle;"><select class="form-control" name="worksheet_list">';
        foreach ($notes as $key => $value) {
            if (in_array('worksheet_list', $array)) {
                $selected = 1;
            } else {
                $selected = 0;
            }
            echo '<option value="' . $key . '" ' . (($key == $selected) ? 'selected' : '') . '>' . $value . '</option>';
        }
        echo '</select></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
</div>
</div>
</div>
<button type="submit" id="" class="btn btn-xs btn-warning test" style="float: right;">Submit</button>
';
    }
    // listmatformat
    public function getRolePermission(array $inputData)
    {
        $requestData = $inputData["request"];
        $sql = "SELECT `name` FROM tbl_role_permission WHERE `user_type` = '" . $requestData['userTypeID'] . "'";
        $result = $this->db->getCustomRows($sql, "single");
        $array1 = json_decode($result['name'], true);
        //             echo '<pre>';
        // print_r($array1);
        // $roles = [
        //     'usertype' => [
        //         'create' => true,
        //         'read' => false,
        //         'update' => false,
        //         'delete' => false,
        //     ],
        //     'editor' => [
        //         'create' => false,
        //         'read' => false,
        //         'update' => false,
        //         'delete' => false,
        //     ],
        //     'user' => [
        //         'create' => false,
        //         'read' => false,
        //         'update' => false,
        //         'delete' => false,
        //     ],
        // ];
        $modules = [
            'User Configuration' => [
                'usertype' => [
                    'create' => true,
                    'read' => true,
                    'update' => true,
                    'delete' => true,
                ],
                'user' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ]
            ],
            'Work Sheet' => [
                'worksheet_list' => [
                    'create' => true,
                    'read' => true,
                    'update' => true,
                    'delete' => true,
                ]
            ],
            'Testing' => [
                'assign-test' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'master-test' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ]
            ],
            'Approvals' => [
                'test-approval' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'worksheet-approval' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ]
            ],
            'Masters' => [
                'test-category' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'test-group' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'material' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'material-category' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'sample-master' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'material-test-format' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'standard-test-type' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'standard-test-procedure' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'product-category' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'notes' => [
                    'create' => false,
                    'read' => false,
                    'update' => false,
                    'delete' => false,
                ]
            ]
        ];
        $i = 0;
        if ($modules) {
            foreach ($modules as $headkey => $headvalue) {
                // print_r($value);
                $i++;
                // exit;
                echo '<div class="accordion-item">
                <h2 class="accordion-header" id="heading' . $i . '">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '" aria-expanded="false" aria-controls="collapse' . $i . '">
                  ' . $headkey . '
                  </button>
                </h2>
                <div id="collapse' . $i . '" class="accordion-collapse collapse" aria-labelledby="heading' . $i . '" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                  <div class="table-responsive pt-3">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Create</th>
                                                            <th>Read</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                $j = 0;
                foreach ($headvalue as $subheadkey => $subheadvalue) {
                    if ($array1[$subheadkey]['create'] == 'true') {
                        $checkedcreate = 'checked="checked"';
                    } else {
                        $checkedcreate = '';
                    }
                    if ($array1[$subheadkey]['read'] == 'true') {
                        $checkedread = 'checked="checked"';
                    } else {
                        $checkedread = '';
                    }
                    if ($array1[$subheadkey]['edit'] == 'true') {
                        $checkededit = 'checked="checked"';
                    } else {
                        $checkededit = '';
                    }
                    if ($array1[$subheadkey]['delete'] == 'true') {
                        $checkeddelete = 'checked="checked"';
                    } else {
                        $checkeddelete = '';
                    }
                    //   $create = $headvalue[$array1]['create'];
                    //   if($create==1){
                    //     $crh = 'checked="checked"';
                    //   }else{
                    $crh = '';
                    //   }
                    //    echo $headvalue[$subheadkey][$subheadvalue];
                    // if ($headvalue[$subheadkey][$subheadvalue]){
                    //     $checked = 'checked';
                    // }else{
                    //     $checked = '';
                    // }
                    $j++;
                    echo '<input type="hidden" name="' . $subheadkey . '" value="' . $subheadkey . '"> 
                                                        <tr>
                                                            <td>' . $j . '</td>
                                                            <td>' . strtoupper($subheadkey) . '</td>
                                                            <td style="text-align: center;vertical-align: middle;"><input type="checkbox" ' . $checkedcreate . ' class="form-check-input" name="' . $subheadkey . '+create" value="1"></td>
                                                            <td style="text-align: center;vertical-align: middle;"><input type="checkbox" ' . $checkedread . ' class="form-check-input" name="' . $subheadkey . '+read" value="1"></td>
                                                            <td style="text-align: center;vertical-align: middle;"><input type="checkbox" ' . $checkededit . ' class="form-check-input" name="' . $subheadkey . '+edit" value="1"></td>
                                                            <td style="text-align: center;vertical-align: middle;"><input type="checkbox" ' . $checkeddelete . ' class="form-check-input" name="' . $subheadkey . '+delete" value="1"></td>
                                                        </tr>';
                }
                echo '</tbody>
                                
                                                </table>
                                            </div>
            
                </div>
                </div>
              </div>';
            }
        }
    }
    //
    // public function hasPermission($role, $operation) {
    //     global $roles;
    //     if (isset($roles[$role]) && isset($roles[$role][$operation])) {
    //         return $roles[$role][$operation];
    //     }
    //     return false;
    // }
    // public function parametersList(array $inputData)
    // {
    //     $requestData = $inputData["request"];
    //     $sampleId = $requestData["sampleId"];
    //    $sql = "SELECT * FROM `tbl_main_heading` WHERE `is_active`=1 AND `sample_id` = $sampleId ";
    //     $result = $this->db->getCustomRows($sql);
    // $html = '<div class="row">
    //         <div class="col-md-12">';
    //             $i = 1;
    //             foreach ($result as $key => $value) {
    //                 $sno = $i++;
    //                 $html .= '<button type="button" id="' . $value['id'] . '" text="' . $value['name'] . '" class="btn btn1 col-6 mb-2 usertype"><span style="float:left;" class="text-primary">' . $sno . ')</span>' . $value['name'] . '<span style="float:right;"><span class="result" >Result</span> ' . $x . '</span></button>';
    //             }
    //             $html .= '</div>
    //     </div>';
    //     echo $html;
    // }
    function filterZeroValues($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = filterZeroValues($value);
            } elseif ($value === 0) {
                unset($array[$key]);
            }
        }
        return $array;
    }
    //
    public function rolemenu(array $inputData)
    {
        $requestData = $inputData["request"];
        $userTypeID = $requestData["userTypeID"];
        unset($requestData['action']);
        unset($requestData['userTypeID']);
        // $swappedArray = $requestData;
        $result = array_diff($requestData, [0]);
        // $flippedArray = array_flip($result);
        $keys[$userTypeID] = array_keys($result);
        $jsonarr = json_encode($keys, true);
        // print_r($valid);
        // exit;
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_menu` WHERE `user_type`='" . $userTypeID . "';";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $updateData = array(
                "name" => $jsonarr
            );
            $where = array(
                "user_type" => $userTypeID
            );
            $runQuery = $this->db->appUpdate("tbl_menu", $updateData, $where);
            if ($runQuery) {
                $outStatus = 'success';
                $outTitle = 'Form Detail';
                $outMessage = 'Data added successfully.';
            } else {
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
            }
        } else {
            $insertData = array(
                "user_type" => $userTypeID,
                "name" => $jsonarr
            );
            $runQuery = $this->db->appInsert("tbl_menu", $insertData);
            if ($runQuery) {
                $outStatus = 'success';
                $outTitle = 'Form Detail';
                $outMessage = 'Data added successfully.';
            } else {
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
            }
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    //
    public function rolepermission(array $inputData)
    {
        $requestData = $inputData["request"];
        $userTypeID = $requestData["userTypeID"];
        unset($requestData['action']);
        unset($requestData['userTypeID']);
        $type = array('0' => 'create', '1' => 'read', '2' => 'edit', '3' => 'delete');
        $nameresult = array_diff($requestData, [1]);
        $userArray = [];
        foreach ($nameresult as $key => $value) {
            foreach ($type as $typekey => $typevalue) {
                if ($requestData[$key . '+' . $typevalue] != '') {
                    $main[$key][$typevalue] = 'true';
                } else {
                    $main[$key][$typevalue] = 'false';
                }
                //  $main[$key][$typevalue] = $requestData[$key.'+'.$typevalue];
            }
        }
        $jsonarr = json_encode($main, true);
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_role_permission` WHERE `user_type`='" . $userTypeID . "';";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $updateData = array(
                "name" => $jsonarr
            );
            $where = array(
                "user_type" => $userTypeID
            );
            $runQuery = $this->db->appUpdate("tbl_role_permission", $updateData, $where);
            if ($runQuery) {
                $outStatus = 'success';
                $outTitle = 'Form Detail';
                $outMessage = 'Data added successfully.';
            } else {
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
            }
        } else {
            $insertData = array(
                "user_type" => $userTypeID,
                "name" => $jsonarr
            );
            $runQuery = $this->db->appInsert("tbl_role_permission", $insertData);
            if ($runQuery) {
                $outStatus = 'success';
                $outTitle = 'Form Detail';
                $outMessage = 'Data added successfully.';
            } else {
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
            }
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    //
    public function testgroup_1(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        // $var = "15-06-2023 12:00";
        // echo date("Y-m-d H:i", strtotime($var) );
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material` WHERE `is_active`=1 AND `name`='" . $requestData["material_id"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material WHERE `name` = '" . $requestData['material_id'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_id = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_id"]
            );
            $runQuery = $this->db->appInsert("tbl_material", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material WHERE `is_active`=1 AND `name` = '" . $requestData['material_id'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_id = $result['id'];
            }
        }
        //tbl_test_category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_category` WHERE `is_active`=1 AND `name`='" . $requestData["test_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_category WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["test_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_category WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_category_name = $result['id'];
            }
        }
        //tbl_test_group
        // $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `name`='".$requestData["test_group_name"]."'";
        // $countData = $this->db->getCustomRows($sql, "single");
        // if($countData["total"]>0){
        //    $sql = "SELECT `id` FROM tbl_test_group WHERE `name` = '".$requestData['test_group_name']."'";
        //     $result = $this->db->getCustomRows($sql, "single");
        //     $test_group_name = $result['id'];
        // }else{
        //     $insertData = array(
        //         "name" => $requestData["test_group_name"]
        //     );
        //     $runQuery = $this->db->appInsert("tbl_test_group", $insertData);
        //     if($runQuery){
        //         $sql = "SELECT `id` FROM tbl_test_group WHERE `name` = '".$requestData['test_group_name']."'";
        //         $result = $this->db->getCustomRows($sql, "single");
        //         $test_group_name = $result['id'];
        //      }
        // }
        //tbl_test_category//tbl_test_group//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `is_active`=1 AND `test_category_id`='" . $test_category_name . "' AND `name`='" . $requestData["test_group_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_group WHERE `is_active`=1 AND `name` = '" . $requestData['test_group_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_group_name = $result['id'];
        } else {
            $insertData = array(
                "test_category_id" => $test_category_name,
                "name" => $requestData["test_group_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_group", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_group WHERE `test_category_id`='" . $test_category_name . "' AND `name` = '" . $requestData['test_group_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_group_name = $result['id'];
            }
        }
        // echo $test_group_name;
        // print_r($test_group_name);
        // exit;
        //Standard Test Type
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND `name`='" . $requestData["standard_test_type_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $standard_test_type_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["standard_test_type_name"]
            );
            $runQuery = $this->db->appInsert("tbl_standard_test_type", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $standard_test_type_name = $result['id'];
            }
        }
        //Material Category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_category` WHERE `is_active`=1 AND `name`='" . $requestData["material_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_category WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_category WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_category_name = $result['id'];
            }
        }
        //Material Category//Material Item//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name`='" . $requestData["material_sample_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_item WHERE `is_active`=1 AND `name` = '" . $requestData['material_sample_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_sample_name = $result['id'];
        } else {
            $insertData = array(
                "mateial_category_id" => $material_category_name,
                "name" => $requestData["material_sample_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_item", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_item WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name` = '" . $requestData['material_sample_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_sample_name = $result['id'];
            }
        }
        //sampling_method
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_sampling_method` WHERE `is_active`=1 AND `name`='" . $requestData["sampling_method"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_sampling_method WHERE `is_active`=1 AND `name` = '" . $requestData['sampling_method'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $sampling_method = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["sampling_method"]
            );
            $runQuery = $this->db->appInsert("tbl_sampling_method", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_sampling_method WHERE `is_active`=1 AND `name` = '" . $requestData['sampling_method'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $sampling_method = $result['id'];
            }
        }
        //  $test_category_name;
        //  $test_group_name;
        //  $standard_test_type_name;
        //  $material_category_name;
        //  $material_sample_name;
        //  $sampling_method;
        $otherlabel = json_encode($requestData["otherlabel"], true);
        $othervalue = json_encode($requestData["othervalue"], true);
        // $temArry_iss1 = $itemArray_iss1 = [];
        // foreach ($otherlabel as $key => $value) {
        //     $temArry_iss1['other_label'] = $value;
        //     $temArry_iss1['protocols'] = $othervalue[$key];
        //     // $itemArray_iss1[$key] = $temArry_iss1;
        // }
        // print_r($otherlabel);
        // exit;
        $insertFormData = array(
            //
            "sample_code" => $requestData["sample_code"],
            "sampling_date" => date("Y-m-d 00:00", strtotime($requestData["sampling_date"])),
            "sampling_receive_date" => date("Y-m-d 00:00", strtotime($requestData["sampling_receive_date"])),
            "sample_quantity" => $requestData["sample_quantity"],
            "issued_to" => $requestData["issued_to"],
            "test_start_date" => date("Y-m-d H:i", strtotime($requestData["test_start_date"])),
            "test_end_date" => date("Y-m-d H:i", strtotime($requestData["test_end_date"])),
            "temp" => $requestData["temp"],
            "humidity" => $requestData["humidity"],
            "sampling_condition" => $requestData["sampling_condition"],
            "assign_from" => $requestData["assign_from"],
            // "chemical_test_res" => $requestData["chemical_test_res"],
            // "micro_test_res" => $requestData["micro_test_res"],
            "test_responsibility" => $requestData["test_responsibility"],
            "test_category_id" => $test_category_name,
            "test_grp_id" => $test_group_name,
            "standard_test_id" => $standard_test_type_name,
            "material_id" => $material_id,
            "material_grp_id" => $material_category_name,
            "sample_id" => $material_sample_name,
            "sample_method_id" => $sampling_method,
            "status" => $requestData["status"],
            "is_retest" => $requestData["is_retest"],
            "is_resample" => $requestData["is_resample"],
            "reference_id" => $requestData["testing_id"],
            "notes" => json_encode($requestData["notes"], true),
            "otherlabel" => $otherlabel,
            "othervalue" => $othervalue,
            "test_number" => "TEST" . -rand(1000, 9999) . -rand(1000, 9999),
            "created_by" => $_SESSION['userId']
        );
        $formQuery = $this->db->appInsert("tbl_testing", $insertFormData);
  
        if ($formQuery) {
            //
            $sqlmaxid = "SELECT MAX(id) as maxtesting_id FROM tbl_testing WHERE `is_active`=1 ";
            $maxid = $this->db->getCustomRows($sqlmaxid, "single");
            $insertDatalog = array(
                "testing_id" => $maxid['maxtesting_id'],
                "prepared_by" => $requestData["assign_from"]
            );
            $runQuery = $this->db->appInsert("tbl_testing_logs", $insertDatalog);
            $sql = "SELECT `id` FROM tbl_testing WHERE `is_active`=1 AND `id`='" . $requestData["testing_id"] . "' ";
            $refPrevId = $this->db->getCustomRows($sql, "single");
            //
            $updateData = array(
                "status" => 5
            );
            $where = array(
                "id" => $refPrevId['id'],
            );
            $runQuery = $this->db->appUpdate("tbl_testing", $updateData, $where);
        }
        //
        $id = $requestData["id"];
        $istrue = $requestData["istrue"];
        $order_by = $requestData["order_by"];
        $parameters = $requestData["parameters"];
        $protocol = $requestData["protocols"];
        $specification = $requestData["specification"];
        $text = $requestData["text"];
        $unit = $requestData["unit"];
        $value1 = $requestData["value"];
        $remark = $requestData["remark"];
        $temArry_iss = $itemArray_iss = [];
        foreach ($parameters as $key => $value) {
            $temArry_iss['id'] = $id[$key];
            // $temArry_iss['id'] = $id[$key];
            $temArry_iss['istrue'] = $istrue[$key];
            $temArry_iss['order_by'] = $order_by[$key];
            $temArry_iss['parameters'] = $value;
            $temArry_iss['protocols'] = $protocol[$key];
            $temArry_iss['specification'] = $specification[$key];
            $temArry_iss['text'] = $text[$key];
            $temArry_iss['unit'] = $unit[$key];
            $temArry_iss['value'] = $value1[$key];
            $temArry_iss['remark'] = $remark[$key];
            $itemArray_iss[$key] = $temArry_iss;
        }
        //
        foreach ($itemArray_iss as $valueitemArray_iss) {
            if (!empty($valueitemArray_iss['parameters']) && ($valueitemArray_iss['istrue'] == 1)) {
                // if (isset($valueitemArray_iss['istrue']) && !empty($valueitemArray_iss['istrue'])) {
                $sql = "SELECT MAX(id) as testing_id FROM tbl_testing  WHERE `is_active`= 1 ";
                $countData = $this->db->getCustomRows($sql, "single");
                $headId = $this->app->getheadId($valueitemArray_iss['parameters'], $valueitemArray_iss["protocols"]);
                $headId = !empty($headId) ? $headId : NULL;
                $insertData = array(
                    "testing_id" => $countData['testing_id'],
                    "order_by" => $valueitemArray_iss['order_by'],
                    "parameters" => $valueitemArray_iss['parameters'],
                    "protocols" => $valueitemArray_iss["protocols"],
                    "specification" => $valueitemArray_iss["specification"],
                    "head_id" => $headId,
                    "text" => $valueitemArray_iss["text"],
                    "unit" => $valueitemArray_iss["unit"],
                    "value" => $valueitemArray_iss["value"],
                    "remark" => $valueitemArray_iss["remark"],
                    "created_by" => 1
                );
                $formQuery = $this->db->appInsert("tbl_test_material_format", $insertData);
                // }
            }
        }
        if ($formQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    //
    public function getmaterialFormat_2(array $inputData)
    {
        // if (isset($_POST['mateial_category_id']) && !empty($_POST['mateial_category_id'])) {
        $requestData = $inputData["request"];
        $sql2 = "SELECT `id` FROM `tbl_test_category` WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
        $tbl_test_category = $this->db->getCustomRows($sql2, "single");
        $sql1 = "SELECT `id` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type'] . "'";
        $standardTypeId = $this->db->getCustomRows($sql1, "single");
        $sql1 = "SELECT `id` FROM `tbl_test_group` WHERE `is_active`=1 AND `test_category_id` = '" . $tbl_test_category['id'] . "' AND `name` = '" . $requestData['test_group_name'] . "'";
        $tbl_test_group = $this->db->getCustomRows($sql1, "single");
        $sql11 = "SELECT `id` FROM `tbl_material_category` WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
        $material_category_id = $this->db->getCustomRows($sql11, "single");
          $sql = "SELECT `id` FROM `tbl_material_item` WHERE `is_active`=1 AND `name` = '" . $requestData['sample_name'] . "' AND `mateial_category_id`= '" . $material_category_id['id'] . "' ";
        $sampleResultId = $this->db->getCustomRows($sql, "single");
        // echo $result['id'];



        $sql = "SELECT * FROM `tbl_material_format` WHERE `is_active`=1 AND `test_grp_id` = '" . $tbl_test_group['id'] . "' AND `sample_id` = '" . $sampleResultId['id'] . "' AND `standard_test_id` = '" . $standardTypeId['id'] . "'";
        // print_r($sql);
        // exit;

      $result = $this->db->getCustomRows($sql);
        $i = 1;
        if ($result) {
            foreach ($result as $row) {
                echo '<tr id="additionalContinerId">
<input class="col form-control" type="hidden" name="id[]" value="' . $row['id'] . '">
<td class="checkbox-cell"><input type="checkbox" value = "" name="" class="checkbox"></td>
			<td class="input-cell" style="display:none"><input type="text" class="input" value="0" name="istrue[]"></td>
<td><input class="col form-control" type="text" name="order_by[]" value="' . $i . '" ></td>
<td><input class="col form-control" type="text" name="parameters[]" value="' . $row['parameters'] . '" readonly></td>
<td><input class="col form-control" type="text" name="protocols[]" value="' . $row['protocols'] . '"
        fdprocessedid="3suo2o" readonly></td>
<td><input class="col form-control" type="text" name="specification[]" value="' . $row['specification'] . '"
        fdprocessedid="3suo2o" readonly></td>
<td><input class="col form-control" type="text" value="' . $row['text'] . '" name="text[]" readonly></td>
<td><input class="col form-control" type="text" name="unit[]" value="' . $row['unit'] . '" readonly></td>
<td><input class="col-12 form-control result" type="text" id="" name="value[]" value="" tabindex="' . $i++ . '"></td>
<td><select id="remark" class="col-12 form-control form-control-xs" name="remark[]" fdprocessedid="effusw">
<option value="">Select</option>
<option value="pass" ' . (('pass' == $row['remark']) ? 'selected' : '') . '>PASS</option>
<option value="fail" ' . (('fail' == $row['remark']) ? 'selected' : '') . '>FAIL</option>
</select></td>
<td><button disabled type="button" class="btn btn-danger btn-xs additionalContinerRemove" value="" style="padding: 0.213rem 0.6rem;"><i class="mdi mdi-close-circle m-0"></i></button></td>
</tr>';
            }
            // foreach ($result as $row){
            //   echo'<option value="'. $row["id"].'">'. $row["name"].'</option>';
            // }
        }
    }
    //
    //
    public function taskedit(array $inputData)
    {
        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        $testing_id = $requestData["testing_id"];
        $updateFormData = array(
            "test_start_date" => date("Y-m-d 00:00", strtotime($requestData["test_start_date"])),
            "test_end_date" => date("Y-m-d 00:00", strtotime($requestData["test_end_date"])),
            "notes" => json_encode($requestData["notes"], true),
            "is_completed" => 1
        );
        //
        $where = array(
            "id" => $testing_id
        );
        $formQuery1 = $this->db->appUpdate("tbl_testing", $updateFormData, $where);
        //
        if ($formQuery1) {
            $updateDatalog = array(
                "prepared_by" => $requestData["assign_from"]
            );
            $where = array(
                "testing_id" => $testing_id
            );
            $runQuery = $this->db->appUpdate("tbl_testing_logs", $updateDatalog, $where);
        }
        //
        $id = $requestData["id"];
        $order_by = $requestData["order_by"];
        $parameters = $requestData["parameters"];
        $protocol = $requestData["protocols"];
        $specification = $requestData["specification"];
        $text = $requestData["text"];
        $unit = $requestData["unit"];
        $value1 = $requestData["value"];
        $remark = $requestData["remark"];
        $temArry_iss = $itemArray_iss = [];
        foreach ($parameters as $key => $value) {
            // $temArry_iss['id'] = $id[$key];
            $temArry_iss['id'] = $id[$key];
            $temArry_iss['order_by'] = $order_by[$key];
            $temArry_iss['parameters'] = $value;
            $temArry_iss['protocols'] = $protocol[$key];
            $temArry_iss['specification'] = $specification[$key];
            $temArry_iss['text'] = $text[$key];
            $temArry_iss['unit'] = $unit[$key];
            $temArry_iss['value'] = $value1[$key];
            $temArry_iss['remark'] = $remark[$key];
            $itemArray_iss[$key] = $temArry_iss;
        }
        //
        foreach ($itemArray_iss as $value) {
            
            if (!empty($value['id']) && !empty($value['parameters']) && !empty($value['value'])) {
                // if(isset($this->app->getheadId($value['parameters'], $value["protocols"]))){
                 $headId=$this->app->getheadId($value['parameters'], $value["protocols"]);
                //  echo count($headId);
                // }else{
                //     $headId = 1; 
                // }
                $updatematData = array(
                    // "testing_id" => $requestData['testing_id'],
                    "order_by" => $value['order_by'],
                    "parameters" => $value['parameters'],
                    "protocols" => $value["protocols"],
                    "specification" => $value["specification"],
                    "head_id" => $headId,
                    "text" => $value["text"],
                    "unit" => $value["unit"],
                    "value" => $value["value"],
                    "remark" => $value["remark"],
                    "created_by" => 1
                );
                $wheremat = array(
                    "id" => $value['id'],
                    "testing_id" => $requestData['testing_id']
                );
                $formQuery2 = $this->db->appUpdate("tbl_test_material_format", $updatematData, $wheremat);
            }
        }
        //
        if ($formQuery1 || $formQuery2 || $runQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
    //
    public function test(array $inputData)
    {
        $requestData = $inputData["request"];
        $headingcount = $requestData['headingcount'];
        $headingcountarray = count($headingcount);

        // $subHeadingArray = $requestData['sub_heading0'];
        // $fieldtypeArray = $requestData[$fieldtype];
        // if($fieldtypeArray<>'label'){
        // $formValues = 'field_'.$i;
        // $forminsertData = array(
        //     "formheadid" => $formValues
        // );
        // $formValuesQuery = $this->db->appInsert("tbl_form_detail", $forminsertData);
        // }
        for ($i = 0; $i < 10; $i++) {
            $heading = 'heading' . $i;
            $HeadingArray = $requestData[$heading];
            //
            //
            $sub_heading = 'sub_heading' . $i;
            $subHeadingArray = $requestData[$sub_heading];
            $colspan = count($subHeadingArray);
            if (isset($subHeadingArray)) {
                $span = 'colspan="' . $colspan . '"';
            } else {
                $span = 'rowspan="2"';
            }
            /////////////////////////////////
            $insertData = array(
                "head_id" => $requestData['id'],
                "is_main" => 1,
                "is_sub_heading" => 0,
                "span" => $span,
                "head_name" => $HeadingArray[0]
            );
            $formQuery = $this->db->appInsert("tbl_heading", $insertData);
            if ($formQuery) {
                $sql = ("SELECT MAX(id) as id FROM `tbl_heading`  WHERE 1 ");
                $countData = $this->db->getCustomRows($sql, "single");
                foreach ($subHeadingArray as $value) {
                    $subinsertData = array(
                        "head_id" => $requestData['id'],
                        "is_main" => 0,
                        "is_sub_heading" => 1,
                        "head_name" => $value,
                        "reference_id" => $countData['id']
                    );
                    $subformQuery = $this->db->appInsert("tbl_heading", $subinsertData);
                }
            }
        }
        $fieldtype = $requestData['fieldtype'];
        // print_r($fieldtype);
        // exit;
        foreach ($fieldtype as $fieldkey => $fieldvalues) {
            if ($fieldvalues <> 'label') {
                $forminsertData = array(
                    "name" => 'field_' . $fieldkey . '[]',
                    "formheadid" => $requestData['id'],
                    "field_value" => $requestData['fieldvalue'][$fieldkey]
                );
                $formValuesQuery = $this->db->appInsert("tbl_form_detail", $forminsertData);
            }
        }
             //
             if ($formValuesQuery) {
                $outStatus = 'success';
                $outTitle = 'Form Detail';
                $outMessage = 'Data added successfully.';
            } else {
                $outStatus = 'failed';
                $outTitle = "Form Detail";
                $outMessage = 'Data failed';
            }
            $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
            echo json_encode($data, true);
    }
    //
    public function getsearchType(array $inputData)
    {
        $requestData = $inputData["request"];
        $type = $requestData['type'];
        if (isset($requestData['type']) && !empty($requestData['type'])) {
            $sql = "SELECT DISTINCT $type FROM `tbl_testing` WHERE `status`=1 AND `is_active`=1";
            $result = $this->db->getCustomRows($sql);
        }
        echo '<option value="">------------------Select----------------------</option>';
        foreach ($result as $row) {
            echo '<option value="' . $row[$type] . '">' . $row[$type] . '</option>';
        }
    }
    //
    //
    public function testgroupeditassign(array $inputData)
    {


        $requestData = $inputData["request"];
        $form_action = $requestData["form_action"];
        $testing_id = $requestData["testing_id"];
        //
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material` WHERE `is_active`=1 AND `name`='" . $requestData["material_id"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material WHERE `name` = '" . $requestData['material_id'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_id = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_id"]
            );
            $runQuery = $this->db->appInsert("tbl_material", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material WHERE `is_active`=1 AND `name` = '" . $requestData['material_id'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_id = $result['id'];
            }
        }
        //tbl_test_category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_category` WHERE `is_active`=1 AND `name`='" . $requestData["test_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_category WHERE `name` = '" . $requestData['test_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["test_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_category WHERE `is_active`=1 AND `name` = '" . $requestData['test_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_category_name = $result['id'];
            }
        }
        //tbl_test_category//tbl_test_group//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_test_group` WHERE `is_active`=1 AND `test_category_id`='" . $test_category_name . "' AND `name`='" . $requestData["test_group_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_test_group WHERE `is_active`=1 AND `name` = '" . $requestData['test_group_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $test_group_name = $result['id'];
        } else {
            $insertData = array(
                "test_category_id" => $test_category_name,
                "name" => $requestData["test_group_name"]
            );
            $runQuery = $this->db->appInsert("tbl_test_group", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_test_group WHERE `is_active`=1 AND `test_category_id`='" . $test_category_name . "' AND `name` = '" . $requestData['test_group_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $test_group_name = $result['id'];
            }
        }
        //Standard Test Type
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_standard_test_type` WHERE `is_active`=1 AND `name`='" . $requestData["standard_test_type_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `name` = '" . $requestData['standard_test_type_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $standard_test_type_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["standard_test_type_name"]
            );
            $runQuery = $this->db->appInsert("tbl_standard_test_type", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_standard_test_type WHERE `is_active`=1 AND `name` = '" . $requestData['standard_test_type_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $standard_test_type_name = $result['id'];
            }
        }
        //Material Category
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_category` WHERE `is_active`=1 AND `name`='" . $requestData["material_category_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_category WHERE `name` = '" . $requestData['material_category_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_category_name = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["material_category_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_category", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_category WHERE `is_active`=1 AND `name` = '" . $requestData['material_category_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_category_name = $result['id'];
            }
        }
        //Material Category//Material Item//
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_material_item` WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name`='" . $requestData["material_sample_name"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_material_item WHERE `is_active`=1 AND `name` = '" . $requestData['material_sample_name'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $material_sample_name = $result['id'];
        } else {
            $insertData = array(
                "mateial_category_id" => $material_category_name,
                "name" => $requestData["material_sample_name"]
            );
            $runQuery = $this->db->appInsert("tbl_material_item", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_material_item WHERE `is_active`=1 AND `mateial_category_id`='" . $material_category_name . "' AND `name` = '" . $requestData['material_sample_name'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $material_sample_name = $result['id'];
            }
        }
        //sampling_method
        $sql = "SELECT COUNT(`id`) as `total` FROM `tbl_sampling_method` WHERE `name`='" . $requestData["sampling_method"] . "'";
        $countData = $this->db->getCustomRows($sql, "single");
        if ($countData["total"] > 0) {
            $sql = "SELECT `id` FROM tbl_sampling_method WHERE `is_active`=1 AND `name` = '" . $requestData['sampling_method'] . "'";
            $result = $this->db->getCustomRows($sql, "single");
            $sampling_method = $result['id'];
        } else {
            $insertData = array(
                "name" => $requestData["sampling_method"]
            );
            $runQuery = $this->db->appInsert("tbl_sampling_method", $insertData);
            if ($runQuery) {
                $sql = "SELECT `id` FROM tbl_sampling_method WHERE `is_active`=1 AND `name` = '" . $requestData['sampling_method'] . "'";
                $result = $this->db->getCustomRows($sql, "single");
                $sampling_method = $result['id'];
            }
        }
        $otherlabel = json_encode($requestData["otherlabel"], true);
        $othervalue = json_encode($requestData["othervalue"], true);
        $updateFormData = array(
            "sample_code" => $requestData["sample_code"],
            "sampling_date" => date("Y-m-d H:i", strtotime($requestData["sampling_date"])),
            "sampling_receive_date" => date("Y-m-d H:i", strtotime($requestData["sampling_receive_date"])),
            "sample_quantity" => $requestData["sample_quantity"],
            "issued_to" => $requestData["issued_to"],
            "test_start_date" => date("Y-m-d H:i", strtotime($requestData["test_start_date"])),
            "test_end_date" => date("Y-m-d H:i", strtotime($requestData["test_end_date"])),
            "temp" => $requestData["temp"],
            "humidity" => $requestData["humidity"],
            "sampling_condition" => $requestData["sampling_condition"],
            "assign_from" => $requestData["assign_from"],
            "test_responsibility" => $requestData["test_responsibility"],
            "test_category_id" => $test_category_name,
            "test_grp_id" => $test_group_name,
            "standard_test_id" => $standard_test_type_name,
            "material_id" => $material_id,
            "material_grp_id" => $material_category_name,
            "sample_id" => $material_sample_name,
            "sample_method_id" => $sampling_method,
            "status" => $requestData["status"],
            "is_retest" => $requestData["is_retest"],
            "is_resample" => $requestData["is_resample"],
            "reference_id" => $requestData["testing_id"],
            "notes" => json_encode($requestData["notes"], true),
            "otherlabel" => $otherlabel,
            "othervalue" => $othervalue,
            "test_number" => "TEST" . -rand(1000, 9999) . -rand(1000, 9999)
        );
        $where = array(
            "id" => $testing_id
        );
        $formQuery1 = $this->db->appUpdate("tbl_testing", $updateFormData, $where);
        // print_r($formQuery1);
        // exit;
        if ($formQuery1) {
            //
            $sqlmaxid = "SELECT MAX(id) as maxtesting_id FROM tbl_testing WHERE `is_active`=1 ";
            $maxid = $this->db->getCustomRows($sqlmaxid, "single");
            $updateDatalog = array(
                "prepared_by" => $requestData["assign_from"]
            );
            $where = array(
                "testing_id" => $testing_id//is_active
            );
            $runQuery = $this->db->appUpdate("tbl_testing_logs", $updateDatalog, $where);
        }
        //
        $id = $requestData["id"];
        $istrue = $requestData["istrue"];
        $order_by = $requestData["order_by"];
        $parameters = $requestData["parameters"];
        $protocol = $requestData["protocols"];
        $specification = $requestData["specification"];
        $text = $requestData["text"];
        $unit = $requestData["unit"];
        $value1 = $requestData["value"];
        $remark = $requestData["remark"];
        $temArry_iss = $itemArray_iss = [];
        foreach ($parameters as $key => $value) {
            // $temArry_iss['id'] = $id[$key];
            $temArry_iss['id'] = $id[$key];
            $temArry_iss['istrue'] = $istrue[$key];
            $temArry_iss['order_by'] = $order_by[$key];
            $temArry_iss['parameters'] = $value;
            $temArry_iss['protocols'] = $protocol[$key];
            $temArry_iss['specification'] = $specification[$key];
            $temArry_iss['text'] = $text[$key];
            $temArry_iss['unit'] = $unit[$key];
            $temArry_iss['value'] = $value1[$key];
            $temArry_iss['remark'] = $remark[$key];
            $itemArray_iss[$key] = $temArry_iss;
        }
        //

        // print_r($itemArray_iss);
        // exit;
        foreach ($itemArray_iss as $value) {
            if (!empty($value['id']) && ($value['istrue'] == 0)) {
                $conditions = array(
                    "id" => $value["id"],
                );
                $this->db->appDelete('tbl_test_material_format', $conditions);
            }
            //
            if (!empty($value['id']) && !empty($value['parameters']) && ($value['istrue'] == 1)) {
                $updatematData = array(
                    // "testing_id" => $requestData['testing_id'],
                    "order_by" => $value['order_by'],
                    "parameters" => $value['parameters'],
                    "protocols" => $value["protocols"],
                    "specification" => $value["specification"],
                    "head_id" => $this->app->getheadId($value['parameters'], $value["protocols"]),
                    "text" => $value["text"],
                    "unit" => $value["unit"],
                    "value" => $value["value"],
                    "remark" => $value["remark"],
                    "created_by" => 1
                );
                $wheremat = array(
                    "id" => $value['id'],
                    "testing_id" => $requestData['testing_id']
                );
                $formQuery2 = $this->db->appUpdate("tbl_test_material_format", $updatematData, $wheremat);
            }
            //
            if (empty($value['id']) && !empty($value['parameters']) && ($value['istrue'] == 1)) {
                $insertmatData = array(
                    "testing_id" => $requestData['testing_id'],
                    "order_by" => $value['order_by'],
                    "parameters" => $value['parameters'],
                    "protocols" => $value["protocols"],
                    "head_id" => $this->app->getheadId($value['parameters'], $value["protocols"]),
                    "specification" => $value["specification"],
                    "text" => $value["text"],
                    "unit" => $value["unit"],
                    "value" => $value["value"],
                    "remark" => $value["remark"],
                    "created_by" => 1
                );
                // print_r($value);
                $insertrunQuery = $this->db->appInsert("tbl_test_material_format", $insertmatData);
            }
        }
        //
        if ($formQuery1 || $runQuery || $formQuery2 || $insertrunQuery) {
            $outStatus = 'success';
            $outTitle = 'Form Detail';
            $outMessage = 'Data added successfully.';
        } else {
            $outStatus = 'failed';
            $outTitle = "Form Detail";
            $outMessage = 'Data failed';
        }
        $data = array("status" => $outStatus, "title" => $outTitle, "message" => $outMessage);
        echo json_encode($data, true);
    }
    //
}
