<?php
require "Header.php";

?>

<html>
<main>
	<div class="container py-5 col-xl-10 bg-dark">
	<div class="text-white">
	<h1 class="display-4 font-weight-bold mb-3">New Conference</h1>
	<?php

	//check if user is logged in
	if (!(isset($_SESSION["account_uid"]) && 
	isset($_SESSION["account_fname"]) && 
	isset($_SESSION["account_lname"]) &&
	isset($_SESSION["account_id"])))	
	{
		echo "NOT LOGGED IN!!!";
		header("Location: http://localhost/cpsc571-hw-conference/Login.php");
	}		

	$conf_name = $_POST["conf_name"];
	$conf_host_id = $_SESSION["account_id"];
	$conf_status = 0;
	$conf_date_created = date("Y/m/d");
	$conf_date_scheduled = $_POST["conf_date_scheduled"];
	$conf_journal_DOI = $_POST["journal_DOI"];
	$conf_details = $_POST["conf_details"];



	//Create Connection
	$con = mysqli_connect("localhost","root","","571Homework");
	//Check connection
	if (mysqli_connect_errno($con)) {
		echo "Failed to connect to MYSQL: " . mysqli_connect_error();
		}

	//real escape strings
	$conf_name = mysqli_real_escape_string($con, $conf_name);
	$conf_details = mysqli_real_escape_string($con, $conf_details);
	
	$sql = "INSERT INTO conference (conf_name,conf_host_id,conf_status,conf_date_created,conf_date_scheduled,conf_journal_DOI, conf_details) VALUES 
	('". $conf_name."', '". $conf_host_id."', '". $conf_status."', '". $conf_date_created."', '". $conf_date_scheduled."', '". $conf_journal_DOI."', '". $conf_details."')";


	if (!mysqli_query($con,$sql)) {
		die('Error: ' . mysqli_error($con));
		}
	else {
		$last_id = mysqli_insert_id($con);
		echo "Record successfully added: " . $last_id;
	}
	
	$account_id = $_SESSION["account_id"];
	//Add host to attendee list
	$sql = "INSERT INTO conference_attendees (conference_id, attendee_id) VALUES ('$last_id', '$account_id')";
	$result = mysqli_query($con, $sql);

	mysqli_close($con);

	echo "<div id='input-container'>";
	echo "<form action='ConferenceDetails.php?confid=$last_id' method='post'>";
	?>
	
	<input type="submit" value="View">
	</form>
	</div>
	</div>
</main>
</html>

<?php
require "Footer.php";
?>
