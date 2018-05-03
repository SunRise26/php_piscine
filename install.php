<?php
$servername = "localhost";
$username = "root";
$password = "derparol";
$dbname = "rush";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected to MySql server successfully<br>";

// Create database
$sql = "CREATE DATABASE " . $dbname;
if ($conn->query($sql) === TRUE) {
    echo 'Database "' . $dbname . '" created successfully<br>';
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}
$conn->close();

// Reconecting to created DB
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create users table
$sql = "CREATE TABLE users (
user_id INT AUTO_INCREMENT NOT NULL, 
login VARCHAR(30) NOT NULL UNIQUE,
name VARCHAR(30) NOT NULL,
email VARCHAR(50),
password VARCHAR(130),
reg_date TIMESTAMP,
PRIMARY KEY(user_id)
)";
if (mysqli_query($conn, $sql)) {
    echo 'Table "users" created successfully<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Creating admin user
$password = hash('sha512', 'qwerty');
$sql = "INSERT INTO users (login, name, email, password)
VALUES ('admin', 'rkhilenk', 'khilenkoroman@gamil.com', '$password')";
if (mysqli_query($conn, $sql)) {
    echo 'User "admin" added successfully<br>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}

// sql to create users table
$sql = "CREATE TABLE products (
prod_id  INT AUTO_INCREMENT NOT NULL, 
name VARCHAR(30) NOT NULL UNIQUE,
description TEXT,
stock INT(3) DEFAULT 0,
price INT NOT NULL,
img VARCHAR(400),
reg_date TIMESTAMP,
PRIMARY KEY(prod_id)
) ENGINE=InnoDB CHARACTER SET=UTF8";
if (mysqli_query($conn, $sql)) {
    echo 'Table "products" created successfully<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// sql to create products table
$sql = "CREATE TABLE categories (
cat_id INT AUTO_INCREMENT NOT NULL, 
name VARCHAR(30) NOT NULL UNIQUE,
reg_date TIMESTAMP,
PRIMARY KEY(cat_id)
) ENGINE=InnoDB CHARACTER SET=UTF8";
if (mysqli_query($conn, $sql)) {
    echo 'Table "categories" created successfully<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// sql to create connect table
$sql = "CREATE TABLE connect (
    inv_id  INT AUTO_INCREMENT NOT NULL,
    cat_id  INT NOT NULL,
    prod_id  INT NOT NULL,
    PRIMARY KEY(inv_id),
    FOREIGN KEY (cat_id) REFERENCES categories(cat_id) ON DELETE CASCADE,
    FOREIGN KEY (prod_id) REFERENCES products(prod_id) ON DELETE CASCADE
  ) ENGINE=InnoDB CHARACTER SET=UTF8";
if (mysqli_query($conn, $sql)) {
    echo 'Table "connect" created successfully<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// sql to create cart table
$sql = "CREATE TABLE orders (
    order_id  INT NOT NULL,
    user_id  INT NOT NULL,
    prod_id  INT NOT NULL,
    prod_qty  INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (prod_id) REFERENCES products(prod_id)
  ) ENGINE=InnoDB CHARACTER SET=UTF8";
if (mysqli_query($conn, $sql)) {
    echo 'Table "cart" created successfully<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}



// Creating test products
$sql = "INSERT INTO products (name, description, stock, img, price)
VALUES ('BARRETT M82', 'The Barrett M82, standardized by the U.S. military as the M107, is a recoil-operated, semi-automatic anti-materiel rifle developed by the American Barrett Firearms Manufacturing company.', '10', 'http://www.thespecialistsltd.com/sites/default/files/barrett_m82.jpg', '1000'),
('Steyr AMR / IWS 2000', 'A concept from WWI, the heavy anti-material rifle, which used to be called the anti-tank rifle , but following WWI, tank armor became thick enough where the only areas on most tanks that could be reliably damaged with a rifle were the tracks and the vision blocks or periscopes.', '4', 'http://1.bp.blogspot.com/_pPsuc9rvU4Y/SotzvC1Xi3I/AAAAAAAAAR0/OKr1hGiJ9Hg/s1600/steyr_amr_1.jpg', '1500'),
('SVD (Dragunov)', 'The Dragunov was designed as a squad support weapon since, according to Soviet and Soviet-derived military doctrines, the long-range engagement ability was lost to ordinary troops when submachine guns and assault rifles (which are optimized for close-range and medium-range, rapid-fire combat) were adopted.', '101', 'https://www.all4shooters.com/ru/imgres/600x/strelba/ruzhya/KO-SVD-nareznoye-ruzhye/molot1.png', '200'),
('KPV-14.5', 'The KPV-14.5 heavy machine gun is a Soviet designed 14.5×114mm-caliber heavy machine gun, which first entered service as an infantry weapon', '30', 'https://topwar.ru/uploads/posts/2010-11/1289291631_kord_gun.jpg', '800'),
('DP-27', 'light machine gun firing the 7.62×54mmR cartridge that was primarily used by the Soviet Union starting in 1928. The DP machine gun was supplemented in the 1950s by the more modern RPD machine gun', '30', 'https://upload.wikimedia.org/wikipedia/commons/1/13/Machine_gun_DP_MON.jpg', '100')";

if (mysqli_query($conn, $sql)) {
    echo 'test products added successfully<br>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}

// Creating test categories
$sql = "INSERT INTO categories (name)
VALUES ('Крупнокалиберное'),('Снайперское'),('Пулеметы')";

if (mysqli_query($conn, $sql)) {
    echo 'test categories added successfully<br>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}

// Creating test connections
$sql = "INSERT INTO connect (cat_id, prod_id)
VALUES ('1', '1'),('1' , '2'),('2', '3'),('2', '2'),('2', '1'),('1', '4'),('3', '4'),('3', '5')";

if (mysqli_query($conn, $sql)) {
    echo 'test connections added successfully<br>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}


// Creating test orders
$sql = "INSERT INTO orders (order_id, user_id, prod_id, prod_qty)
VALUES ('1', '1', '1', '3'), ('1', '1', '2', '3'), ('2', '1', '1', '3'), ('2', '1', '2', '3')";

if (mysqli_query($conn, $sql)) {
    echo 'test orders added successfully<br>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}

$conn->close();
?>