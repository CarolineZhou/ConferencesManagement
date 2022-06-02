<?php
require "Header.php";
?>

<main>
	<div class="container py-5 col-xl-10 bg-dark">
		<header class="text-left text-white py-5">
		<div class="row justify-content-md-center">
			<div class="col">
				<h1 class="display-4 font-weight-bold mb-3">Conference: Home</h1>
				</div>
			<div class="col col-lg-2">
			<?php
				if(isset($_SESSION["account_uid"]) && isset($_SESSION["account_fname"]) && isset($_SESSION["account_lname"])) : ?>
					<span>
					<a href="AddConference.php">
						<button class="btn btn-light">Host Conference</button>
					</a>
					</html>
					</span>
				
			<?php endif; ?>
				</div>
				</div>
		</header>
	
	<table class="table table-striped" >
          <thead class="text-light table-bordered">
          <tr>
		
			<th scope="col">Conference ID</th>
			<th scope="col">Conference Name</th>
			<th scope="col">Host ID</th>
			<th scope="col">Current Status</th>
			<th scope="col">Date Created</th>
            <th scope="col">Date Scheduled </th>
            <th scope="col">Approved By</th>
            <th scope="col">Journal DOI</th>

			
          </tr>
          </thead>
          <tbody class= "text-light">
          <?php
		  
		  
			//Fetch corporations

			// Create Connection
			$con = mysqli_connect("localhost","root","","571Homework");
			//Check connection
			if (mysqli_connect_errno($con)) {
				echo "Failed to connect to MYSQL: " . mysqli_connect_error();
				}

			$result = mysqli_query($con, "SELECT * FROM conference");

			while ($row = mysqli_fetch_array($result)) {
				
				
				//make conferences scheduled that are in the past not appear
				if (strtotime($row['conf_date_scheduled']) < date("y-m-d")){
					continue;
				}
				else {
				}
				
				//status parse
				if ($row['conf_status'] == 1)
				{
					$status = 'approved';
					
				}
				else if ($row['conf_status'] == 0)
				{
					//No need to display anything if it isn't approved
					//$status = 'pending';
					continue;
				}
				else
				{
					//No need to display anything if it isn't approved
					//$status = 'denied';
					continue;
				}

				echo "<tr>";
				echo "<td><span>" . $row['conf_id'] . "</span></td>";
				echo "<td><a href='ConferenceDetails.php?confid=" . $row['conf_id'] . "'>" . $row['conf_name'] . "</a></td>";
				echo "<td><span>" . $row['conf_host_id'] . "</span></td>";
				echo "<td><span>" . $status . "</span></td>";
				echo "<td><span>" . $row['conf_date_created'] . "</span></td>";
				echo "<td><span>" . $row['conf_date_scheduled'] . "</span></td>";
				echo "<td><span>" . $row['conf_approved_id'] . "</span></td>";
				echo "<td><span>" . $row['conf_journal_DOI'] . "</span></td>";
				echo "</tr>";
				}
			echo "</table>";
		  
		  
		  
		  ?>
          </tbody>
        </table>
    </div>
  </div>

  <ng-template #thenBlock1><div *ngIf="sortDir == 'asc'; then thenBlock2 else elseBlock2"></div></ng-template>
  <ng-template #elseBlock1><fa-icon [icon]="faSort"></fa-icon></ng-template>
  <ng-template #thenBlock2><fa-icon [icon]="faSortUp"></fa-icon></ng-template>
  <ng-template #elseBlock2><fa-icon [icon]="faSortDown"></fa-icon></ng-template>
        
	</div>
</main>

<?php
require "Footer.php";
?>
