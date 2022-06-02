<html>
<body>


<?php

$account_id = $_POST["account_id"];
$account_fname = $_POST["account_fname"];
$account_lname = $_POST["account_lname"];

// Create Connection
$con = mysqli_connect("localhost","root","","571Homework");
//Check connection
if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}
	
$sql = "update account set account_fname='".$account_fname."', account_lname='".$account_lname."' WHERE account_id = '".$account_id."'";
	
$result = mysqli_query($con, $sql);	
	
echo "Record Successfully Updated";
	
mysqli_close($con);
?>

</body>
</html>