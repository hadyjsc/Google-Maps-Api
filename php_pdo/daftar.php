<?php
$resDataUbah = "";
$txtNamaLengkap = "";
$txtPassword = "";
$txtTempatLahir = "";
$txtTanggalLahir = "";
$txtJenisKelamin = "";
$txtAgama = "";
$txtKontak = "";
$txtAlamat = "";
$txtEmail = "";

if (!empty(isset($_GET['ubah']))) {
	$getDataUbah = $conn->select()->selectAll('tb_user',array(
		'select','where'=>array('user_id'=>$_GET['ubah']))
	);
	$resDataUbah = $getDataUbah->fetch(PDO::FETCH_OBJ);
	$txtNamaLengkap = isset(($resDataUbah->user_name)) ? $resDataUbah->user_name : "" ;
	$txtPassword = isset(($resDataUbah->user_password)) ? $resDataUbah->user_password : "" ;
	$txtTempatLahir = isset(($resDataUbah->user_born)) ? $resDataUbah->user_born : "" ;
	$txtTanggalLahir = isset(($resDataUbah->user_date)) ? $resDataUbah->user_date : "" ;
	$txtJenisKelamin = isset(($resDataUbah->user_gender)) ? $resDataUbah->user_gender : "" ;
	$txtAgama = isset(($resDataUbah->user_religion)) ? $resDataUbah->user_religion : "" ;
	$txtKontak = isset(($resDataUbah->user_contact)) ? $resDataUbah->user_contact : "" ;
	$txtAlamat = isset(($resDataUbah->user_address)) ? $resDataUbah->user_address : "" ;
	$txtEmail = isset(($resDataUbah->user_email)) ? $resDataUbah->user_email : "" ;
}
if (isset($_POST['ubah'])) {
	$update = $conn->update()->updateById('tb_user',
		array( 'user_name'=>$_POST['nama_lengkap'],
			   'user_password'=>$_POST['password'],
			   'user_born'=>$_POST['tempat_lahir'],
			   'user_date'=>$_POST['tanggal_lahir'],
			   'user_gender'=>$_POST['jenis_kelamin'],
			   'user_religion'=>$_POST['agama'],
			   'user_contact'=>$_POST['kontak'],
			   'user_address'=>$_POST['alamat'],
			   'user_email'=>$_POST['email'],
				),
		array('where'=>array('user_id'=>$_GET['ubah']))
		);
	 echo "<script>alert('Berhasil Mengubah Data');window.location.href = 'index.php?page=data';</script>";
}

if (isset($_POST['simpan'])) {
  $insert = $conn->insert()->insertInto(
    'tb_user', 
    array('insert' => array(
      '',
      $_POST['nama_lengkap'],
      $_POST['password'],
      $_POST['tempat_lahir'],
      $_POST['tanggal_lahir'],
      $_POST['jenis_kelamin'],
      $_POST['agama'],
      $_POST['kontak'],
      $_POST['alamat'],
      $_POST['email']
      ))
    );
    echo "<script>alert('Berhasil Menyimpan Data');window.location.href = 'index.php?page=login';</script>";
}
?>

<form class="form-horizontal" action="" method="POST">
	<div class="form-group">
    <label class="col-sm-2 control-label">Nama Lengkap</label>
    <div class="col-sm-5">
      <input name="nama_lengkap" type="text" class="form-control" placeholder="Masukan Nama Lengkap" required="" value="<?php echo $txtNamaLengkap; ?>"> 
    </div>
  </div>
	<div class="form-group">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-5">
      <input name="email" type="email" class="form-control" placeholder="Masukan Email" required="" value="<?php echo $txtEmail; ?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-sm-2 control-label">Password</label>
    <div class="col-sm-5">
      <input name="password" type="password" class="form-control" placeholder="Masukan Password"  required="" value="<?php echo $txtPassword; ?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
    <div class="col-sm-3">
      <input name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir" required="" value="<?php echo $txtTempatLahir; ?>">
    </div>
		<div class="col-sm-2">
      <input name="tanggal_lahir" type="date" class="form-control" placeholder="Tanggal Lahir" required="" value="<?php echo $txtTanggalLahir; ?>">
    </div>
  </div>
	<div class="form-group">
    <label class="col-sm-2 control-label">Jenis Kelamin</label>
    <div class="radio-inline">
			<input name="jenis_kelamin" <?php echo ($txtJenisKelamin == "Laki-Laki") ? "checked" : "" ; ?> required="" type="radio" value="Laki-Laki"> Laki-Laki
    </div>
		<div class="radio-inline">
			<input name="jenis_kelamin" <?php echo ($txtJenisKelamin == "Perempuan") ? "checked" : "" ; ?> required="" type="radio" value="Perempuan"> Perempuan
    </div>
  </div>
	<div class="form-group">
	    <label class="col-sm-2 control-label">Agama</label>
	    <div class="col-sm-5">
	      <select class="form-control" name="agama" required="" value="<?php echo $txtAgama; ?>">
				<option value="Islam" <?php echo ($txtAgama == "Islam") ? "selected" : "" ; ?> >Islam</option>
				<option value="Kristen" <?php echo ($txtAgama == "Kristen") ? "selected" : "" ; ?>>Kristen</option>
				<option value="Katolik" <?php echo ($txtAgama == "Katolik") ? "selected" : "" ; ?>>Katolik</option>
				<option value="Budha" <?php echo ($txtAgama == "Budha") ? "selected" : "" ; ?>>Budha</option>
				<option value="Hindu" <?php echo ($txtAgama == "Hindu") ? "selected" : "" ; ?>>Hindu</option>
				<option value="Agama Lainnya" <?php echo ($txtAgama == "Agama Lainnya") ? "selected" : "" ; ?>>Agama Lainnya</option>
	      </select>
	    </div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Kontak</label>
		<div class="col-sm-5">
			<input name="kontak" type="number" class="form-control" placeholder="Nomor Handphone Aktif" required="" value="<?php echo $txtKontak; ?>">
		</div>
	</div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-5">
			<textarea name="alamat" rows="3" class="form-control" required="" ><?php echo $txtAlamat; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" <?php echo (isset($_GET['ubah'])) ? "checked" : "" ;; ?> required=""> Setuju Dan Mendaftar 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    	<?php 
    	if (!empty(isset($_GET['ubah']))) {
    		echo '<button name="ubah" type="submit" class="btn btn-info">Ubah</button>';
    	}else {
    		echo '<button name="simpan" type="submit" class="btn btn-success">Sign Up</button>';
    	}

    	 ?>
    </div>
  </div>
</form>
