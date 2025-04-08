<?php
/**
* Format Class
*/
ini_set('default_charset', 'UTF-8');
class Format{
	public function __construct() {
		ini_set('default_charset', 'UTF-8');
	}
	public function hashPassword($password){
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}

	public function textShorten($text, $limit = 400){
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text.".....";
		return $text;
	}

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		//$title = str_replace('_', ' ', $title);
		if ($title == 'index') {
			$title = 'home';
		}elseif ($title == 'contact') {
			$title = 'contact';
		}
		return $title = ucfirst($title);
	}
	//
	public function getYear(){
		$curYear = date("Y");
		$array = []; 
		for($year = 2022; $year<=($curYear+1); $year++){
			$array[] = $year;
		}
		return $array;
	}
	//
	public function getMonth(){
		$array=array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
		return $array;
	}
	//
	public function getSundays($y, $m)
	{
		return new DatePeriod(
			new DateTime("first sunday of $y-$m"),
			DateInterval::createFromDateString('next sunday'),
			new DateTime("last day of $y-$m 23:59:59")
		);
	}
	//Search by 
	public function getSqlCommaSplit($filed_values, $field_name)
	{
		$filed_values=trim($filed_values);
		$condi="";
		$ids=explode(',', $filed_values);
		if(count($ids)>0 && $filed_values!=""){
			for($i=0; $i<count($ids); $i++)
			{
				if($i==0)
				{
					$condi.=" AND (".$field_name."='".trim($ids[$i])."'";
				}
				else
				{
					$condi.=" OR ".$field_name."='".trim($ids[$i])."'";
				}
				
			}
			if($i<>0)
			{
				$condi.=")";
			}
		}
		return $condi;
	}
	//
	public function GetThisMonthDateDiff(){
		$from_date=date("Y-m-d", strtotime("first day of this month"));
		$to_date=date("Y-m-d", strtotime("last day of this month"));
		return array("from_date"=>$from_date,"to_date"=>$to_date);
	}
	//
	public function GetLastMonthDateDiff(){
		$from_date=date("Y-m-d", strtotime("first day of previous month"));
		$to_date=date("Y-m-d", strtotime("last day of previous month"));
		return array("from_date"=>$from_date,"to_date"=>$to_date);
	}
	//
	public function GetLastPreviousMonth($cnt=1){
		return date("Y-m-d",strtotime("-".$cnt." Months"));
	}
	//
	public function GetToday(){
		return date("Y-m-d");
	}
	//
	public function GetYesterday(){
		return date('Y-m-d',strtotime("-1 days"));
	}
	//
	public function GetTomorrow(){
		return date("Y-m-d", strtotime('tomorrow'));
	}
	//
	public function GetThisWeekDiff(){
		//$firstday = date('l - d/m/Y', strtotime("sunday -1 week"));
		//echo "First day of this week: ", $firstday, "\n";
		$from_date = date('Y-m-d', strtotime("sunday -1 week"));
		$to_date = date('Y-m-d', strtotime("saturday 0 week"));
		return array("from_date"=>$from_date,"to_date"=>$to_date);
	}
	//
	public function GetLastWeekDateDiff(){
		$from_date = date('Y-m-d', strtotime("sunday -2 week"));
		$to_date = date('Y-m-d', strtotime("saturday -1 week"));
		return array("from_date"=>$from_date,"to_date"=>$to_date);
	}
	//
	public function getDateDiffList($start, $end, $format = 'Y-m-d' ) { 
		// Declare an empty array 
		$array = array(); 
		// Variable that store the date interval 
		$interval = new DateInterval('P1D'); 
		$realEnd = new DateTime($end); 
		$realEnd->add($interval); 
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
		// Use loop to store date into array 
		foreach($period as $date) {  
			$check_date=$date->format($format); 
			$array[] = $check_date; 
		} 
		// Return the array elements 
		return $array; 
	}

	public function arraySearchData($array, $search_list) { 
		// Create the result array 
		$result = array(); 
	  
		// Iterate over each array element 
		foreach ($array as $key => $value) { 
	  
			// Iterate over each search condition 
			foreach ($search_list as $k => $v) { 
		  
				// If the array element does not meet 
				// the search condition then continue 
				// to the next element 
				if (!isset($value[$k]) || $value[$k] != $v) 
				{ 
					  
					// Skip two loops 
					continue 2; 
				} 
			} 
		  
			// Append array element's key to the 
			//result array 
			$result[] = $value; 
		} 
	  
		// Return result  
		return $result; 
	}

	// Get File type Icons
	public function getfiletypeicon($type){
		$icon=$type;
		switch($type){
			// MS-Word Document
			case 'pdf':
				$icon="pdf";
			break;
			case 'doc':
				$icon="doc";
			break;
			case 'dot':
				$icon="doc";
			break;
			case 'docx':
				$icon="doc";
			break;
			case 'docm':
				$icon="doc";
			break;
			case 'dotx':
				$icon="doc";
			break;
			case 'dotm':
				$icon="doc";
			break;
			case 'docb':
				$icon="doc";
			break;
			// MS-PowerPoint Document
			case 'ppt':
				$icon="ppt";
			break;
			case 'pot':
				$icon="ppt";
			break;
			case 'pps':
				$icon="ppt";
			break;
			case 'pptx':
				$icon="ppt";
			break;
			case 'pptm':
				$icon="ppt";
			break;
			case 'potx':
				$icon="ppt";
			break;
			case 'potm':
				$icon="ppt";
			break;
			case 'ppam':
				$icon="ppt";
			break;
			case 'ppsx':
				$icon="ppt";
			break;
			case 'ppsm':
				$icon="ppt";
			break;
			case 'sldx':
				$icon="ppt";
			break;
			case 'sldm':
				$icon="ppt";
			break;
			// MS-Excle Document
			case 'xls':
				$icon="xls";
			break;
			case 'xlt':
				$icon="xls";
			break;
			case 'xlm':
				$icon="xls";
			break;
			case 'xlsx':
				$icon="xls";
			break;
			case 'xlsm':
				$icon="xls";
			break;
			case 'xltx':
				$icon="xls";
			break;
			case 'xltm':
				$icon="xls";
			break;
			case 'xlsb':
				$icon="xls";
			break;
			case 'xla':
				$icon="xls";
			break;
			case 'xlam':
				$icon="xls";
			break;
			case 'xll':
				$icon="xls";
			break;
			case 'xlw':
				$icon="xls";
			break;
			default:
				$icon="doc";
		}
		$icon=BASE_URL."global_assets/images/filetype/".$icon.".svg";
		return $icon;
	}
	//
	public function urlTitle($str, $separator = '-', $lowercase = FALSE)
	{
		if ($separator === 'dash')
		{
			$separator = '-';
		}
		elseif ($separator === 'underscore')
		{
			$separator = '_';
		}

		$q_separator = preg_quote($separator, '#');

		$trans = array(
			'&.+?;'			=> '',
			'[^\w\d _-]'		=> '',
			'\s+'			=> $separator,
			'('.$q_separator.')+'	=> $separator
		);

		$str = strip_tags($str);
		foreach ($trans as $key => $val)
		{
			//$str = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $str);
			$str = preg_replace('#'.$key.'#i'.(''), $val, $str);
		}

		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}

		return trim(trim($str, $separator));
	}
	//
}
?>