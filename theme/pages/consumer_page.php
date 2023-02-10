<?php
include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";
$now = new DateTime('now');
$product_result = $mysqli->query("SELECT * FROM product GROUP BY product_image");
session_start();

if (isset($_SESSION['user_id'])) {
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $cart_result = $mysqli->query("SELECT SUM(number_of_items) AS number_of_items FROM user_order WHERE user_id=$user_id AND check_out_status=0");

    $cart_row = $cart_result->fetch_array();
    $number_of_items = $cart_row['number_of_items'];
} else {
    header("Location: ../../index.html");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Ukulima | Products</title>
    <script src="../js/jquery.js"></script>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png" />
    <!-- Custom Stylesheet -->
    <link href="../plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/custom_css/consumer_page.css" />
</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <img src="../assets/logo.png" alt="" class="logo" />
            <!-- <svg class="circular" viewBox="25 25 50 50">
          <circle
            class="path"
            cx="50"
            cy="50"
            r="20"
            fill="none"
            stroke-width="3"
            stroke-miterlimit="10"
          />
        </svg> -->
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="border-bottom: 2px solid #00FF7F; padding: 0; height: fit-content">
            <div class="brand-logo my-0 py-0" style="
            background-color: #ffffffff;
            border-bottom: 3px solid #00FF7F;
            padding: 0;
            max-height: 78px;
            display: flex;
            justify-content: center;
            align-items: center;
          ">
                <a href="../home.php">
                    <b class="logo-abbr"><img src="../assets/logo.png" alt="" style="height: 60px; width: 60px" />
                    </b>
                    <span class="logo-compact"><img src="../assets/logo.png" alt="" style="height: 60px; width: 60px" /></span>
                    <span class="brand-title">
                        <img src="../assets/logo.png" alt="" style="height: 60px; width: 60px" />
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header" style="border-bottom: 5px solid #00FF7F">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard" />
                        <div class="drop-down d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown" title="Cart" data-toggle="tooltip" data-placement="top">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="badge badge-pill gradient-3 badge-primary" id="number_of_cat"><?php echo $number_of_items; ?></span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class=""><b><?php echo $number_of_items; ?></b> Items Pending in cart</span>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="./consumer_cart.php">
                                                Check out
                                                <!-- <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">
                                                        Events near you
                                                    </h6>
                                                    <span class="notification-text">Within next 5 days</span>
                                                </div> -->
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                        </li>

                        <li class="icons dropdown" title="Notifications" data-toggle="tooltip" data-placement="top">
                            <!-- <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2 badge-primary">3</span>
                            </a> -->
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">
                                                        Events near you
                                                    </h6>
                                                    <span class="notification-text">Within next 5 days</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">
                                                        Event Ended Successfully
                                                    </h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="icons dropdown" title="Profile" data-toggle="tooltip" data-placement="top">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="../images/user/1.png" height="40" width="40" alt="" />
                            </div>
                            <div class="drop-down dropdown-profile dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icon-user"></i> <span><?php echo decrypt_data($user_name); ?></span></a>
                                        </li>
                                        <!-- <li>
                                            <a href="email-inbox.html"><i class="icon-envelope-open"></i> <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill badge-primary">
                                                    3
                                                </div>
                                            </a>
                                        </li> -->

                                        <hr class="my-2" />
                                        <!-- <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li> -->
                                        <li>
                                            <a href="../APIs/logout_api.php"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar" style="background: #00FF7F">
            <div class="nk-nav-scroll" style="background: #00FF7F">
                <ul class="metismenu" id="menu" style="background: #00FF7F">
                    <!-- <li class="nav-label">Dashboard</li> -->
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="fals" style="background: #00FF7F">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false" class="" style="background: #00FF7F">
                            <li><a href="./consumer_page.php">Products</a></li>
                            <li><a href="./verify_product.php">Verify product</a></li>
                            <li><a href="./product_report_form.php">Report a product</a></li>
                            <li><a href="./consumer_cart.php">Orders</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="fals" style="background: #00FF7F">
                            <i class="fa fa-group menu-icon"></i><span class="nav-text">Group Management</span>
                        </a>
                        <ul aria-expanded="false" class="" style="background: #00FF7F">
                            <li><a href="./consumer_group.php">Group Members</a></li>
                            <li><a href="./savings.php">Savings</a></li>
                            <li><a href="./loans.php">Loans</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="javascript:void(0)" id="show-user-details">Products</a>
                        </li>
                    </ol>
                </div>
            </div> -->
            <!-- row -->

            <div class="container-fluid">
                <!-- <div class="col-md-8 my-4 row">
                    <form class="container-fluid p-2 col-12">
                        <h4 class="col-12">Verify Product</h4>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" placeholder="Enter serial number to verify product..." id="input_serial_number" />
                            <input type="submit" value="Verify" class="btn btn-success rounded" id="verify_product" />
                        </div>
                        <b id="verification_message" class="col-12 text-danger"></b>
                    </form>
                </div> -->

                <div class="col-12 row">
                    <?php while ($product_row = $product_result->fetch_array()) : ?>
                        <div class="card col-xl-4 col-lg-4 col-md-6 col-sm-12 p-2">
                            <div class="card-inner card" id="card_inner<?php echo $product_row['product_id']; ?>">
                                <img src="../assets/product_images/<?php echo decrypt_data($product_row['product_image']); ?>" class="card-head" height="250" width="220" />
                                <div class="card-body" style="line-height: 2px;">
                                    <h4><?php echo decrypt_data($product_row['brand_name']); ?></h4>
                                    <p><?php echo decrypt_data($product_row['unit_of_measure']); ?></p>
                                    <p class="text-success">Ugx. <?php echo number_format(decrypt_data($product_row['unit_cost']), 1); ?>/=</p>
                                    <div>
                                        <button id="product_details<?php echo $product_row['product_id']; ?>" class="btn btn-sm btn-warning">Details</button>
                                        <button id="add_to_cat<?php echo $product_row['product_id']; ?>" class="btn btn-sm btn-info"><i class="btn-sm fa fa-shopping-cart" style="color: #ffffff;"></i>Add to cat</button>
                                    </div>

                                </div>
                                <div id="cat_div<?php echo $product_row['product_id']; ?>" class="cat_div">
                                    <div class="cat-details p-3">
                                        <h4 class="col-12 text-center">Add to cat</h4>
                                        <input type="number" autofocus class="form-control" placeholder="Enter number of items" id="number_of_items<?php echo $product_row['product_id']; ?>" />
                                        <b id="cat_msg<?php echo $product_row['product_id']; ?>" class="text-danger"></b>
                                        <div id="cat_action_btn" class="justify-center">
                                            <button id="cancel_add_to_cat<?php echo $product_row['product_id']; ?>" class="btn btn-sm btn-secondary">Cancel</button>
                                            <button id="add_btn<?php echo $product_row['product_id']; ?>" class="btn btn-sm btn-success">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $(() => {

                                $("#product_details<?php echo $product_row['product_id']; ?>").on('click', () => {
                                    $("#product-details").addClass("show");
                                    $("#product_image").attr("src", "../assets/product_images/<?php echo decrypt_data($product_row['product_image']); ?>");
                                    $("#p_brand_name").text("<?php echo decrypt_data($product_row['brand_name']); ?>");
                                    $("#p_manufacturer").text("<?php echo decrypt_data($product_row['product_manufacturer']) ?>");
                                    $("#p_supplier").text("<?php echo decrypt_data($product_row['product_supplier']); ?>");
                                    $("#p_point_of_origin").text("<?php echo decrypt_data($product_row['point_of_origin']); ?>");
                                    $("#p_date_of_manufacture").text("<?php echo $product_row['date_of_manufacture']; ?>");
                                    $("#p_expiry_date").text("<?php echo $product_row['product_expiry_date']; ?>");
                                    $("#p_unit_of_measure").text("<?php echo decrypt_data($product_row['unit_of_measure']); ?>");
                                    $("#p_batch_number").text("<?php echo decrypt_data($product_row['batch_number']); ?>");
                                    $("#p_serial_number").text("<?php echo decrypt_data($product_row['serial_number']); ?>");
                                    $("#p_product_category").text("<?php echo decrypt_data($product_row['product_category']); ?>");
                                    $("#p_unit_cost").text("Ugx. <?php echo number_format(decrypt_data($product_row['unit_cost'])); ?>/=");
                                    $("#product_id").text("<?php echo decrypt_data($product_row['serial_number']); ?>");
                                    $("#product_name").text("<?php echo decrypt_data($product_row['brand_name']); ?>");
                                    $("#p_user_guid").text("<?php echo decrypt_data($product_row['user_guid']); ?>");
                                });


                                $("#add_to_cat<?php echo $product_row['product_id']; ?>").on('click', function() {

                                    $(".card-inner").removeClass("show");

                                    $("#card_inner<?php echo $product_row['product_id']; ?>").addClass("show");

                                    // $("#cat_div<?php echo $product_row['product_id']; ?>").addClass('show');
                                    // $("#cat_div<?php echo $product_row['product_id']; ?>").siblings().removeClass('show');

                                });


                                $("#cancel_add_to_cat<?php echo $product_row['product_id']; ?>").on('click', () => {
                                    $("#card_inner<?php echo $product_row['product_id']; ?>").removeClass("show");
                                    $("#number_of_items<?php echo $product_row['product_id']; ?>").val("");
                                });


                                $("#add_btn<?php echo $product_row['product_id']; ?>").on('click', () => {
                                    var number_of_items = $("#number_of_items<?php echo $product_row['product_id']; ?>").val();
                                    if (number_of_items <= 0) {
                                        $("#cat_msg<?php echo $product_row['product_id']; ?>").text("Please enter a valid number of items");
                                    } else {
                                        $.ajax({
                                            url: "../APIs/consumer_page_api.php",
                                            type: "POST",
                                            dataType: "JSON",
                                            data: {
                                                action: "add_to_cat",
                                                product_id: "<?php echo $product_row['product_id']; ?>",
                                                number_of_items: number_of_items,
                                            },
                                            Cache: false,
                                            success: (res) => {
                                                alert(res['message']);
                                                $("#number_of_cat").text(res['number_of_items']);
                                                $(".card-inner").removeClass("show");
                                                $("#number_of_items<?php echo $product_row['product_id']; ?>").val("");

                                            },
                                        });

                                    }
                                });
                            })
                        </script>

                    <?php endwhile; ?>
                </div>
            </div>

            <div id="product-details">
                <div class="details-inner bg-light alert container py-5 pt-5">
                    <i class="fa fa-times fa-2x" id="close-user"></i>
                    <div class="row justify-content-center align-content-center py-5">
                        <div class="left col-md-4">
                            <h3 class="text-success text-center" id="product_name"></h3>
                            <!-- <h3 class="text-success text-center" id="product_id"></h3> -->
                            <img class="col-12" id="product_image" />
                            <!-- <div class="col-12 row justify-content-center my-3 py-4">
                                <a href="" class="btn btn-danger mx-1">Delete</a>
                                <a href="./Add_product.php" class="btn btn-info mx-1">Edit</a>
                            </div> -->
                        </div>
                        <div class="right col-md-6 row justify-content-left">
                            <div class="left text-right alert col-6">
                                <!-- <p><b>Product ID: </b></p> -->
                                <p><b>Brand Name: </b></p>
                                <p><b>Manufacturer: </b></p>
                                <p><b>Registered supplier: </b></p>
                                <p><b>Point of origin: </b></p>
                                <p><b>Date of manufacture: </b></p>
                                <p><b>Expiry date: </b></p>
                                <p><b>Unit of measure: </b></p>
                                <p><b>Batch number: </b></p>
                                <p><b>Serial number: </b></p>
                                <p><b>Product category: </b></p>
                                <p><b>Unit cost: </b></p>
                                <p><b>E-Extension: </b></p>
                            </div>
                            <div class="right alert col-6">
                                <!-- <p id="p_product_id">Prod-0001</p> -->
                                <p id="p_brand_name">Weed master</p>
                                <p id="p_manufacturer">Kakoola Ug ltd</p>
                                <p id="p_supplier">K&M Traders</p>
                                <p id="p_point_of_origin">Mukono industrial Area</p>
                                <p id="p_date_of_manufacture">25th/06/2022</p>
                                <p id="p_expiry_date">23th/06/2023</p>
                                <p id="p_unit_of_measure">1.5ltr</p>
                                <p id="p_batch_number">44545Y64</p>
                                <p id="p_serial_number">RUE4466564RTT56</p>
                                <p id="p_product_category">Plant husbandry</p>
                                <p id="p_unit_cost">UGX. 17500</p>
                                <p id="p_user_guid">ddd</p>

                                <p id="p_user_guid">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Voluptatem sapiente, consectetur dicta nostrum quas porro ex
                                    explicabo, earum maiores dolore repudiandae sit nulla sequi
                                    fugit, qui iure velit ratione! Exercitationem veritatis
                                    accusantium, ab eius eum aliquam ea alias sed quod obcaecati
                                    maxime dicta quae quas ratione nobis debitis corporis ullam.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>
                    Copyright &copy; Designed & Developed by
                    <a href="#">Anatoli</a> 2022
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>
    <script src="../js/custom_js/consumer_page.js"></script>

    <script src="../plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="../plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>