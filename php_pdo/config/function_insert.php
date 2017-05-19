<?php
/**
* Class Untuk Query INSERT database By Java-SC Developer a.k.a Hady Eka Saputra
*/

class simple_insert {
	private $database;
	function __construct($connection) {
		$this->database = $connection;
	}
	public function insertInto($namaTabel , $isiData = array()){
		try {
			$sql = ' INSERT ';
			$sql .= ' INTO '.$namaTabel;
			$string = null;
			if (array_key_exists('insert', $isiData)){
				foreach ($isiData as $key => $value) {
					for ($i=0; $i < count($value); $i++) {
						$string .= '"'.$value[$i].'",';
					}
				}
				$string = rtrim($string, ',');
			}
			$sql .= ' VALUES ('.$string.')';
			$this->save($sql);
		} catch (PDOException $e) {
			die("Gagal Untuk Menyimpan Data Ke Table ".$namaTabel."<br> Error : ".$e->getMessage());
		}
	}

	public function insertOneTableWithAttr($namaTabel , $isiData = array()) {
		try {
			if (!empty($isiData)) {
				$columnString = '';
				$valueString = '';
				$i = 0;
				$columnString = implode(',', array_keys($isiData));
				$valueString = ':'.implode(',:', array_keys($isiData));
				$sql = ' INSERT INTO '.$namaTabel.'('.$columnString.') VALUES ('.$valueString.')';
				$Query = $this->jsc_database->prepare($sql);
				foreach ($isiData as $key => $value) {
					$Query->bindValue(':'.$key,$value);
				}
				$Query->execute();
				return $Query;
			}
			else {
				return false;
			}
		} catch (PDOException $e) {
			die("Gagal Untuk Menyimpan Data Ke Table ".$namaTabel."<br> Error : ".$e->getMessage());
		}
	}
	public function save($sql) {
		try {
			$Query = $this->database->prepare($sql);
			$Query->execute();
		} catch (PDOException $e) {
			die("Error : ".$e->getMessage());
		}
		
	}
}

?>
