
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


// FUNCTION FOR ADDING A PRODUCT TO CAT
function add_to_cat($mysqli, $product_id, $user_id, $number_of_items)
{
    $result = $mysqli->query("SELECT * FROM Product WHERE product_id=$product_id");
    if (!$result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {
        if (mysqli_num_rows($result) > 0) {
            $query = $mysqli->query("INSERT INTO Order(product_id, user_id, number_of_items) VALUES($product_id, $user_id, $number_of_items')");
            if (!$query) {
                echo json_encode(array("status" => "error", "message" => $mysqli->error));
            } else {
                echo json_encode(array("status" => "success", "message" => "Product successfully added to cat."));
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

        add_to_cat($mysqli, $product_id, $user_id, $number_of_items);
    }
}
