<?php
function maxDoc_index(){
	/**
	 * index.php is a model for largely static PHP pages
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
}

require '_inc/config_inc.php'; #provides configuration, pathing, error handling, db credentials
$config->titleTag = THIS_PAGE; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php

# END CONFIG AREA ----------------------------------------------------------

header("Location: threads/index.php ");
