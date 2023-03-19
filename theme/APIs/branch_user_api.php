

<?php

include_once "./connection_api.php";
include_once "./encryption_api.php";


// FUNCTION FOR ADDING A SUPPLIER
function add_supplier($mysqli, $user_id, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth)
{
    $query = $mysqli->query("INSERT INTO supplier(user_id, branch_id, user_type, user_address, nationality, marital_status, identity_type, identity_number, date_of_birth) VALUES($user_id, $branch_id, '$user_type', '$user_address', '$nationality', '$marital_status', '$identity_type', '$identity_number', '$date_of_birth')");

    if (!$query) {
        header("Location: ../pages/add_branch_user.php?status=error&message=1$mysqli->error");
    } else {
        header("Location: ../pages/add_branch_user.php?status=success&message=User has been addes successfully.");
    }
}

// FUNCTION FOR DELETING A SUPPLIER
function delete_supplier($mysqli, $user_id, $admin_id)
{
    $admin_result = $mysqli->query("SELECT user_type FROM supplier WHERE user_id=$admin_id");
    if (!$admin_result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {

        $admin_row = $admin_result->fetch_array();
        $user_type = $admin_row['user_type'];
        if ($user_type != "super admin") {
            echo json_encode(array("status" => "error", "message" => "You are not authorised to perform this action."));
        } else {

            $query = $mysqli->query("DELETE FROM supplier WHERE user_id=$user_id");
            if (!$query) {
                echo json_encode(array("status" => "error", "message" => $mysqli->error));
            } else {
                $query = $mysqli->query("DELETE FROM User WHERE user_id=$user_id");
                if (!$query) {
                    echo json_encode(array("status" => "error", "message" => $mysqli->error));
                } else {
                    echo json_encode(array("status" => "error", "message" => "User has been deleted successfully."));
                }
            }
        }
    }
}

// FUNCTION FOR UPDATING USER INFO
function update_user($mysqli, $user_id, $first_name, $last_name, $user_email, $user_telephone, $user_category, $user_gender, $profile_image, $branch_number, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth)
{
    $result = $mysqli->query("SELECT branch_id FROM branch WHERE branch_number='$branch_number'");
    if (!$result) {
        header("Location: ../pages/add_branch_user.php?status=error&message=1$mysqli->error");
    } else {
        if (mysqli_num_rows($result) < 1) {
            header("Location: ../pages/add_branch_user.php?status=error&message=No branch with sucn a branch number was found.");
        } else {
            $row = $result->fetch_array();
            $branch_id = $row['branch_id'];
            $user_result = $mysqli->query("SELECT user_id FROM User WHERE (user_email='$user_email' AND user_id!=$user_id) OR (user_telephone='$user_telephone' AND user_id!=$user_id)");
            if (mysqli_num_rows($user_result) > 0) {
                header("Location: ../pages/add_branch_user.php?status=error&message=Email or telephone already used by another user.");
            } else {
                if ($profile_image != NULL) {
                    $user_query = $mysqli->query("UPDATE User SET first_name='$first_name', last_name='$last_name', user_email='$user_email', user_telephone='$user_telephone', user_category='$user_category', user_gender='$user_gender', profile_image='$profile_image' WHERE user_id=$user_id");
                } else {
                    $user_query = $mysqli->query("UPDATE User SET first_name='$first_name', last_name='$last_name', user_email='$user_email', user_telephone='$user_telephone', user_category='$user_category', user_gender='$user_gender' WHERE user_id=$user_id");
                }
                if (!$user_query) {
                    header("Location: ../pages/add_branch_user.php?status=error&message=11$mysqli->error");
                } else {
                    if ($user_category == "producer") {
                        $query = $mysqli->query("UPDATE producer SET branch_id=$branch_id, user_type='$user_type', user_address='$user_address', nationality='$nationality', marital_status='$marital_status', identity_type='$identity_type', identity_number='$identity_number', date_of_birth='$date_of_birth' WHERE user_id=$user_id");
                        if (!$query) {
                            header("Location: ../pages/add_branch_user.php?status=error&message=$mysqli->error");
                        } else {
                            header("Location: ../pages/add_branch_user.php?status=success&message=User info have been updated successfully.");
                        }
                    } else {
                        $query = $mysqli->query("UPDATE producer SET branch_id=$branch_id, user_type='$user_type', user_address='$user_address', nationality='$nationality', marital_status='$marital_status', identity_type='$identity_type', identity_number='$identity_number', date_of_birth='$date_of_birth' WHERE user_id=$user_id");
                        if (!$query) {
                            header("Location: ../pages/add_branch_user.php?status=error&message=$mysqli->error");
                        } else {
                            header("Location: ../pages/add_branch_user.php?status=success&message=User info hav been updated successfully.");
                        }
                    }
                }
            }
        }
    }
}


// FUNCTION FOR ADDING A PRODUCER
function add_producer($mysqli, $user_id, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth)
{
    $query = $mysqli->query("INSERT INTO producer(user_id, branch_id, user_type, user_address, nationality, marital_status, identity_type, identity_number, date_of_birth) VALUES($user_id, $branch_id, '$user_type', '$user_address', '$nationality', '$marital_status', '$identity_type', '$identity_number', '$date_of_birth')");

    if (!$query) {
        header("Location: ../pages/add_branch_user.php?status=error&message=2$mysqli->error");
    } else {
        header("Location: ../pages/add_branch_user.php?status=success&message=User has been addes successfully.");
    }
}

// FUNCTION FOR DELETING A SUPPLIER
function delete_producer($mysqli, $user_id, $admin_id)
{
    $admin_result = $mysqli->query("SELECT user_type FROM producer WHERE user_id=$admin_id");
    if (!$admin_result) {
        echo json_encode(array("status" => "error", "message" => $mysqli->error));
    } else {

        $admin_row = $admin_result->fetch_array();
        $user_type = $admin_row['user_type'];
        if ($user_type != "super admin") {
            echo json_encode(array("status" => "error", "message" => "You are not authorised to perform this action."));
        } else {

            $query = $mysqli->query("DELETE FROM producer WHERE user_id=$user_id");
            if (!$query) {
                echo json_encode(array("status" => "error", "message" => $mysqli->error));
            } else {
                $query = $mysqli->query("DELETE FROM User WHERE user_id=$user_id");
                if (!$query) {
                    echo json_encode(array("status" => "error", "message" => $mysqli->error));
                } else {
                    echo json_encode(array("status" => "success", "message" => "User has been deleted successfully."));
                }
            }
        }
    }
}




// FUNCTION FOR ADDING A USER
function add_user($mysqli, $user_id, $first_name, $last_name, $user_email, $user_telephone, $user_category, $user_gender, $user_password, $profile_image, $branch_number, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth)
{
    $branch_result = $mysqli->query("SELECT branch_id FROM branch WHERE branch_number='$branch_number'");
    if (!$branch_result) {
        header("Location: ../pages/add_branch_user.php?status=error&message=3$mysqli->error");
    } else {
        if (mysqli_num_rows($branch_result) < 1) {
            header("Location: ../pages/add_branch_user.php?status=error&message=No branch with such a branch number was found");
        } else {
            $branch_row = $branch_result->fetch_array();
            $branch_id = $branch_row['branch_id'];
            $user_result = $mysqli->query("SELECT user_id FROM User WHERE user_email='$user_email' OR user_telephone='$user_telephone'");
            if (!$user_result) {
                header("Location: ../pages/add_branch_user.php?status=error&message=4$mysqli->error");
            } else {
                if (mysqli_num_rows($user_result) > 0) {
                    header("Location: ../pages/add_branch_user.php?status=error&message=Telephone number or email already used");
                } else {
                    $query = $mysqli->query("INSERT INTO User(first_name, last_name, user_email, user_telephone, user_category, user_gender, user_password, profile_image) VALUES('$first_name', '$last_name', '$user_email', '$user_telephone', '$user_category', '$user_gender', '$user_password', '$profile_image')");

                    if (!$query) {
                        header("Location: ../pages/add_branch_user.php?status=error&message=5$mysqli->error");
                    } else {
                        $result = $mysqli->query("SELECT user_id, user_category FROM User WHERE user_email='$user_email' OR user_telephone='$user_telephone'");
                        if (!$result) {
                            header("Location: ../pages/add_branch_user.php?status=error&message=$mysqli->error");
                        } else {
                            $row = $result->fetch_array();
                            $user_id = $row['user_id'];
                            $user_category = $row['user_category'];


                            // if ($user_category == "producer") {

                            //     add_supplier($mysqli, $user_id, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth);
                            // } else {

                            //     add_producer($mysqli, $user_id, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth);
                            // }

                            $user_category = "producer" ? add_producer($mysqli, $user_id, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth) : add_supplier($mysqli, $user_id, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth);
                        }
                    }
                }
            }
        }
    }
}


// FUNCTION FOR DELETING A USER
function delete_user($mysqli, $user_id, $user_category, $admin_id)
{
    if ($user_category == "producer") {
        delete_producer($mysqli, $user_id, $admin_id);
    } else {
        delete_supplier($mysqli, $user_id, $admin_id);
    }
}



if (isset($_POST['action'])) {
    session_start();
    $user_id = $_POST['val-user-id'];
    $first_name = encrypt_data($_POST['val-firstname']);
    $last_name = encrypt_data($_POST['val-othernames']);
    $user_email = encrypt_data($_POST['val-email']);
    $user_telephone = encrypt_data($_POST['val-telephone']);
    $user_category = $_SESSION['user_category'];
    $admin_id = $_SESSION['user_id'];
    $user_gender = $_POST['val-gender'];
    // $user_password = encrypt_data($_POST['val-confirm-password']);
    $profile_image = $_FILES['val-image']['name'];
    $target = "../images/avatar/";
    $branch_number = encrypt_data($_POST['val-branch-number']);
    $user_type = $_POST['val-user-category'];
    $user_address = encrypt_data($_POST['val-address']);
    $nationality = encrypt_data($_POST['val-nationality']);
    $marital_status = $_POST['val-marital'];
    $identity_type = $_POST['val-identity-type'];
    $identity_number = encrypt_data($_POST['val-identity-number']);
    $date_of_birth = $_POST['val-date-of-birth'];

    if ($_POST['action'] == "add_user") {

        add_user($mysqli, $user_id, $first_name, $last_name, $user_email, $user_telephone, $user_category, $user_gender, $user_password, $profile_image, $branch_number, $branch_id, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth);
    } else if ($_POST['action'] == "edit_user") {
        update_user($mysqli, $user_id, $first_name, $last_name, $user_email, $user_telephone, $user_category, $user_gender, $profile_image, $branch_number, $user_type, $user_address, $nationality, $marital_status, $identity_type, $identity_number, $date_of_birth);

        echo json_encode(array("status" => "error", "message" => "yes"));

        // delete_user($mysqli, $user_id, $user_category, $user_type, $admin_id);
    }
}


if (isset($_POST['delete_user'])) {
    session_start();
    $user_id = $_POST['user_id'];
    $user_category = $_SESSION['user_category'];
    $admin_id = $_SESSION['user_id'];
    delete_user($mysqli, $user_id, $user_category, $admin_id);
}
