<?php
function maxDoc_users_login(){
/**
 * login.php is entry point (form) page to user/administrative area
 *
 * Works with validate.php to process user/administrator login requests.
 * Forwards user to dashboard.php, upon successful login.
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see validate.php
 * @see dashboard.php
 * @see logout.php
 * @see user_only_inc.php
 * @todo none
 */
}


require '../_inc/config_inc.php'; #provides configuration, et al.
$config->pageID = 'User Login';
$config->titleTag = 'User Login'; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->metaRobots = 'no index, no follow';#never index admin pages

//END CONFIG AREA ----------------------------------------------------------
if(startSession() && isset($_SESSION['user-red']) && $_SESSION['user-red'] != 'logout.php')
{//store redirect to get directly back to originating page
	$user_red = $_SESSION['user-red'];
}else{//don't redirect to logout page!
	$user_red = '';
}#required for redirect back to previous page
get_header(); #defaults to theme header or header_inc.php
?>




 <div class="row">	 
	<div class="col-sm-6">
		<form role="form" action="<?=$config->userValidate?>" method="post">
			<div class="form-group">
				<label for="em">Email</label>
				<input type="email" class="form-control" id="em" name="em" autofocus required>
			</div>
			<div class="form-group">
				<label for="pw">Password</label>
				<input type="password" class="form-control" id="pw" name="pw" required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Login</button>
				<a href="forgot-password.php" class="pull-right">Forgot Password?</a>
				<input type="hidden" name="red" value="' . $user_red . '" />
			</div>
		</form>
	</div><!-- / 6 -->
		<div class="col-sm-6"></div><!-- / 6 -->
</div><!-- / row -->
<?
get_footer(); #defaults to theme footer or footer_inc.php

if(isset($_SESSION['user-red']) && $_SESSION['user-red'] == 'logout.php')
{#since logout.php uses the session var to pass feedback, kill the session here!
	$_SESSION = array();
	session_destroy();
}
?>
