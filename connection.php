<?php

// database definition
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ajax_crud');

try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
   } catch (PDOException $e) {
       exit("Error: " . $e->getMessage());
   }

?>