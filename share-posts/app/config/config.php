<?php
//DB Params
//These are the defined in the db service in the docker-compose.yml.
define('DB_HOST', 'db');
define('DB_USER', 'MYSQL_USER');
define('DB_PASS', 'MYSQL_PASSWORD');
define('DB_NAME', 'mvc_test');
 
// App Root
define('APPROOT', dirname(dirname(__FILE__)));
//URL Root
define('URLROOT', 'http://mvc-test.test:8000');
//Site Name
define('SITENAME', 'Share Posts');
//app version
define('APPVERSION', '1.0.0');

// // check the MySQL connection status
// $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Connected to MySQL server successfully!";
// }