<?php



echo 'here';
die;

/**
 * header_inc.php provides the initial HTML and left panel for our site files
 *
 * An include file named meta_inc.php includes all meta data, title tag and a place to
 * install JS via a variable named $loadHead
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see meta_inc.php
 * @see footer_inc.php
 * @todo none
 */
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">\n"; //xml uses ?, so we escape it
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include INCLUDE_PATH . 'meta_inc.php'; ?>
	<link href="<?php echo VIRTUAL_PATH; ?>_css/default_style.css" rel="stylesheet" type="text/css" />
	<style type="text/css">




			table {border-collapse: collapse;}

	.profileTable{
		width:770px;
		clear: both;
		}

	.profileHeadMainTD {
		overflow: auto;
		height: 440px;
		background-repeat:no-repeat;
		vertical-align: bottom;
		color: white;
		}

		td.profileHeadDiv{
			float: left;
			}

		div.profileHeaderMainLeft h1{
			text-shadow: 2px -3px 5px black;
			margin-bottom: -0px;
			}

		TR:hover {background-color: #f5f5f5}

			.profileHeaderMainLeft{ width: 540px;}

			.profileHeaderMainLeft, .profileHeaderMainRight{
				//background-color: blue;
				padding-left: 10px;

				vertical-align: bottom;
				display: inline-block;
					/* ie6/7 */
					*display: inline;
				zoom: 1;
				}


			.OCFC{
				font-weight: 100;
				font-style: italic;
				vertical-align: super;
				font-size: 60%;
				}

			.profileHeaderMainRight{
				text-align: center;
				margin: 10px 20px -30px 20px;
				padding: 20px;
				width: 180px;
				}

				.profileHeadThumbLG {
					margin: 10px 15px -10px 0;
					border: solid 5px white;
					}

				.profileHeadThumbSM {
					width: 32px;
					Height: 32px;
					border: solid 1px white;
					background-color: #888;




		tr.spacerBottom > td {
			padding-bottom: .5em;
			}

		.profileLeftTD {
			text-align: right;
			min-width: 35%;
			padding-left: 10px;
			color: #111;
			background-color: red;
			vertical-align: top;
			}


		table, th, td { border: 1px solid black; }









	</style>
</head>
<body>
<table width="100%" cellpadding="5" cellspacing="0" margin="0">
			<!-- change header color here -->
	<tr>
		<td colspan="3">
				 <h1 align="center"><?php echo $config->banner;?></h1>
				 <p>This theme means you didn't choose one!  (default)
		</td>
		</tr>
	<tr>
				<!-- change left panel color here -->
				<td width="175" valign="top">
			<p align="center"><? echo $config->sidebar1; ?></p>
			<?php
				#echo makeLinks($config->nav1,'<p align="center">','</p>'); #link arrays are created in config_inc.php file
			?>
		</td>
						<!-- change guts/identity area color here -->
		<td valign="top">
		<?=showFeedback();?>
		<!-- end of header include file -->
