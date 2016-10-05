<?php

	session_start();
	// Unset all of the session variables.
	$_SESSION = array();
	// Finally, destroy the session.
	session_destroy();

	$myURL = $_GET['url'];

	header( "Location: " . $myURL); //Send me back to where

