
<?php

include_once "../APIs/connection_api.php";

session_start();
$user_id = $_SESSION['user_id'];
$mysqli->query("UPDATE User SET login_status=0 WHERE user_id = $user_id");

session_destroy();
header("Location: ../../index.php");
