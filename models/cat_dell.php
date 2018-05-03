<?php
require_once('db_handler.php');


if (!$_POST[action] || !$_POST[cat_id])
	header('Location: ../admin.php?error=wrong_post');

if ($_POST[action] = 'dell') 
{
	$conn = db_connect();

	$cat_id = htmlspecialchars($_POST[cat_id]);
	$cat_id = mysqli_real_escape_string($conn, $cat_id);

	$sql = "DELETE FROM categories WHERE cat_id='$cat_id'";
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
