<?php
/**
* Class Untuk Query DELETE database By Java-SC Developer a.k.a Hady Eka Saputra
*/
class simple_delete {
	private $database;
	function __construct($connection) {
		$this->database = $connection;
	}
  public function deleteById($namaTabel, $kolomId ,$idData){
    try {
      $sql = 'DELETE FROM '.$namaTabel.' WHERE '.$kolomId.' = '.$idData.'';
      $Query = $this->database->prepare($sql);
      $Query->execute();
      return $Query;
    } catch (PDOException $e) {
      die("Gagal Untuk Menghapus Data dari Table ".$namaTabel."<br> Error : ".$e->getMessage());
    }

  }
}
?>
