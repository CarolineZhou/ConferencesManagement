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
		<header class="text-left text-white py-5">
		<div class="row justify-content-md-center">
			<div class="col">
				<h1 class="display-4 font-weight-bold mb-3">Journals: Home</h1>
				</div>
			<div class="col col-lg-2">
			
			<a href="AddJournal.php">
				<button class="btn btn-light">Propose New Journal</button>
				</a>
				</div>
			</div>
		</header>
	
	<table class="table table-striped" >
          <thead class="text-light table-bordered">
          <tr>
            <th scope="col">DOI</th>
            <th scope="col">Title </th>
            <th scope="col">Authors</th>
            <th scope="col">Publish Date</th>
            <th scope="col">Category</th>
            <th scope="col">Email</th>
			<th scope="col">Utility</th>
          </tr>
          </thead>
          <tbody class= "text-light">
          <?php
		  
		  
			//Fetch journals

			// Create Connection
			$con = mysqli_connect("localhost","root","","571Homework");
			//Check connection
			if (mysqli_connect_errno($con)) {
				echo "Failed to connect to MYSQL: " . mysqli_connect_error();
				}
			//Before submission, replace line 65 with the lines in this comment
			// 
			// 	$result = mysqli_query($con, "SELECT * FROM journal WHERE journal_status = 1");
			//
			$result = mysqli_query($con, "SELECT * FROM journal");

			while ($row = mysqli_fetch_array($result)) {
				$date = strtotime($row['journal_publish']);
				$dateBottom = strtotime("1800-01-01");
				if ($date > $dateBottom) {
				$dateF = date("Y-m-d", $date);
				}
				else{
				$dateF = "Journal Publish Date Unknown";
				}
				
				echo "<tr>";
				echo "<td><span>" . $row['journal_DOI'] . "</span></td>";
				echo "<td><span>" . $row['journal_title'] . "</span></td>";
				echo "<td><span>";
				$auth_sql = "SELECT * FROM journal_authors WHERE journal_id = '" . $row['journal_DOI']."'";
				$auth_result = mysqli_query($con, $auth_sql);
				if (!$auth_result) {
				printf("Error: %s\n", mysqli_error($con));
				exit();
				}
				while ($auth_row = mysqli_fetch_array($auth_result)) {
					$auth_sql2 = "SELECT * FROM account WHERE account_id = '" . $auth_row['authors_id']."'";
					$auth_result2 = mysqli_query($con, $auth_sql2);
					while ($auth_row2 = mysqli_fetch_array($auth_result2)) {
						echo $auth_row2['account_uid'];
					echo "; ";
					}
				}
				echo "</span></td>";
				echo "<td><span> " . $dateF . "</span></td>";
				echo "<td><span>" . $row['journal_category'] . "</span></td>";
				echo "<td><span>" . $row['journal_email'] . "</span></td>";
				echo "<td><span> <form action='DisplayJournal.php' method='post'>
						<p hidden><input type='text' name='journal_DOI' value=". $row['journal_DOI'] . "></p>
						<input type='submit' value='View'>
					</form></span></td>";
				echo "</tr>";
				}
			echo "</table>";
		  
		  
		  
		  ?>
          </tbody>
        </table>
    </div>
	</div>
</main>
</html>
<?php
require "Footer.php";
?>
