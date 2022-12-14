
<?php
include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";

// FUNCTION FOR ADDING A LOAN
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

            $savings_result = $mysqli->query("SELECT * FROM loan WHERE consumer_id=$consumer_id AND savings_date='$savings_date'");

            if (!$savings_result) {
                echo json_encode(array("status" => "error", "msg" => "2" . $mysqli->error));
            } else {
                if (mysqli_num_rows($savings_result) > 0) {
                    echo json_encode(array("status" => "error", "msg" => "This user already has a loan registered on the same date."));
                } else {
                    $today = new DateTime("now");
                    $date_of_loan = new DateTime($savings_date);

                    if ($today < $date_of_loan) {
                        echo json_encode(array("status" => "error", "msg" => "Wrong loan date, Loan date can't be in the fulure"));
                    } else {
                        $query = $mysqli->query("INSERT INTO loan(consumer_id, savings_date, savings_amount, brought_by_name, brought_by_phone) VALUES($consumer_id, '$savings_date', '$savings_amount', '$brought_full_name', '$brought_phone_number')");

                        if (!$query) {
                            echo json_encode(array("status" => "error", "msg" => "3" . $mysqli->error));
                        } else {
                            echo json_encode(array("status" => "success", "msg" => "Loan has been added successfully."));
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
