<?php
require "Header.php";

?>

<html>
<main>
	<div class="container py-5 col-xl-10 bg-dark">
	<div class="text-white">

	<?php 

	if (!isset($_GET["confid"]))
	{
		header("Location: http://localhost/cpsc571-hw-conference/Login.php");
	}
	$conf_id = $_GET["confid"];
	
	// Create Connection
	$con = mysqli_connect("localhost","root","","571Homework");
	//Check connection
	if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}
	
	$sql = "SELECT * FROM conference WHERE conf_id = '".$conf_id."'";
	$result = mysqli_query($con, $sql);

	if ($row = mysqli_fetch_array($result))
	{
		if (strtotime($row['conf_date_scheduled']) < date("y-m-d"))
		{
			$conf_status = "past";
		}
		else
		{
			if ($row['conf_status'] == 0)
			{
				$conf_status = "pending";
			}
			else if ($row['conf_status'] == 1)
			{
				$conf_status = "approved";
			}
			else 
			{
				$conf_status = "denied";
			}
		}
		
		
		echo "<h1 class='display-4 font-weight-bold mb-3'>" . $row['conf_name'] . "</h1>"; 
		echo "<div class='row'><div class='col'>";
		echo "<br><label><b>Host ID: </b></Label> ". $row['conf_host_id'];
		echo "<br><label><b>Conference Status: </b></Label> ". $conf_status;
		echo "<br><label><b>Date Created: </b></Label> ". $row['conf_date_created'];
		echo "<br><label><b>Date Scheduled: </b></Label> <b>". $row['conf_date_created'] . "</b>";
		
		if ($row['conf_status'] == "approved")
		{
			echo "<br><label><b>Approved By (ID): </b></Label> ". $row['conf_approved_id'];
		}
		
		echo "<br><label><b>Journal DOI: </b></Label> ".$row['conf_journal_DOI'];
		echo "<br><label><b>Details: </b></Label>";
		echo "<br>";
		echo "<p>" . $row['conf_details'] . "</p>";
	}
	else {
		echo "<br>error fetching record. Fetch id: " . $conf_id;
	}

	//Attendees
	echo "<br><label><b>Attendees: </b></Label><br>";
	//$sql1 = "SELECT attendee_id FROM conference_attendees WHERE conference_id = $confi_id";

	$att_sql = "SELECT account_uid FROM account, conference_attendees WHERE account_id = attendee_id AND conference_id = $conf_id";
	$att_result = mysqli_query($con, $att_sql);
	while ($att_row = mysqli_fetch_array($att_result)) 
	{
		echo $att_row["account_uid"] . "<br>";
	}
	?>
	
	<br>
	<div class="col col-lg-2">
			<?php
				if(isset($_SESSION["account_uid"]) && 
				isset($_SESSION["account_fname"]) && 
				isset($_SESSION["account_lname"]) &&
				isset($_SESSION["account_id"]))	: ?>
					
				<?php if ($_SESSION["account_id"] != $row['conf_host_id']) : ?>
						
					<span>
					<a href="ConferenceRegistration.php?confid=<?php echo $conf_id?>">
						<button class="btn btn-light">Register Now!</button>
					</a>
					</html>
					</span>
				
				<?php endif; ?>
			<?php endif; ?>
	</div>
	
	<?php
	if (isset($_SESSION["account_type"])) 
	{
		if($_SESSION["account_type"] === "Admin") 
		{
		echo "<br><br>";
		echo "<form action='ConferenceAction.php?confid=$conf_id' method='post'>";
		echo "<input type='submit' id='approve' value='Approve' name='action' class='approve'>";
		echo "<input type='submit' id='reject' value='Deny' name='action' class='reject'>";
		}
		else
		{
			//echo "<label>NOT ADMIN   </label>" . $_SESSION["account_type"] . ": ". $_SESSION["account_uid"];
		}
	}
	mysqli_close($con);
	?>
	
	
	</form>
	
	
	
	</div>
	</div>

</main>
</html>




<?php
require "Footer.php";
?>