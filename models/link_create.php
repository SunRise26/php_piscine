<?php
require_once('db_handler.php');

if (!$_SERVER['REQUEST_METHOD'] === 'POST')
{
	header('Location: ../admin.php?error=wrong_method');
	return (0);
}
if (!$_POST[cat_id] || !$_POST[prod_id])
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
$cat_id = htmlspecialchars($_POST[cat_id]);
$cat_id = mysqli_real_escape_string($conn, $cat_id);

$prod_id = htmlspecialchars($_POST[prod_id]);
$prod_id = mysqli_real_escape_string($conn, $prod_id);


$sql = "INSERT INTO connect (cat_id, prod_id) 
VALUES ('$cat_id', '$prod_id')";

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