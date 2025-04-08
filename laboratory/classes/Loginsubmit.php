<?php
/**
* Report Class
*/
class Loginsubmit{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database;
        $this->fm = new Format;
        $this->now = date("Y-m-d H:i:s");
    }
    //
    public function loginFormSubmit(array $requestData){
        $username = $requestData["username"];    
        $password = $requestData["password"];
        $con = array("returnType"=>'single');
        $con["where"] = array(
            "username" => $username,
            "is_active" => 1
         );
        $userData = $this->db->getRows("users", $con);
       // print_r($userData);
        if($userData){
            $hash = $userData["password"];
            if($this->db->verifyPasswordHash($password, $hash)){
                //Session::init();
                Session::set("login", true);
                Session::set("userId", $userData["id"]);
                Session::set("name", $userData["emp_name"]);
                Session::set("email", $userData["email"]);
                Session::set("roleId", $userData["user_type_id"]);
                $outStatus = 'success';
                $outTitle = 'Login Status';
                $outMessage = 'Login successfully.';
            }else{
                $outStatus = 'failed';
                $outTitle = "Login Status";
                $outMessage = 'Password not matched!';
            }    
        }
        else{
            $outStatus = 'failed';
            $outTitle = "Login Status";
            $outMessage = 'User inactive';
        }
        $data = array("status"=>$outStatus,"title"=>$outTitle,"message"=>$outMessage);
        echo json_encode($data, true);
    }
    //
}