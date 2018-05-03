<?php
require_once('db_handler.php');


if (!$_POST[name] || !$_POST[email] || !$_POST[login])
	header('Location: ../user.php?error=wrong_post');
$conn = db_connect();
$name = htmlspecialchars($_POST[name]);
$name = mysqli_real_escape_string($conn, $name);

$email = htmlspecialchars($_POST[email]);
$email = mysqli_real_escape_string($conn, $email);

$login = htmlspecialchars($_POST[login]);
$login = mysqli_real_escape_string($conn, $login);


$sql = "UPDATE users SET name='$name', email='$email' WHERE login='$login'";
$req = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($req, MYSQLI_ASSOC);

header('Location: ../user.php');