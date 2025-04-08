<?php
Class Database{
	public $host   = DB_HOST;
	public $user   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	
	
	public $link;
	public $error;
	
	public function __construct(){
		$this->connectDB();
	}
	
	private function connectDB(){
		if(!$this->link){
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            if(!$this->link){
                $this->error ="Connection fail".$this->link->connect_error;
                return false;
            }else{
                $this->link->set_charset("utf8");
            }
        }        
    }
	
	/*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, whereIn, notEqual,likeOr, orderBy, limit and returnType conditions
     */
    public function getRows($table, $conditions = array()){
		$sql = 'SELECT ';
        $sql .= array_key_exists("select", $conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
		if(array_key_exists("where", $conditions) && !empty($conditions['where']) ){
			$sql .= ' WHERE ';
			$i = 0;
			foreach($conditions['where'] as $key => $value){
				$pre = ($i > 0)?' AND ':'';
				$sql .= $pre.$key." = '".$this->link->real_escape_string($value)."'";
				$i++;
			}
            // return $sql;
        }
		
		if(array_key_exists("whereIn", $conditions)){
            $sql .= (strpos($sql, 'WHERE') !== false)?' AND ':' WHERE ';
			$i = 0;
            foreach($conditions['whereIn'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." IN (".$this->link->real_escape_string($value).")";
                $i++;
            }
			
        }
		
		if(array_key_exists("between", $conditions)){
            if(count($conditions["between"])>0){
				$sql .= (strpos($sql, 'WHERE') !== false)?' AND ':' WHERE ';
				$i = 0;
				foreach($conditions['between'] as $key => $valueData){
					$pre = ($i > 0)?' AND ':'';
					$sql .= $pre.$key." BETWEEN '".$valueData["startvalue"]."' AND '".$valueData["endvalue"]."'";
					  $i++;
				}
			}
		}
		
		if(array_key_exists("notEqual", $conditions)){
            $sql .= (strpos($sql, 'WHERE') !== false)?' AND ':' WHERE ';
			$i = 0;
            foreach($conditions['notEqual'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." <> '".$this->link->real_escape_string($value)."'";
                $i++;
            }
		}
        
        if(array_key_exists("like", $conditions) && !empty($conditions['like'])){
            $sql .= (strpos($sql, 'WHERE') !== false)?' AND ':' WHERE ';
            $i = 0;
            $likeSQL = '';
            foreach($conditions['like'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $likeSQL .= $pre.$key." LIKE '%".$this->link->real_escape_string($value)."%'";
                $i++;
            }
            $sql .= '('.$likeSQL.')';
        }
        
        if(array_key_exists("likeOr", $conditions) && !empty($conditions['likeOr'])){
            $sql .= (strpos($sql, 'WHERE') !== false)?' AND ':' WHERE ';
            $i = 0;
            $likeSQL = '';
            foreach($conditions['likeOr'] as $key => $value){
                $pre = ($i > 0)?' OR ':'';
                $likeSQL .= $pre.$key." LIKE '%".$this->link->real_escape_string($value)."%'";
                $i++;
            }
            $sql .= '('.$likeSQL.')';
        }
        
        if(array_key_exists("orderBy", $conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
		//
        $result = $this->link->query($sql);
        
        if(array_key_exists("returnType", $conditions) && $conditions['returnType'] != 'all'){
            switch($conditions['returnType']){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    $data = '';
            }
        }else{
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
	//
    public function getCustomRows($sql, $returnType = '') {
        // Execute the query
        $result = $this->link->query($sql);
        
        // Check if the query was successful
        if ($result === false) {
            // Log the SQL query and the error message
            error_log("SQL Query Error: " . $sql);
            error_log("MySQL Error: " . $this->link->error);
            return false; // Return false to indicate failure
        }
        
        $data = [];
        
        // Process the result based on the return type
        if ($returnType != '') {
            switch ($returnType) {
                case 'count':
                    // Ensure $result is valid before accessing num_rows
                    if ($result instanceof mysqli_result) {
                        $data = $result->num_rows;
                    }
                    break;
                case 'single':
                    // Ensure $result is valid before fetching the single row
                    if ($result instanceof mysqli_result) {
                        $data = $result->fetch_assoc();
                    }
                    break;
                default:
                    $data = '';
            }
        } else {
            // Fetch all rows if no return type is specified
            if ($result instanceof mysqli_result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
        }
        
        // Return the data if not empty, otherwise return false
        return !empty($data) ? $data : false;
    }
    
	//
    
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function appInsert($table, $data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            //
            $array_filter_data = array_filter($data);
            foreach($array_filter_data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= $pre."'".$this->link->real_escape_string($val)."'";
                $i++;
            }
            $query = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
            // return $query;
            // exit;
            $insert = $this->link->query($query);
            return $insert?$this->link->insert_id:false;
        }else{
            return false;
        }
    }
     /*
     * Escape
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
     public function sqlescape($val){
        return $this->link->real_escape_string($val);
     } 
	
    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function appUpdate($table, $data, $conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            //
            foreach($data as $key=>$val){
                // $val = trim($val);
                $pre = ($i > 0)?', ':'';
                if(is_null($val)){
                    $colvalSet .= $pre.$key." =null ";
                }
                elseif(strlen($val) > 0){
                    $colvalSet .= $pre.$key."='".$this->link->real_escape_string($val)."'";
                }else{
                    $colvalSet .= $pre.$key." ='' ";  
                }
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            // return $query;
            $update = $this->link->query($query);
            return $update?$this->link->affected_rows:false;
        }else{
            return false;
        }
    }
    
    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function appDelete($table, $conditions){
        $whereSql = '';
        if(!empty($conditions) && is_array($conditions)){
            $whereSql .= ' WHERE ';
            $data = array(
                "is_active" => 0,
                "is_deleted" => 1
            );
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$this->link->real_escape_string($val)."'";
                $i++;
            }

            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
        // $query = "DELETE FROM ".$table.$whereSql;
        $delete = $this->link->query($query);
        return $delete?true:false;
    }
    // public function appDelete($table, $conditions){
    //     $whereSql = '';
    //     if(!empty($conditions) && is_array($conditions)){
    //         $whereSql .= ' WHERE ';
    //         $i = 0;
    //         foreach($conditions as $key => $value){
    //             $pre = ($i > 0)?' AND ':'';
    //             $whereSql .= $pre.$key." = '".$value."'";
    //             $i++;
    //         }
    //     }
    //     $query = "DELETE FROM ".$table.$whereSql;
    //     $delete = $this->link->query($query);
    //     return $delete?true:false;
    // }
	
	// Select or Read data
	public function select($query){
		$result = $this->link->query($query) or die($this->link->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}
	
	// Insert data
	public function insert($query){
		$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if($insert_row){
			return $insert_row;
		} else {
			return false;
		}
	}
  
    // Update data
  	public function update($query){
		$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if($update_row){
			return $update_row;
		} else {
			return false;
		}
	}
  
	//Delete data
	public function delete($query){
		$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
		if($delete_row){
			return $delete_row;
		} else {
			return false;
		}
	}
    //
    public function verifyPasswordHash($password, $hash) {
        return password_verify($password, $hash);
        /*$password = md5($password);
        if($password==$hash){
            return true;
        }*/
        return false;
    }
    //
    public function sqlinsertid()
    {
        $value=mysqli_insert_id($this->link);
        return $value;
    }
    //
        public function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

}