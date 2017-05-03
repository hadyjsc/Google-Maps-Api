<div class="page-header">
	<center><h1 class="alert alert-success">Query Read MySQL With PHP::PDO</h1></center>
</div>
<div class="row">
	<div class="col-md-12 table-responsive">
		<h5>Query Join 2 Table</h5>
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
					<th width="4%">#No</th>
					<th width="9%">NIM</th>
					<th width="10%">Nama Depan</th>
					<th width="15%">Nama Belakang</th>
					<th width="5%">Kelas</th>
					<th>Suka Cita Masuk Praktikum</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$n = 1;
			$QueryJoin2Table = $db->select()->selectJoinTwoTable(
										array('mhs_nim'=>'mhs','mhs_fname'=>'mhs','mhs_lname'=>'mhs','mhs_class'=>'mhs','pinet_desc'=>'pinet'),
										array('mhs','pinet'),
										array('mhs_nim','pinet_nim')
										);
			while ($FetchQueryJoin2Table = $QueryJoin2Table->fetch(PDO::FETCH_OBJ)){
				if ($QueryJoin2Table->rowCount() < 1) {
					echo "<tr>Tidak Ada Data</tr>";
				}else {
				?>
				<tr>
					<td><?php echo $n++; ?></td>
					<td><?php echo $FetchQueryJoin2Table->mhs_nim; ?></td>
					<td><?php echo $FetchQueryJoin2Table->mhs_fname; ?></td>
					<td><?php echo $FetchQueryJoin2Table->mhs_lname; ?></td>
					<td><?php echo $FetchQueryJoin2Table->mhs_class; ?></td>
					<td><?php echo $FetchQueryJoin2Table->pinet_desc; ?></td>
				</tr>
				<?php
				}
			}
			 ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<pre><code class="php">
&lt;?php 
$n = 1;
$QueryJoin2Table = $db-&gt;select()-&gt;selectJoinTwoTable(
	array(&#39;mhs_nim&#39;=&gt;&#39;mhs&#39;,&#39;mhs_fname&#39;=&gt;&#39;mhs&#39;,&#39;mhs_lname&#39;=&gt;&#39;mhs&#39;,&#39;mhs_class&#39;=&gt;&#39;mhs&#39;,&#39;pinet_desc&#39;=&gt;&#39;pinet&#39;),
	array(&#39;mhs&#39;,&#39;pinet&#39;),
	array(&#39;mhs_nim&#39;,&#39;pinet_nim&#39;)
);
while ($FetchQueryJoin2Table = $QueryJoin2Table-&gt;fetch(PDO::FETCH_OBJ)){
	if ($QueryJoin2Table-&gt;rowCount() &lt; 1) {
		echo &quot;&lt;tr&gt;Tidak Ada Data&lt;/tr&gt;&quot;;
	}else {
	?&gt;
	&lt;tr&gt;
		&lt;td&gt;&lt;?php echo $n++; ?&gt;&lt;/td&gt;
		&lt;td&gt;&lt;?php echo $FetchQueryJoin2Table-&gt;mhs_nim; ?&gt;&lt;/td&gt;
		&lt;td&gt;&lt;?php echo $FetchQueryJoin2Table-&gt;mhs_fname; ?&gt;&lt;/td&gt;
		&lt;td&gt;&lt;?php echo $FetchQueryJoin2Table-&gt;mhs_lname; ?&gt;&lt;/td&gt;
		&lt;td&gt;&lt;?php echo $FetchQueryJoin2Table-&gt;mhs_class; ?&gt;&lt;/td&gt;
		&lt;td&gt;&lt;?php echo $FetchQueryJoin2Table-&gt;pinet_desc; ?&gt;&lt;/td&gt;
	&lt;/tr&gt;
	&lt;?php
	}
}
 ?&gt;
		</code></pre>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<h5>Query Select All Data</h5>
		<table class="table table-striped table-bordered table-condensed table-responsive">
			<thead>
				<tr>
					<th width="4%">#No</th>
					<th width="9%">NIM</th>
					<th width="10%">Nama Depan</th>
					<th width="15%">Nama Belakang</th>
					<th width="5%">Kelas</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$m = 1;
			$QuerySelectAll = $db->select()->selectAll('mhs',array('select'));
			if (is_array($QuerySelectAll) || is_object($QuerySelectAll)){				
			foreach ($QuerySelectAll as $key => $value) {
				if (count($QuerySelectAll) < 1) {
					echo "<tr>Tidak Ada Data</tr>";
				}else {
				?>
				<tr>
					<td><?php echo $m++; ?></td>
					<td><?php echo $value['mhs_nim']; ?></td>
					<td><?php echo $value['mhs_fname']; ?></td>
					<td><?php echo $value['mhs_lname']; ?></td>
					<td><?php echo $value['mhs_class']; ?></td>
				</tr>
				<?php
				}
			}
		}
			 ?>
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<h5>Query Select All Data Order By</h5>
		<table class="table table-striped table-bordered table-condensed table-responsive">
			<thead>
				<tr>
					<th width="4%">#No</th>
					<th width="9%">NIM</th>
					<th width="5%">Kelas</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$l = 1;
			$QuerySelectAllDesc = $db->select()->selectAll('mhs',array('select'=>'mhs_nim,mhs_class'),array('order_by' => 'mhs_class DESC'));
			if (is_array($QuerySelectAllDesc) || is_object($QuerySelectAllDesc)){
			foreach ($QuerySelectAllDesc as $key => $value) {
				if (count($QuerySelectAllDesc) < 1) {
					echo "<tr>Tidak Ada Data</tr>";
				}else {
				?>
				<tr>
					<td><?php echo $l++; ?></td>
					<td><?php echo $value['mhs_nim']; ?></td>
					<td><?php echo $value['mhs_class']; ?></td>
				</tr>
				<?php
				}
			}
		}
			 ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	
		<pre><code class="php">
.::Query Untuk Mengambil Semua Data::.

$QuerySelectAll = $db->select()->selectAll('table name',array('value'));
Contoh
$QuerySelectAll = $db->select()->selectAll('mhs',array('select'));
		</code></pre>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<pre><code class="php">
$QueryJoin2Table = $db->select()->selectJoinTwoTable(
	array('mhs_nim'=>'mhs','mhs_fname'=>'mhs','mhs_lname'=>'mhs','mhs_class'=>'mhs','pinet_desc'=>'pinet'),
	array('mhs','pinet'),
	array('mhs_nim','pinet_nim')
);
		</code></pre>
	</div>
</div>