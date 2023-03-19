

<?php

include "./connection_api.php";
include "./encryption_api.php";

// FUNCTION FOR REGISTERING A CONSUMERS' GROUP
function register_group($mysqli, $user_id, $group_name, $registration_type, $registration_number, $group_type)
{
    $result = $mysqli->query("SELECT * FROM consumer_group WHERE user_id=$user_id AND group_name='$group_name'");
    if (!$result) {
        echo json_encode(array($mysqli->error));
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo json_encode(array("Same group already registered."));
        } else {
            $query = $mysqli->query("INSERT INTO consumer_group(user_id, group_name, registration_type, registration_number, group_type) VALUES($user_id, '$group_name', '$registration_type', '$registration_number', '$group_type')");
            if (!$query) {
                echo json_encode(array($mysqli->error));
            } else {
                $group_result = $mysqli->query("SELECT group_id, FROM consumer_group WHERE user_id=$user_id");

                if (!$group_result) {
                    echo json_encode(array($mysqli->error));
                } else {
                    $group_row = $group_result->fetch_arrar();
                    $group_id = $group_row['group_id'];
                    $consumer_query = $mysqli->query("INSERT INTO consumer(user_id, group_id, consumer_type) VALUES($user_id, $group_id, 'admin')");
                    if (!$consumer_query) {
                        echo json_encode(array($mysqli->error));
                    } else {
                        echo json_encode(array("Group has been successfully registered."));
                    }
                }
            }
        }
    }
}



// EXCUTING VARIOUS ACTIONS

if (isset($_POST['action'])) {
    if ($_POST['action'] == "register_group") {
        session_start();
        $user_id = $_SESSION['user_id'];
        $group_name = $_POST['group_name'];
        $registration_type = $_POST['registration_type'];
        $registration_number = $_POST['registration_number'];
        $group_type = $_POST['group_type'];

        register_group($mysqli, $user_id, $group_name, $registration_type, $registration_number, $group_type);
    }
}
