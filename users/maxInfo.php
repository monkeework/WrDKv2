<?php
/**
 * admin_info.php shows phpInfo() command results
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @todo none
 */

require '../_inc/config_inc.php'; #provides configuration, et al.


//set access priv needed for this page by member
		chekPrivies(7); #dev+

$access = "admin"; #admins can edit themselves, developers can edit any - don't change this var or no one can edit their own data
include_once INCLUDE_PATH . 'admin_only_inc.php'; #session protected page - level is defined in $access var
$config->titleTag = 'PHP Info'; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->metaRobots = 'no index, no follow';#never index admin pages

# END CONFIG AREA ----------------------------------------------------------
phpInfo();
?>
