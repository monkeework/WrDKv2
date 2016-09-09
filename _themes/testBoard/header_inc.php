<?php
//theme specific functions
function maxDoc_themes_header_testBoard_themes(){
	/**
	 * based on dashboard-offCanvasSidebar-master
	 *
	 * @package ma-v1605-22
	 * @author monkeework <monkeework@gmail.com>
	 * @version 3.02 2011/05/18
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @todo add more complicated checkbox & radio button examples
	 */
}

include 'functions-themes.php';


#http://localhost/WrDKv2/users/css/bootstrap.min.css



?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Dashboard | Marvel Champions</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="<?=THEME_PATH;?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=THEME_PATH;?>css/testBoard.css" rel="stylesheet">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<!-- BEGIN body -->
	<!-- BEGIN nav -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?=VIRTUAL_PATH; ?>">Marvel Champions</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><?=$_SESSION['UserName']; ?>'s Dashboard</a></li>

			<?php
				#echo bootstrapAdmin(); //right aligned Admin link - see bootswatch_functions.php
			?>

				<!--
					<li><a href="#">Settings</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Help</a></li>
				-->
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search TBD">
				</form>
			</div>
		</div>
	</nav>

	<!-- END nav -->
