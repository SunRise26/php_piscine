<?php
require_once('db_handler.php');
session_start();


if (!$_POST[login])
{
	header('Location: ../user.php?error=wrong_post');
	return ;
}
if ($_POST[submit] != "delete")
{
	header('Location: ../user.php');
	return ;
}
$conn = db_connect();
$login = htmlspecialchars($_POST[login]);
$login = mysqli_real_escape_string($conn, $login);



$sql = "DELETE FROM users WHERE login='$login'";
$req = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql))
{
    $_SESSION["logged_in_user"] = "";
	header('Location: ../index.php');
	return;
}
else {
    header('Location: ../user.php?error=cant_delete');
	return;
}
