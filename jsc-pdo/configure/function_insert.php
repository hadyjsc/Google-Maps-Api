<?php
/**
* Class Untuk Query INSERT database By Java-SC Developer a.k.a Hady Eka Saputra
* BELUM DISEMPURNAKAN
*/
class jsc_insert {
	private $jsc_database;
	function __construct($jsc_connection) {
		$this->jsc_database = $jsc_connection;
	}

	public function insertOneTable($jsc_tableName , $jsc_value = array()){
		try {
			$sql = ' INSERT ';
			$sql .= ' INTO '.$jsc_tableName;
			$string = null;
			if (array_key_exists('insert', $jsc_value)){
				foreach ($jsc_value as $key => $value) {
					for ($i=0; $i < count($value); $i++) { 
						$string .= '"'.$value[$i].'",';							
					}
				}
				$string = rtrim($string, ',');

			}
			$sql .= ' VALUES ('.$string.')';
			print_r($sql);
			$this->save($sql);

		} catch (PDOException $e) {
			die("Gagal Untuk Menyimpan Data Ke Table ".$jsc_tableName."<br> Error : ".$e->getMessage());
		}
	}

	public function insertOneTableWithAttr($jsc_tableName , $jsc_value = array()) {
		try {
			if (!empty($jsc_value)) {
				$column = '';
				$value = '';
				$i = 0;

				$columnString = implode(',', array_keys($jsc_value));
				$valueString = ':'.implode(',:', array_keys($jsc_value));
				$sql = ' INSERT INTO '.$jsc_tableName.'('.$columnString.') VALUES ('.$valueString.')';

				$Query = $this->jsc_database->prepare($sql);
				foreach ($jsc_value as $key => $value) {
					$Query->bindValue(':'.$key,$value);
				}
				$Query->execute();
				return $Query;
			}
			else {
				return false;
			}

		} catch (PDOException $e) {
			die("Gagal Untuk Menyimpan Data Ke Table ".$jsc_tableName."<br> Error : ".$e->getMessage());
		}
	}

	public function createId($jsc_tableName , $attr) {
		try {
			// $sql = 'SELECT '.$attr.' FROM '.$jsc_tableName.' ORDER BY '.$attr.' DESC';
			$sql = 'SELECT '.$attr.' FROM '.$jsc_tableName.' ORDER BY CAST(SUBSTRING('.$attr.',LOCATE("-",'.$attr.')+1) AS SIGNED) DESC';
			$Query = $this->jsc_database->prepare($sql);
			$Query->execute();
			$data = $Query->fetch(PDO::FETCH_ASSOC);
			$explode = explode("-", $data[$attr]);
			if (isset($explode[1])) {
				$id = $explode[1]+1;
			}else {
				$id = "Tidak Di Izinkan Membuat ID Auto Increment (int)";
			}

			return $id;
		} catch (PDOException $e) {
			die("Gagal Untuk Membaca Data <br> Error : ".$e->getMessage());
		}
	}

	public function save($sql) {
		$Query = $this->jsc_database->prepare($sql);
		$Query->execute();
		
	}
}

?>