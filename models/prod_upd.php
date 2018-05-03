<?php
require_once('db_handler.php');

print_r($_POST);

if (!$_POST[action] || !$_POST[prod_id])
{
	header('Location: ../admin.php?error=wrong_post');
	return;
}

if ($_POST[action] = 'upd') 
{
	$conn = db_connect();

	$price = htmlspecialchars($_POST[price]);
	$price = mysqli_real_escape_string($conn, $price);

	$stock = htmlspecialchars($_POST[stock]);
	$stock = mysqli_real_escape_string($conn, $stock);

	$img = htmlspecialchars($_POST[img]);
	$img = mysqli_real_escape_string($conn, $img);

	$description = htmlspecialchars($_POST[description]);
	$description = mysqli_real_escape_string($conn, $description);

	$prod_id = htmlspecialchars($_POST[prod_id]);
	$prod_id = mysqli_real_escape_string($conn, $prod_id);

	$sql = "UPDATE products SET price='$price', stock='$stock', img='$img', description='$description' WHERE prod_id='$prod_id'";
	$req = mysqli_query($conn, $sql);
	header('Location: ../admin.php');
	return;
}
