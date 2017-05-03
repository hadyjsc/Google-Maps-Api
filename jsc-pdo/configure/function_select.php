<?php
/**
* Class Untuk Query SELECT database By Java-SC Developer a.k.a Hady Eka Saputra
* BELUM DISEMPURNAKAN
*/
class jsc_select {

	private $jsc_database;
	function __construct($jsc_connection) {
		$this->jsc_database = $jsc_connection;
	}

	public function selectLogin($jsc_tableName , $jsc_condition = array() ) {
		try {
			$Query = $this->jsc_database->prepare('SELECT * FROM '.$jsc_tableName.' WHERE user_name=:user_name LIMIT 1');
			$Query->bindParam(':user_name', $jsc_condition[0], PDO::PARAM_STR);
			$Query->execute();

			$data = $Query->fetch(PDO::FETCH_ASSOC);
			if ($Query->rowCount() == 1) {
				if (password_verify($jsc_condition[1], $data['user_pass'] )) {
					$_SESSION['userName'] = $data['user_name'];
					$_SESSION['keyLog'] = $data['user_token'];
					$_SESSION['accessControl'] = $data['user_access'];
					return true;
				}
				else {
					return false;
				}
			}
		} catch (PDOException $e) {
			die("Gagal Untuk Membaca Data Login<br> Error : ".$e->getMessage());

		}
	}

	//select, where , order by, limit , group by, having , return type
	public function selectAll($jsc_tableName , $jsc_condition = array() ) {
		try {
			$sql = 'SELECT ';
			$sql .= array_key_exists('select', $jsc_condition) ? $jsc_condition['select']:' * ';
			$sql .= ' FROM '.$jsc_tableName;
			if (array_key_exists('where', $jsc_condition)) {
				$sql .= ' WHERE ';
				$i = 0;
				foreach ($jsc_condition['where'] as $key => $value) {
					$pre = ($i > 0) ? ' AND ':'';
					$sql .= $pre.$key." = '".$value."'";
					$i++;
				}
			}
			// echo $sql;
			if (array_key_exists('order_by', $jsc_condition)) {
				$sql .= ' ORDER BY '.$jsc_condition['order_by'];
			}
			if (array_key_exists('start', $jsc_condition) && array_key_exists('limit', $jsc_condition)) {
				$sql .= ' LIMIT '.$jsc_condition['start'].','.$jsc_condition['limit'];
			}elseif (!array_key_exists('start', $jsc_condition) && array_key_exists('limit', $jsc_condition)) {
				$sql .= ' LIMIT '.$jsc_condition['limit'];
			}
			if (array_key_exists('group_by', $jsc_condition)) {
				$sql .= ' GROUP BY '.$jsc_condition['group_by'];
			}
			if (array_key_exists('having', $jsc_condition)) {
				$sql .= ' HAVING '.$jsc_condition['having'];
			}


			$Query = $this->jsc_database->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$Query->execute();
			// $Result = $Query->fetch(PDO::FETCH_OBJ);
			
			// print_r($Result);

			if(array_key_exists("return_type",$jsc_condition) && $jsc_condition['return_type'] != 'all'){
	            switch($jsc_condition['return_type']){
	                case 'count':
	                    $data = $Query->rowCount();
	                    break;
	                case 'single':
	                    $data = $Query->fetch(PDO::FETCH_ASSOC);
	                    break;
	                default:
	                    $data = '';
	            }
	        }else{
	            if($Query->rowCount() > 0){
	                $data = $Query->fetchAll();
	            }
	        }

	        return !empty($data)?$data:false;

		}catch (PDOException $e) {
			die("Gagal Untuk Membaca Data <br> Error : ".$e->getMessage());
		}
	}

	public function selectJoinTwoTable($jsc_field = array(), $jsc_tableName = array(), $jsc_condition = array() ){
		try {
			$sql = ' SELECT ';
				$string = '';
				foreach ($jsc_field as $key => $value) {
				  $string .= $value.".".$key . ',';
				}
				$string = rtrim($string, ',');
			$sql .= $string;
			$sql .= ' FROM '.$jsc_tableName[0].' INNER JOIN '.$jsc_tableName[1];
			$sql .= ' WHERE '.$jsc_tableName[0].'.'.$jsc_condition[0].' = '.$jsc_tableName[1].'.'.$jsc_condition[1];

			$Query = $this->jsc_database->prepare($sql);
			$Query->execute();
			// print_r($Query);

			return $Query;
		} catch (PDOException $e) {
			die("Gagal Untuk Membaca Data <br> Error : ".$e->getMessage());
		}
	}

	public function functionSQL($jsc_tableName , $jsc_condition = array()){
		try {
			$sql = ' SELECT ';
			$sql .= array_key_exists('select', $jsc_condition) ? $jsc_condition['select']:' * ';
			if (array_key_exists('where', $jsc_condition)) {
				$sql .= ' WHERE ';
				$i = 0;
				foreach ($jsc_condition['where'] as $key => $value) {
					$pre = ($i > 0) ? ' AND ':'';
					$sql .= $pre.$key." = '".$value."'";
					$i++;
				}
			}
			if (array_key_exists('average' , $jsc_condition )) {
				$sql .= ' AVG ('.$jsc_condition.')';
			}
			if (array_key_exists('count', $jsc_condition)) {
				$sql .= ' COUNT ('.$jsc_condition.')';
			}
			if (array_key_exists('first', $jsc_condition)) {
				$sql .= ' FIRST ('.$jsc_condition.')';
			}
			if (array_key_exists('last', $jsc_condition)) {
				$sql .= ' LAST ('.$jsc_condition.')';
			}
			if (array_key_exists('max', $jsc_condition)) {
				$sql .= ' MAX ('.$jsc_condition.')';
			}
			if (array_key_exists('min', $jsc_condition)) {
				$sql .= ' MIN ('.$jsc_condition.')';
			}
			if (array_key_exists('round', $jsc_condition)) {
				$sql .= ' ROUND ('.$jsc_condition.')';
			}
			if (array_key_exists('sum', $jsc_condition)) {
				$sql .= ' SUM ('.$jsc_condition.')';
			}
			$sql .= ' FROM '.$jsc_tableName;

			$Query = $this->jsc_database->prepare($sql);
			$Query->execute();
		} catch (PDOException $e) {
			die("Gagal Untuk Membaca Data <br> Error : ".$e->getMessage());
		}
	}

}

?>
