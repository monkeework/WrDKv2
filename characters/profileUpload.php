<?php

function maxDoc_characters_profileUpload(){
#id - series - suffix
#THUMB   2-1t.jpg     teddy thumbnail
#GALLY 	 2-1.jpg      teddy gallery
#PROFL   2.jpg        teddy profile/featured image/emoji
#HEADR   2-1h.jpg     teddy header/background

/**
 * profileUpload.php based upload_form.php
 *
 * takes id number from a view page (http://localhost/WrDK/characters/profile.php?id=15&act=edit),
 * and creates form for uploading a new image.
 *
 * This page requires a loaded querystring, with an id number of an item passed to it. Form
 * will submit image to be uploaded, and ID, imageType (is gallery, is banner, is profile) to upload_image.php, which processes the upload.
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seelist.php
 *
 * @todo edit peekaboo edit character link
 *	  cheks char assigned/is mod+
 *		show edit option
 *
 * @see view_upload.php
 * @todo Identify the return page more specifically - don't rely on referer
 */

 # '../' works for a sub-folder.  use './' for the root
}


$pageDeets = '<ol>
	<li> Get Uploads working nicely</li>
	<li> make a popup or something?</li>

	<li> add classes</li>
	';



require '../_inc/config_inc.php';

//set access priv needed for this page by member
		chekPrivies(3); #mems+

#config for image uploads
$title = "Image Upload";
$returnPage = $_GET['returnPage'];

#declare file size max (100000 = 100K)
$sizeBytes = 100000; # bytes max file size

#If true, will create thumbnail in same upload directory
#Pass as a string, so can be placed in hidden form field
$createThumb = "TRUE";

#Declared width of thumbnail
#Height calculated from there
$thumbWidth  = 50;
$thumbHeight = 50;

#Declared suffix of thumbnail.
#if use '_thumb', and image prefix is 'm', file name would be: m1_thumb.jpg
#$thumbSuffix = "_thumb";

#Folder for upload.
$uploadFolder = "uploads/"; # Physical path added to uploadFolder info in profileUploadProcess.php

#unique prefix to add to your image name.
$type = "";

#unique prefix to add to your image name.
#$imagePrefix = "m";

#image extension - currently only supporting .jpg - see profileUploadProcess.php
$extension = ".jpg";
#end config for image uploads




# END CONFIG AREA ---------------------------------------


require_once INCLUDE_PATH . 'admin_only_inc.php';
#the loadHead variable allows us to add JS or CSS into the <head> tag inside header_inc.php
$loadhead =
'
<script language="JavaScript">
function checkForm(thisForm)
{
	if(thisForm.FileToUpload.value=="")
	{
		alert("Please select a file to upload");
		thisForm.FileToUpload.focus();
		return false;
	}else{
		document.getElementById("mySubmit").disabled=true;
		document.getElementById("mySubmit").value="Uploading, please wait...";
		return true;
	}
}
</script>
';

get_header(); #defaults to theme header or header_inc.php

#notes to self
#echo MaxNotes($pageDeets); #notes to me!

# check variable of item passed in on querystring
if(isset($_REQUEST['id'])){$myID = (int)$_REQUEST['id'];}else{$myID = 0;}

//Get header element after myAction processed to determine if we show button or not.
getJumbotron($myID, $title);




#over-ride info sent from form, if sent - uses $_REQUEST instead of $_GET or $_POST
if(isset($_REQUEST['imagePrefix'])){$imagePrefix 	 = $_REQUEST['imagePrefix'];}
if(isset($_REQUEST['uploadFolder'])){$uploadFolder = $_REQUEST['uploadFolder'];}
if(isset($_REQUEST['extension'])){$extension 			 = $_REQUEST['extension'];}
if(isset($_REQUEST['createThumb'])){$createThumb   = $_REQUEST['createThumb'];}
if(isset($_REQUEST['thumbWidth'])){$thumbWidth     = $_REQUEST['thumbWidth'];}
if(isset($_REQUEST['thumbSuffix'])){$thumbSuffix   = $_REQUEST['thumbSuffix'];}
if(isset($_REQUEST['sizeBytes'])){$sizeBytes       = $_REQUEST['sizeBytes'];}

if(isset($_REQUEST['returnPage'])){$returnPage     = $_REQUEST['returnPage'];}
if(isset($_REQUEST['type'])){$type                 = $_REQUEST['type'];}else{$type = '';}
#a-zz so we can have lots
if(isset($_REQUEST['series'])){$series             = $_REQUEST['series'];}else{$series = '';}


$size = $sizeBytes/1000; # divide by 1000, use KB

