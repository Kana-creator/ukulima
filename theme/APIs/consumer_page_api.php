
<?php

include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";



// FUNCTION FOR VERIFYING A PRODUCT
function verify_product($mysqli, $serial_number)
{
    $result = $mysqli->query("SELECT * FROM Product WHERE serial_number = '$serial_number'");
    if (!$result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {

        if (mysqli_num_rows($result) < 1) {
            echo json_encode(array("status" => "error", "message" => "No product with such a serial number has been found!"));
        } else {
            $row = $result->fetch_array();
            echo json_encode(array("status" => "success", "brand_name" => decrypt_data($row['brand_name']), "manufacturer" => decrypt_data($row['product_manufacturer']), "supplier" => decrypt_data($row['product_supplier']), "point_of_origin" => decrypt_data($row['point_of_origin']), "date_of_manufacture" => $row['date_of_manufacture'], "expiry_date" => $row['product_expiry_date'], "product_image" => decrypt_data($row['product_image']), "unit_of_measure" => decrypt_data($row['unit_of_measure']), "batch_number" => decrypt_data($row['batch_number']), "serial_number" => decrypt_data($row['serial_number']), "unit_cost" => number_format(decrypt_data($row['unit_cost'])), "user_guid" => decrypt_data($row['user_guid'])));
        }
    }
}


// FUNCTION FOR ADDING A PRODUCT TO CART
function add_to_cat($mysqli, $product_id, $user_id, $number_of_items, $order_date)
{
    $result = $mysqli->query("SELECT * FROM Product WHERE product_id=$product_id");
    if (!$result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {
        if (mysqli_num_rows($result) > 0) {
            $result = $mysqli->query("SELECT * FROM user_order WHERE product_id=$product_id AND user_id=$user_id");
            if (mysqli_num_rows($result) > 0) {
                $row = $result->fetch_array();
                $number_of_items = $row['number_of_items'] + $number_of_items;
                $query = $mysqli->query("UPDATE user_order SET number_of_items=$number_of_items WHERE product_id=$product_id AND user_id=$user_id");
                if (!$query) {
                    echo json_encode(array("status" => "error", "message" => $mysqli->error));
                } else {
                    echo json_encode(array("status" => "success", "message" => "Product has successfully been added to cart."));
                }
            } else {
                $query = $mysqli->query("INSERT INTO user_order(product_id, user_id, number_of_items, order_date) VALUES($product_id, $user_id, $number_of_items, '$order_date')");
                if (!$query) {
                    echo json_encode(array("status" => "error", "message" => $mysqli->error));
                } else {
                    $cat_result = $mysqli->query("SELECT SUM(number_of_items) AS number_of_items FROM USER_ORDER WHERE user_id=$user_id");
                    $cat_row = $cat_result->fetch_array();
                    $number_of_items = $cat_row['number_of_items'];
                    if ($number_of_items > 9) {
                        $number_of_items = "9+";
                    }
                    echo json_encode(array("status" => "success", "message" => "Product successfully added to cart.", "number_of_items" => $number_of_items));
                }
            }
        } else {
            echo json_encode(array("status" => "success", "message" => "Product not found"));
        }
    }
}

// add_to_cat($mysqli, 4, 3, 2);




if (isset($_POST['action'])) {
    if ($_POST['action'] == "verify_product") {
        $serial_number = encrypt_data($_POST['serial_number']);
        verify_product($mysqli, $serial_number);
    } else if ($_POST['action'] == "add_to_cat") {
        session_start();
        $product_id = $_POST['product_id'];
        $user_id = $_SESSION['user_id'];
        $number_of_items = $_POST['number_of_items'];
        $order_date = date("Y-m-d");

        add_to_cat($mysqli, $product_id, $user_id, $number_of_items, $order_date);
    }
}
