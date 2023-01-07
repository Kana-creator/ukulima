<?php

include "../objects/user_object.php";

// LOGIN FUNCTION 
function user_login($mysqli, $user_type, $user_name, $password)
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
                $user_category = $row['user_category'];
                if ($user_type == "admin" && $user_category != "admin") {
                    echo json_encode(array("status" => "error", "message" => "Sorry but you can't login through this page. Only administrators are allowed."));
                } else if ($user_type == "dev" && $user_category != "dev") {
                    echo json_encode(array("status_error", "message" => "Sorry you can't login through this page. Only developers are allowed."));
                } else if ($user_type == "any_user" && ($user_category == "admin" || $user_category == "dev")) {
                    echo json_encode(array("status" => "error", "message" => "Sorry You can't login through this page accoding to your account type."));
                } else {
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
                }
            } else {
                echo json_encode(array("status" => "error", "message" => "Incorrect login credentials."));
            }
        }
    }
}




if (isset($_POST['action'])) {
    $user_name = encrypt_data($_POST['user_name']);
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];

    user_login($mysqli, $user_type, $user_name, $password);
}
