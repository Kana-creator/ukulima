
<?php

include "../objects/product_object.php";

$product = new Product();
$product->set_properties(
    $_POST['val-brand-name'],
    $_POST['val-manufacturer'],
    $_POST['val-supplier'],
    $_POST['val-point-of-origin'],
    $_POST['val-date-of-manufacture'],
    $_POST['val-date-of-expiry'],
    $_POST['val-product-image'],
    $_POST['val-unit-of-measure'],
    $_POST['val-batch-number'],
    $_POST['val-serial-number'],
    $_POST['val-unit-cost'],
    $_POST['val-e-extension']
);
$product_properties = $product->get_properties();


$user_id = 1;
$brand_name = encrypt_data($product_properties['brand_name']);
$product_manufacturer = encrypt_data($product_properties['product_manufacturer']);
$product_supplier = encrypt_data($product_properties['product_supplier']);
$point_of_origin = encrypt_data($product_properties['point_of_origin']);
$date_of_manufacture = $product_properties['date_of_manufacture'];
$expiry_date = $product_properties['expiry_date'];
$product_image = encrypt_data($product_properties['product_image']);
$unit_of_measure = encrypt_data($product_properties['unit_of_measure']);
$batch_number = encrypt_data($product_properties['batch_number']);
$serial_number = encrypt_data($product_properties['serial_number']);
$unit_cost = encrypt_data($product_properties['unit_cost']);
$user_guid = encrypt_data($product_properties['user_guid']);


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
    $unit_of_measure,
    $batch_number,
    $serial_number,
    $unit_cost,
    $user_guid
) {

    $result = $mysqli->query("SELECT * FROM Product WHERE serial_number='$serial_number'");
    if (!$result) {
        echo "error";
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo "exists";
        } else {
            $query = $mysqli->query("INSERT INTO Product(user_id, brand_name, product_manufacturer, product_supplier, point_of_origin, date_of_manufacture, product_expiry_date, unit_of_measure, batch_number, serial_number, unit_cost, user_guid) VALUES(1, '$brand_name', '$product_manufacturer', '$product_supplier', '$point_of_origin', '$date_of_manufacture', '$expiry_date', '$unit_of_measure', '$batch_number', '$serial_number', '$unit_cost', '$user_guid')");
            if (!$query) {
                echo $mysqli->error;
            } else {
                echo "success";
            }
        }
    }
}



// FUNCTION FOR UPDATING A PRODUCT INFO
function edit_product(
    $product_id,
    $user_id,
    $brand_name,
    $product_manufacturer,
    $product_supplier,
    $point_of_origin,
    $date_of_manufacture,
    $expiry_date,
    $product_image,
    $unit_of_measure,
    $batch_number,
    $serial_number,
    $unit_cost,
    $user_guid
) {
}



// FUNCTION FOR DELETING A PRODUCT 
function delete_product($product_id)
{
}



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
    $unit_of_measure,
    $batch_number,
    $serial_number,
    $unit_cost,
    $user_guid
);
