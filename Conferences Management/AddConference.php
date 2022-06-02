<?php
require "Header.php";


?>

<main>
	<div class="container py-5 col-xl-10 bg-dark">
	<!--check if user is logged in first, otherwise navigate to user -->
	<?php
		//check if user is logged in
		if (!(isset($_SESSION["account_uid"]) && 
		isset($_SESSION["account_fname"]) && 
		isset($_SESSION["account_lname"]) &&
		isset($_SESSION["account_id"])))	
		{
			echo "NOT LOGGED IN!!!";
			header("Location: http://localhost/cpsc571-hw-conference/Login.php");
		}		
	?>
		<div id="input-container" class="text-white">
			<h1 class="display-4 font-weight-bold mb-3">New Conference</h1>
			<p> Host a conference</p>
			<form action="NewConference.php" method="post">
				
				<label for="model">Conference Name </label>
				<input type="text" class="form-control" name="conf_name" placeholder="Conference name is required" required>
				
				<br>				
				
				<label for="model">Date Scheduled </label>
				<input type="date" id="start" name="conf_date_scheduled"
					value="2020-12-31"
					min= "2020-01-01" max="2050-12-31">
				<br>
				<br>

		
				<label for="model">Journal</label>
				<select name="journal_DOI" id="journal_DOI" required>
					<option value="">-- Select Journal --</option>
					<?php
					
					//Create Connection
					$con = mysqli_connect("localhost","root","","571Homework");
					//Check connection
					if (mysqli_connect_errno($con)) {
						echo "Failed to connect to MYSQL: " . mysqli_connect_error();
					}
					
					//TODO: need to turn this into a list of journals that are created by this user only.
					$query = mysqli_query($con, "SELECT journal_DOI FROM journal"); // Run your query
					// Loop through the query results, outputing the options one by one
					while ($row = mysqli_fetch_array($query)) {
					   echo '<option value="'.$row['journal_DOI'].'">'.$row['journal_DOI'].'</option>';
					}
					?>
				</select>		
				
				<br>
				<br>
				
				<textarea id="conf_details" name="conf_details" rows="4"  cols="50" placeholder="Conference Details" required></textarea>

				<br>

				<input type="submit">
			</form>
		</div>		      
	</div>
</main>

<?php
require "Footer.php";
?>