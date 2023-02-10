
<?php

include_once "../APIs/connection_api.php";

session_start();
$user_id = $_SESSION['user_id'];

$result = $mysqli->query("SELECT * FROM  User WHERE user_id=$user_id");
$row = $result->fetch_array();
$user_category = $row['user_category'];


if ($user_category == "dev") {

    $mysqli->query("UPDATE User SET login_status=0 WHERE user_id = $user_id");
    session_destroy();
    header("Location: ../dev");
} else if ($user_category == "admin") {
    $mysqli->query("UPDATE User SET login_status=0 WHERE user_id = $user_id");
    session_destroy();
    header("Location: ../admin");
} else {
    $mysqli->query("UPDATE User SET login_status=0 WHERE user_id = $user_id");
    session_destroy();
    header("Location: ../../");
}
