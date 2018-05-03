<?php
session_start();
// echo "<script>alert('У вас ".$num_message." новых сообщений');</script>";
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>login</title>
	<meta charset="utf-8">

    <link href="styles/login.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="models/register.php" method="POST">
      <h1 style="color: grey; margin: 0">Please sign in</h1>


      <input type="text" class="input_form" placeholder="Login" name="login" value="" required autofocus>

      <input type="text" class="input_form" placeholder="Name" name="name" value="" required>

      <input type="email" class="input_form" placeholder="Email" name="email" value="" required>

      <input type="password" class="input_form" placeholder="Password" name="password" value="" required>

      <button class="input_btm" type="submit">Register</button>
    </form>

  </body>
</html>
