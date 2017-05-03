<?php
if ($_GET['page'] == NULL) {
	header('location:index.php?page=read');
}
include_once 'configure/database.php';
include_once 'view/view.php';
$view = new View();
$db = new DatabaseConn();

?>
<!DOCTYPE html>
<html>
<head>
	<?php $view->title("CRUD PDO By www.java-sc.com"); ?>
</head>
<?php echo $view->css(); ?>
<body>
 <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?"><?php $view->brand("Java-Sc"); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($_GET['page'] == "read") ?  'class="active"' : '' ; ?> ><a href="?page=read">Query Read</a></li>
            <li <?php echo ($_GET['page'] == "insert") ?  'class="active"' : '' ; ?> ><a href="?page=insert">Query Insert</a></li>
            <li <?php echo ($_GET['page'] == "delete") ?  'class="active"' : '' ; ?> ><a href="?page=delete">Query Delete</a></li>
            <li <?php echo ($_GET['page'] == "update") ?  'class="active"' : '' ; ?> ><a href="?page=update">Query Update</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container theme-showcase" role="main">
<?php 
	switch ($_GET['page']) {
		case 'read':
			include_once 'page/read.php';
			break;
		case 'insert':
			include_once 'page/insert.php';
			break;
		case 'delete':
			include_once 'page/delete.php';
			break;
		case 'update':
			include_once 'page/update.php';
			break;
		default:
			include_once 'page/404.php';
			break;
	}
 ?>
 	</div>
</body>
<?php echo $view->javascript(); ?>
</html>