
<?php

//  sudo chmod 777 -R /var/www/html/theme/image/avatar/

include "./connection_api.php";
include "./encryption_api.php";

// FUNCTION FOR INSERTING NEXT OF KIN'S INFO
function add_next_of_kin($mysqli, $group_id, $consumer_id, $full_name, $phone_number)
{
    $result = $mysqli->query("SELECT * FROM next_of_kin WHERE phone_number='$phone_number'");
    if (!$result) {
        header("Location: ../pages/group_member_form.php?error=1$mysqli->error&group_id=$group_id");
    } else {
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../pages/group_member_form.php?error=Same next of kin already exists&group_id=$group_id");
        } else {
            $query = $mysqli->query("INSERT INTO next_of_kin(consumer_id, full_name, phone_number) VALUES($consumer_id, '$full_name', '$phone_number')");
            if (!$query) {
                header("Location: ../pages/group_member_form.php?error=2$mysqli->error&group_id=$group_id");
            } else {
                header("Location: ../pages/consumer_group.php?error=Group member has been addded successfully&group_id=$group_id");
            }
        }
    }
}


// INSERTING CONSUMER DATA INTO CONSUMER TABLE 
function create_consumer(
    $mysqli,
    $user_id,
    $group_id,
    $consumer_type,
    $occupation,
    $date_of_birth,
    $identity_type,
    $identity_number,
    $estimated_acreage,
    $major_economic_activity,
    $estimated_monthly_income,
    $location,
    $disability,
    $nationality,
    $marital_status,
    $consumer_id,
    $full_name,
    $phone_number,
    $profile_image,
    $target
) {
    $result = $mysqli->query("SELECT * FROM consumer WHERE user_id=$user_id");
    if (!$result) {
        header("Location: ../pages/group_member_form.php?error=3$mysqli->error&group_id=$group_id");
        // echo "error1" . $mysqli->error;
    } else {
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../pages/group_member_form.php?error=Same consumer details already saved.");
        } else {
            $query = $mysqli->query("INSERT INTO consumer(user_id, group_id, consumer_type, occupation, date_of_birth, identity_type, identity_number, estimated_acreage, major_economic_activity, estimated_monthly_income, consumer_location, disability, nationality, marital_status) VALUES($user_id, $group_id, '$consumer_type', '$occupation', '$date_of_birth', '$identity_type', '$identity_number', $estimated_acreage, '$major_economic_activity', $estimated_monthly_income,'$location','$disability', '$nationality', '$marital_status')");

            if (!$query) {
                header("Location: ../pages/group_member_form.php?error=4$mysqli->error&group_id=$group_id");
                // echo "error2" . $mysqli->error;
            } else {

                $result = $mysqli->query("SELECT * FROM consumer WHERE user_id=$user_id");
                if (!$result) {
                    header("Location: ../pages/group_member_form.php?error=5$mysqli->error&group_id=$group_id");
                } else {
                    $row = $result->fetch_array();
                    $consumer_id = $row['consumer_id'];
                    add_next_of_kin($mysqli, $group_id, $consumer_id, $full_name, $phone_number);
                }

                // header("Location: ../pages/group_member_form.php?error=Member has been saved successfully.&group_id=$group_id");
            }
        }
    }
}

// INSERTING CONSUMER DATA INTO USER TABLE
function create_user(
    $mysqli,
    $first_name,
    $last_name,
    $user_email,
    $user_telephone,
    $user_category,
    $user_gender,
    $user_password,
    $group_id,
    $consumer_type,
    $occupation,
    $date_of_birth,
    $identity_type,
    $identity_number,
    $estimated_acreage,
    $major_economic_activity,
    $estimated_monthly_income,
    $location,
    $disability,
    $nationality,
    $marital_status,
    $consumer_id,
    $full_name,
    $phone_number,
    $profile_image,
    $target
) {
    $result = $mysqli->query("SELECT * FROM user WHERE user_email='$user_email' OR user_telephone='$user_telephone'");
    if (!$result) {
        header("Location: ../pages/group_member_form.php?error=6$mysqli->error&group_id=$group_id");
        // echo "error3" . $mysqli->error;
    } else {
        if (mysqli_num_rows($result) > 0) {
            header("Location: ../pages/group_member_form.php?error=User with the same details already saved.&group_id=$group_id");
        } else {
            $query = $mysqli->query("INSERT INTO user(first_name, last_name, user_email, user_telephone, user_category, user_gender, user_password, profile_image) VALUES('$first_name', '$last_name', '$user_email', '$user_telephone', '$user_category', '$user_gender', '$user_password', '$profile_image')");

            if (!$query) {
                header("Location: ../pages/group_member_form.php?error=7$mysqli->error&group_id=$group_id");
                // echo "error4" . $mysqli->error;
            } else {
                $result = $mysqli->query("SELECT user_id FROM user WHERE user_telephone='$user_telephone'");
                if (!$result) {
                    header("Location: ../pages/group_member_form.php?error=8$mysqli->error&group_id=$group_id");
                    // echo "error5" . $mysqli->error;
                } else {
                    if (!move_uploaded_file($_FILES['val-image']['tmp_name'], $target)) {
                        header("Location: ../pages/group_member_form.php?error=8$mysqli->error&group_id=$group_id");
                    } else {


                        if (mysqli_num_rows($result) > 0) {
                            $row = $result->fetch_array();
                            $user_id = $row['user_id'];
                            create_consumer(
                                $mysqli,
                                $user_id,
                                $group_id,
                                $consumer_type,
                                $occupation,
                                $date_of_birth,
                                $identity_type,
                                $identity_number,
                                $estimated_acreage,
                                $major_economic_activity,
                                $estimated_monthly_income,
                                $location,
                                $disability,
                                $nationality,
                                $marital_status,
                                $consumer_id,
                                $full_name,
                                $phone_number,
                                $profile_image,
                                $target
                            );
                        }
                    }
                }
            }
        }
    }
}


