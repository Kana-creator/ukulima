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
    <title>Ukulima | Product report form</title>
    <script src="../js/jquery.js"></script>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png" />
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet" />

    <link href="../css/custom_css/add_admin_user.css" rel="stylesheet" />
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
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <h4 class="text-center text-success">Report a product</h4>
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="javascript:void(0)">User form</a>
                    </li>
                </ol> -->
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" action="../APIs/product_report_api.php" method="post">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-right" for="val-report-type">Report type <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select type="text" class="form-control" id="val-report-type" name="val-report-type">
                                                <option value="">SELECT A REPORT TYPE</option>
                                                <option value="counterfeit">Counterfeit</option>
                                                <option value="product not found">Product not found</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-right" for="val-serial-number">Serial number <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-serial-number" name="val-serial-number" placeholder="Enter product serial number" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-right" for="val-batch-number">Batch number <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-batch-number" name="val-batch-number" placeholder="Enter productbatch number" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-right" for="val-manufacturer">Manufacturer <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-manufacturer" name="val-manufacturer" placeholder="Enter manufacturer" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-right" for="val-supplier">Supplier <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-supplier" name="val-supplier" placeholder="Enter supplier" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label text-right" for="val-report-details">Report details <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <textarea rows="10" class="form-control" id="val-report-details" name="val-report-details" placeholder="Enter details"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-success">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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

    <?php
    if (isset($_GET['status'])) {
    ?>

        <script>
            $(() => {

                alert("<?php echo $_GET['message']; ?>");
            })
        </script>


    <?php
    }
    ?>
    <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>

    <script src="../plugins/validation/jquery.validate.min.js"></script>
    <script src="../plugins/validation/form-validation-product.js"></script>
</body>

</html>