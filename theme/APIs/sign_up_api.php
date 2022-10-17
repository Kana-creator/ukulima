
<?php

    include "./connection_api.php";
    include "./encryption_api.php";

    class User {
        public $first_name;
        public $last_name;
        public $user_email;
        public $user_telephone;
        public $user_category;
        public $user_password;
        

        public function set_properties($first_name, $last_name, $user_email, $user_telephone, $user_category, $user_password){

            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->user_email = $user_email;
            $this->user_telephone = $user_telephone;
            $this->user_category = $user_category;
            $this->user_password = $user_password;

        }


        public function get_properties(){
            $this->properties = array("first_name"=>$this->first_name, "last_name"=>$this->last_name, "user_email"=>$this->user_email, "user_telephone"=>$this->user_telephone, "user_category"=>$this->user_category, "user_password"=>$this->user_password);

            return $this->properties;
        }
    }


    $user = new User();
    $user->set_properties(
        $_POST['first_name'], 
        $_POST['last_name'], 
        $_POST['user_email'], 
        $_POST['user_telephone'], 
        $_POST['user_category'], 
        $_POST['user_password']
    );
    $user_properties = $user->get_properties();

    
    $first_name = encrypt_data($user_properties["first_name"]);
    $last_name = encrypt_data($user_properties["last_name"]);
    $user_email = encrypt_data($user_properties["user_email"]);
    $user_telephone = encrypt_data($user_properties["user_telephone"]);
    $user_category = $user_properties["user_category"];
    $user_password = password_hash($user_properties["user_password"], PASSWORD_DEFAULT);

    $result = $mysqli->query("SELECT * FROM User WHERE user_email='$user_email' OR user_telephone='$user_telephone'");
    if(!$result){
        echo $mysqli->error;
    }else{
        if(mysqli_num_rows($result)>0){
            echo "Same user exists";
        }else{
            $query = $mysqli->query("INSERT INTO User(first_name, last_name, user_email, user_telephone, user_category, user_password) VALUES('$first_name', '$last_name', '$user_email', '$user_telephone', '$user_category', '$user_password')");
            if(!$query){
                echo $mysqli->error;
            }else{
                echo "Sign up successfull";
            }
        }
    }
    
    



