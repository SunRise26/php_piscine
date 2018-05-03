<?php
session_start();
if (!$_SESSION["logged_in_user"])
{
	header('Location: ./index.php');
	return ;
}
require_once('models/get_orders.php');
require_once('models/products.php');
require_once('models/user.php');

$user = get_user_by_login($_SESSION["logged_in_user"]);
$orders = get_orders_by_login($_SESSION["logged_in_user"]);
$current_order = 0;

?>
<html>
<head>
	<title>Ammu-Nation</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="styles/styles.css" rel="stylesheet">

</head>
<body>
<div class="header_container">
    <div class="header">
        <a href="./index.php" class="site_name">Ammu-Nation</a>
        <div id="auth">
        	<?php if (!$_SESSION["logged_in_user"]): ?>
            	<a href="./login.php">Sign in</a>
            	<a href="./register.php">Register</a>
            <?php else : ?>
            	<a href="controller/user.php">User: <span><?php echo $_SESSION["logged_in_user"] ?></span></a>
            	<a href="./logout.php">Logout</a></li>
            <?php endif; ?>
            <?php if ($_SESSION["cart"]): ?>
            	<a href="./cart.php">Cart <?php echo count($_SESSION["cart"]) ?></a></li>
            <?php endif; ?>
        </div>
      </div>
    </div>



    <div class="main_user">
    	<div class="user_orders">
    	<?php foreach($orders as $order): ?>

    		<?php if ($current_order != $order[order_id]): ?>
    			<?php $current_order = $order[order_id] ?>
    			<div class="order">Order № <?php echo $order[order_id ] ?></div>
    		<?php endif; ?> 
    		<?php $product = get_prod_by_id($order['prod_id'])?>
    		<div class="order_product">
    			<img src="<?php echo $product[0][img] ?>">
    			<div style="margin-left: 20px">
    				<div><?php echo $product[0][name] ?></div>
    				<div>Peice for one <?php echo $product[0][price] ?> $</div>
    				<div>Quantity <?php echo $order[prod_qty] ?></div>
    			</div>
    		</div>
    	<?php endforeach; ?>
    	</div>

    	<div class="user_data">
    		<form action="models/user_upd.php" method="POST">
    			<div>Update user (only name and email)</div>
    			<div style="display: flex;">
    			<input type="text" class="user_form" name="name" value="<?php echo $user[name] ?>" required>
    			<input type="text" class="user_form" name="email" value="<?php echo $user[email] ?>" required>
    			<input type="text" name="login" style="display: none" value="<?php echo $user[login] ?>">
    			<button class="user_form_btm">update user</button>
    			</div>
    		</form>
    		<form action="models/user_dell.php" method="POST">
    			<div style="display: flex;">
    			<p style="margin-right: 15px">Type "delete" to delete</p>
    			<input type="text" class="user_form" name="submit" value="" style="width: 100px" required>
    			<input type="text" name="login" style="display: none" value="<?php echo $user[login] ?>">
    			<button class="user_form_btm">delete user</button>
    			</div>
    		</form>
    	</div>
   	</div>
<div class="footer_container">
	<div class="footer">
		<p class="m-0 text-center text-white">&copy; rkhilenk & vveselov 2018</p>
	</div>
</div>


</body>
</html>