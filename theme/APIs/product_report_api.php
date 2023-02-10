
<?php


include_once "./connection_api.php";
include_once "./encryption_api.php";
session_start();


function report_product($mysqli, $user_id, $report_type, $serial_number, $batch_number, $producer, $supplier, $report_details)
{
    $user_result = $mysqli->query("SELECT * FROM User WHERE user_id=$user_id");
    if (!$user_result) {
        header("Location: ../pages/product_report_form.php?status=error&message=$mysqli->error");
    } else {
        $report_result = $mysqli->query("SELECT * FROM product_report WHERE user_id=$user_id AND serial_number='$serial_number'");
        if (!$report_result) {
            header("Location: ../pages/product_report_form.php?status=error&message=$mysqli->error");
        } else {
            if (mysqli_num_rows($report_result) > 0) {
                header("Location: ../pages/product_report_form.php?status=error&message=You already reported this prooduct! Please report another product.");
            } else {
                $query = $mysqli->query("INSERT INTO product_report(user_id, report_type, serial_number, batch_number, producer, supplier, report_details) VALUES($user_id, '$report_type', '$serial_number', '$batch_number', '$producer', '$supplier', '$report_details')");
                if (!$query) {
                    header("Location: ../pages/product_report_form.php?status=error&message=$mysqli->error");
                } else {
                    header("Location: ../pages/product_report_form.php?status=success&message=Report has been sent successfully.");
                }
            }
        }
    }
}


if (isset($_POST['val-report-type'])) {
    $user_id = $_SESSION['user_id'];
    $report_type = encrypt_data($_POST['val-report-type']);
    $serial_number = encrypt_data($_POST['val-serial-number']);
    $batch_number = encrypt_data($_POST['val-batch-number']);
    $producer = encrypt_data($_POST['val-manufacturer']);
    $supplier = encrypt_data($_POST['val-supplier']);
    $report_details = encrypt_data($_POST['val-report-details']);

    report_product(
        $mysqli,
        $user_id,
        $report_type,
        $serial_number,
        $batch_number,
        $producer,
        $supplier,
        $report_details
    );
}
