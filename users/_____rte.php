<html>
<head>
	<meta charset="utf-8">
	<title>CKEditor Sample</title>
	<script src="./../_ckSetup/ckeditor.js"></script>
	<script src="./../_ckSetup/js/sample.js"></script>

	<link rel="stylesheet" href="./../_ckSetup/toolbarconfigurator/lib/codemirror/neo.css">
</head>
<body id="main">

<main>
	<div class="adjoined-bottom">
		<div class="grid-container">
			<div class="grid-width-100">




			<?php //006e_01-formhandler.php
define ('THIS_PAGE', basename($_SERVER['PHP_SELF'])); #CONSTANT/SUPERGLOBAL

//include '_tbx_functions.php';

echo '<b>PHYSICAL Path:</b> ' . realpath(dirname(__FILE__)) . '<br />';
echo '<b>SERVER Path:</b> ' . realpath(__FILE__) . '<br />';
echo '<b>VIRTUAL Path:</b> ' . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '<br />';
echo '<b>FILE:</b> ' . basename($_SERVER['PHP_SELF']);




echo '<br /><br />';
echo 'SEE: <a href="http://www.w3schools.com/php/php_forms.asp" target="_blank">Forms</a><br />';
echo 'SEE: <a href="http://www.newmanix.com/itc280/forms_RTE.php" target="_blank">Forms</a><br />';
echo '<br />';

echo '<p>A form is comprised of three pieces: Form, Form Handler, & Feeback </p>';

/*
		=   : data is (assigning value)
		==  : data is the same (checking assigned value)
		=== : data and container type are the same (check everything)
*/
if(isset($_POST['nFirstName'])){//if data show result
		echo 'Thank you for your comments<b>
		' . $_POST['nFirstName'] . '
		' . $_POST['nLastName'] . '</b>.<br /> You email is: <b>
		' . $_POST['nEmail'] . '.</b><br /> You submitted: <b>
		' . $_POST['nSecChek'] . '</b>

		<br />';

		echo "<br/><br/>
				<form '" . THIS_PAGE . "' method='post' onclick='reset();'>
						<input type='submit' value='reset' />
				</form>
				";
}else{//show form
		echo "
		<form action='" . THIS_PAGE . "' method='post' >
		<label for='nFirstName'>First Name: </label>
		<input
				placeholder=' First Name'
				type='text'
				name='nFirstName'
				id='idFirstName'
				required='required'

				title='We need your name - title tag'
				/>

		<br /><br />

		<label for='nLastName'>Last Name: </label>
		<input
				placeholder=' Last Name'
				type='text'
				name='nLastName'
				id='idLirstName'
				required='required'
				/>

		<br /><br />

		<label for='nEmail'>Email: </label>
		<input
				placeholder=' Your Email'
				type='email'
				name='nEmail'
				id='idEmail'
				required='required'

				title='We need your email - title tag'
				/>

		<br /><br />

		<label for='nSecChek'>Security Question: 9 + 3 = ?</label>
		 <input
				type='text'
				name='nSecChek'
				id='idSecChek'
				required='required'
				/>

						<br /><br />
		<br /><br />
		<input type='submit' value='submit'/> | <input type='reset' value='Clear' />

		</form>
		";
}


echo '<br /><br /><br />';

echo "dumpDie: <br />";
	 #dumpDie($aarFruit);
	 echo '<b>dumpDie disabled - it kills everything at end or run</b>';
echo '<br /><br /><br />';
echo 'run';

?>





</div>
		</div>
	</div>
</main>


<script>
	initSample();
</script>

</body>
</html>


