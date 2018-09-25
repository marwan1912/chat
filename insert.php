<?php
session_start();
$username = $_SESSION['username'];
$msg = $_REQUEST['msg'];


require_once "config.php";
$msg = mysqli_real_escape_string($link, $_REQUEST['msg']);
mysqli_query($link,"INSERT INTO logs (`username`, `msg`) VALUES ('$username', '$msg')");

?>