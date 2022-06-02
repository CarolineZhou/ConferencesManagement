


<?php
require "Header.php";


?>

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
		<div id="input-container" class="text-white">
			<h1 class="display-4 font-weight-bold mb-3">New Journal</h1>
			<p> General Information, articles and authors will be added in the next steps.</p>
			<form action="NewJournal.php" method="post">
				<label for="model">DOI </label>
				<input type="text" class="form-control" name="journal_DOI" placeholder="DOI is required" required>
				
				<label for="model">Title </label>
				<input type="text" class="form-control" name="journal_title" placeholder="Title is required" required>
				
				<label for="model">Publish Date </label>
				<input type="text" class="form-control" name="journal_publish">
				
				<label for="model">Category</label>
				<p>
				<select name="journal_category">
					<option value="">Select...</option>
					<option value="Conference Paper">Conference Paper </option>
					<option value="Review article">Review article </option>
					<option value="Journal article">Journal article </option>
					<option value="Magazine article">Magazine article </option>
					<option value="Book">Book </option>
					<option value="Meta-analysis">Meta-analysis </option>
					<option value="Systematic analysis">Systematic analysis </option>
					<option value="Other">Other </option>
				</select>
				</p>
				
				<label for="model">Contact Email </label>
				<input type="text" class="form-control" name="journal_email" placeholder="Email is required" required>
				
				<label for="model">Country </label>
				<input type="text" class="form-control" name="journal_country">
				
				<label for="model">Affiliation </label>
				<input type="text" class="form-control" name="journal_affiliation" placeholder="Affiliation is required" required>
				
				<label for="model">References </label>
				<input type="text" class="form-control" name="journal_references" placeholder="References are required" required>
				
				<br>
				<input type="submit">
			</form>
		</div>		      
	</div>
	</div>
</main>

<?php
require "Footer.php";
?>