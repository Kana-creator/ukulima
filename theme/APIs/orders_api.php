
<?php
include "./connection_api.php";
include "./encryption_api.php";


function clear_order($mysqli, $order_id)
{
    $result = $mysqli->query("SELECT * FROM user_order WHERE order_id=$order_id");
    if (!$result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {
        if (mysqli_num_rows($result) < 1) {
            echo json_encode(array('status' => "success", "message" => "Order not found"));
        } else {
            $query = $mysqli->query("UPDATE user_order SET clearence_status = 1 WHERE order_id=$order_id");
            if (!$query) {
                echo json_encode(array("status" => "error", "message" => $mysqli->error));
            } else {
                echo json_encode(array("status" => "success", "message" => "Order cleared successfully"));
            }
        }
    }
}



if (isset($_POST['action'])) {
    if ($_POST['action'] == "clear_order") {
        $order_id = $_POST['order_id'];
        clear_order($mysqli, $order_id);
    }
}