// FUNCTION FOR UPDATING NEXT OF KIN
function update_next_of_kin($mysqli, $group_id, $consumer_id, $full_name, $phone_number)
{
    $query = $mysqli->query("UPDATE next_of_kin SET full_name='$full_name', phone_number='$phone_number' WHERE consumer_id=$consumer_id");

    if (!$query) {
        header("Location: ../pages/group_member_form.php?error=9$mysqli->error&group_id=$group_id");
    } else {
        header("Location: ../pages/consumer_group.php?error=Member has been updated successfully.&group_id=$group_id");
    }
}




// FUNCTION FOR UPDATING A CONSUMER'S INFORMATION
function update_consumer(
    $mysqli,
    $user_id,
    $group_id,
    $consumer_type,
    $occupation,
    $date_of_birth,
    $identity_type,
    $identity_number,
    $estimated_acreage,
    $major_economic_activity,
    $estimated_monthly_income,
    $location,
    $disability,
    $nationality,
    $marital_status,
    // $consumer_id,
    $full_name,
    $phone_number,
    $profile_image,
    $target
) {
    $query = $mysqli->query("UPDATE consumer SET consumer_type='$consumer_type', occupation='$occupation', date_of_birth='$date_of_birth', identity_type='$identity_type', identity_number='$identity_number', estimated_acreage=$estimated_acreage, major_economic_activity='$major_economic_activity', estimated_monthly_income=$estimated_monthly_income, consumer_location='$location', disability='$disability', nationality='$nationality', marital_status='$marital_status' WHERE user_id=$user_id");

    if (!$query) {
        header("Location: ../pages/group_member_form.php?edit_member&error=10$mysqli->error&group_id=$group_id&user_id=$user_id");
    } else {
        $result = $mysqli->query("SELECT * FROM consumer WHERE user_id=$user_id");
        if (!$result) {
            header("Location: ../pages/group_member_form.php?error=11$mysqli->error&group_id=$group_id");
        } else {
            $row = $result->fetch_array();
            $consumer_id = $row['consumer_id'];
            update_next_of_kin($mysqli, $group_id, $consumer_id, $full_name, $phone_number);
            // header("Location: ../pages/group_member_form.php?error=$consumer_id.Member's infor has been updated successfully.&group_id=$group_id");
        }
    }
}




// FUNCTION UPDATING USER'S INFORMATION
function update_user(
    $mysqli,
    $user_id,
    $first_name,
    $last_name,
    $user_email,
    $user_telephone,
    $user_category,
    $user_gender,
    $user_password,
    $group_id,
    $consumer_type,
    $occupation,
    $date_of_birth,
    $identity_type,
    $identity_number,
    $estimated_acreage,
    $major_economic_activity,
    $estimated_monthly_income,
    $location,
    $disability,
    $nationality,
    $marital_status,
    // $consumer_id,
    $full_name,
    $phone_number,
    $profile_image,
    $target
) {
    $query = $mysqli->query("UPDATE user SET first_name='$first_name', last_name='$last_name', user_email='$user_email', user_telephone='$user_telephone', user_category='$user_category', user_gender='$user_gender' WHERE user_id=$user_id");
    if (!$query) {
        header("Location: ../pages/group_member_form.php?error=12$mysqli->error&group_id=$group_id&user_id=$user_id");
    } else {
        update_consumer(
            $mysqli,
            $user_id,
            $group_id,
            $consumer_type,
            $occupation,
            $date_of_birth,
            $identity_type,
            $identity_number,
            $estimated_acreage,
            $major_economic_activity,
            $estimated_monthly_income,
            $location,
            $disability,
            $nationality,
            $marital_status,
            // $consumer_id,
            $full_name,
            $phone_number,
            $profile_image,
            $target
        );
    }
}




