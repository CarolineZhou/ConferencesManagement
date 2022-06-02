<?php
require "Header.php";
?>

<html>
<main>
<style>
  label {
	display: inline-block;
	width: 150px;
	text-align: right;
  }
.page-holder {
	min-height: 100vh;
}
.bg-cover{
	background-attachment: fixed !important;
	background-size: cover !important;
}
</style>
<div style="background: url(https://images.unsplash.com/photo-1501290741922-b56c0d0884af?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1190&q=80)" class="page-holder bg-cover" >
	<div class="container py-5 col-xl-10 bg-dark">
	<div class="text-white">
	<?php 
	
	$journal_DOI = empty($_POST['journal_DOI']) ? $_GET['journal_DOI'] : $_POST['journal_DOI'];
	
	
	// Create Connection
	$con = mysqli_connect("localhost","root","","571Homework");
	//Check connection
	if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
		}
		
	$sql = "SELECT * FROM journal WHERE journal_DOI = '".$journal_DOI."'";
	$result = mysqli_query($con, $sql);
	if ($row = mysqli_fetch_array($result)){
		$date = strtotime($row['journal_publish']);
		$dateBottom = strtotime("1800-01-01");
		if ($date > $dateBottom) {
		$dateF = date("Y-m-d", $date);
		}
		else{
		$dateF = "Journal Publish Date Unknown";
		}
		
		echo "<h1 class='display-4 font-weight-bold mb-3'>" . $row['journal_title'] . "</h1>"; 
		
		//echo "<p> ". $row['journal_status'] . "</p>";
		if (isset($_SESSION["account_type"])) {
			if($_SESSION["account_type"] === "Admin") {
			if($row['journal_status'] == 0) {
				echo "<b>This journal has not been approved or denied</b>";
			}
			else if($row['journal_status'] == 1){
				echo "This journal is currently <b>approved</b>";				
			}
			else if($row['journal_status'] == 2){
				echo "This journal is currently <b>denied</b>";				
			}
			echo "<form action='JournalStatus.php?journal_DOI=$journal_DOI' method='post'>";
			echo "<input type='submit' id='approve' value='Approve' name='journal_change' class='approve'>";
			echo "<input type='submit' id='reject' value='Deny' name='journal_change' class='reject'>";
			echo "</form>";
			}
			else {
				//echo "<label>NOT ADMIN   </label> " . $_SESSION["account_type"] . ": ". $_SESSION["account_uid"];
			}
		}
		echo "<br><br>";
		
		echo "<div class='row'><div class='col'>";
		echo "<label><b>DOI: </b></Label> " . $row['journal_DOI'];
		echo "<br><label><b>Publish Date: </b></Label> ". $dateF;
		echo "<br><label><b>Category: </b></Label> ".$row['journal_category'];
		echo "<br><label><b>Contact Email: </b></Label> ".$row['journal_email'];
		echo "<br><label><b>Country of Publication: </b></Label> ".$row['journal_country'];
		echo "<br><label><b>Affiliation: </b></Label> ".$row['journal_affiliation'];
		echo "<br><label><b>References: </b></Label> ".$row['journal_references'];
	}
	else {
		echo "<br>error fetching record";
	}
	
	echo "</div>";
	
	$sql = "SELECT * FROM journal_documents WHERE journal_DOI = '".$journal_DOI."'";
	$result = mysqli_query($con, $sql);
	
	echo "<div class='col'>";
	echo "<b>Associated Documents</b>";
	echo "<table class='table table-striped'>
	<thead class='text-light table-bordered'>
	<tr>
	<th>Documents</th>
	</tr>
	</thead>
	<tbody class= 'text-light'>";

	while ($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $row['journal_document'] . "</td>";
		echo "</tr>";
		}
	echo "</tbody></table>";
	
	$sql2 = "SELECT * FROM journal_authors WHERE journal_id = '".$journal_DOI."'";
	$result2 = mysqli_query($con, $sql2);
	$row2 = mysqli_fetch_array($result2);
	if(($_SESSION["account_type"] === "Admin") || ($row2['authors_id'] == $_SESSION["account_id"])){
	echo "<div id='input-container'>
		<form action='NewDocument.php' method='post'>
			<p hidden><input type='text' name='journal_DOI' value=". $journal_DOI ."></p>
			<input type='submit' value='Link New Document'>
		</form>
	</div>";
	}
	echo "</div></div><br><br><br>";
	
	$rsql = "SELECT * FROM journal_reviews WHERE journal_DOI = '".$journal_DOI."'";
	$rresult = mysqli_query($con, $rsql);
	
	
	echo "<br><br><div class='col'>";
	echo "<b>Reviews</b>";
	
	if($_SESSION["account_type"] === "Admin"){
	echo "<div id='input-container'>
		<form action='NewReview.php' method='post'>
		
			<input type='text' class='form-control' name='journal_Wreview' placeholder='Write your review here' required>";
			
			$asql = "SELECT * from account WHERE account_uid = '". $_SESSION['account_uid']."'";
			$auth_result = mysqli_query($con, $asql);
			$auth_row = mysqli_fetch_array($auth_result);
			
			echo "<p hidden><input type='text' name='journal_Sreview' value=". $auth_row['account_id'] ."></p>
			<p hidden><input type='text' name='journal_DOI' value=". $journal_DOI ."></p>
			<input type='submit' value='Submit Review'>
		</form>
	</div><br>";
	}
	
	echo "<table class='table table-striped'>
	<thead class='text-light table-bordered'>
	<tr>
	<th>Reviewer</th>
	<th>Comments</th>
	</tr>
	</thead>
	<tbody class= 'text-light'>";

	while ($row = mysqli_fetch_array($rresult)) {
		echo "<tr>";
		$rsql2 = "SELECT * FROM account WHERE account_id = '" . $row['journal_Sreview']."'";
		$rresult2 = mysqli_query($con, $rsql2);
		while ($row2 = mysqli_fetch_array($rresult2)) {
			echo "<td>" . $row2['account_uid'] . "</td>";
		}
		echo "<td>" . $row['journal_Wreview'] . "</td>";
		echo "</tr>";
		}
	echo "</tbody></table>";
	
	mysqli_close($con);
	?>
	
	</div>
	</div>
	</div>
</main>
</html>
