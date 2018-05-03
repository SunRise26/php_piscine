<?php
require_once('db_handler.php');

function get_user_by_login($login)
{
	$conn = db_connect();
	$sql = "SELECT * FROM users  WHERE login='$login'";
	$req = mysqli_query($conn, $sql);
	$result = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return($result[0]);
}

function get_users()
{
	$conn = db_connect();
	$sql = "SELECT * FROM users ";
	$req = mysqli_query($conn, $sql);
	$result = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return($result);
}