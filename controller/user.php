<?php
session_start();

if ($_SESSION["logged_in_user"] == "admin")
	header('Location: ../admin.php');
else
	header('Location: ../user.php');