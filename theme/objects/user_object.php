
<?php

include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";

class User
{
    public $first_name;
    public $last_name;
    public $user_email;
    public $user_telephone;
    public $user_category;
    public $user_gender;
    public $user_password;
    public $confirm_password;


    public function set_properties($first_name, $last_name, $user_email, $user_telephone, $user_category, $user_gender, $user_password, $confirm_password)
    {

        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_email = $user_email;
        $this->user_telephone = $user_telephone;
        $this->user_category = $user_category;
        $this->user_gender = $user_gender;
        $this->user_password = $user_password;
        $this->confirm_password = $confirm_password;
    }


    public function get_properties()
    {
        $this->properties = array("first_name" => $this->first_name, "last_name" => $this->last_name, "user_email" => $this->user_email, "user_telephone" => $this->user_telephone, "user_category" => $this->user_category, "user_gender" => $this->user_gender, "user_password" => $this->user_password, "confirm_password" => $this->confirm_password);

        return $this->properties;
    }
}


$user_result = $mysqli->query("SELECT * FROM User WHERE user_category != 'dev'");
