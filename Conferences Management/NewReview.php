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
	<h1 class="display-4 font-weight-bold mb-3">New Review</h1>
<?php
$journal_DOI = $_POST["journal_DOI"];
$journal_Sreview = $_POST["journal_Sreview"];
$journal_Wreview = $_POST["journal_Wreview"];


//Create Connection
$con = mysqli_connect("localhost","root","","571Homework");
//Check connection
if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}

$sql = "INSERT INTO journal_reviews (journal_DOI,journal_Sreview,journal_Wreview) VALUES 
('". $journal_DOI."', '". $journal_Sreview."', '". $journal_Wreview."')";

if (!mysqli_query($con,$sql)) {
	die('Error: ' . mysqli_error($con));
	}
else 
	echo "Review successfully added";

mysqli_close($con);
?>
	</div>
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

<?php
require "Footer.php";
?>