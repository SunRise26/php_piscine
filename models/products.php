<?php
require_once('db_handler.php');


function get_prod_from_category($category)
{
	$conn = db_connect();

	$sql = "SELECT * FROM products INNER JOIN connect ON connect.prod_id=products.prod_id WHERE connect.cat_id=$category[cat_id]";
	$req = mysqli_query($conn, $sql);
	$result = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return($result);
}

function get_prod_by_id($prod_id)
{
	$conn = db_connect();
	$sql = "SELECT * FROM products  WHERE prod_id=$prod_id";
	$req = mysqli_query($conn, $sql);
	$result = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return($result);
}

function get_prod()
{
	$conn = db_connect();
	$sql = "SELECT * FROM products";
	$req = mysqli_query($conn, $sql);
	$result = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return($result);
}