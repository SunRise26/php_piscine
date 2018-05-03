<?php
session_start();
require_once('models/categories.php');
require_once('models/products.php');
$categories = category_get_all();
$total_cost = 0;

// print_r($_SESSION);
// unset($_SESSION[cart]);
// $qwe = get_prod_by_id(1);
// print_r($qwe);

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
            	<a href="./controller/user.php">User: <span><?php echo $_SESSION["logged_in_user"] ?></span></a>
            	<a href="./logout.php">Logout</a></li>
            <?php endif; ?>
            <?php if ($_SESSION["cart"]): ?>
            	<a href="./cart.php">Cart <?php echo count($_SESSION["cart"]) ?></a></li>
            <?php endif; ?>
        </div>
      </div>
    </div>
    <h1 class="cart_title">Cart</h1>

    <?php if ($_SESSION["cart"]): ?>
    <div class="main_cart" style="">
    	<div class="products_wraper">
    	<?php foreach($_SESSION['cart'] as $item): 
    	$product = get_prod_by_id($item['prod_id'])?> 
    	<div class="cart_item">
    		<div class="cart_item_name"><?php echo $product[0]['name'] ?></div> 
    		<img src="<?php echo $product[0]['img'] ?>">
    		<div class="cart_item_row">
    			<div style="display: flex;">
    				<div style="margin-bottom: 30px">Quantity <?php echo $item['prod_qty'] ?></div>
    				<div style="margin-bottom: 30px; margin-left: 50px">Cost <?php echo $item['prod_qty'] * $product[0]['price'] ?> $</div>
    				<?php $total_cost = $total_cost + $item['prod_qty'] *  $product[0]['price'] ?>
    			</div>
    			<form style="display: flex; height: 25px; margin-right: 10px" action="models/add_cart.php" method="POST">
            		<input style="display: none" type="number" name="prod_id" value="<?php echo $product[0]['prod_id']?>">
            		<button id="cart_btm" type="submit" name="action" value="delete">Remove from cart</button>
    			</form>
    		</div>
    		
    	</div>
    	<?php endforeach; ?> 
    	</div>
    	<!-- end items -->

    	<div class="checkout">
    		<div>Checkout</div>
    		<div>Total cost: <?php echo $total_cost ?> $</div>
    		<form style="display: flex; height: 25px; margin-right: 10px" action="models/add_cart.php" method="POST">
            	<button id="submit_btm" type="submit" name="action" value="submit">Submit order</button>
    		</form>
    	</div>
    </div>

    <?php else : ?>
    	<h1 style="height: 100%; width: 400px; margin: 0 auto; margin-top: 100px">Cart is empty</h1>
    <?php endif; ?>

<div class="footer_container">
	<div class="footer">
		<p class="m-0 text-center text-white">&copy; rkhilenk & vveselov 2018</p>
	</div>
</div>


</body>
</html>