if($myID > 0)
{//show table


	$referringPage=strval(isset($_SERVER['HTTP_REFERER']));


	echo '
		<div class="container-fluid text-center">
			<div class="row content">
				<div class="col-sm-12 text-center">
					<h1>Uploading Image Type</h1>

					<table border="1" align="center" style="border-collapse:collapse">
						<tr>
							<td align="center">Current Image:</td>
						</tr>

						<tr>
							<td align="center">';

#id - series - suffix
#THUMB   2-1t.jpg     teddy thumbnail
#GALLY 	 2-1.jpg      teddy gallery
#PROFL   2.jpg        teddy profile/featured image/emoji
#HEADR   2-1h.jpg     teddy header/background


								if($type == 'p'){
									#if profile image show profile image
									echo '<img src="' . VIRTUAL_PATH . $uploadFolder . $myID . '-' . $series . $extension . '" />';
								}else if ($type == 'g'){
									#if gallery image show gallery image
									echo '<img src="' . VIRTUAL_PATH . $uploadFolder . $myID . '-' . $series . $extension . '" />';
								}else{
									#else show header image
									echo '<img width="500px" src="' . VIRTUAL_PATH . $uploadFolder . $myID . '-h' . $series . $extension . '" />';
								}

							echo '</td>

						</tr>
						<tr>
							<td align="center" colspan="2">

								<!-- upload_form.php -->
								<form name="myForm" action="' . VIRTUAL_PATH . 'characters/profileUploadProcess.php"
									method="post"
									enctype="multipart/form-data" onsubmit="return checkForm(this);">';


									echo '<input type="file" 	 name="FileToUpload" id="FileToUpload" /><br />
										<input type="hidden" name="myID" value="' . $myID . '" />';


										echo'
										<input type="hidden" name="type"          value="' . $type . '" />
										<input type="hidden" name="series"        value="' . $series . '" />
										<input type="hidden" name="uploadFolder" 	value="' . $uploadFolder . '" />
										<input type="hidden" name="extension" 		value="' . $extension . '" />
										<input type="hidden" name="uploadFolder" 	value="' . $uploadFolder . '" />
										<input type="hidden" name="thumbWidth" 		value="' . $thumbWidth . '" />
										<input type="hidden" name="createThumb" 	value="' . $createThumb . '" />
										<input type="hidden" name="sizeBytes" 		value="' . $sizeBytes . '" />
										<input type="hidden" name="returnPage"    value="' . $returnPage . '" />';

									echo 'Browse an Image to Upload:<br />
									<em>file must be ' . $size . ' KB or less.</em><br />';


									/*

	#id - series - suffix
	#THUMB   2-1t.jpg     teddy thumbnail
	#GALLY 	 2-1.jpg      teddy gallery
	#PROFL   2.jpg        teddy profile/featured image/emoji
	#HEADR   2-1h.jpg     teddy header/background

									 * The address of the page (if any) which referred the user agent to the current page.
									 * This is set by the user agent. Not all user agents will set this,
									 * and some provide the ability to modify HTTP_REFERER as a feature.
									 * In short, it cannot really be trusted.
									 */

									$referringPage=strval(isset($_SERVER['HTTP_REFERER']));

									echo '<input type="hidden" name="returnPage" value="' . $returnPage . '" />

									<br />

									<input type="Submit" value="Upload File" id="mySubmit" />
								</form>
								<p align="center"><a href="javascript:history.go(-1)">Return Without Upload</a></p>
							</td>
						</tr>
					</table>

				</div>
			</div>
		</div>';

	 echo '<p align="center">

		</p>';

}else{
	echo '<p align="center"><h4>No Such Image</h4></p>
		<p align="center"><a href="javascript:history.go(-1)">EXIT</a></p>';
}



get_footer(); #defaults to footer_inc.php


///// #myFunctions



function randLetter(){
		//$int = rand(0,51);
		$int = rand(0,8);
		$a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rand_letter = $a_z[$int];
		return $rand_letter;
}

function getThumbs($imgID, $name){ #create 4 random thumbnails
	#id - series - suffix
	#THUMB   2-1t.jpg     teddy thumbnail
	#GALLY 	 2-1.jpg      teddy gallery
	#PROFL   2.jpg        teddy profile/featured image/emoji
	#HEADR   2-1h.jpg     teddy header/background

	#define variables needed
	$x = 1;
	$str = '';
#edit
	if(($_REQUEST['act']) == 'show'){
		#make gallery of 4 random images
		while($x <= 4) {
			$imgPath = '../uploads/' . $imgID . '-' . rand(1,6) . 't.jpg';

			#if image exists
			if(file_exists($imgPath)){
				$str .= '<img src="' . VIRTUAL_PATH .
					'uploads/' . $imgPath . '" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}else{ #show static
				$str .= '<img src="' . VIRTUAL_PATH .
					'_img/_static/static---00' . rand(0,9) . '.gif" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}
			$x++;
		}
	}

	#edit mod
	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images
		while($x <= 4) {
			$imgPath = '../uploads/c' . $imgID . randLetter() .
					'.jpg';

			#if image exists
			if(file_exists($imgPath)){
				$str .= '<img src="../uploads/c' . $imgID . randLetter() .
					'.jpg" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}else{ #show static
				$str .= '<img src="../_img/_dims/dims35x35.jpg" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}
			$x++;
		}
	}

return $str; #return gallery images
}

function getJumboBg($imgID, $str=''){ #create background image
	#id - series - suffix
	#THUMB   2-1t.jpg     teddy thumbnail
	#GALLY 	 2-1.jpg      teddy gallery
	#PROFL   2.jpg        teddy profile/featured image/emoji
	#HEADR   2-1h.jpg     teddy header/background
	$imgPath = '../uploads/' . $imgID . '-h0.jpg';

	if(($_REQUEST['act']) == 'show'){
		#make gallery of 4 random images
		if(file_exists($imgPath)){
			$str .= $imgPath;
		}else{ #show static
			$str .= VIRTUAL_PATH . '_img/_static/static---blueCascade.gif';
		}
	}

	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images

		if(file_exists($imgPath)){
				$str .= $imgPath;
			}else{ #show static
				$str .= VIRTUAL_PATH . '_img/_dims/dims940x462ph.jpg';
			}

		}
	return $str; #return gallery images
}

