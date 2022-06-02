<html>
<body>


<?php
//Fetch corporations

// Create Connection
$con = mysqli_connect("localhost","root","","571Homework");
//Check connection
if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}

$result = mysqli_query($con, "SELECT * FROM account");

echo "<table border = '1'>
<tr>
<th>account_id</th>
<th>account_fname</th>
<th>account_lname</th>
<th>account_type</th>
<th>account_date_created</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>" . $row['account_id'] . "</td>";
	echo "<td>" . $row['account_fname'] . "</td>";
	echo "<td>" . $row['account_lname'] . "</td>";
	echo "<td>" . $row['account_type'] . "</td>";
	echo "<td>" . $row['account_date_created'] . "</td>";
	echo "</tr>";
	}
echo "</table>";

mysqli_close($con);
?>

</body>
</html>







