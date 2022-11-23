
<?php

include "../objects/product_object.php";


// FUNCTION FOR ADDING A NEW PRODUCT
function add_product(
    $mysqli,
    $user_id,
    $brand_name,
    $product_manufacturer,
    $product_supplier,
    $point_of_origin,
    $date_of_manufacture,
    $expiry_date,
    $product_image,
    $target,
    $unit_of_measure,
    $batch_number,
    $serial_number,
    $unit_cost,
    $user_guid
) {

    $result = $mysqli->query("SELECT * FROM Product WHERE serial_number='$serial_number'");
    $message = "";
    $status = "";
    if (!$result) {
        $message = $mysqli->error;
        $status = "error";
    } else {
        if (mysqli_num_rows($result) > 0) {
            $message = $mysqli->error;
            $status = "error";
        } else {
            $manufacture = new DateTime($date_of_manufacture);
            $expiry = new DateTime($expiry_date);
            $now = new DateTime("now");

            if ($expiry <= $now) {
                $message = "Your product could not be added because it is expired!";
                $status = "error";
            } else if ($now->diff($expiry)->format('%a') <= 5) {
                $message = "your Product could not be added because it is soon expiring";
                $status = "error";
            } else if ($expiry < $manufacture) {
                $message = "Error expiry date can't be in the past";
                $status = "error";
            } else {
                $query = $mysqli->query("INSERT INTO Product(user_id, brand_name, product_manufacturer, product_supplier, point_of_origin, date_of_manufacture, product_expiry_date, product_image, unit_of_measure, batch_number, serial_number, unit_cost, user_guid) VALUES($user_id, '$brand_name', '$product_manufacturer', '$product_supplier', '$point_of_origin', '$date_of_manufacture', '$expiry_date', '$product_image', '$unit_of_measure', '$batch_number', '$serial_number', '$unit_cost', '$user_guid')");

                if (!$query) {
                    $message = $mysqli->error;
                    $status = "error";
                } else {
                    move_uploaded_file($_FILES['val-product-image']['tmp_name'], $target);
                    $message = "Product has been added successfully.";
                    $status = "success";
                }
            }
        }
    }

    header("Location: ../pages/Add_product.php?action=add&status=$status&message=$message");
}



// FUNCTION FOR UPDATING A PRODUCT INFO
function edit_product(
    $mysqli,
    $product_id,
    $user_id,
    $brand_name,
    $product_manufacturer,
    $product_supplier,
    $point_of_origin,
    $date_of_manufacture,
    $expiry_date,
    $product_image,
    $target,
    $unit_of_measure,
    $batch_number,
    $serial_number,
    $unit_cost,
    $user_guid
) {
    $result = $mysqli->query("SELECT * FROM Product WHERE product_id=$product_id");
    $message = "";
    $status = "";
    if (!$result) {
        $message = $mysqli->error;
        $status = "error";
    } else {
        if (mysqli_num_rows($result) < 1) {
            $message = $mysqli->error;
            $status = "error";
        } else {

            if (!empty($product_image)) {

                $query = $mysqli->query("UPDATE Product SET user_id=$user_id, brand_name='$brand_name', product_manufacturer='$product_manufacturer', product_supplier='$product_supplier', point_of_origin='$point_of_origin', date_of_manufacture='$date_of_manufacture', product_expiry_date='$expiry_date', product_image='$product_image', unit_of_measure='$unit_of_measure', batch_number='$batch_number', serial_number='$serial_number', unit_cost='$unit_cost', user_guid='$user_guid' WHERE product_id=$product_id");
            } else {
                $query = $mysqli->query("UPDATE Product SET user_id=$user_id, brand_name='$brand_name', product_manufacturer='$product_manufacturer', product_supplier='$product_supplier', point_of_origin='$point_of_origin', date_of_manufacture='$date_of_manufacture', product_expiry_date='$expiry_date', unit_of_measure='$unit_of_measure', batch_number='$batch_number', serial_number='$serial_number', unit_cost='$unit_cost', user_guid='$user_guid' WHERE product_id=$product_id");
            }

            if (!$query) {
                $message = $mysqli->error;
                $status = "error";
            } else {
                move_uploaded_file($_FILES['val-product-image']['tmp_name'], $target);
                $message = "Product info have been updated successfully.";
                $status = "success";
            }
        }
    }

    header("Location: ../pages/Add_product.php?action=edit&status=$status&message=$message");
}



