<?php //aboutus.php
/**
 * aboutus.php is a model for largely static PHP pages
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see config_inc.php
 * @todo none
 */

require './../_inc/config_inc.php'; #provides configuration, pathing, error handling, db credentials
$config->titleTag = "This is the about Us page, silly!"; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php

/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS

//$config->banner = ''; #goes inside header
$config->banner = 'ABOUT US'; #goes inside header

$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

# END CONFIG AREA ----------------------------------------------------------

//get_header('SmallPark_AboutUs_header_inc.php'); #defaults to theme header or header_inc.php
get_header(); #defaults to theme header or header_inc.php
?>
<h3 align="center"><?php echo THIS_PAGE ?></h3>

<h1 class="masthead">SITE SUMMARY</h1>

<h3>STORY TITLE</h3>
<ul>
	<li>KEY POINTS OF STORY/HISTORY</li>
	<li>>KEY POINTS OF STORY/HISTORY</li>
	<li>>KEY POINTS OF STORY/HISTORY</li>

</ul>



<h2>Summary of storyline</h2>

<p>A summary of the the story thus far goes here...</p>

<ul>
	<li>Links to key threads/posts</li>
	<li>Links to key threads/posts</li>
	<li>Links to key threads/posts</li>

</ul>



<?php
get_footer(); #defaults to theme header or footer_inc.php
?>
