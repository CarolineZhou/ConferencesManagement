<html>
<body>

<?php
//Add to corporate table

$account_pw = $_POST["account_pw"];
$account_fname = $_POST["account_fname"];
$account_lname = $_POST["account_lname"];
$account_type = $_POST["account_type"];
$account_date_created = date("Y/m/d");


//Create Connection
$con = mysqli_connect("localhost","root","","571Homework");
//Check connection
if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}

$sql = "INSERT INTO account (account_pw,account_fname,account_lname, account_type, account_date_created) VALUES ('". $account_pw."', '". $account_fname."', '". $account_lname."', '". $account_type."', '". $account_date_created."')";

if (!mysqli_query($con,$sql)) {
	die('Error: ' . mysqli_error($con));
	}
else 
	echo "Record successfully added";
mysqli_close($con);
?>


</body>
</html>







