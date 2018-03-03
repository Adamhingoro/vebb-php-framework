<?php

require_once 'meekrodb.2.3.class.php';
function Init_Database(){
    DB::$host = DATABASE_HOST;
    DB::$user = DATABASE_USERNAME;
    DB::$password = DATABASE_PASSWORD;
    DB::$dbName = DATABASE_NAME;
    DB::$error_handler = 'my_error_handler';
}
 
function my_error_handler($params) {
  echo "Error: " . $params['error'] . "<br>\n";
  echo "Query: " . $params['query'] . "<br>\n";
  die; // don't want to keep going if a query broke
}