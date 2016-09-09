<?php
//theme specific functions
 //include 'functions-themes.php';//WAS bootswatch_functions.php
 include 'header_testBoard-themes.php';

/*
Fatal error: Cannot redeclare myTab()
(previously declared in
/Applications/AMPPS/www/WrDKv2/_themes/testBoard/functions-themes.php:9)

in
/Applications/AMPPS/www/WrDKv2/_themes/functions-themes.php on line 14
*/


?>

<div class="container-fluid">

<?php
	#echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php
?>


	<!-- BEGIN row -->
	<div class="row row-offcanvas row-offcanvas-left">
		 <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
				<ul class="nav nav-sidebar">
					<li class="active"><a href="#">Dashboard (Username)</a></li>

					<!-- <li><a href="#" target="_ext">My Characters</a></li> -->
					<li><a href="<?=VIRTUAL_PATH; ?>" target="_ext">My Characters</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>" target="_ext">My Profile*</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>" target="_ext">My Posts*</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>" target="_ext">My Tags*</a></li>

				</ul>

				<ul class="nav nav-sidebar">
					<li><a href="<?=VIRTUAL_PATH; ?>">Add User</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>">Edit User</a></li>
				</ul>

				<ul class="nav nav-sidebar">
					<li><a href="#">Max's Links</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>users/adminer.php">Adminer</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>users/#">Session Nuke</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>users/#">PHP_INFO</a></li>
					<li><a href="<?=VIRTUAL_PATH; ?>users/#">View Logs</a></li>
				</ul>

		</div><!--/span-->

		<div class="col-sm-9 col-md-10 main">
			<!--toggle sidebar button-->
			<p class="visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
			</p>




			<!-- content to go here -->


			<h1 class="page-header"> My Characters</h1>

			<div class="row placeholders">
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My Character</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/66ff66/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My Character</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My Charater</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/66ff66/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My character</span>
				</div>
			</div>

			<hr>

			<h1 class="page-header"> Characters To Review</h1>
			<div class="row placeholders">
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My Character</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My Character</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My Charater</span>
				</div>
				<div class="col-xs-6 col-sm-3 placeholder text-center">
					<img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
					<h4>Label</h4>
					<span class="text-muted">My character</span>
				</div>
			</div>

			<hr>


			<h2 class="sub-header">Section title</h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Header</th>
							<th>Header</th>
							<th>Header</th>
							<th>Header</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1,001</td>
							<td>Lorem</td>
							<td>ipsum</td>
							<td>dolor</td>
							<td>sit</td>
						</tr>
						<tr>
							<td>1,002</td>
							<td>amet</td>
							<td>consectetur</td>
							<td>adipiscing</td>
							<td>elit</td>
						</tr>
						<tr>
							<td>1,003</td>
							<td>Integer</td>
							<td>nec</td>
							<td>odio</td>
							<td>Praesent</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div><!--/row-->

	<div class="push"></div>



</div><!--/.container-->


<?php include 'footer_testBoard-themes.php';?>