function getHero($imgID, $str=''){
	#id - series - suffix
	#HEADR   2-h0.jpg    teddy header/background
	#PROFL   2-0.jpg    teddy profile/featured image/emoji
	#GALLY 	 2-0.jpg    teddy gallery
	#THUMB   2-0t.jpg   teddy thumbnail

	$imgPath = '../uploads/' . $imgID . '-0.jpg';

	if(($_REQUEST['act']) == 'show'){
		#make gallery of 4 random images

		if(file_exists($imgPath)){
			$str .= $imgPath;
		}else{ #show static
			$str .= VIRTUAL_PATH . '_img/_static/static---00' . rand(1,9). '.gif';
		}
	}

	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images

		if(file_exists($imgPath)){
				$str .= $imgPath;
			}else{ #show static
				$str .= VIRTUAL_PATH . '_img/_dims/dims170x170phf.jpg';
			}
		}
	return $str; #return gallery images
}

function getJumbotron($myID ='', $CodeName=''){
	echo '<style>
				.jumbotron {
					position: relative;
					background: #fff url("' . getJumboBg($myID) . '") center center;
					width: 100%;
					height: 100%;
					background-size: cover;
					overflow: hidden;
					}

				.vertical-align {
					position: absolute;
					bottom: -18px;
					left: 1%;
					}

				.btnJumbotron {
					position: absolute;
					top:10px;
					right: 0px;

					color: #000;

					background: white;
					#opacity: 0.9;
					font-size: 10px;
					padding: -3px -4px;

					border-radius: 10px 0 0 10px  ;
					font-weight: bold;
					}

					.btnJumbotron a {color: grey; text-decoration: none;}
					.btnJumbotron a:hover { color: tomato; text-decoration: none;}

				.jumbotron h1 {
					color: white;
					text-shadow: 4px 4px 8px #444;
					}

				.btn.outline {
					background: none;
					padding: 12px 22px;
					color: white;
					border: solid 2px white;
					border-radius: 10px;
					font-weight: bold;
					text-shadow: 0px 0px 8px #000000;
					box-shadow: 0px 0px 8px #000000;
					}


				.pull-bottom{
					position: absolute;
					bottom: 0px;}


				.myThumb {
					height: 35px;
					width: 35px;
					margin: 0 3px 0 6px;
					}

				.txt-KO{color: white;}

				.hoverHighlight:hover{ background: WhiteSmoke;}

				.charSection { background: WhiteSmoke;}

			</style>

			<!-- begin character -->
			<div class="container">
				<div class="jumbotron">
					<br />
					<br />
					<br />';

			if(
				startSession() &&
				isset($_SESSION['UserID']) &&
				($_REQUEST['act']) == 'show')
			{

				#add additional cheks
				#if is admin, suepr, owner, developer or is player show edit option.

				echo '<div class=text-right>
					<button type="button"  class="btn btn-sm btnJumbotron"><a class="txt-KO" href="./profile.php?id=' . $myID . '&act=edit" data-toggle="click to edit ' . $CodeName . '"> ' . $CodeName . ' &nbsp; <i class="glyphicon glyphicon-edit"></i></a></button>
				</div>';
			}

			echo '<h1 class="col-sm-8 vertical-align"><b>' . $CodeName . '</b></h1>

			<!-- image gallery here -->
			<div class"col-sm-2 vertical-align pull-right .vertical-align">

			<div class" pull-right">';

			echo getThumbs($myID, $CodeName) . '</div>
			<br />

			<div col-sm-2 pull-right">
				<img src="' . getHero($myID) . '" alt="' . $CodeName . '"
					class="img-thumbnail pull-right" width="170" height="170">
			</div>

		</div>
		<!--END IMAGES-->


	</div>
	<!--END JUMBO-->'; #END jumbo
}





#scripts must site outside php so the browser can properly read the script tags
?>


