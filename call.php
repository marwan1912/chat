<?php
session_start();
$uname = $_SESSION['username'];

require_once "config.php";

$result1 = mysqli_query($link, "SELECT * FROM logs ORDER BY id DESC");

while($extract = mysqli_fetch_array($result1)) {
	echo "<span>" . $extract['username'] . "</span>: <span>" . $extract['msg'] . "</span><br />";
}
?>