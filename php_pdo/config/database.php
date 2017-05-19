<?php
/**
 * Class Database
 */
class DatabaseConn {
  private $dbHost = "localhost";
  private $dbName = "kependudukan_db";
  private $dbUser = "root";
  private $dbPass = "";
  function __construct() {
    if (!isset($this->DatabaseConn)) {
      try {
        $koneksi = new PDO("mysql:host=".$this->dbHost.";
        dbname=".$this->dbName,$this->dbUser,$this->dbPass);
        $koneksi -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->DatabaseConn = $koneksi;
      } catch (PDOException $e) {
        die("Gagal Untuk Mengkoneksi ke database ".$this->dbName."
        Dengan Error".$e->getMessage());
      }
    }
  }
  public function select() {
		include_once 'function_select.php';
		return new simple_select($this->DatabaseConn);
	}
	public function insert() {
		include_once 'function_insert.php';
		return new simple_insert($this->DatabaseConn);
	}
	public function delete() {
		include_once 'function_delete.php';
		return new simple_delete($this->DatabaseConn);
	}
  public function update(){
    include_once 'function_update.php';
    return new simple_update($this->DatabaseConn);
  }
}
 ?>
