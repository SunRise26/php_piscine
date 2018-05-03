<?php

function db_connect()
{
	$servername = "localhost";
	$username = "root";
	$password = "derparol";
	$dbname = "rush";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) 
	{
    	die("Connection failed: " . mysqli_connect_error());
    }
    return ($conn);
}