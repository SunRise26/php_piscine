<?php
require_once('db_handler.php');

if (!$_SERVER['REQUEST_METHOD'] === 'POST')
{
	header('Location: ../admin.php?error=wrong_method');
	return (0);
}
if (!$_POST[login] || !$_POST[name] || !$_POST[email] || !$_POST[password])
{
	header('Location: ../admin.php?error=wrong_post');
	return (0);
}
if ($_POST[action] != "create")
{
	header('Location: ../admin.php?error=button');
	return (0);
}

$conn = db_connect();

$login = htmlspecialchars($_POST[login]);
$login = mysqli_real_escape_string($conn, $login);

$name = htmlspecialchars($_POST[name]);
$name = mysqli_real_escape_string($conn, $name);

$email = htmlspecialchars($_POST[email]);
$email = mysqli_real_escape_string($conn, $email);

$password = hash('sha512', $_POST['password']);
$sql = "INSERT INTO users (login, name, email, password) 
VALUES ('$login', '$name', '$email', '$password')";

if (mysqli_query($conn, $sql)) 
{
	$conn->close();
    header('Location: ../admin.php');
	return;
} 
else 
{
	$conn->close();
	$error = mysqli_error($conn);
	header('Location: ../admin.php?error=cant_create');
	return;
}