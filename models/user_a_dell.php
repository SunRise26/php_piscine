<?php
require_once('db_handler.php');
session_start();


if (!$_POST[user_id])
{
	header('Location: ../admin.php?error=wrong_post');
	return ;
}
if ($_POST[action] != "dell")
{
	header('Location: ../admin.php');
	return ;
}
$conn = db_connect();

$user_id = htmlspecialchars($_POST[user_id]);
$user_id = mysqli_real_escape_string($conn, $user_id);


$sql = "DELETE FROM users WHERE user_id='$user_id'";
$req = mysqli_query($conn, $sql);

header('Location: ../admin.php');
