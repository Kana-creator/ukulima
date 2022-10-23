
<?php

    // include "./connection_api.php";
    include "../objects/user_object.php";   


    $user = new User();
    $user->set_properties(
        $_POST['first_name'], 
        $_POST['last_name'], 
        $_POST['user_email'], 
        $_POST['user_telephone'], 
        $_POST['user_category'], 
        $_POST['user_gender'], 
        $_POST['user_password'],
        $_POST['confirm_password']
    );
    $user_properties = $user->get_properties();

    
    $first_name = encrypt_data($user_properties["first_name"]);
    $last_name = encrypt_data($user_properties["last_name"]);
    $user_email = encrypt_data($user_properties["user_email"]);
    $user_telephone = encrypt_data($user_properties["user_telephone"]);
    $user_category = $user_properties["user_category"];
    $user_gender = $user_properties["user_gender"];
    $user_password = password_hash($user_properties["user_password"], PASSWORD_DEFAULT);
    $confirm_password = password_hash($user_properties["confirm_password"], PASSWORD_DEFAULT);

    $result = $mysqli->query("SELECT * FROM User WHERE user_email='$user_email' OR user_telephone='$user_telephone'");
    if(!$result){
        echo json_encode(array("msg"=>$mysqli->error, "status"=>"Error"));

    }else{
        if(mysqli_num_rows($result)>0){
            echo json_encode(array("msg"=>"Phone number or email already used by another user.", "status"=>"error"));

        }else{
            if($user_properties["user_password"] != $user_properties["confirm_password"]){
                echo json_encode(array("msg"=>"Passwords do not match", "status"=>"error"));

            }else{
                $query = $mysqli->query("INSERT INTO User(first_name, last_name, user_email, user_telephone, user_category, user_gender, user_password) VALUES('$first_name', '$last_name', '$user_email', '$user_telephone', '$user_category', '$user_gender', '$user_password')");

                if(!$query){
                    echo json_encode(array("msg"=>$mysqli->error, "status"=>"error"));

                }else{
                    echo json_encode(array("msg"=>"Sign up successfull", "status"=>"success"));
                }
            }
        }
    }
    
    



