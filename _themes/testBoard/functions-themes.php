<?php
/**
	* functions-themes.php
	* General theme based functions go here
	*/

function myTab($tab = '', $str=''){ #highlite active navbar tab
	#CURRENT_DIR == TabName, make active
	if (CURRENT_DIR == $tab){ $str = ' active ';}

	return $str;
}

function activeLink($chek = ''){
	#get name of page -- 'contact.php'
	$page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

	if($chek == $page){
		$classLi  = ' active';
	}else{
		$classLi  = '';
	}
	return $classLi;
}

function bsLinks($linkArray, $prefix='', $suffix='', $classLiPrefix='', $separator="~", $myReturn = ''){

	foreach($linkArray as $url => $text)
	{
		$target = ' target="_blank"'; #will be removed if relative URL
		if(basename($url) == THIS_PAGE){$flexPrefix = $classLiPrefix;}else{$flexPrefix = $prefix;} #added to create PageID
		$httpCheck = strtolower(substr($url,0,8)); # http:// or https://

		if(!(strrpos($httpCheck,"http://")>-1) && !(strrpos($httpCheck,"https://")>-1))
		{//relative url - add path
			$url = VIRTUAL_PATH . $url;
			$target = "";
		}else if(strrpos($url, ADMIN_PATH . 'user_')>-1){$target = "";}# clear target="_blank" for admin files
		$pos = strrpos($text, $separator); #tilde as default separator

		if ($pos === false)
		{// note: three equal signs - not found!
			$myReturn .= $flexPrefix . "<a href=\"" . $url . "\"" . $target . ">" . $text . "</a>" . $suffix . "\n";
		}else{//found!  explode into title!
			$aText = explode($separator, $text); #split into an array on separator
			$myReturn .= $flexPrefix . "<a href=\"" . $url . "\" title=\"" . $aText[1] . "\"" . $target . ">" . $aText[0] . "</a>" . $suffix . "\n";
		}

	}
	return $myReturn;
}

function bootstrapAdmin(){//add admin link to right if bootswatch
	global $config;
	if(startSession() && isset($_SESSION['UserID']))
	{#add admin logged in info to sidebar

		$nav[$config->userDashboard] = $_SESSION["UserName"] . "'s Dashboard~Go to Dashboard";
		#return '<ul class="nav navbar-nav navbar-right">' . bsLinks($nav,"<li>","</li>","<li class=\"active\">") . '</ul>';

		return '<ul class="nav navbar-nav navbar-right">

			<!-- next drop down -->

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						' . $_SESSION["UserName"] . '
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">

						<!-- LINK generated in bootswatch_functions -->
						<li>' . bsLinks($nav,"<li>","</li>","<li class=\"active\">") . '</li>
						<li><a href="' . VIRTUAL_PATH . 'users/logout.php">Logout</a></li>
					</ul>
				</li>

		</ul>';

	}else{
		//return ""; if you don't want login to show, uncomment this and comment all below in else block:

		$nav[$config->userLogin] = "Login~Login to site";

		return '<ul class="nav navbar-nav navbar-right">

			<!-- next drop down -->

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						Login / Join
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">

						<!-- LINK generated in bootswatch_functions -->
						<li>' . bsLinks($nav,"<li>","</li>","<li class=\"active\">") . '</li>

						<!-- join modal in footer -->
						<li>
							<a href="#" data-toggle="modal" data-target="#joinMC">Join MC!</a>
						</li>
					</ul>
				</li>

		</ul>';
		#<ul class="nav navbar-nav navbar-right">' . bsLinks($nav,"<li>","</li>","<li class=\"active\">") . '</ul>';
	}
}

function bootswatchFeedback(){
	/**
 * shows a quick user message (flash/heads up) to provide user feedback
 *
 * Uses a Session to store the data until the data is displayed via showFeedback()
 *
 * Related feedback() function used to store message
 *
 * <code>
 * echo showFeedback(); #will show then clear message stored via feedback()
 * </code>
 *
 * changed from showFeedback() version 2.10
 *
 * @param none
 * @return string html & potentially CSS to style feedback
 * @see feedback()
 * @todo none
 */

	startSession();//startSession() does not return true in INTL APP!

	$myReturn = "";  //init
	if(isset($_SESSION['feedback']) && $_SESSION['feedback'] != "")
	{#show message, clear flash
		if(isset($_SESSION['feedback-level'])){$level = $_SESSION['feedback-level'];}else{$level = '';}

		switch($level)
		{
			case 'warning';
				$level = 'warning';
				break;
			case 'info';
			case 'notice';
				$level = 'info';
				break;
			case 'success';
				$level = 'success';
				break;
			case 'error';
			case 'danger';
				$level = 'danger';
				break;

		}



		$myReturn .= '
		<div class="alert alert-dismissable alert-' . $level . '" style="margin-top:.5em;">
		<button class="close" data-dismiss="alert" type="button">&times;</button>
		' . $_SESSION['feedback'] . '</div>
		';
		$_SESSION['feedback'] = ""; #cleared
		$_SESSION['feedback-level'] = "";
	}
	return $myReturn; //data passed back for printing
}




