<?php
/**
 * log_view.php works with admin_log_list.php to
 * view & delete log files
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * admin_log_list.php
 * @todo none
 */

require '../_inc/config_inc.php'; #provides configuration, et al.
$config->titleTag = 'Log File Details'; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->metaRobots = 'no index, no follow';#never index admin pages

//END CONFIG AREA ----------------------------------------------------------


//set access priv needed for this page by member
		chekPrivies(7); #mods+



$access = "admin"; #admins can edit themselves, developers can edit any - don't change this var or no one can edit their own data
include_once INCLUDE_PATH . 'admin_only_inc.php'; #session protected page - level is defined in $access var

if(isset($_GET['del']))
{#prepare to delete log file
	$myDelete = (trim($_GET['del']));
	unlink(LOG_PATH . $myDelete);  #deletes file
	feedback("File '" . $myDelete . "' successfully deleted!");
	myRedirect(ADMIN_PATH . 'admin_log_list.php'); #redirect back to list page with message
}

if(isset($_GET['f']))
{#file info from qstring
	$fileName = (trim($_GET['f']));
	$filePath = LOG_PATH . $_GET['f'];
}else{
	$fileName = "No File Found";
}

$config->loadhead = '
<script language="JavaScript">
function confirmDelete()
{
	var agree=confirm("Are you sure you wish to delete this log file?");
	if(agree)
	{
		location.href="' . ADMIN_PATH . 'log_view.php?del=' . $fileName . '";
	}else{
		return false;
	}
}
</script>
';
get_header(); #defaults to theme header or header_inc.php
echo '
<h3 align="center">View Log File Contents</h3>
<div align="center"><b>' . $fileName . '</b></div>
<div align="center"><a href="' . ADMIN_PATH . 'log_list.php">back to log list</a></div>
';

if($fileName != "No File Found")
{#show log file contents - reading backwards to see most recent at top
	$myArray = file($filePath);
	if ($myArray != FALSE)
	{
		 for($x=count($myArray) - 1;$x>=0;$x--)
		 {
				print $myArray[$x] . "<br />";
		 }
	}else{
		 print "No info in file";
	}
	echo '<div align="center"><a href="javascript:void(0);" onclick="return confirmDelete();">DELETE (no undo)</a></div>';
}
get_footer(); #defaults to theme footer or footer_inc.php
