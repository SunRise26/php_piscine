<?php
session_start();
require_once('db_handler.php');
$conn = db_connect();


function select_from_where($conn, $type, $table, $val)
{
	$sql = "SELECT $type FROM $table WHERE $val";
	$req = mysqli_query($conn, $sql);
	$result = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return ($result[0][$type]);
}

if ($_POST['action'] == "add")
{
	$prod_id = $_POST['prod_id'];
	$prod_qty = $_POST['prod_qty'];
	if (!$prod_id || !$prod_qty){
		header('Location: ../index.php?error=wrong_qty');
		return ;
	}
	$max_qty = select_from_where($conn, "stock", "products", "prod_id=$prod_id");
	foreach ($_SESSION['cart'] as $key => $value) {
		if ($value['prod_id'] == $prod_id){
			$new_qty = $_SESSION['cart'][$key]['prod_qty'] + $prod_qty;
			if ($new_qty <= $max_qty && $new_qty > 0 && $prod_qty > 0) {
				$_SESSION['cart'][$key]['prod_qty'] = $new_qty;
			}
			else if ($new_qty > $max_qty){
				$_SESSION['cart'][$key]['prod_qty'] = $max_qty;
			}
			header('Location: ../index.php');
			return ;
		}
	}
	if ($prod_qty <= 0) {
		header('Location: ../index.php?error=wrong_qty');
		return ;
	}
	else if ($prod_qty > $max_qty){
		$prod_qty = $max_qty;
	}
	$_SESSION['cart'][] = array('prod_id' => $prod_id, 'prod_qty' => $prod_qty);
	header('Location: ../index.php');
}
else if ($_POST['action'] == "delete")
{
	$prod_id = $_POST['prod_id'];
	if (!$prod_id){
		header('Location: ../cart.php');
		return ;
	}
	foreach ($_SESSION['cart'] as $key => $value) {
		if ($value['prod_id'] == $prod_id) {
			array_splice($_SESSION['cart'], $key, 1);
			header('Location: ../cart.php');
			return ;
		}
	}
	header('Location: ../cart.php');
}
else if ($_POST['action'] == "submit")
{
	$order_id = 0;
	while (++$order_id) {
		if (!select_from_where($conn, "order_id", "orders", "order_id=$order_id")) {
			break ;
		}
	}
	$user_id = select_from_where($conn, "user_id", "users", "login='$_SESSION[logged_in_user]'");
	if ($_SESSION['logged_in_user'] == "") {
		header("Location: ../login.php");
		return ;
	}
	if (!$_SESSION['cart']) {
		echo '<a href="../index.php">ORDER SMTH FIRST!!!</a>';
		return ;
	}
	foreach ($_SESSION['cart'] as $key => $value) {
		if (!$value['prod_id'] || !$value['prod_qty']) {
			header("Location: ../cart.php?error=order");
			return ;
		}
		$sql = "INSERT INTO orders (order_id, user_id, prod_id, prod_qty) VALUES ('$order_id', '$user_id', '$value[prod_id]', '$value[prod_qty]')";
		$new_qty = select_from_where($conn, "stock", "products", "prod_id=$value[prod_id]") - $value[prod_qty];
		if ($new_qty < 0) {
			header("Location: ../cart.php?error=sql_new_qty");
			return ;
		}
		$sqlmod = "UPDATE products SET stock=$new_qty WHERE prod_id=$value[prod_id]";
		if (!mysqli_query($conn, $sql)) {
			header("Location: ../cart.php?error=sql_new_order");
			return ;
		}
		if (!mysqli_query($conn, $sqlmod)) {
			header("Location: ../cart.php?error=sql_update");
			return ;
		}
		unset($_SESSION[cart]);
	}
	header("Location: ../cart.php?order=done");
}

?>