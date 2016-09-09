<?php
/**
 * index.php is an ADMIN ONLY page for redirects!
 *
 * Place in the Home
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

require '../_inc/config_inc.php'; #provides configuration, et al.

$redirect_to_login = TRUE; #if true, will redirect to admin login page, else redirect to main site index

# END CONFIG AREA ----------------------------------------------------------

if($redirect_to_login)
{# redirect to current login page
	myRedirect($config->userLogin);
}else{#redirect to main site index
	myRedirect(VIRTUAL_PATH . "index.php");
}
?>
