<?php
require "Header.php";

?>

<html>
<main>
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
	<div class="container py-5 col-xl-10 bg-dark">
	<div class="text-white">
	<h1 class="display-4 font-weight-bold mb-3">New Journal</h1>
<?php
$journal_DOI = $_POST["journal_DOI"];
$journal_title = $_POST["journal_title"];
$journal_publish = $_POST["journal_publish"];
$journal_category = $_POST["journal_category"];
$journal_email = $_POST["journal_email"];
$journal_country = $_POST["journal_country"];
$journal_affiliation = $_POST["journal_affiliation"];
$journal_references = $_POST["journal_references"];

//Create Connection
$con = mysqli_connect("localhost","root","","571Homework");
//Check connection
if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}

$sql = "INSERT INTO journal (journal_DOI,journal_title,journal_publish,journal_category,journal_email,journal_country,journal_affiliation,journal_references) VALUES 
('". $journal_DOI."', '". $journal_title."', '". $journal_publish."', '". $journal_category."', '". $journal_email."', '". $journal_country."', '". $journal_affiliation."', '". $journal_references."')";

if (!mysqli_query($con,$sql)) {
	die('Error: ' . mysqli_error($con));
	}
else 
	echo "Record successfully added";

$asql1 = "SELECT * from account WHERE account_uid = '". $_SESSION['account_uid']."'";
$auth_result = mysqli_query($con, $asql1);
$auth_row = mysqli_fetch_array($auth_result);
$asql = "INSERT INTO journal_authors (journal_id,authors_id) VALUES ('". $journal_DOI."', '". $auth_row['account_id']."')";
if (!mysqli_query($con,$asql)) {
	die('Error: ' . mysqli_error($con));
	}
else 
	echo "Author Successfully Linked";
mysqli_close($con);
?>
	</div>
	<div id="input-container">
		<form action="DisplayJournal.php" method="post">
			<p hidden><input type="text" name="journal_DOI" value=<?=$journal_DOI?>></p><br>
			<input type="submit" value="View">
		</form>
	</div>
	</div>
	</div>
</main>
</html>

<?php
require "Footer.php";
?>
