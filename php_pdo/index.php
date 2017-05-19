<?php 
include_once 'config/database.php';
$conn = new DatabaseConn(); 
if (!$_GET['page']) {
	header("location:index.php?page=dashboard");
}
 ?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Sistem informasi</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	</head>
	<body>
		<br />
		<div class="container">
			<!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">WWW.JAVA-SC.COM</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="index.php?page=dashboard">Beranda</a></li>
							<li><a href="index.php?page=tentang">Tentang</a></li>
							<li><a href="index.php?page=login">Login</a></li>
							<li><a href="index.php?page=data">Data</a></li>
						</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <?php
      switch ($_GET['page']) {
      	case 'tentang':
      		include_once 'about.php';
      		break;
      	case 'login':
      		include_once 'login.php';
      		break;
      	case 'data':
      		include_once 'data.php';
      		break;
      	case 'daftar':
      		include_once 'daftar.php';
      		break;
      	default:
      		include_once 'dashboard.php';
      		break;
      }

      ?>
			
 <script type = "text/javascript" src="assets/js/jquery-1.9.1.js"></script>
 <script type = "text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
