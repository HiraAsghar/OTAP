
<?php

$conn = mysqli_connect("localhost","root","","control");

if(isset($_POST["button"]))
{
	$email = $_POST["user"];
	$pwd = $_POST["pwd"];

	if($email != "" && $pwd != "")
	{
		$query = mysqli_query($conn,"select * from `admin` where `email`='$email' and `password`='$pwd'");
		if($admin_array = mysqli_fetch_array($query))
		{
			
			session_start();
			$_SESSION["admin_email"] = $admin_array["email"];
			$_SESSION["admin_id"] = $admin_array["admin_id"];

			if($_SESSION["admin_email"] != "" && $_SESSION["admin_id"] != "")
			{
				$msg = "welcome to Dashboard";
				header("Location: dashboard.php?success=$msg");
			}
		}
		else
		{
			$msg = "Invalid Information";
			header("Location: index.php?error=$msg");
		}
	}
	else{
		$msg = "Please fill all the Fields";
		header("Location: index.php?error=$msg");
	}
}
?>

<html>
<head>
<title>Admin login form</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="styleA.css">
</body>
<div class="loginbox">
<h1> Admin login </h1>
<form action="index.php" method="post">
<p>Username</p>
<input type="email" required="required" name="user" placeholder="Enter Username" />
<p>Password</p>
<input type="password" name="pwd" placeholder="Enter Password" />
<input type="submit" name="button" value="Login" />
</form>
</div>
</head>
</html>