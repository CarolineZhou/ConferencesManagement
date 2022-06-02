<?php
require "Header.php";
?>

<?php
$journal_DOI = $_POST["journal_DOI"];


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
		  <form method="POST" action="upload.php" enctype="multipart/form-data">
			<div>
			  <span>Upload a File:</span>
			  <input type="file" name="journal_document" />
			</div>

				
			<p hidden><input type='text' name='journal_DOI' value=<?=$journal_DOI?>></p>
		 
			<input type="submit" name="uploadBtn" value="Upload" />
		  </form>
		 </div>
		</div>
		</div>
      
   </body>
</html>