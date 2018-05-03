<?php
session_start();
require_once('models/get_orders.php');
require_once('models/products.php');
require_once('models/categories.php');
require_once('models/user.php');

$categories = category_get_all();
$products = get_prod();
$users = get_users();
unset($users[0]);



if ($_SESSION["logged_in_user"] != "admin")
	header('Location: ./index.php');

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
<div style="display: flex; flex-direction: column; width: 800px"> 
<div class="prod_wrap">
	<div style="margin-bottom: 20px">Products</div>
	<table>
		<tr class="prod_item">
			<td>id</td>
			<td>name</td>
			<td>cost</td>
			<td>stock</td>
			<td>img</td>
			<td>description</td>
			<td>update</td>
			<td>delete</td>
		</tr>
	<?php foreach($products as $product): ?>
		<tr class="prod_item">
		<td ><?php echo $product[prod_id] ?></td>
		<td ><?php echo $product[name] ?></td>
		<form style="margin: 0" action="models/prod_upd.php" method="POST">
		<td style="margin-left: 10px"><input style="width: 60px" type="number" name="price" value="<?php echo $product[price] ?>" required min='0'></td>
		<td style="margin-left: 10px"><input style="width: 60px" type="number" name="stock" value="<?php echo $product[stock] ?>" required min='0'></td>
		<td style="margin-left: 10px"><input style="width: 100px" type="text" name="img" value="<?php echo $product[img] ?>" required></td>
		<td style="margin-left: 10px"><textarea style="width: 200px; height: 100px;" type="text" name="description" required><?php echo $product[description] ?></textarea></td>
		<td><button name="action" value="upd">upd</button></td>
		<input style="display: none" name="prod_id" value="<?php echo $product[prod_id] ?>" >
		</form>
		<form action="models/prod_dell.php" method="POST">
		<td><button name="action" value="dell">dell</button></td>
		<input style="display: none" name="prod_id" value="<?php echo $product[prod_id] ?>" >
		</form>
		</tr>
	<?php endforeach; ?> 
	</table>
</div>

<div class="prod_wrap">
	<div style="margin-bottom: 20px; margin-top: 20px;">Categories</div>
	<table>
		<tr class="prod_item">
			<td>id</td>
			<td>name</td>
			<td>delete</td>
		</tr>
	<?php foreach($categories as $categorie): ?>
		<tr class="prod_item">
		<td ><?php echo $categorie[cat_id] ?></td>
		<td ><?php echo $categorie[name] ?></td>

		<?php $cat_products = get_prod_from_category($categorie)?>
    	
		<form action="models/cat_dell.php" method="POST">
		<td><button name="action" value="dell">dell</button></td>
		<input style="display: none" name="cat_id" value="<?php echo $categorie[cat_id] ?>" >
		</form>
		</tr>
		<?php foreach($cat_products as $cat_prod): ?>
			<tr>
				<td></td>
				<td><?php echo $cat_prod[prod_id] ?></td>
				<td ><?php echo $cat_prod[name] ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?> 
	</table>
</div>

<div class="prod_wrap">
	<div style="margin-bottom: 20px; margin-top: 20px;">Users</div>
	<table>
		<tr class="prod_item">
			<td>id</td>
			<td>login</td>
			<td>name</td>
			<td>email</td>
			<td>update</td>
			<td>delete</td>
		</tr>
	<?php foreach($users as $user): ?>
		<tr class="prod_item">
		<td ><?php echo $user[user_id] ?></td>
		<td ><?php echo $user[login] ?></td>
		<form style="margin: 0" action="models/user_a_upd.php" method="POST">
			<td style="margin-left: 10px"><input style="width: 60px" type="text" name="name" required value="<?php echo $user[name] ?>"></td>
			<td style="margin-left: 10px"><input style="width: 160px" type="email" name="email" required value="<?php echo $user[email] ?>"></td>
			<td><button name="action" value="upd">upd</button></td>
			<input style="display: none" name="user_id" value="<?php echo $user[user_id] ?>" >
		</form>
		<form action="models/user_a_dell.php" method="POST">
			<td><button name="action" value="dell">dell</button></td>
			<input style="display: none" name="user_id" value="<?php echo $user[user_id] ?>" >
		</form>
		</tr>
	<?php endforeach; ?> 
	</table>
</div>
</div>





<div style="display: flex; flex-direction: column; width: 400px; margin-left: 10px ">
	<div class="create_a_item">
	<p style="font-size: 20px;font-weight: bold;">create product</p>
	<form action="models/prod_create.php" method="POST">
		name:<input style="width: 60px" type="text" name="name" value="" required>
		price<input style="width: 60px" type="number" name="price" value="" required min='0'>
		stock<input style="width: 60px" type="number" name="stock" value="" required min='0'>
		img<input style="width: 60px" type="text" name="img" value="" required>
		description<textarea style="width: 200px; height: 50px; margin-top: 10px" type="text" name="description"></textarea>
		<button name="action" value="create">create product</button>
	</form>
	</div>
	<div class="create_a_item">
	<p style="font-size: 20px;font-weight: bold;">create categorie</p>
	<form action="models/cat_create.php" method="POST">
		name:<input style="width: 60px" type="text" name="name" value="" required>
		<button name="action" value="create">create categorie</button>
	</form>
	</div>
	<div class="create_a_item">
	<p style="font-size: 20px;font-weight: bold;">create user</p>
	<form action="models/user_a_create.php" method="POST">
		login:<input style="width: 60px" type="text" name="login" value="" required>
		name<input style="width: 60px" type="text" name="name" value="" required>
		email<input style="width: 60px" type="email" name="email" value="" required>
		<br>password<input style="width: 60px" type="password" name="password" value="" required>
		<button name="action" value="create">create user</button>
	</form>
	</div>
	<div class="create_a_item">
	<p style="font-size: 20px;font-weight: bold;">create link</p>
	<form action="models/link_create.php" method="POST">
		cat_id:<input style="width: 60px" type="number" name="cat_id" value="" required>
		prod_id<input style="width: 60px" type="number" name="prod_id" value="" required>
		<button name="action" value="create">create link</button>
	</form>
	</div>
	<div class="create_a_item">
	<p style="font-size: 20px;font-weight: bold;">remove link</p>
	<form action="models/link_dell.php" method="POST">
		cat_id:<input style="width: 60px" type="number" name="cat_id" value="" required>
		prod_id<input style="width: 60px" type="number" name="prod_id" value="" required>
	<button name="action" value="dell">remove link</button>
	</form>
	</div>
	
</div>


    	
</div>
<div class="footer_container" style="margin-top: 60px">
	<div class="footer">
		<p class="m-0 text-center text-white">&copy; rkhilenk & vveselov 2018</p>
	</div>
</div>
</body>
</html>