// FUNCTION FOR DELETING A PRODUCT 
function delete_product($mysqli, $product_id)
{
    $result = $mysqli->query("SELECT product_id FROM Product WHERE product_id=$product_id");
    if (!$result) {
        echo json_encode(array("status" => "error", "message" => "Error occured, product could not be deleted"));
    } else {
        $query = $mysqli->query("DELETE FROM Product WHERE product_id=$product_id");
        if (!$query) {
            echo json_encode(array("status" => "error", "message" => "Error occured, product could not be deleted"));
        } else {
            echo json_encode(array("status" => "success", "message" => "Product deleted successfully"));
        }
    }
}





if (isset($_POST['add_product'])) {
    $product = new Product();
    $product->set_properties(
        $_POST['product_id'],
        $_POST['val-brand-name'],
        $_POST['val-manufacturer'],
        $_POST['val-supplier'],
        $_POST['val-point-of-origin'],
        $_POST['val-date-of-manufacture'],
        $_POST['val-date-of-expiry'],
        $_FILES['val-product-image']['name'],
        $_POST['val-unit-of-measure'],
        $_POST['val-batch-number'],
        $_POST['val-serial-number'],
        $_POST['val-unit-cost'],
        $_POST['val-e-extension']
    );
    $product_properties = $product->get_properties();
    session_start();
    $user_id = $_SESSION['user_id'];
    $brand_name = encrypt_data($product_properties['brand_name']);
    $product_manufacturer = encrypt_data($product_properties['product_manufacturer']);
    $product_supplier = encrypt_data($product_properties['product_supplier']);
    $point_of_origin = encrypt_data($product_properties['point_of_origin']);
    $date_of_manufacture = $product_properties['date_of_manufacture'];
    $expiry_date = $product_properties['expiry_date'];
    $product_image = encrypt_data($product_properties['product_image']);
    $target = "../assets/product_images/" . basename(decrypt_data($product_image));
    $unit_of_measure = encrypt_data($product_properties['unit_of_measure']);
    $batch_number = encrypt_data($product_properties['batch_number']);
    $serial_number = encrypt_data($product_properties['serial_number']);
    $unit_cost = encrypt_data($product_properties['unit_cost']);
    $user_guid = encrypt_data($product_properties['user_guid']);

    add_product(
        $mysqli,
        $user_id,
        $brand_name,
        $product_manufacturer,
        $product_supplier,
        $point_of_origin,
        $date_of_manufacture,
        $expiry_date,
        $product_image,
        $target,
        $unit_of_measure,
        $batch_number,
        $serial_number,
        $unit_cost,
        $user_guid
    );
} else if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    delete_product($mysqli, $product_id);
} else if (isset($_POST['edit_product'])) {
    $product = new Product();
    $product->set_properties(
        $_POST['product_id'],
        $_POST['val-brand-name'],
        $_POST['val-manufacturer'],
        $_POST['val-supplier'],
        $_POST['val-point-of-origin'],
        $_POST['val-date-of-manufacture'],
        $_POST['val-date-of-expiry'],
        $_FILES['val-product-image']['name'],
        $_POST['val-unit-of-measure'],
        $_POST['val-batch-number'],
        $_POST['val-serial-number'],
        $_POST['val-unit-cost'],
        $_POST['val-e-extension']
    );
    $product_properties = $product->get_properties();

    session_start();
    $user_id = $_SESSION['user_id'];
    $product_id = $product_properties['product_id'];
    $brand_name = encrypt_data($product_properties['brand_name']);
    $product_manufacturer = encrypt_data($product_properties['product_manufacturer']);
    $product_supplier = encrypt_data($product_properties['product_supplier']);
    $point_of_origin = encrypt_data($product_properties['point_of_origin']);
    $date_of_manufacture = $product_properties['date_of_manufacture'];
    $expiry_date = $product_properties['expiry_date'];
    $product_image = encrypt_data($product_properties['product_image']);
    $target = "../assets/product_images/" . basename(decrypt_data($product_image));
    $unit_of_measure = encrypt_data($product_properties['unit_of_measure']);
    $batch_number = encrypt_data($product_properties['batch_number']);
    $serial_number = encrypt_data($product_properties['serial_number']);
    $unit_cost = encrypt_data($product_properties['unit_cost']);
    $user_guid = encrypt_data($product_properties['user_guid']);

    edit_product(
        $mysqli,
        $product_id,
        $user_id,
        $brand_name,
        $product_manufacturer,
        $product_supplier,
        $point_of_origin,
        $date_of_manufacture,
        $expiry_date,
        $product_image,
        $target,
        $unit_of_measure,
        $batch_number,
        $serial_number,
        $unit_cost,
        $user_guid
    );
}
