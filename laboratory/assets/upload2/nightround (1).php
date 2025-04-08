<?php
// MobileFo.php
	public function addBeatSubmit_post(){
        case 9:
            $outStatus = $this->appfo_lib->addNightRoundSubmit($requestData);
        break;

    }
// MobileSho.php
	public function addBeatSubmit_post(){
        case 9:
            $outStatus = $this->appSho_lib->addNightRoundSubmit($requestData);
        break;

    }
// AppFo_lib.php
public function addNightRoundSubmit($requestData = array()){
    $loginUserId = $requestData["loginUserId"];
    $policeStationId = $requestData["loginPoliceStationId"];
    //
    $now = $this->now;
    $action = $requestData["action"];
    $createdBy=$requestData["createdBy"];
    //
    $beatData = $this->addBeatSubmit($requestData); 	
    if($beatData["status"]=="success")
    {
        $beatId = $beatData["beatId"];
        //
        $insertData = array(
            "beatId" => $beatId,
            "startLocation" => $requestData["startLocation"],
            "endLocation" => $requestData["endLocation"],
            "startLocationLat" => $requestData["startLocationLat"],
            "startLocationLng" => $requestData["startLocationLng"],
            "endLocationLat" => $requestData["endLocationLat"],
            "endLocationLng" => $requestData["endLocationLng"]
        );
        //
        if($action=="insert"){
            $detailRun = $this->CI->API_model->appInsert("night_round", $insertData);	
        }elseif($action=="update"){
            $detailRun = $this->CI->API_model->appUpdate("night_round", $insertData, array("beatId"=>$beatId));	
        }
        return array("msg"=>"success","beatId"=>$beatId);
        //
        
    }else{
        return array("msg"=>"failed","beatId"=>0);
    }		
}
//


//AppFo_lib.php
public function addRouteBeatSubmit($requestData = array()){
    $loginUserId = $requestData["loginUserId"];
    $policeStationId = $requestData["loginPoliceStationId"];
    //
    $now = $this->now;
    $action = $requestData["action"];
    $createdBy=$requestData["createdBy"];
    //
    $beatData = $this->addBeatSubmit($requestData); 	
    if($beatData["status"]=="success")
    {
        $beatId = $beatData["beatId"];
        //
        $insertData = array(
            "beatId" => $beatId,
            "startLocation" => $requestData["startLocation"],
            "endLocation" => $requestData["endLocation"],
            "startLocationLat" => $requestData["startLocationLat"],
            "startLocationLng" => $requestData["startLocationLng"],
            "endLocationLat" => $requestData["endLocationLat"],
            "endLocationLng" => $requestData["endLocationLng"]
        );
        //
        if($action=="insert"){
            $detailRun = $this->CI->API_model->appInsert("beats_route", $insertData);	
        }elseif($action=="update"){
            $detailRun = $this->CI->API_model->appUpdate("beats_route", $insertData, array("beatId"=>$beatId));	
        }
        return array("msg"=>"success","beatId"=>$beatId);
        //
        
    }else{
        return array("msg"=>"failed","beatId"=>0);
    }		
}
//

//App_Sho_lib.php
public function addRouteBeatSubmit($requestData = array()){
    $loginUserId = $requestData["loginUserId"];
    $policeStationId = $requestData["loginPoliceStationId"];
    //
    $now = $this->now;
    $action = $requestData["action"];
    $createdBy=$requestData["createdBy"];
    //
    $beatData = $this->addBeatSubmit($requestData); 	
    if($beatData["status"]=="success")
    {
        $beatId = $beatData["beatId"];
        $userId = $requestData["userId"];
        //
        foreach($userId as $key=> $userIdvalue){
            $insertData = array(
            "beatId" => $beatId,
            "userId" => $userIdvalue
        );

         $this->CI->API_model->appInsert("beats_assign", $insertData);	
    }

        $insertData = array(
            "beatId" => $beatId,
            "startLocation" => $requestData["startLocation"],
            "endLocation" => $requestData["endLocation"],
            "startLocationLat" => $requestData["startLocationLat"],
            "startLocationLng" => $requestData["startLocationLng"],
            "endLocationLat" => $requestData["endLocationLat"],
            "endLocationLng" => $requestData["endLocationLng"]
        );
        //
        if($action=="insert"){
            $detailRun = $this->CI->API_model->appInsert("beats_route", $insertData);	
        }elseif($action=="update"){
            $detailRun = $this->CI->API_model->appUpdate("beats_route", $insertData, array("beatId"=>$beatId));	
        }
        return array("msg"=>"success","beatId"=>$beatId);
        //
        
    }else{
        return array("msg"=>"failed","beatId"=>0);
    }		
}
//App_Sho_lib.php
public function addNightRoundSubmit($requestData = array()){
    $loginUserId = $requestData["loginUserId"];
    $policeStationId = $requestData["loginPoliceStationId"];
    //
    $now = $this->now;
    $action = $requestData["action"];
    $createdBy=$requestData["createdBy"];
    //
    $beatData = $this->addBeatSubmit($requestData); 	
    if($beatData["status"]=="success")
    {
        $beatId = $beatData["beatId"];
        //
        $insertData = array(
            "beatId" => $beatId,
            "startLocation" => $requestData["startLocation"],
            "endLocation" => $requestData["endLocation"],
            "startLocationLat" => $requestData["startLocationLat"],
            "startLocationLng" => $requestData["startLocationLng"],
            "endLocationLat" => $requestData["endLocationLat"],
            "endLocationLng" => $requestData["endLocationLng"]
        );
        //
        if($action=="insert"){
            $detailRun = $this->CI->API_model->appInsert("night_round", $insertData);	
        }elseif($action=="update"){
            $detailRun = $this->CI->API_model->appUpdate("night_round", $insertData, array("beatId"=>$beatId));	
        }
        return array("msg"=>"success","beatId"=>$beatId);
        //
        
    }else{
        return array("msg"=>"failed","beatId"=>0);
    }		
}



//sql
INSERT INTO `beattypes` (`id`, `name`, `short_name`, `formMasterId`, `is_active`, `is_deleted`, `createdAt`, `updatedAt`) VALUES (NULL, 'Night Round', 'Night Round', '52', '1', '0', NULL, NULL)