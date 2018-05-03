<?php
require_once('db_handler.php');

function get_orders_by_login($user_login)
{
	$conn = db_connect();

	$user_login = htmlspecialchars($user_login);
	$user_login = mysqli_real_escape_string($conn, $user_login);
	
	$sql = "SELECT * FROM orders INNER JOIN users ON orders.user_id=users.user_id WHERE users.login='$user_login'";
	$result = mysqli_query($conn, $sql);
	if ($result !== FALSE)
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
	return (null);
}