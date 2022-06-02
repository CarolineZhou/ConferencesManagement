<?php
require "Header.php";

?>

<html>
<main>
	<div class="container py-5 col-xl-10 bg-dark">
	<div class="text-white">
	
	<?php
	
		//check if user is logged in
		if (!(isset($_SESSION["account_uid"]) && 
		isset($_SESSION["account_fname"]) && 
		isset($_SESSION["account_lname"]) &&
		isset($_SESSION["account_id"]) &&
		isset($_GET["confid"])))	
		{
			echo "NOT LOGGED IN!!!";
			header("Location: http://localhost/cpsc571-hw-conference/Login.php");
		}			
	
		
		$con = mysqli_connect("localhost","root","","571Homework");
		//Check connection
		if (mysqli_connect_errno($con)) 
		{
			echo "Failed to connect to MYSQL: " . mysqli_connect_error();
		}
		
		$account_id = $_SESSION["account_id"];
		$conf_id = $_GET["confid"];
		
		$sql = "SELECT * FROM conference_attendees WHERE conference_id = $conf_id AND attendee_id = $account_id";
		$result = mysqli_query($con, $sql);
		$num_rows = mysqli_num_rows($result);
		
		if ($num_rows > 0)
		{
			echo "You are already registered for this conference!";
		}
		else 
		{
			$sql = "INSERT INTO conference_attendees (conference_id, attendee_id) VALUES ('$conf_id', '$account_id')";
			$result = mysqli_query($con, $sql);
			echo "Registration Successful!";
		}

		mysqli_close($con);
	?>
	</div>
	</div>

</main>
</html>




<?php
require "Footer.php";
?>