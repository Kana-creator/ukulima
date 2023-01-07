
<?php

include_once './connection_api.php';
include_once './encryption_api.php';



function reset_password($mysqli, $user_name, $confirm_new_password)
{
    $result = $mysqli->query("SELECT * FROM User WHERE user_email='$user_name' OR user_telephone='$user_name'");
    if (!$result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {
        if (mysqli_num_rows($result) > 0) {
            $row  = $result->fetch_array();
            $user_category = $row['user_category'];

            $query = $mysqli->query("UPDATE User SET user_password = '$confirm_new_password' WHERE user_telephone='$user_name' OR user_email='$user_name'");
            if (!$query) {
                echo json_encode(array("status" => "error", "message" => $mysqli->error, "user_type" => ""));
            } else {
                echo json_encode(array("status" => "success", "message" => "Password has been updated successfully.", "user_type" => $user_category));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "No user with such a user email orphone number was found!", "user_type" => ""));
        }
    }
}

// reset_password($mysqli, "user_name", "confirm_new_password");


if (isset($_POST['action'])) {
    $user_name = encrypt_data($_POST['user_name']);
    $confirm_new_password = $_POST['confirm_new_password'];
    $password = password_hash($confirm_new_password, PASSWORD_DEFAULT);
    reset_password($mysqli, $user_name, $password);
}
