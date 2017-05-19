<?php
$getData = $conn->select()->selectAll('tb_user',array(
			'select')
	);
if ($_GET['page'] == 'data' && !empty($_GET['ubah'])) {
	include_once 'daftar.php';
}
if ($_GET['page'] == 'data' && !empty($_GET['hapus'])) {
	$delete = $conn->delete()->deleteById('tb_user','user_id',$_GET['hapus']);
		 echo "<script>alert('Berhasil Menghapus Data');window.location.href = 'index.php?page=data';</script>";
}

?>
<div class="bs-example col-md-12" data-example-id="bordered-table">
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Tempat, Tanggal Lahir</th>
				<th>Jenis Kelamin</th>
				<th>Agama</th>
				<th>Kontak</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$nomor = 1;
		while ($resData = $getData->fetch(PDO::FETCH_OBJ)) {
			?>
	<tr>
		<th scope="row"><?php echo $nomor++; ?></th>
		<td><?php echo $resData->user_name; ?></td>
		<td><?php echo $resData->user_born." ,".$resData->user_date; ?></td>
		<td><?php echo $resData->user_gender; ?></td>
		<td><?php echo $resData->user_religion; ?></td>
		<td><?php echo $resData->user_contact; ?></td>
		<td><?php echo $resData->user_email; ?></td>
		<td>
			<a href="index.php?page=data&ubah=<?php echo $resData->user_id; ?>" class="btn btn-warning">Ubah</a>
			<a href="index.php?page=data&hapus=<?php echo $resData->user_id; ?>" class="btn btn-danger">Hapus</a>
		</td>
	</tr>
			<?php
		}
		?>
		</tbody>
	</table>
</div>