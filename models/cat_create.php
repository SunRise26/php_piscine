<?php
require_once('db_handler.php');

if (!$_SERVER['REQUEST_METHOD'] === 'POST')
{
	header('Location: ../admin.php?error=wrong_method');
	return (0);
}
if (!$_POST[name])
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
$name = htmlspecialchars($_POST[name]);
$name = mysqli_real_escape_string($conn, $name);

$sql = "INSERT INTO categories (name) VALUES ('$name')";

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

