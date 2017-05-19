<?php
/**
* Class Untuk Query UPDATE database By Java-SC Developer a.k.a Hady Eka Saputra
*/
class simple_update {
	private $database;
	function __construct($connection) {
		$this->database = $connection;
	}
  public function updateById($namaTabel, $isiData = array() , $kondisi = array()){
    try {
			if (!empty($isiData) && !empty($kondisi)) {
				foreach ($isiData as $key => $value) {
					$column[] = $key;
					$data[] = $value;
				}
				$sql = ' UPDATE '.$namaTabel.' SET ';
				for ($i=0; $i < count($isiData); $i++) { 
					$arr[] = $column[$i]." = '".$data[$i]."'";
					
				}
				$sql .= $implode = implode(',', $arr);
        		if (array_key_exists('where', $kondisi)) {
  				$sql .= ' WHERE ';
  				$i = 0;
  				foreach ($kondisi['where'] as $key => $value) {
  					$pre = ($i > 0) ? ' AND ':'';
  					$sql .= $pre.$key.' = "'.$value.'"';
  					$i++;
  				}
  			}
        		$Query = $this->database->prepare($sql);
				$Query->execute();
				return $Query;
			}
			else {
				return false;
			}
		} catch (PDOException $e) {
			die("Gagal Untuk Mengubah Data Pada Table ".$namaTabel."<br> Error : ".$e->getMessage());
		}
  }
}
?>
