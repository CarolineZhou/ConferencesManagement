<?php
require "Header.php";
?>

<?php
$journal_DOI = empty($_POST['journal_DOI']) ? $_GET['journal_DOI'] : $_POST['journal_DOI'];
?>
<html>
   <body>
<style>
.page-holder {
	min-height: 100vh;
}
.bg-cover{
	background-attachment: fixed !important;
	background-size: cover !important;
}
</style>
<div style="background: url(https://images.unsplash.com/photo-1501290741922-b56c0d0884af?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1190&q=80)" class="page-holder bg-cover" >
      <div class="container py-5 col-xl-10 bg-dark text-white">
<?php

// Create Connection
	$con = mysqli_connect("localhost","root","","571Homework");
	//Check connection
	if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}
	
	//echo "<p> ". $_POST["journal_change"] . "</p>";
	//echo "<p> ". $_POST["journal_DOI"] . "</p>";
	if ($_SESSION["account_type"] === "Admin") {
		if ($_POST["journal_change"] === "Approve") {
			$sql = "UPDATE journal SET journal_status = 1 WHERE journal_DOI = '". $journal_DOI . "'";
			$result = mysqli_query($con, $sql);
			if($result) {
			echo "Journal Approved!";
			}
			else {
				echo "Error approving journal";
			}
		}
		else{
			$sql = "UPDATE journal SET journal_status = 2 WHERE journal_DOI = '". $journal_DOI . "'";
			$result = mysqli_query($con, $sql);
			if($result) {
			echo "Journal Denied!";
			}
			else {
				echo "Error approving journal";
			}
		}
	}
		mysqli_close($con);
		?>
		
		<div id="input-container">
		<form action="DisplayJournal.php" method="post">
			<p hidden><input type="text" name="journal_DOI" value=<?=$journal_DOI?>></p><br>
			<input type="submit" value="Back">
		</form>
	</div>
		
	</div>
	</div>
</main>
</html>
