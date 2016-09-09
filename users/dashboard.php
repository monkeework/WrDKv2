<?php
function maxDoc_users_dashboard(){
/**
 * based on dashboard.php is based on admin.php
 * A session protected 'dashboard' page of links to handler/administrator tools
 *
 * Use this file as a landing page after successfully logging in as an administrator.
 * Be sure this page is not publicly accessible by referencing admin_only_inc.php
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see $config->userLogin.php
 * @see $config->adminValidate.php
 * @see $config->adminLogout.php
 * @see admin_only_inc.php
 * @todo Get Image Border to show around submitted characters in my characters portion of dashboard.
 */
}

require '../_inc/config_inc.php'; //provides configuration, et al.

//set access priv needed for this page by member
chekPrivies(1); //known guest+

$config->titleTag = 'User/Admin Dashboard'; //Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->metaRobots = 'no index, no follow';//never index admin pages
$server = 'localhost'; //CHANGE TO YOUR MYSQL HOST!!
$username='root'; //CHANGE TO YOUR MYSQL USERNAME!!

//to switch theme from Yeti to testBoard
$config->theme = 'testBoard'; //default theme (header/footer combo) see 'Themes' folder for others and info
$config->style = 'testBoard.css'; //currently only Bootswatch Theme uses style to switch look & feel

$uID 	 = $_SESSION['UserID'];
$uName = $_SESSION['UserName'];
$uPriv = $_SESSION['Privilege'];

//END CONFIG AREA ----------------------------------------------------------
$access = "admin"; //admin or higher level can view this page
include_once INCLUDE_PATH . 'admin_only_inc.php'; //session protected page - level is defined in $access var

$feedback = ""; //initialize feedback
if(isset($_GET['msg']))
{
	switch($_GET['msg'])
	{
			case 1:
				 $feedback = "Your administrative permissions don't allow access to that page.";
				 break;
		default:
				 $feedback = "";
	}
}

if($feedback != ""){$feedback = '<div align="center"><h4><font color="red">' . $feedback . '</font></h4></div>';} //Fill out feedback HTML

get_header('testBoard'); //defaults to theme header or header_inc.php

//BEGIN CONTENT AREA
?>

<div class="container-fluid">

<?php
	//echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php
?>


	<!-- BEGIN row -->
	<div class="row row-offcanvas row-offcanvas-left">
		 <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

				<ul class="nav nav-sidebar">
					<li class="active"><a href="//"><?=$uName; ?>'s Homepage</a></li>
					<!-- <li><a href="//" target="_ext">My Characters</a></li> -->

					<li class="text-muted">&nbsp; &nbsp; &nbsp; My Posts*</li>
					<li class="text-muted">&nbsp; &nbsp; &nbsp; My Tags*</li>
						<li class="divider"></li>
					<li class="text-muted">&nbsp; &nbsp; &nbsp; My Profile*</li>
					<li class="text-muted">&nbsp; &nbsp; &nbsp; My Preferences*</li>
				</ul>

				<?php
					 $priv = $_SESSION['Privilege'];
					if($priv >= 4){
						echo'<h4>Moderator Tools</h4>';
						echo '<ul class="nav nav-sidebar">
						<li class="text-muted">&nbsp; &nbsp; &nbsp; Members*</li>
						<li class="text-muted">&nbsp; &nbsp; &nbsp; Characters*</li>
						<li class="text-muted">&nbsp; &nbsp; &nbsp; Posts*</li>
						<li class="text-muted">&nbsp; &nbsp; &nbsp; Pages*</li>
						<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/addUser.php">Add User</a></li>
						<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/editUser.php">Edit User</a></li>
						<li class="text-muted">&nbsp; &nbsp; &nbsp; Ban User*</li>
					</ul>';
					}
				?>

				<?php
					 $priv = $_SESSION['Privilege'];
					if($priv == 7){
						echo '<h4>Monkee Tools</h4>';
						echo '<ul class="nav nav-sidebar">
								<li><a href="' . VIRTUAL_PATH . 'users/adminer.php">Adminer</a></li>
								<li><a href="' . VIRTUAL_PATH . 'users/cleanSessions.php">Session Nuke</a></li>
								<li><a href="' . VIRTUAL_PATH . 'users/info.php">PHP_INFO</a></li>
								<li><a href="' . VIRTUAL_PATH . 'users/users/viewLogs.php">View Logs</a></li>
							</ul>';
					}
				?>

		</div><!--/span-->

		<div class="col-sm-9 col-md-10 main">
			<!--toggle sidebar button-->
			<p class="visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
			</p>

			<!-- content to go here -->

			<h1 class="page-header"> Your Characters</h1>
			<div class="row placeholders">

			<?php
