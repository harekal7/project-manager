<html>

<head>
</head>

<body>

<?php
session_start();
$_SESSION['is_logged_in'] = 0;
$username = $_POST['name'];
$password = md5($_POST['pass']);

$con=mysqli_connect("localhost","root","","projects");

if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM users WHERE usn='$username' AND passwd='$password'");
if (mysqli_error($con))
{
   die(mysqli_error($con));
}
if(mysqli_num_rows($result) == 1)
{
	$_SESSION['is_logged_in'] = 1;
	$_SESSION['name']=$username;
	$row = mysqli_fetch_array($result);
	if ( $row['usertype'] == 'admin')
	{
		header("location:admin.php");	
	}
	else
	{
		header("location:home.php");
	}
}
else
{
	echo "HELLO";
	//header("location:logout.php");
}
mysqli_close($con);
?>
</body>
</html>