<?php
require "Header.php";
?>

<?php
$journal_DOI = $_POST["journal_DOI"];

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {

	if (isset($_FILES['journal_document']) && $_FILES['journal_document']['error'] === UPLOAD_ERR_OK) {

		// get details of the uploaded file
		$fileTmpPath = $_FILES['journal_document']['tmp_name'];
		$fileName = $_FILES['journal_document']['name'];
		$fileSize = $_FILES['journal_document']['size'];
		$fileType = $_FILES['journal_document']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		
		$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
		
		$allowedfileExtensions = array('docx', 'pdf', 'doc');
		if (in_array($fileExtension, $allowedfileExtensions)) {
		
			// directory in which the uploaded file will be moved
			$uploadFileDir = './uploaded_files/';
			$dest_path = $uploadFileDir . $fileName;
			 
			move_uploaded_file($fileTmpPath, $dest_path);
			
			//Create Connection
			$con = mysqli_connect("localhost","root","","571Homework");
			//Check connection
			if (mysqli_connect_errno($con)) {
				echo "Failed to connect to MYSQL: " . mysqli_connect_error();
				}

			$sql = "INSERT INTO journal_documents (journal_DOI,journal_document) VALUES 
			('". $journal_DOI."', '". $dest_path."')";

			if (!mysqli_query($con,$sql)) {
				die('Error: ' . mysqli_error($con));
				}
			else {}
			mysqli_close($con);
		}		
	}		
}

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
		<div class="container py-5 col-xl-10 bg-dark">
			<div id="input-container" class="text-white">
			
				<div id="input-container">
					<form action="DisplayJournal.php" method="post">
						<p hidden><input type="text" name="journal_DOI" value=<?=$_POST["journal_DOI"]?>></p>
						<input type="submit" value="Back to Journal Page">
					</form>
				</div>
			</div>
		</div>
		</div>
	</body>
</html>