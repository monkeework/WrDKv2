<?php
include './../_inc/config_inc.php';

//session_start(); //session starts in config file



if(isset($_SESSION['UserID'])){
	$userEmail = $_SESSION['UserID'];
}else{
	$userEmail = 0;
}

if(isset($_SESSION['Privilege'])){
	$privilege = $_SESSION['Privilege'];
}else{
	$privilege = 0;
}

if(isset($_SESSION['UserID'])){
	$myID = $_SESSION['UserID'];
}else{
	$myID = 0;
}



function getEvalImg($str = ''){
	$evalNum = mt_rand(1, 12);

	$str .= '<label for="evalChek" class="col-sm-2 control-label"><img
			style="width:75px; margin-top:-35px;margin-left: -25px;"
			src="./../_img/_eval/eval-img-'. $evalNum .'.jpg"
			alt="img" />
		</label>
		<input type="hidden" name="evalChek" value="' . $evalNum . '">
	';


	return $str;

}


function testInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


if (isset($_POST["submit"])) {
	//initialize vars to minimize explosions
	$urlPointer = $name = $email = $gender = $comment = $website = $urlPointer = $message = $requestMembership = $evalChek = $evalAnswer = $charFCOC = $charSum = $charRequest = '';


	//get data
	$urlPointer 				= $_POST['urlPointer'];
	$name 							= $_POST['name'];
	$email 							= $_POST['email'];
	$message 						= $_POST['message'];

	//NOT ALWAYS SET - so check only if exist...
	if(isset($_POST['charAdopt'])){
		$charAdopt 					= $_POST['charAdopt'];
		$charAdopt 					= testInput($charAdopt);
	}

	//NOT ALWAYS SET - so check only if exist...
	if(isset($_POST['charRequest'])){
		$charRequest 					= $_POST['charRequest'];
		$charRequest 					= testInput($charRequest);
	}

	//NOT ALWAYS SET - so check only if exist...
	if(isset($_POST['charFCOC'])){
		$charFCOC 					= $_POST['charFCOC'];
		$charFCOC 					= testInput($charFCOC);
	}

	$evalChek = intval($_POST['evalChek']);

	//chek data

	$urlPointer 				= testInput($urlPointer);
	$name       				= testInput($name);
	$email      				= testInput($email);
	$message    				= testInput($message);


	#$evalChek 					= testInput($evalChek);
	#$evalChek = intval($_POST['evalChek']);
	$evalAnswer       	= testInput($evalAnswer);

	$requestMembership  = testInput($requestMembership);


	//flag if membership request
	if(isset($requestMembership)){ $requestMembership = ' (' . $name . ' has requested membership)';}

	$from = 'Marvel Champions (' . 	$urlPointer . ')';
	$to = 'speedlanerunner@yahoo.com, monkeework@gmail.com, chezshire@gmail.com ';
	$subject = 'Marvel Champions ' . $requestMembership ;

	//build body of email
	$message .= '


<hr />Request to Adopt: ' . $charAdopt . '

Request to Create: ' . $charRequest . '
Character is: ' . $charFCOC;



	$body ="From: $name\n E-Mail: $email\n Message:\n $message";

	// Check if name has been entered
	if (!$_POST['name']) {
		$errName = 'Please enter your name';
	}

	// Check if email has been entered and is valid
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Please enter a valid email address';
	}

	//Check if message has been entered
	if (!$_POST['message']) {
		$errMessage = 'Please enter your message';
	}
	//Check if simple anti-bot test is correct

	// Check if answer has been entered
	if (!$_POST['evalAnswer']) {
		$errAnswer = 'Please guess who the hero is, thank you.';
	}

	//eval answer
	$evalGiven = $evalAnswer;
	switch (strtolower($evalGiven)) {
		case "black widow":
			$evalAnswer = 1;
			$evalWanted = 'black widow';
			break;

		case "captain america":
		case "cap":
			$evalAnswer = 2;
			$evalWanted = 'captain america';
			break;

		case "agent  phil coulson":
		case "agent coulson":
		case "coulson":
		case "phil coulson":
			$evalAnswer = 3;
			$evalWanted = 'coulson';
			break;

		case "falcon":
		case "agent wilson":
		case "agent sam wilson":
		case "sam wilson":
			$evalAnswer = 4;
			$evalWanted = 'falcon';
			break;

		case "agent nick fury":
		case "agent nickolas fury":
		case "nickolas fury":
		case "agent fury":
			$evalAnswer = 5;
			$evalWanted = 'agent fury';
			break;

		case "giant-man":
		case "giant man":
		case "ant-man":
		case "ant man":
			$evalAnswer = 6;
			$evalWanted = 'ant man';
			break;

		case "hawkeye":
		case "ronin":
		case "barton":
		case "agent barton":
			$evalAnswer = 7;
			$evalWanted = 'hawkeye';
			break;

		case "hulk":
			$evalAnswer = 8;
			$evalWanted = 'hulk';
			break;

		case "tony stark":
		case "stark":
		case "iron man":
		case "iron-man":
		case "ironman":
			$evalAnswer = 9;
			$evalWanted = 'iron man';
			break;

		case "Fury":
		case "Nick Fury":
		case "Director Fury":
		case "Director Nike Fury":
			$evalAnswer = 10;
			$evalWanted = 'fury';
			break;

		case "thor":
		case "thor odinson":
			$evalAnswer = 11;
			$evalWanted = 'thor';
			break;

		case "war machine":
		case "warmachine":
		case "war-machine":
		case "rhodey":
		case "agent rhodes":
		case "james rhodes":
			$evalAnswer = 12;
			$evalWanted = 'war machine';
			break;

		default:
			$evalAnswer = 0;
			$evalWanted = $evalAnswer;
	}


	//dumpDie($evalAnswer);



	// chek if answer is correct
	if ($evalAnswer !== $evalChek) {
		$errAnswer = 'Your guess did not match, please try again.' . (string)$evalAnswer . ' | '. (string)$evalChek;
	}

	//if logged in....
	if (!$errName && !$errEmail && !$errMessage) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Thank You! I will be in touch</div>';

				feedback("Thank You! We will be in touch soon-ish ;)", "success");

				#header( "Location: $myURL "); //Send me back to where i belong
				header( "Location: " . $urlPointer ); //Send me back to where i belong

	// If there are no errors, send the email
	}else if (!$errName && !$errEmail && !$errMessage && !$errAnswer) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Thank You! I will be in touch</div>';

				feedback("Thank You! We will be in touch soon-ish ;)", "success");

				#header( "Location: $myURL "); //Send me back to where i belong
				header( "Location: " . $urlPointer ); //Send me back to where i belong
			}
		} else {
			$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Bootstrap contact form with PHP example by BootstrapBay.com.">
	<meta name="author" content="BootstrapBay.com">
	<title>Bootstrap Contact Form With PHP Example</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>

<body>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1 class="page-header text-center">Contact Marvel Champions</h1>
			<form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars('index.php');?>">
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" placeholder="Your name..." value="<?php echo htmlspecialchars($_POST['name']); ?>">
						<?php echo "<p class='text-danger'>$errName</p>";?>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
						<?php echo "<p class='text-danger'>$errEmail</p>";?>
					</div>
				</div>
				<div class="form-group">
					<label for="message" class="col-sm-2 control-label">Message</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
						<?php echo "<p class='text-danger'>$errMessage</p>";?>
					</div>
				</div>



<?php
	//if user is a vistor, guest, unregistered user, not logged in... et al
	if(!isset($_SESSION['Privilege']) || (($_SESSION['Privilege']) <= 1)){

	//treat user as possibly malicious
?>

	<div class="form-group">
		<label for="eval" class="col-sm-2 control-label"><?=getEvalImg(); ?></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="evalAnswer" name="evalAnswer" placeholder="Please Name the Character Shown?*"  value="<?php echo htmlspecialchars($_POST['evalAnswer']); ?>">
			<?php echo "<p class='text-danger'>$errAnswer</p>";?>
			<?php echo "<p class='text-danger'>Given: $evalGiven  || Wanted: $evalWanted</p>";?>

		</div>
	</div>


	<div class="form-group">
		<label for="requestMembership" class="col-sm-2 control-label"></label>
		<div class="col-sm-10 ">
			<input type="checkbox" name="requestMembership" value="membership request"> &nbsp; <i>Request membership to Marvel Champions</i>
		</div>
	</div>

<?php
	}
?>










<?php
//if user a member...
if(($privilege == 0) || ($privilege >= 1)){

$sql = "SELECT CharID, UserID FROM ma_Characters WHERE UserID = $myID";

$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	$count = 0;
	while ($row = mysqli_fetch_assoc($result))
	{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
		$charSum = $count;
		$count++; //automatically now equal to one as loop ran once
	}
}

@mysqli_free_result($result); //free resources


$charTot = 2 - $charSum;// max char allowance is currently 2

echo '<div style="background-color: #edf8f1; padding:10px;  margin-bottom: 10px;">
<div class="form-group">
	<label for="evalAnswer" class="col-sm-2 control-label"><?=getEvalImg(); ?></label>
	<div class="col-sm-10">';

	if($charSum <= 2){
		echo '<div><p> You may be eligible for a character*</p></div>
				</div>
			</div>';

			$sql = "SELECT CharID, UserID, CodeName, StatusID FROM ma_Characters WHERE StatusID <= 2";

			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results
				#External formatting here...
				echo '<div class="form-group">
					<label for="charAdopt"  class="col-sm-2 control-label">Adoptable:</label>
					<div class="col-sm-10">
						<select class="form-control" id="charAdopt" name="charAdopt">
							<option> Choose from our list of pre-built character shells</option>';

				while ($row = mysqli_fetch_assoc($result))
				{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
					$codeName = $row['CodeName'];
					echo '<option value="' . $codeName . '">' . $codeName . '</option>';
				}
				echo '</select>
					</div>
				</div>';
			}

		@mysqli_free_result($result); //free resources











		//@TODO
		/*

			HOW: How to disable a specific input text acording to the dropbox selection?


			SEE: https://stackoverflow.com/questions/16916624/how-to-disable-a-specific-input-text-acording-to-the-dropbox-selection
			FID: https://jsfiddle.net/dovereem/L7wsa/2/

			Add an onchange to the select box..


		*/








		echo '<div class="form-group">
			<label for="charNew" class="col-sm-2 control-label text-right">New/original</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="charNew" name="charRequest" placeholder="Enter the name of the character you would like to apply for">
			</div>
		</div>

		<div class="form-group">
			<label for="charFCOC" class="col-sm-2 control-label"></label>
			<div class="col-sm-10 ">

				<input type="radio" name="charFCOC" value="fc"> &nbsp; <i>FC - A Featured Character of the Marvel Universe?</i>
				<br />
				<input type="radio" name="charFCOC" value="oc"> &nbsp; <i>OC - An original character of your imagination?</i>
			</div>
		</div>';

	}else{
		echo '<div>You currently have ' . $count .   ' characters and are not eligible for any additonal characters at this time.</div>
			</div>
		</div>';
	}

	echo '</div>';
} //END if statement
?>









				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<input type="hidden" name="urlPointer" value="<?=$urlPointer; ?>">

						<a href="logout.php?url=<?=$urlPointer; ?>" class="btn btn-default btn-sm" role="button"><i>Exit without Sending</i></a>
						<input class="btn btn-success btn-sm pull-right" id="submit" name="submit" type="submit" value="Send Message" class="btn btn-primary">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">


						<?php //echo $result; ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
