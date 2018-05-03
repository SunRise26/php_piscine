<?php
require_once('db_handler.php');
session_start();

if (!$_SERVER['REQUEST_METHOD'] === 'POST')
{
	echo ("ERROR\n");
	return (0);
}
$conn = db_connect();
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT login, password FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result))
    {
        if ($row['login'] == $_POST['login'])
        {
			header('Location: ../register.php?error=Such user exist');
			return(0);
		}
    }  
}

$login = htmlspecialchars($_POST[login]);
$login = mysqli_real_escape_string($conn, $login);

$name = htmlspecialchars($_POST[name]);
$name = mysqli_real_escape_string($conn, $name);

$email = htmlspecialchars($_POST[email]);
$email = mysqli_real_escape_string($conn, $email);


$password = hash('sha512', $_POST['password']);
$sql = "INSERT INTO users (login, name, email, password)
VALUES ('$login', '$name', '$email', '$password')";

if (mysqli_query($conn, $sql))
{
    $_SESSION["logged_in_user"] = $_POST["login"];
    header('Location: ../index.php');
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}