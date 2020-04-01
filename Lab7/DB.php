<?php
define('QUERY', "SELECT `country_name`, continents.continent, `population`, `square`, government.government,
(SELECT GROUP_CONCAT(languages.language) 
 FROM languages NATURAL JOIN country_language
WHERE country_language.id_country = countries.id_country)
FROM `countries` NATURAL JOIN government NATURAL JOIN continents " );
  class DB {
	private $_connection;
	private static $_instance; 
	private $_host = "labs.ua";
	private $_username = "root";
	private $_password = "";
	private $_database = "php_lab";

	protected $table;

	public static function getInstance() {
		if(!self::$_instance) { 
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}

	private function __clone() { }

	public function getConnection() {
		return $this->_connection;
	}

	public function select($where="") {
		return $this->_connection->query("SELECT * FROM ".$this->table." ".$where);
	}

	public static function getAll() {
        $res = DB::getInstance()->getConnection()->query(QUERY);
        return $res->fetch_all(MYSQLI_ASSOC);
	}
	
	public static function getObjectsByValues($values){
		$str="WHERE ";
		$query="";
		$i=0;
		$j=0;
		foreach($values as $key=>$value):
			if($key=="id_language" && $value!=null) {
				if($i!=0)
					$query.="OR ";
				$query .= "(SELECT GROUP_CONCAT(languages.language)
			 				FROM languages NATURAL JOIN country_language
							 WHERE country_language.id_country = countries.id_country AND (id_language = ";
				foreach($value as $v){
					if($j==0){
						$query .= $v;
						$j++;
					}
					else
						$query.=' OR id_language = "'.$v.'" ';
				}
				$query.=' ))<>"" ';
			}
			if($value !=null && $key!="id_language"){
				if($i==0){
					$str.= $key." = '".$value."' ";
					$i++;
				}
				else
				$str.= "OR ".$key." = '".$value."' ";
			}
		endforeach;
		//$s=QUERY.$str.$query;
		//echo $s;
        $res = DB::getInstance()->getConnection()->query(QUERY.$str.$query);
        return $res->fetch_all(MYSQLI_ASSOC);
	}

	public static function getCountryByName($name) {
		$res = DB::getInstance()->getConnection()->query(QUERY."WHERE country_name LIKE '".$name."'");
		return $res -> fetch_all(MYSQLI_ASSOC);
	}

}
?>
