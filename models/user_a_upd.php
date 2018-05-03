<?php
require_once('db_handler.php');


if (!$_POST[name] || !$_POST[email] || !$_POST[user_id])
	header('Location: ../admin.php?error=wrong_post');


$conn = db_connect();

$name = htmlspecialchars($_POST[name]);
$name = mysqli_real_escape_string($conn, $name);

$email = htmlspecialchars($_POST[email]);
$email = mysqli_real_escape_string($conn, $email);

$user_id = htmlspecialchars($_POST[user_id]);
$user_id = mysqli_real_escape_string($conn, $user_id);


$sql = "UPDATE users SET name='$name', email='$email' WHERE user_id='$user_id'";
$req = mysqli_query($conn, $sql);

header('Location: ../admin.php');