//BEGIN user's character que
				$sql = " SELECT UserID, CodeName, FirstName, LastName, MiddleName, CharID, StatusID, Playby, Gender FROM ma_Characters WHERE UserID = $uID ORDER BY CodeName;";

				// connection comes first in mysqli (improved) function
				$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

				if(mysqli_num_rows($result) > 0){//records exist - process
					//outer formatting
					while($row = mysqli_fetch_assoc($result))
					{// process each row
						$cID = $cName = $cStatus = $cPlayby = $cGender = $cDefault = $cLink = $cImg = $pbImg = $statusBorder = '';

						$cID   		= dbOut($row['CharID']);
						$cName 		= dbOut($row['CodeName']);
						$cStatus	= dbOut($row['StatusID']);
						$cPlayby  = dbOut($row['Playby']);
						$cGender  = dbOut($row['Gender']);

						if($cGender == ''){$cGender = 'male';}

						$cLink    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=show';
						$cEdit    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=edit';
						$cImg     = '../uploads/' . $cID . '-0.jpg';

						$cbDir     = strtolower(str_replace(' ', '_', $cPlayby));
						$cbLnk    = '../uploads/_' . $cGender . '/' . $cbDir . '/' . $cbDir . '-000.jpg';
						$sImg     = './../_img/_static/static---000.gif';

						if($cStatus == 6){$statusBorder = 'border: solid 5px #FFB240;';}

						//create link
						echo '<div class="col-xs-6 col-sm-3 placeholder text-center"><a href="' . $cLink . '"  target="_blank" title="' . $cName . '" >';

						//if we ahve an image use it, else show proxy or default)
						if (file_exists($cImg)) {  //if handler did, show us image
							//set image path
							$imgPath = $cImg;

						//Proxy image
						} elseif(file_exists($cbLnk)) { //if we can match playby, map to playby as proxy
							//set image path
							$imgPath = $cbLnk;

						//default image
						} else { //show default
							//set to static
							$imgPath = $sImg;
						}

						//close up link
						echo '<img src="'
							. $imgPath . '" class="center-block img-responsive img-circle" alt="'
							. $cName . '" style="height:150px; width:150px; '
							. $statusBorder . '"/></a><h5><a href="'
							. $cLink . '" title="'
							. $cName . '" target="_blank">'
							. $cName . '</a></h5><span class="text-muted">'
							. $aarStatus[$cStatus] . ' | <a href="'
							. $cEdit . '" target="_blank" title="'
							. $cName . '">Edit</a> '
							. $cStatus . ' </span>
							<br /><br /></div>'; //close character
					}


				}else{//no records
						echo "<p>You currently have no characters assigned to you.</p>";
				} //END PROFILES SEARCH
				//outer formatting here
//END  user character que

				@mysqli_free_result($result);

