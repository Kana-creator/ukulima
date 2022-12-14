
<?php
include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";

// FUNCTION FOR ADDING A SAVING
function add_saving($mysqli, $phone_number, $savings_amount, $savings_date, $brought_full_name, $brought_phone_number)
{
    $result = $mysqli->query("SELECT * FROM User INNER JOIN consumer ON User.user_id=consumer.user_id WHERE user.user_telephone='$phone_number'");
    if (!$result) {
        echo json_encode(array("status" => "error", "msg" => "1" . $mysqli->error));
    } else {
        if (mysqli_num_rows($result) < 1) {
            echo json_encode(array("status" => "error", "msg" => "Farmer with such a phone number could not be found!"));
        } else {
            $row = $result->fetch_array();
            $consumer_id = $row['consumer_id'];

            $savings_result = $mysqli->query("SELECT * FROM savings WHERE consumer_id=$consumer_id AND savings_date='$savings_date'");

            if (!$savings_result) {
                echo json_encode(array("status" => "error", "msg" => "2" . $mysqli->error));
            } else {
                if (mysqli_num_rows($savings_result) > 0) {
                    echo json_encode(array("status" => "error", "msg" => "This user has a saving on the same date."));
                } else {
                    $today = new DateTime("now");
                    $date_of_saving = new DateTime($savings_date);

                    if ($today < $date_of_saving) {
                        echo json_encode(array("status" => "error", "msg" => "Wrong date. Savings date can't be in the future."));
                    } else {

                        $query = $mysqli->query("INSERT INTO savings(consumer_id, savings_date, savings_amount, brought_by_name, brought_by_phone) VALUES($consumer_id, '$savings_date', '$savings_amount', '$brought_full_name', '$brought_phone_number')");

                        if (!$query) {
                            echo json_encode(array("status" => "error", "msg" => "3" . $mysqli->error));
                        } else {
                            echo json_encode(array("status" => "success", "msg" => " Saving has been added successfully."));
                        }
                    }
                }
            }
        }
    }
}



if (isset($_POST['action'])) {
    $phone_number = encrypt_data($_POST['phone_number']);
    $savings_amount = $_POST['savings_amount'];
    $savings_date = $_POST['savings_date'];
    $brought_full_name = encrypt_data($_POST['brought_full_name']);
    $brought_phone_number = encrypt_data($_POST['brought_phone_number']);

    if ($_POST['action'] == "save_saving") {
        add_saving($mysqli, $phone_number, $savings_amount, $savings_date, $brought_full_name, $brought_phone_number);
    }
}