//General links for TOP NAV HERE
function bsDropdownLinks($linkArray, $prefix='', $suffix='', $classLiPrefix='', $separator="~"){

	/*
#SEE http://webcheatsheet.com/php/multidimensional_arrays.php

SEE: bootswatch_functions.php
SEE: bootswatch/header-inc.php
SEE: common-inc.php
SEE: config-inc.php

HOW LINK IS STORED IN CONFIG-INC.PHP
	$nav2['users/dashboard.php'] = "Dashboard~Link to user/admin dashboard";

	$nav2['#'] = "DropDown Logic";
	$nav2['users/dashboard.php'] = "Dashboard~~Link to user/admin dashboard";
	$nav2['users/todo.php'] = "ToDo~~My Task List";
	$nav2['users/login.php'] = "Dashboard~~title tag deets";

	$nav2['_test/'] = "Test~Build Block Files Go Here";
	$nav2['_test/contact.php'] = "Contact~title tag deets";


HOW IT's CALLED:

	#IN config-inc.php - line #129
	$config->nav1 = $nav2;

	Then in bootswatch/header-inc.php - line #
	echo bsDropdownLinks( #called from bootswatch_functions.php
		$config->nav1,   #now $config->nav2
		'<li>',
		'</li>',
		'<li class="active">'
		); #link arrays are created in config_inc.php file - see

 */

	#initial for return of data...
	$myReturn = '';

	$target = ' target="_blank"'; #will be removed if relative URL

	#here is where we sort out what we are getting
	#if is/isn't dropdown...

	$chek  = '~~'; #is dropdown else is not
	$match = '';

	/*
	#if ($chek != $match){ #its not a dropdown - process out

		if(basename($url) == THIS_PAGE){
		$flexPrefix = $classLiPrefix;
		}else{
			$flexPrefix = $prefix;
		} #added to create PageID

		$httpCheck = strtolower(substr($url,0,8)); # http:// or https://

		if(!(strrpos($httpCheck,"http://")>-1) && !(strrpos($httpCheck,"https://")>-1))
		{//relative url - add path
			$url = VIRTUAL_PATH . $url;
			$target = "";
		}else if(strrpos($url, ADMIN_PATH . 'user_')>-1){
			$target = "";
		}# clear target="_blank" for admin files



		$pos = strrpos($text, $separator); #tilde as default separator
		if ($pos === false)
		{// note: three equal signs - not found!
			$myReturn .= $flexPrefix . "<a href=\"" . $url . "\"" . $target . ">" . $text . "</a>" . $suffix . "\n";
		}else{//found!  explode into title!
			$aText = explode($separator, $text); #split into an array on separator
			$myReturn .= $flexPrefix . "<a href=\"" . $url . "\" title=\"" . $aText[1] . "\"" . $target . ">" . $aText[0] . "</a>" . $suffix . "\n";
		}

	}else{ #it is a dropdown - process




	}
	*/


	#SEE https://getbootstrap.com/components/#navbar
	#build dummy to analyse...


	$compMenu = '<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="new-nav-2">
			<ul class="nav navbar-nav">

<!-- BEGIN CHARACTERS dropdown -->

<li class="dropdown ' . myTab('characters') . ' ">
	<a href="#" class="dropdown-toggle "data-toggle="dropdown" role="button"
	aria-haspopup="true" aria-expanded="false">Characters<span class="caret"></span>
</a>
<ul class="dropdown-menu">';



if(startSession() && isset($_SESSION['UserID'])){
	$compMenu .= '<li><a href="' . VIRTUAL_PATH . 'characters/profileAdd.php">Add Character</a></li>';
}


$compMenu .= '<li><a href="' . VIRTUAL_PATH . 'characters">Characters</a></li>
	<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowWanted" class="' . activeLink('index.php'). '">Wanted</a></li>
	<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowTaken" class="' . activeLink('index.php'). '">Taken</a>';

if(startSession() && isset($_SESSION['UserID'])){
	$compMenu .= '
		<li><a href="#" class="' . activeLink('plotter.php'). '"><strike>Plotters(N/A)</strike></a></li>
	';
}

$compMenu .= '<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowPlayby">PlayBys (All)</a></li>';

if(startSession() && isset($_SESSION['UserID'])){
	$compMenu .= '<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowPlayby">PlayBys (Male)></a></li>
		<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowPlayby">PlayBys (female)</a></li>
	';
}

$compMenu .= '<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowBanned">Banned</a></li>
	<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowAvailable">Available</a></li>
	<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowTeams">Teams</a></li>';

if(startSession() && isset($_SESSION['UserID'])){
	$compMenu .= '<li role="separator" class="divider"></li>
		<li><a href="' . VIRTUAL_PATH . 'characters/index.php?act=ShowMembers"><strike>MEMBERs(N/A)</strike></a></li>
		<li role="separator" class="divider"></li>
		<li><a href="#" ><strike>Creation Rules(N/A)</strike></a></li>
	';
}

$compMenu .= '</ul>
</li>
<!-- END CHARACTERS dropdown -->


<!-- BEGIN THREADS NO DROPDOWN -->
<li class=" ' . myTab('threads') . ' "><a href="' . VIRTUAL_PATH . 'threads/index.php" class="nav-item ">Posts</a></li>
<!-- END THREADS dropdown -->


<!-- BEGIN MODAL -->
<li><a href="#" data-toggle="modal" data-target="#myModal">MODAL</a></li>
<!-- END MODAL dropdown -->


<!-- BEGIN LIBRARY dropdown -->

<li class="dropdown ' . myTab('library') . '">
	<a href="' . VIRTUAL_PATH . 'library"
		class="dropdown-toggle" data-toggle="dropdown"
		role="button" aria-haspopup="true"
		aria-expanded="false">Library<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">

	<li><a href="' . VIRTUAL_PATH . 'library/about.php">About</a></li>
	<li><a href="' . VIRTUAL_PATH . 'library/about.php">Rules</a></li>
	<li><a href="' . VIRTUAL_PATH . 'library/about.php">Posting Guidelines</a></li>
	<li><a href="' . VIRTUAL_PATH . 'library/summary.php">"Story Summary</a></li>
	<li><a href="' . VIRTUAL_PATH . 'library/timeline.php">MCU Timeline</a></li>

		<li role="separator" class="divider"></li>

	<li><a href="' . VIRTUAL_PATH . 'library/powers.php">Powers</a></li>
	<li><a href="' . VIRTUAL_PATH . 'library/index.php">Traits</a></li>
			<li><a href="' . VIRTUAL_PATH . 'library/index.php"><strike>STATs(N/A)</strike></a></li>
			<li><a href="' . VIRTUAL_PATH . 'library/index.php"><strike>QUIRKs(N/A)</strike></a></li>
			<li><a href="' . VIRTUAL_PATH . 'library/index.php"><strike>SKILLs(N/A)</strike></a></li>
			<li><a href="' . VIRTUAL_PATH . 'library/index.php"><strike>TRAITs(N/A)</strike></a></li>

		<li role="separator" class="divider"></li>

	<li><a href="' . VIRTUAL_PATH . 'library/definitions.php">Site Definitions</a></li>
	<li><a href="' . VIRTUAL_PATH . 'library/faqs.php">FAQs</a></li>
	<li><a href="' . VIRTUAL_PATH . 'library/sitelog.php">Site Development Log</a></li>

		<li role="separator" class="divider"></li>

	<li><a href="http://goo.gl/BqCKe3">Superhero Nation</a></li>
	</ul>
</li>

<!-- END LIBRARY dropdown -->


<li><a href="' . VIRTUAL_PATH . 'contact.php" class="nav-item">Contact</a></li>';


if(startSession() && isset($_SESSION['UserID']) && ($_SESSION['UserID'])==1){
$compMenu .= '

<!-- next drop down -->

<li class="dropdown ">
	<a
		href="#"
			class="dropdown-toggle"
			data-toggle="dropdown"
			role="button"
			aria-haspopup="true"
			aria-expanded="false">Monkee<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">

		<li><a href="' . VIRTUAL_PATH . 'users/dashboard.php">Dashboard</a></li>
		<li><a href="' . VIRTUAL_PATH . 'users/adminer.php" target="_blank">Adminer</a></li>
		<li><a href="' . VIRTUAL_PATH . '_test">Test</a></li>

			<li role="separator" class="divider"></li>

		<li><a href="' . VIRTUAL_PATH . '_todo.php">2DOs</a></li>

		<li><a href="#">&nbsp;</a></li>

		<li><a href="' . VIRTUAL_PATH . 'characters/profileCreate.php"><strike>Create Character</strike></a></li>
		<li><a href="' . VIRTUAL_PATH . 'characters/index.php">Update Characters</a></li>
		<li><a href="' . VIRTUAL_PATH . 'characters/profileDestroy.php">Delete Characters</a></li>

		<li><a href="' . VIRTUAL_PATH . 'contact.php">2DOs</a></li>

			<li role="separator" class="divider"></li>

		<li><a href="#">TODO - GroupBook</a></li>
		<li><a href="#">TODO - Gossemer-twitter</a></li>

		<li><a href="#">TODO - Daily Buggle</a></li>

		<li><a href="#">TODO - Power Personalizer</a></li>
		<li><a href="#">TODO - Tool Tips</a></li>
	</ul>
</li>';
}

			$compMenu .= '</ul>
		</div><!-- /.navbar-collapse -->
	';

	#if user is logged in they can see this shit...
		return $compMenu;
}