//BEGIN Member que
				if($uPriv >= 4){

					//Lets get all the characters associated with the primary user (if any characters exist)
					$sql = " SELECT UserID, UserName, Privilege, LastUpdated FROM ma_Users WHERE Privilege = 1 ORDER BY LastUpdated;";

					// connection comes first in mysqli (improved) function
					$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

					if(mysqli_num_rows($result) > 0)
					{//records exist - process
						//outer formatting here

						echo '<div class="clearfix"></div>
							<hr>
							<h3 class="page-header">Member Review</h3>';

						while($row = mysqli_fetch_assoc($result))
						{// process each row
							$uID = $uName = $uStatus = $uLink = $uImg = '';

							$uID   			= dbOut($row['UserID']);
							$uName 			= dbOut($row['UserName']);
							$uPrivilege	= dbOut($row['Privilege']);

							$uLink    	= 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=show';
							$uImg     	= 'http://www.mycustomer.com/sites/all/themes/pp/img/default-user.png';

							//create link
							echo '<div class="col-xs-6 col-sm-3 placeholder text-center">
								<a href="' . $uLink . '" title="' . $uName . '" >';

							//chek, did handler provide an image? exists, show
							if (file_exists($uImg)) { //if handler did, show us image
								echo '<img src="' . $uImg . '" class="center-block img-responsive img-circle" alt="' . $uName . '" style="height: 150px; width: 150px;"/></a>';
							} else {//no img matches, show random static pattern
								echo '<img src="' . $uImg . '" class="center-block img-responsive img-circle" style="width:150px; hieght: 150px;" alt="' . $uName . '" />';
							}

							//close up link
							echo '</a>
								<h5><a href="' . $uLink . '" title="' . $uName . '" >' . $uName . '</a></h5>
								<span class="text-muted">';

							if($uPriv >= 4){echo '<a href="">' . $aarPrivilege[$uPrivilege] . '</a> |';}

							echo ' <a href="">Approve?</a></span><br /><br /></div>'; //close character
						}
					}
					//outer formatting here
//END  member que

					@mysqli_free_result($result);

//BEGIN character review que
				$sql = " SELECT UserID, CodeName, FirstName,
					LastName, MiddleName, CharID, StatusID,
					Playby, Gender, Playby, LastUpdated FROM ma_Characters

					WHERE StatusID BETWEEN 3 AND 6

					GROUP BY LastUpdated

					ORDER BY StatusID DESC;";


				// connection comes first in mysqli (improved) function
				$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

				if(mysqli_num_rows($result) > 0){//records exist - process
					//outer formatting

					echo '<div class="clearfix"></div>
						<hr>
						<h3 class="page-header">Character Review Que</h3>';

					while($row = mysqli_fetch_assoc($result))
					{// process each row
						$cID = $cName = $cStatus = $cPlayby = $cGender = $cDefault = $cLink = $cImg = $pbImg = $statusBorder = '';

						$cID   		= dbOut($row['CharID']);
						$cName 		= dbOut($row['CodeName']);
						$cStatus	= dbOut($row['StatusID']);
						$cPlayby  = dbOut($row['Playby']);
						$cGender  = dbOut($row['Gender']);

						if($cGender == ''){$cGender = 'male';}

						$cLink    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=show';
						$cEdit    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=edit';
						$cImg     = '../uploads/' . $cID . '-0.jpg';

						$cbDir     = strtolower(str_replace(' ', '_', $cPlayby));
						$cbLnk    = '../uploads/_' . $cGender . '/' . $cbDir . '/' . $cbDir . '-000.jpg';
						$sImg     = './../_img/_static/static---000.gif';


						if($cStatus == 6){$statusBorder = 'border: solid 5px #FFB240;';}

						//create link
						echo '<div class="col-xs-6 col-sm-3 placeholder text-center"><a href="' . $cLink . '"  target="_blank" title="' . $cName . '" >';

						//if we ahve an image use it, else show proxy or default)
						if (file_exists($cImg)) {  //if handler did, show us image
							//set image path
							$imgPath = $cImg;

						//Proxy image
						} elseif(file_exists($cbLnk)) { //if we can match playby, map to playby as proxy
							//set image path
							$imgPath = $cbLnk;

						//default image
						} else { //show default
							//set to static
							$imgPath = $sImg;
						}

						//close up link
						echo '<img src="'
							. $imgPath . '" class="center-block img-responsive img-circle" alt="'
							. $cName . '" style="height:150px; width:150px; '
							. $statusBorder . '"/></a><h5><a href="'
							. $cLink . '" title="'
							. $cName . '" target="_blank">'
							. $cName . '</a></h5><span class="text-muted">'
							. $aarStatus[$cStatus] . ' | <a href="'
							. $cEdit . '" target="_blank" title="'
							. $cName . '">Edit</a> '
							. $cStatus . ' </span>
							<br /><br /></div>'; //close character
					}

				}else{//no records
						echo "<p>You currently have no assigned characters.</p>";
				} //END PROFILES SEARCH
				//outer formatting here
//END  user character que

				@mysqli_free_result($result);

			}
		?>


			<div class="clearfix"></div>
			<hr>


			<h2 class="sub-header">Moderated Postings*</h2>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>//</th>
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
		</div>
	</div>
	</div><!--/row-->

	<div class="push"></div>

</div><!--/.container-->


<?php

//END CONTENT AREA

get_footer(); //defaults to theme footer or footer_inc.php


function getDirectories($path='', $str = ''){


	foreach (glob("*") as $dirname ) {
	if( is_dir( $dirname ) )
	echo "<a target=\"_blank\" href=\"$dirname \">$dirname</a><br />";}
	}
