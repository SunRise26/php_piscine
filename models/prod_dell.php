<?php
require_once('db_handler.php');


if (!$_POST[action] || !$_POST[prod_id])
	header('Location: ../admin.php?error=wrong_post');

if ($_POST[action] = 'dell') 
{
	$conn = db_connect();

	$prod_id = htmlspecialchars($_POST[prod_id]);
	$prod_id = mysqli_real_escape_string($conn, $prod_id);

	$sql = "DELETE FROM products WHERE prod_id='$prod_id'";
	if (mysqli_query($conn, $sql)) 
	{
    	header('Location: ../admin.php');
		return;
	} 
	else 
	{
		$error = mysqli_error($conn);
		header('Location: ../admin.php?error=cant_delete');
		return;
	}
}