if (isset($_POST['action'])) {
    $user_id = $_POST['val-user-id'];
    $first_name = encrypt_data($_POST['val-firstname']);
    $last_name = encrypt_data($_POST['val-othernames']);
    $user_email = encrypt_data($_POST['val-email']);
    $user_telephone = encrypt_data($_POST['val-telephone']);
    $user_category = $_POST['val-member-category'];
    $user_gender = $_POST['val-gender'];
    $user_password = $_POST['val-password'];
    $user_password = password_hash($user_password, PASSWORD_DEFAULT);
    $group_id = $_POST['val-group-id'];
    $consumer_type = $_POST['val-member-category'];
    $occupation = encrypt_data($_POST['val-occupation']);
    $date_of_birth = $_POST['val-date-of-birth'];
    $identity_type = $_POST['val-identity-type'];
    $identity_number = encrypt_data($_POST['val-identity-number']);
    $estimated_acreage = $_POST['val-estimated-acreage'];
    $major_economic_activity = encrypt_data($_POST['val-major-economic-activity']);
    $estimated_monthly_income = $_POST['val-estimated-monthly-income'];
    $location = encrypt_data($_POST['val-address']);
    $disability = encrypt_data($_POST['val-disability']);
    $nationality = encrypt_data($_POST['val-nationality']);
    $marital_status = encrypt_data($_POST['val-marital']);
    $full_name = encrypt_data($_POST['val-full-name']);
    $phone_number = encrypt_data($_POST['val-phone-number']);
    $profile_image = $_FILES['val-image']['name'];
    $target = "../images/avatar/" . basename($profile_image);
    if ($_POST['action'] == "add_member") {
        create_user(
            $mysqli,
            $first_name,
            $last_name,
            $user_email,
            $user_telephone,
            "consumer",
            $user_gender,
            $user_password,
            $group_id,
            $consumer_type,
            $occupation,
            $date_of_birth,
            $identity_type,
            $identity_number,
            $estimated_acreage,
            $major_economic_activity,
            $estimated_monthly_income,
            $location,
            $disability,
            $nationality,
            $marital_status,
            $consumer_id,
            $full_name,
            $phone_number,
            $profile_image,
            $target
        );
    } else if ($_POST['action'] == "edit_member") {
        update_user(
            $mysqli,
            $user_id,
            $first_name,
            $last_name,
            $user_email,
            $user_telephone,
            "consumer",
            $user_gender,
            $user_password,
            $group_id,
            $consumer_type,
            $occupation,
            $date_of_birth,
            $identity_type,
            $identity_number,
            $estimated_acreage,
            $major_economic_activity,
            $estimated_monthly_income,
            $location,
            $disability,
            $nationality,
            $marital_status,
            // $consumer_id,
            $full_name,
            $phone_number,
            $profile_image,
            $target
        );
    }
}

if (isset($_GET['delete_user'])) {
    $user_id = $_GET['user_id'];
    $group_id = $_GET['group_id'];

    $consumer_result = $mysqli->query("SELECT * FROM consumer WHERE user_id=$user_id");
    $consumer_row = $consumer_result->fetch_array();
    $consumer_id = $consumer_row['consumer_id'];

    $delete_next_of_kin = $mysqli->query("DELETE FROM next_of_kin WHERE consumer_id=$consumer_id");
    if (!$delete_next_of_kin) {
        header("Location: ../pages/consumer_group.php?error=17$mysqli->error&group_id=$group_id&user_id=$user_id");
    } else {

        $delete_saving = $mysqli->query("DELETE FROM savings WHERE consumer_id=$consumer_id");
        if (!$delete_saving) {
            header("Location: ../pages/consumer_group.php?error=13$mysqli->error&group_id=$group_id&user_id=$user_id");
        } else {
            $delete_loan = $mysqli->query("DELETE FROM loan WHERE consumer_id=$consumer_id");
            if (!$delete_loan) {
                header("Location: ../pages/consumer_group.php?error=14$mysqli->error&group_id=$group_id&user_id=$user_id");
            } else {
                $delete_consumer = $mysqli->query("DELETE FROM consumer WHERE consumer_id=$consumer_id");
                if (!$delete_consumer) {
                    header("Location: ../pages/consumer_group.php?error=15$mysqli->error&group_id=$group_id&user_id=$user_id");
                } else {
                    $delete_user = $mysqli->query("DELETE FROM User WHERE user_id=$user_id");
                    if (!$delete_user) {
                        header("Location: ../pages/consumer_group.php?error=16$mysqli->error&group_id=$group_id&user_id=$user_id");
                    } else {
                        header("Location: ../pages/consumer_group.php?error=Member has been deleted successfully&group_id=$group_id&user_id=$user_id");
                    }
                }
            }
        }
    }
}
