<html>
<body>



<?php
//Search account
$account_id = $_POST["account_id"];
$account_fname = $_POST["account_fname"];
$account_lname = $_POST["account_lname"];
$account_type = $_POST["account_type"];
$account_date_created = $_POST["account_date_created"];

// Create Connection
$con = mysqli_connect("localhost","root","","571Homework");
//Check connection
if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MYSQL: " . mysqli_connect_error();
	}

$result = mysqli_query($con, "SELECT * FROM account WHERE account_id = '".$account_id."' OR account_fname = '".$account_fname."' OR account_lname = '".$account_lname."' OR account_date_created = '".$account_date_created."'");

echo "<table border = '1'>
<tr>
<th>account_id</th>
<th>account_fname</th>
<th>account_lname</th>
<th>account_date_created</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>" . $row['account_id'] . "</td>";
	echo "<td>" . $row['account_fname'] . "</td>";
	echo "<td>" . $row['account_lname'] . "</td>";
	echo "<td>" . $row['account_date_created'] . "</td>";
	echo "</tr>";
	}
echo "</table>";

mysqli_close($con);



?>

<form action="UpdateCorp.php" method="post">
	Edit will only work on the item that matches the searched Corp_ID <br>
	Please fill out all information when editing.<br>
	account_id: <input type="text" name="account_id" value="<?=$account_id?>" readonly>
	account_fname: <input type="text" name="account_fname"><br>
	account_lname: <input type="text" name="account_lname"><br>
	account_date_created: <input type="text" name="account_date_created" value="<?=$account_date_created?>" readonly>
	<input type="submit">
</form>



</body>
</html>







