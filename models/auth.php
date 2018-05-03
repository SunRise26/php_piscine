<?php
session_start();
require_once('db_handler.php');

if (!$_SERVER['REQUEST_METHOD'] === 'POST')
{
	echo ("ERROR\n");
	return (0);
}
$conn = db_connect();
$sql = "SELECT login, password FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result))
    {
        if ($row['login'] == $_POST['login'])
		{
			if ($row['password'] == hash("sha512", $_POST['password']))
			{
				$_SESSION["logged_in_user"] = "";
				$_SESSION["logged_in_user"] = $_POST["login"];
				header('Location: ../index.php');
				return(1);
			}
			header('Location: ../login.php?error=Incorrect pasword');
			return(0);
		}
    }
    header('Location: ../login.php?error=User not found');
	return(0);
}