
<?php

include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";

class Product {
        public $brand_name;
        public $product_manufacturer;
        public $product_supplier;
        public $point_of_origin;
        public $date_of_manufacture;
        public $expiry_date;
        public $product_image;
        public $unit_of_measure;
        public $batch_number;
        public $serial_number;
        public $unit_cost;
        public $user_guid;
        

        public function set_properties($brand_name, $product_manufacturer, $point_of_origin, $date_of_manufacture, $product_supplier, $expiry_date, $product_image, $unit_of_measure, $batch_number, $serial_number, $unit_cost, $user_guid){

            $this->brand_name = $brand_name;
            $this->product_manufacturer = $product_manufacturer;
            $this->product_supplier = $product_supplier;
            $this->point_of_origin = $point_of_origin;
            $this->date_of_manufacture = $date_of_manufacture;
            $this->expiry_date = $expiry_date;
            $this->product_image = $product_image;
            $this->unit_of_measure = $unit_of_measure;
            $this->batch_number = $batch_number;
            $this->serial_number = $serial_number;
            $this->unit_cost = $unit_cost;
            $this->user_guid = $user_guid;

        }


        public function get_properties(){
            $this->properties = array("brand_name"=>$this->brand_name, "product_manufacturer"=>$this->product_manufacturer, "product_supplier"=>$this->product_supplier, "point_of_origin"=>$this->point_of_origin, "date_of_manufacture"=>$this->date_of_manufacture, "expiry_date"=>$this->expiry_date, "product_image"=>$this->product_image, "unit_of_measure"=>$this->unit_of_measure, "batch_number"=>$this->batch_number, "serial_number"=>$this->serial_number, "unit_cost"=>$this->unit_cost, "user_guid"=>$this->user_guid);

            return $this->properties;
        }
    }


    $user_result = $mysqli->query("SELECT * FROM User");
    


    