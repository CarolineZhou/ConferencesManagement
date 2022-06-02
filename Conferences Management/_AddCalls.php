
<html lang="en">
  <head>
    <title> 571Homework </title>
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device.width, initial-scale=1">
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link rel="stylesheet" href="Resources/Css/style.css" type="text/css"/>
	</head>
	<body>
		<div id="page" class="page_container">
			<div id="banner" class="hero-image">
				<div id="header" class="header">
					<h2> 571 Homework </h2>
				</div>
			</div>
			<div id="navbar">
				<a href="Index.php">Home</a>
			</div>
			<div id="input-container">
				<p> Add User </p>
				<form action="AddAccount.php" method="post">
					First Name: <input type="text" name="account_fname"><br>
					Last Name: <input type="text" name="account_lname"><br>
					Password: <input type="password" name="account_pw"><br>
					account_type: <input type="text" name="account_type" value="User" readonly><br>
					<input type="submit">
				</form>
			</div>
		</div>
	</body>
</html>
