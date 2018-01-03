<?php
class Model {
	public function __construct($data = null) {
		if ($data) {
			static::readId($data);
		}	
	}
	
	public static function getConn() {
		static $conn = null;
		if ($conn===null) {
			include CONFIG_PATH.DS."db_config.php";
			
			$conn = mysqli_connect(
				$MYSQL_CONFIG['HOST'],
				$MYSQL_CONFIG['USER'],
				$MYSQL_CONFIG['PASSWORD'],
				$MYSQL_CONFIG['DATABASE']
			);
			mysqli_set_charset($conn,"utf8");
			//if connection not exist then send error message
			if (!$conn) static::errorMsg();			
		}
		return $conn;
	}	
	
    protected static function readId ($id){
		static::readRecords(sprintf('`id` = %u',$id), true);
    }
	
    public static function getAll(){
		return static::readRecords('1', true, true);
    }	
	
    public static function getFirst(){
		return static::readRecords('1', true, false, 0, 1, 'id', false);
    }	
	
    public static function getLast(){
		return static::readRecords('1', true, false, 0, 1, 'id', true);
    }	
	protected static function getClassName (){
		$tableName=static::$TABLE_NAME ? static::$TABLE_NAME : '';
		if (strlen(trim($tableName))<1) { return false;}
			$className = ucfirst(substr($tableName, -1)==="s" ? substr($tableName, 0, -1) : $tableName);
		return $className;		
	}
	
	public static function insertRow($array=[]){
		if (count($array)>0){
			$keys = array_keys($array);
			$values = array_values($array);
			$key_data = '(`'.implode('`,`',$keys).'`)';
			$value_data = "('".implode("','",$values)."')";
			$query=sprintf("INSERT INTO `%s` %s VALUES %s",static::$TABLE_NAME,$key_data,$value_data);
			if (!empty($queryResult = mysqli_query(static::getConn(), $query))){
				return [true, ""];
			}else{
				return [false, "Cannot insert this to database"];
			}
		}
	}
	
    protected function setRecord ($record){
		foreach($record as $key => $value){
			$this->$key = $value;
		}
    }		
	//	useage if it is public:
	//	Model::readRecords("id>22", true, true, -1, -1, 'id', true)
	protected static function readRecords ($conditons="1", $returnData=false, $array=false, $page=0, $perPage=PHP_INT_MAX, $orderBy=false, $orderDesc=false){
		if ($perPage < 1) $perPage = 30;
		$orderBy = $orderBy ? sprintf("ORDER BY `%s` %s",$orderBy,$orderDesc ? "DESC" : "ASC") : "";
		$startPage = $page>-1 ? ($page*$perPage): 0;
		$endPage = $page>-1 ? $perPage : PHP_INT_MAX;
		$query = sprintf("SELECT * FROM `%s` WHERE %s %s LIMIT %u, %u",static::$TABLE_NAME,$conditons,$orderBy, $startPage,$endPage);
		$result = static::execQuery($query);	
		// we check if we got result
		if (!empty($result)){
			// we check if we need return data
			if ($returnData!==false){
				$className = static::getClassName();
				$out = [];
				//if we need 1 item then first block, if we need mor record then we use foreach
				if (!$array){
					$obj = new $className;
					$obj -> setRecord($result[0]);
					$out = $obj;
				}else{
					foreach ($result as $row) {
						$obj = new $className();
						$obj -> setRecord($row);
						$out[] = $obj;
					}	
				}
				return $out;
			}
			return true;
		}else{
			return false;
		}		
	}
	
	protected static function execQuery ($query){
		$queryResult = mysqli_query(static::getConn(), $query);
			
		if (!$queryResult) static::errorMsg();
		
		if (is_object($queryResult)){
			$result = [];
			
			while($row = mysqli_fetch_assoc($queryResult)){
				$result[] = $row;
			}; 
			mysqli_free_result($queryResult);
			return $result;
		}
		return $queryResult;
	}
	protected static function errorMsg(){
		$errorNo = mysqli_connect_errno();
		$errorStr = mysqli_connect_error();
		die (PHP_EOL.'<b>error ['.$errorNo.']:</b> <i>'.$errorStr.'</i>'.PHP_EOL);		
	}
}