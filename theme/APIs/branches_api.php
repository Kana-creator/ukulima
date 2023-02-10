<?php

include_once "./connection_api.php";
include_once "./encryption_api.php";


// FUNCTION FOR REGISTERING A NEW BRANCH
function add_branch($mysqli, $user_id, $user_category, $branch_name, $branch_address, $branch_number, $agency_number, $contact_number, $contact_name, $email_address, $branch_location)
{
    $branch_result = $mysqli->query("SELECT branch_id FROM branch WHERE branch_number='$branch_number' AND user_id=$user_id");
    if (!$branch_result) {
        header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
    } else {
        if (mysqli_num_rows($branch_result) > 0) {
            header("Location: ../pages/add_branch.php?status=error&message=Branch with the same number already exists!");
        } else {
            $query = $mysqli->query("INSERT INTO branch(user_id, branch_name, branch_address, branch_number, agency_number, contact_number, contact_name, email_address, branch_location) VALUES($user_id, '$branch_name', '$branch_address', '$branch_number', '$agency_number', '$contact_number', '$contact_name', '$email_address', '$branch_location')");

            if (!$query) {
                header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
            } else {

                if ($user_category == "producer") {
                    $producer_result = $mysqli->query("SELECT producer_id FROM producer WHERE user_id=$user_id");
                    if (!$producer_result) {
                        header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
                    } else {
                        if (mysqli_num_rows($producer_result) < 1) {
                            $branch_result = $mysqli->query("SELECT branch_id FROM branch WHERE user_id=$user_id");
                            if (!$branch_result) {
                                header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
                            } else {
                                $branch_row = $branch_result->fetch_array();
                                $branch_id = $branch_row['branch_id'];

                                $query = $mysqli->query("INSERT INTO producer(user_id, branch_id, user_type) VALUES($user_id, $branch_id, 'super admin')");
                                if (!$query) {
                                    header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
                                } else {
                                    header("Location: ../pages/branch_users.php?status=success&message=Branch has been added successfully.");
                                }
                            }
                        } else {
                            header("Location: ../pages/branch_users.php?status=success&message=Branch has been added successfully.");
                        }
                    }
                } else {
                    $supplier_result = $mysqli->query("SELECT supplier_id FROM supplier WHERE user_id=$user_id");
                    if (!$supplier_result) {
                        header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
                    } else {
                        if (mysqli_num_rows($supplier_result) < 1) {
                            $branch_result = $mysqli->query("SELECT branch_id FROM branch WHERE user_id=$user_id");
                            if (!$branch_result) {
                                header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
                            } else {
                                $branch_row = $branch_result->fetch_array();
                                $branch_id = $branch_row['branch_id'];

                                $query = $mysqli->query("INSERT INTO supplier(user_id, branch_id, user_type) VALUES($user_id, $branch_id, 'super admin')");
                                if (!$query) {
                                    header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
                                } else {
                                    header("Location: ../pages/branch_users.php?status=success&message=Branch has been added successfully.");
                                }
                            }
                        } else {
                            header("Location: ../pages/branch_users.php?status=success&message=Branch has been added successfully.");
                        }
                    }
                }
            }
        }
    }
}


// FUNCTION FOR UPDATING BRANCH INFO
function update_branch($mysqli, $branch_id, $branch_name, $branch_address, $branch_number, $agency_number, $contact_number, $contact_name, $email_address, $branch_location)
{
    $query = $mysqli->query("UPDATE branch SET branch_name='$branch_name', branch_address='$branch_address', branch_number='$branch_number', agency_number='$agency_number', contact_number='$contact_number', contact_name='$contact_name', email_address='$email_address', branch_location='$branch_location' WHERE branch_id=$branch_id");
    if (!$query) {
        header("Location: ../pages/add_branch.php?status=error&message=$mysqli->error");
    } else {
        header("Location: ../pages/add_branch.php?status=success&message=Branch info has been updated successfully.");
    }
}


// FUNCTION FOR DELETING A BRANCH
function delete_branch($mysqli, $user_id, $branch_id)
{
    $producer_result = $mysqli->query("SELECT producer_type FROM producer WHERE user_id=$user_id");
    if (!$producer_result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {
        $producer_row = $producer_result->fetch_array();
        $producer_category = $producer_row['producer_type'];
        if ($producer_category != "super admin") {
            echo json_encode(array("status" => "error", "message" => "You are not authorised to perform this activity."));
        } else {
            $query = $mysqli->query("DELETE FROM branch WHERE branch_id=$branch_id");
            if (!$query) {
                echo json_encode(array("status" => "error", "message" => $mysqli->error));
            } else {
                echo json_encode(array("status" => "success", "message" => "Branch has been deleted successfully."));
            }
        }
    }
}




if (isset($_POST['add_branch'])) {
    session_start();
    $user_id = $_SESSION['user_id'];
    $user_category = $_SESSION['user_category'];
    $branch_name = encrypt_data($_POST['val-branch-name']);
    $branch_address = encrypt_data($_POST['val-branch-address']);
    $branch_number = encrypt_data($_POST['val-branch-number']);
    $agency_number = encrypt_data($_POST['val-agency-number']);
    $contact_number = encrypt_data($_POST['val-contact-number']);
    $contact_name = encrypt_data($_POST['val-contact-name']);
    $email_address = encrypt_data($_POST['val-contact-email']);
    $branch_location = $_POST['val-branch-location'];

    add_branch($mysqli, $user_id, $user_category, $branch_name, $branch_address, $branch_number, $agency_number, $contact_number, $contact_name, $email_address, $branch_location);
} else if (isset($_POST['edit_branch'])) {
    session_start();
    $user_id = $_SESSION['user_id'];
    $user_category = $_SESSION['user_category'];
    $branch_id = $_POST['branch_id'];
    $branch_name = encrypt_data($_POST['val-branch-name']);
    $branch_address = encrypt_data($_POST['val-branch-address']);
    $branch_number = encrypt_data($_POST['val-branch-number']);
    $agency_number = encrypt_data($_POST['val-agency-number']);
    $contact_number = encrypt_data($_POST['val-contact-number']);
    $contact_name = encrypt_data($_POST['val-contact-name']);
    $email_address = encrypt_data($_POST['val-contact-email']);
    $branch_location = $_POST['val-branch-location'];

    update_branch($mysqli, $branch_id, $branch_name, $branch_address, $branch_number, $agency_number, $contact_number, $contact_name, $email_address, $branch_location);
} else if (isset($_POST['delete_branch'])) {
    session_start();
    $user_id = $_SESSION['user_id'];
    $user_category = $_SESSION['user_category'];
    $branch_id = $_POST['branch_id'];

    delete_branch($mysqli, $user_id, $branch_id);
}
