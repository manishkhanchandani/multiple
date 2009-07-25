<?php
class db {
	private static $instance;
	
	public function __construct() {
		if(self::$instance) {
			return self::$instance;
		} else {
			self::$instance = $this;
		}
	}
	
	public function display_table_fields($table_name) {
		$rs = @mysql_query("select * from ".$table_name." LIMIT 1");
		if(!$rs) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		$i = 0;
		$register_main_arr = array();
		while ($i < mysql_num_fields($rs)) {
			$meta = mysql_fetch_field($rs, $i);
			$register_arr[] = $meta->name;
			$i++;
		}
		return $register_arr;
	}
	public function phpinsert($table_name,$pk,$postarray) {
		$register_arr = array();
		$register_arr = $this->display_table_fields($table_name);
		$query = "insert into ".$table_name." set ";
		foreach($postarray as $key=>$value) {
			if(gettype($value)=="array") {
				$string = '';
				foreach($value as $val) {
					if(strlen($val)>0) { 
						$val = $this->processString($val);
						$string .= $val.'|';
					}
				}
				$string = substr($string,0,-1);
				if(in_array($key,$register_arr)) {
					$query .= $key."='".$string."',"; 
				}
			} else {
				if(in_array($key,$register_arr)) {
					$value = $this->processString($value);
					$query .= $key."='".$value."',";
				}
			}
		}
		$query = substr($query,0,-1);
		$result = @mysql_query($query);
		if(!$result) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		$uid = mysql_insert_id();
		return $uid;
	}
	
	public function phpedit($table_name,$pk,$postarray,$uid) {
		$register_arr = array();
		$register_arr = $this->display_table_fields($table_name);
		$query = "update ".$table_name." set ".$pk." = '".$uid."',";
		foreach($postarray as $key=>$value) {
			if(gettype($value)=="array") {
				$string = '';
				foreach($value as $val) {
					if(strlen($val)>0) { 
						$val = $this->processString($val);
						$string .= $val.'|';
					}
				}
				$string = substr($string,0,-1);
				if(in_array($key,$register_arr)) {
					$query .= $key."='".$string."',"; 
				}
			} else {
				if(in_array($key,$register_arr)) {
					$value = $this->processString($value);
					$query .= $key."='".$value."',";
				}
			}
		}
		$query = substr($query,0,-1);
		$query .= " where ".$pk." = '".$uid."'";		
		$result = @mysql_query($query);
		if(!$result) {
			throw new Exception(mysql_error()." on line number ".__LINE__." of file ".__FILE__);
		}
		return $uid;
	}
	
	private function processString($text) {
		return addslashes(stripslashes(trim($text)));
	}
}
?>