<?php
require_once('db_handler.php');

function category_get_all()
	{
		$db = db_connect();
		$sql = "SELECT * FROM categories ORDER BY name ASC";
		$result = mysqli_query($db, $sql);
		if ($result !== FALSE)
			return mysqli_fetch_all($result, MYSQLI_ASSOC);
		return (null);
	}
