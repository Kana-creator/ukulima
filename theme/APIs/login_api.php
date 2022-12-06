<?php

include "../objects/user_object.php";

// LOGIN FUNCTION 
function user_login($mysqli, $user_name, $password)
{
    if (!$mysqli) {
        echo json_encode(array("status" => "error", "message" => "Failed to connect to the database!"));
    } else {
        $result = $mysqli->query("SELECT * FROM User WHERE user_email='$user_name' OR user_telephone='$user_name'");
        if (!$result) {
            echo json_encode(array("status" => "error", "message" => "Failed to fetch user information."));
        } else {
            if (mysqli_num_rows($result) > 0) {
                $row = $result->fetch_array();
                if (password_verify($password, $row['user_password'])) {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['first_name'];
                    $_SESSION['user_category'] = $row['user_category'];
                    $user_id = $row['user_id'];
                    $mysqli->query("UPDATE User SET login_status=1 WHERE user_id=$user_id");
                    echo json_encode(array("status" => "success", "message" => "Login successful", "user_type" => $_SESSION['user_category']));
                } else {
                    echo json_encode(array("status" => "error", "message" => "Wrong password!"));
                }
            } else {
                echo json_encode(array("status" => "error", "message" => "Incorrect login credentials."));
            }
        }
    }
}




if (isset($_POST['action'])) {
    $user_name = encrypt_data($_POST['user_name']);
    $password = $_POST['password'];

    user_login($mysqli, $user_name, $password);
}
