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
	isset($_SESSION["account_id"]) &&
	isset($_GET["confid"])))	
	{
		
		header("Location: http://localhost/cpsc571-hw-conference/Login.php");
	}		
	
	//Admin Check
	if (!($_SESSION["account_type"] === "Admin")) 
	{
		header("Location: http://localhost/cpsc571-hw-conference/Login.php");
	}
	$conf_id = $_GET["confid"];
	$account_id = $_SESSION["account_id"];
	//echo $_POST["action"];
	
	// Create Connection
	$con = mysqli_connect("localhost","root","","571Homework");
	//Check connection
	if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}
	
	if ($_POST["action"] === "Approve") 
	{
		$sql = "UPDATE `conference` SET `conf_status` = 1, `conf_approved_id` = $account_id WHERE `conference`.`conf_id` = $conf_id";
		$result = mysqli_query($con, $sql);
		echo "Conference Approved!";
	}
	else
	{
		$sql = "UPDATE `conference` SET `conf_status` = 2, `conf_approved_id` = $account_id WHERE `conference`.`conf_id` = $conf_id";
		$result = mysqli_query($con, $sql);
		echo "Conference Denied!";
	}
	
	?>
	</div>
	</div>

</main>
</html>




<?php
require "Footer.php";
?>