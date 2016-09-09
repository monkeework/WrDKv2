<?php

function maxDoc_test_index(){
/**
 * index.php (list.php) test portal page
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seeview.php
 * @todo tooltips
 *
 * @todo Customize profiles show based on user
	 - show their characters
	 - show their character allies
	 - show most recently approved
 * @todo Add - sorry no results found for case statements
 * @todo ADD PAGER too playbys option
 *
 */

	# '../' works for a sub-folder.  use './' for the root
}

$pageDeets = '<ol>
	<li> Resolve chat box overlap issue</li>
	<li> Review/update function checkForm(thisForm)</li>

	<!--
		<ul>
			<li> m2 - extended layout?</li>
			<li> m2 - notifications-mail</li>
			<li> m2 - character posting styles</li>
			<li> m2 - dashboard</li>
			<li> m2 - Classes/PDO</li>
			<li> M2 - unapprove/resubmit posts</li>
			<li> m2 - C2E (Click 2 Edit)</li>
			<li> m2 - chat box</li>
			<li> m2 - C2P (Chat to Joint-Post)</li>
			<li> m2 - C2M (Click to Move Thread/Post)</li>
			<li> ???</li>
		</ul>

		<ul>
			<li> m3 - MvC (CodeIngiter)</li>
			<li> M4 - MvC (Laravel)</li>
			<li> ???</li>
		</ul>
	-->';

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials



#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php
$config->titleTag = 'Character Profiles';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Marvel Adventures Character Database ' . $config->metaDescription;
$config->metaKeywords = 'Super-Heroes, Superheroes, Marvel, Comics, Characters, Roleplay, RP, RPG'. $config->metaKeywords;


# END CONFIG AREA ----------------------------------------------------------

get_header(); #defaults to theme header or header_inc.php

echo MaxNotes($pageDeets); #notes to me!

echo '


<style>
	.divThumbs {
		width: 170px;
		float: left;
	}

	img.imgThumbs {
		margin-top: 15px;

		height: 150px;
		width:  150px;

		background-color: #678;
		border: 4px solid #678;

		-webkit-border-radius: 15px;
		-moz-border-radius: 15px;
		border-radius: 15px;
		}

		.boldOrange { color: orange; }
		.thumbSM {
			display: inline;
			height: 50px;
			width:  50px;
			margin-right: 1em;
			float: left;

			background-color: #678;
			border: 1px solid #678;

			-webkit-border-radius: 15px;
			-moz-border-radius: 15px;
			border-radius: 15px;

		}

</style>';


if(isset($_GET['act'])){ $act = ($_GET['act']); }else{ $act = ''; } #initialize $act for switch



echo '<a href="?getDirectories">View Directories</a> | <a href="?getFiles">View Files</a><br /><br />';




//print just file names exclude directory names
	if (isset($_GET['getDirectories'])) getDirectories();
	if (isset($_GET['getFiles'])) getFiles();


	//list directories
	function getDirectories(){
		echo "Available Directories:<br />";

		foreach (glob("*") as $dirname ) {
		if( is_dir( $dirname ) )
		echo "<a target=\"_blank\" href=\"$dirname \">$dirname</a><br />";}
		}

	//list files
	function getFiles(){
		echo "Available Files:<br />";

		foreach (glob("*.php") as $filename) {
		//prints file name & file size!
		//echo "$filename size " . filesize($filename) . "\n";

		echo "<a target=\"_blank\" href=\"$filename\">$filename</a><br />";}
		}

?>























get_footer(); #defaults to theme footer or footer_inc.php
