<a href="?getFiles&?gender=m">Dudes</a> | <a href="?getFiles&gender=f">Chicks</a><br /><br />

<?php
	$gender = $prefix = $pbName = $pbPath = ''; #initialize


	#set needed vars
	if (($_GET['gender']) == 'm') {
		$gender = 'male';
		$prefix = 'm';
	}else{
		$gender = 'female';
		$prefix = 'f';
	}







//<a href="?getDirectories">View Directories</a> | <a href="?getFiles">View Files</a><br /><br />



//print just file names exclude directory names



if (isset($_GET['getDirectories'])) getDirectories();
	if (isset($_GET['getFiles'])) getFiles();


	//list directories
	function getDirectories(){
		echo "Available Directories:<br />";

		foreach (glob("*") as $dirname ) {
		if( is_dir( $dirname ) )
		echo "<a target=\"_blank\" href=\"$dirname \">$dirname</a><br />";}
		}

	//list files
	function getFiles(){
		echo "Available Files:<br />";

		foreach (glob("*.php") as $filename) {
		//prints file name & file size!
		//echo "$filename size " . filesize($filename) . "\n";

		echo "<a target=\"_blank\" href=\"$filename\">$filename</a><br />";}
		}










	#filename
	$pbName     = 'aaron_taylor_johnson';
	$pbFileName = "$pbName" . '-001.jpg';




	$pbFilePath = "../uploads/_playbys/{$gender}/{$pbName}/{$pbFileName}";

	echo $pbFilePath . ' ||||||||| ' . $pbName ;


	echo "<h3>Current Available <b>{$gender}</b> Playbys:<h3>";



	echo "<figure style='float: left'>
			<img style='width: 200px;'
			src='{$pbFilePath}'
			alt='{$pbName}'/>

			<figcaption> {$pbName} </figcaption>
		</figure>";

	echo "<figure style='float: left'>
			<img style='width: 200px;'
			src='{$pbFilePath}'
			alt='{$pbName}'/>

			<figcaption> {$pbName} </figcaption>
		</figure>";

	echo "<figure style='float: left'>
			<img style='width: 200px;'
			src='{$pbFilePath}'
			alt='{$pbName}'/>

			<figcaption> {$pbName} </figcaption>
		</figure>";



		/*
		getFiles();


	//list directories
	function getDirectories(){
		echo "Playbys {$sex}:<br />";

		foreach (glob("*") as $dirname ) {
		if( is_dir( $dirname ) )
		echo "<a target=\"_blank\" href=\"$dirname \">$dirname</a><br />";}
		}

	//list files
	function getFiles(){
		echo "Playbys available:<br />";

		foreach (glob("*.php") as $filename) {
		//prints file name & file size!
		//echo "$filename size " . filesize($filename) . "\n";

		echo "<div><img src='$imgPath' alt='$pbNamae' /><p>$pbName</p></div>";
		}


		*/

?>



