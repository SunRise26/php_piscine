<?php
require_once('db_handler.php');

if (!$_SERVER['REQUEST_METHOD'] === 'POST')
{
	header('Location: ../admin.php?error=wrong_method');
	return (0);
}
if (!$_POST[name] || !$_POST[price] || !$_POST[stock] || !$_POST[img] || !$_POST[description])
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

$price = htmlspecialchars($_POST[price]);
$price = mysqli_real_escape_string($conn, $price);

$stock = htmlspecialchars($_POST[stock]);
$stock = mysqli_real_escape_string($conn, $stock);

$img = htmlspecialchars($_POST[img]);
$img = mysqli_real_escape_string($conn, $img);

$description = htmlspecialchars($_POST[description]);
$description = mysqli_real_escape_string($conn, $description);

$sql = "INSERT INTO products (name, price, stock, img, description) 
VALUES ('$name', '$price', '$stock', '$img', '$description')";

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