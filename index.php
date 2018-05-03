<?php
session_start();
require_once('models/categories.php');
require_once('models/products.php');
$categories = category_get_all();

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



    <div class="main">
    <?php foreach($categories as $category): ?>  


    <h2><?php echo $category['name']; ?></h2>
    <?php $products = get_prod_from_category($category)?>

    <div class="categ">
    <?php foreach($products as $product): ?>
    
        
          <div class="item">
            <img src="<?php echo $product['img']?>" >
            <div class="item-body">
              <h4 class="item-title" style="margin: 0px">
                <?php echo $product['name']?>
              </h4>
              <h5 style="margin: 0px">Price <?php echo $product['price']?>$</h5>
              <div class="box">
              	<div class="box__in">
              		<?php echo $product['description']  ?>
              	</div>
              </div>
            </div>
            <form class="itm_form" action="models/add_cart.php" method="POST">
            	<input id="prod_qty_input" type="number" max="<?php echo $product['stock']?>" name="prod_qty">
            	<input style="display: none" type="number" name="prod_id" value="<?php echo $product['prod_id']?>">
            	<button id="cart_btm" type="submit" name="action" value="add">Add to cart</button>
            </form>
          </div>
       
    <?php endforeach; ?>    
    </div>
    <?php endforeach; ?>
    </div>
    </div>
    </div>

<div class="footer_container">
	<div class="footer">
		<p class="m-0 text-center text-white">&copy; rkhilenk & vveselov 2018</p>
	</div>
</div>

</body>
</html>