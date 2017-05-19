<?php
/**
* Class Untuk Query SELECT database By Java-SC Developer a.k.a Hady Eka Saputra
*/
class simple_select {

	private $database;
	function __construct($connection) {
		$this->database = $connection;
	}

	public function selectAll($namaTabel , $kondisi = array() ) {
		try {
			$sql = 'SELECT ';
			$sql .= array_key_exists('select', $kondisi) ? $kondisi['select']:' * ';
			$sql .= ' FROM '.$namaTabel;
			if (array_key_exists('where', $kondisi)) {
				$sql .= ' WHERE ';
				$i = 0;
				foreach ($kondisi['where'] as $key => $value) {
					$pre = ($i > 0) ? ' AND ':'';
					$sql .= $pre.$key." = '".$value."'";
					$i++;
				}
			}
			if (array_key_exists('order_by', $kondisi)) {
				$sql .= ' ORDER BY '.$kondisi['order_by'];
			}

			if (array_key_exists('start', $kondisi) && array_key_exists('limit', $kondisi)) {
				$sql .= ' LIMIT '.$kondisi['start'].','.$kondisi['limit'];
			}elseif (!array_key_exists('start', $kondisi) && array_key_exists('limit', $kondisi)) {
				$sql .= ' LIMIT '.$kondisi['limit'];
			}

			if (array_key_exists('group_by', $kondisi)) {
				$sql .= ' GROUP BY '.$kondisi['group_by'];
			}

			$Query = $this->database->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$Query->execute();
      return $Query;
		}catch (PDOException $e) {
			die("Gagal Untuk Membaca Data <br> Error : ".$e->getMessage());
		}
	}
}

?>
