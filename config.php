<?php
define('DB_SERVER','localhost');
define ('DB_USERNAME','id7210656_admin');
define('DB_PASSWORD','marwan19');
define ('DB_NAME','id7210656_chatbox');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link===false){
    die("ERROR: Could not connect ". mysqli_connect_error());
}
?>