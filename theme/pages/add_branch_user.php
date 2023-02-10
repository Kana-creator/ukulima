<?php
include "../objects/user_object.php";
// include "../APIs/encryption_api.php";
session_start();
if (isset($_SESSION['user_id'])) {
    $user_name = $_SESSION['user_name'];
    $user_category = $_SESSION['user_category'];
    $user_id = $_SESSION['user_id'];
    $user_result = $mysqli->query("SELECT * FROM User WHERE user_id=$user_id");
    $user_row = $user_result->fetch_array();
    $profile_image = $user_row['profile_image'];
    if (isset($_GET['edit_user'])) {
        $action = "edit_user";
        $branch_id = $_GET['branch_id'];
        $user_idd = $_GET['user_id'];

        if ($user_category == "producer") {
            $member_result = $mysqli->query("SELECT * FROM branch b INNER JOIN producer p ON p.branch_id=b.branch_id INNER JOIN User u ON u.user_id=p.user_id WHERE u.user_id=$user_idd");
        } else {
            $member_result = $mysqli->query("SELECT * FROM branch b INNER JOIN supplier s ON s.branch_id=b.branch_id INNER JOIN User u ON u.user_id=s.user_id WHERE u.user_id=$user_idd");
        }

        $member_row = $member_result->fetch_array();
        // $member_row = $member_result->fetch_array();
        $first_name = decrypt_data($member_row['first_name']);
        $second_name = decrypt_data($member_row['last_name']);
        $user_email = decrypt_data($member_row['user_email']);
        $user_telephone = decrypt_data($member_row['user_telephone']);
        $gender = $member_row['user_gender'];
        $password = $member_row['user_password'];
        $branch_number = decrypt_data($member_row['branch_number']);
        // $occupation = decrypt_data($member_row['occupation']);
        $date_of_birth = $member_row['date_of_birth'];
        $identity_type = $member_row['identity_type'];
        $identity_number = decrypt_data($member_row['identity_number']);
        // $estimated_acreage = $member_row['estimated_acreage'];
        // $major_economic_activity = decrypt_data($member_row['major_economic_activity']);
        // $estimated_monthly_income = $member_row['estimated_monthly_income'];
        $consumer_location = decrypt_data($member_row['user_address']);
        // $disability = decrypt_data($member_row['disability']);
        $nationality = decrypt_data($member_row['nationality']);
        $marital_status = $member_row['marital_status'];
        // $full_name = decrypt_data($member_row['full_name']);
        // $phone_number = decrypt_data($member_row['user_telephone']);
        $password_status = "hidden";
    } else {
        $action = "add_user";
        $user_idd = "";
        $user_id = "";
        $first_name = "";
        $second_name = "";
        $user_email = "";
        $user_telephone = "";
        $gender = "";
        $password = "";
        $branch_number = "";
        $consumer_type = "";
        // $occupation = "";
        $date_of_birth = "";
        $identity_type = "";
        $identity_number = "";
        // $estimated_acreage = "";
        // $major_economic_activity = "";
        // $estimated_monthly_income = "";
        $consumer_location = "";
        // $disability = "";
        $nationality = "";
        $marital_status = "";
        // $full_name = "";
        // $phone_number = "";
        $password_status = "";
    }
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
    <title>Ukulima | group member form</title>
    <script src="../js/jquery.js"></script>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png" />
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet" />

    <link href="../css/custom_css/add_admin_user.css" rel="stylesheet/css" />
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
        <div class="nav-header" style="border-bottom: 2px solid green; padding: 0; height: fit-content">
            <div class="brand-logo my-0 py-0" style="
            background-color: #ffffffff;
            border-bottom: 3px solid green;
            padding: 0;
            max-height: 78px;
            display: flex;
            justify-content: center;
            align-items: center;
          ">
                <a href="/home">
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
        <div class="header" style="border-bottom: 5px solid green">
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
                        <li class="icons dropdown">
                            <!-- <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge gradient-1 badge-pill badge-primary">3</span>
                            </a> -->
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="../images/avatar/1.jpg" alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">
                                                        Hi Teddy, Just wanted to let you ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="../images/avatar/2.jpg" alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">
                                                        Can you do me a favour?
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="../images/avatar/3.jpg" alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">
                                                        Hi Teddy, Just wanted to let you ...
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="../images/avatar/4.jpg" alt="" />
                                                <div class="notification-content">
                                                    <div class="notification-heading">
                                                        Hilari Clinton
                                                    </div>
                                                    <div class="notification-timestamp">
                                                        08 Hours ago
                                                    </div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
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
                        <!-- <li class="icons dropdown d-none d-md-flex">
                <a
                  href="javascript:void(0)"
                  class="log-user"
                  data-toggle="dropdown"
                >
                  <span>English</span>
                  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                </a>
                <div
                  class="drop-down dropdown-language animated fadeIn dropdown-menu"
                >
                  <div class="dropdown-content-body">
                    <ul>
                      <li><a href="javascript:void()">English</a></li>
                      <li><a href="javascript:void()">Dutch</a></li>
                    </ul>
                  </div>
                </div>
              </li> -->
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="../images/avatar/<?php echo decrypt_data($profile_image) ?>" height="40" width="40" alt="" />
                            </div>
                            <div class="drop-down dropdown-profile dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span><?php echo decrypt_data($user_name); ?></span></a>
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

                            <li><a href="./products.php">Products</a></li>
                            <li><a href="./orders.php">Orders</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="fals" style="background: #00FF7F">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Branch Management</span>
                        </a>
                        <ul aria-expanded="false" class="" style="background: #00FF7F">

                            <li><a href="./branches.php">Branches </a></li>
                            <li><a href="./branch_users.php">Users</a></li>
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
                    <h4 class="text-center text-success">Add new group member</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="javascript:void(0)">User form</a>
                        </li>
                    </ol>
                </div>
            </div> -->
            <!-- row -->

            <div class="container-fluid">
                <h4 class="text-center">Add new user</h4>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="../APIs/branch_user_api.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <input type="text" class="form-control" id="val-user-id" name="val-user-id" value="<?php echo $user_idd; ?>" hidden />

                                            <input type="text" class="form-control" id="action" name="action" value="<?php echo $action; ?>" hidden />

                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-branch-number">Branch number <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-branch-number" name="val-branch-number" placeholder="Enter branch number" value="<?php echo $branch_number; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-firstname">First name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-firstname" name="val-firstname" placeholder="Enter a first name" value="<?php echo $first_name; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-othernames">Other names <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-othernames" name="val-othernames" placeholder="Enter other names" value="<?php echo $second_name; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-email">Email <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-email" name="val-email" placeholder="Enter your valid email" value="<?php echo $user_email; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-telephone">Telephone <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-telephone" name="val-telephone" placeholder="Enter the user's telephone" value="<?php echo $user_telephone; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-gender">Gender <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select type="text" class="form-control" id="val-gender" name="val-gender">
                                                    <option value="">SELECT GENDER</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" <?php echo $password_status; ?>>
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-password">Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one.." />
                                            </div>
                                        </div>
                                        <div class="form-group row" <?php echo $password_status; ?>>
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-confirm-password">Confirm Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="Confirm password" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-address">Address <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" id="val-address" name="val-address" rows="5" placeholder="Enter your full address here."><?php echo $consumer_location; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-nationality">Nationality <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input class="form-control" id="val-nationality" name="val-nationality" placeholder="Enter user's nationality here" value="<?php echo $nationality; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-marital">Marital status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select type="text" class="form-control" id="val-marital" name="val-marital">
                                                    <option value="<?php echo $marital_status; ?>"><?php echo $marital_status; ?></option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-image">Profile Image <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" accept="image/*" class="form-control" id="val-image" name="val-image" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-identity-type">Identity Type <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select type="text" class="form-control" id="val-identity-type" name="val-identity-type">
                                                    <option value="<?php echo $identity_type; ?>"><?php echo $identity_type; ?></option>
                                                    <option value="National ID">Natinal ID</option>
                                                    <option value="Passport">Passport</option>
                                                    <option value="Driver's Licence">
                                                        Driver's Licence
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-identity-number">Identity Number <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-identity-number" name="val-identity-number" placeholder="Enter NIN / passprot number / driver's licence number" value="<?php echo $identity_number; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-date-of-birth">Date of birth <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" id="val-date-of-birth" name="val-date-of-birth" value="<?php echo $date_of_birth; ?>" />
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-occupation">Occupation <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-occupation" name="val-occupation" placeholder="Enter member's occupation here." value="<?php echo $occupation; ?>" />
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label text-right text-dark" for="val-user-category">User category <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">

                                                <select class="form-control" id="val-user-category" name="val-user-category">
                                                    <option value="">SELECT USER CATEGORY</option>
                                                    <option value="super admin">Super admin</option>
                                                    <option value="admin">Administrator</option>
                                                    <option value="data entrant">Data entrant</option>
                                                </select>
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

        <?php

        if (isset($_GET['status'])) {
        ?>

            <script>
                $(() => {
                    alert("<?php echo $_GET['message']; ?>");
                    let status = "<?php echo $_GET['status']; ?>";
                    if (status === "success") {
                        window.location.href = "./branch_users.php";
                    }
                })
            </script>

        <?php
        }
        ?>
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

    <script src="../plugins/validation/jquery.validate.min.js"></script>
    <script src="../plugins/validation/form-validation-consumer.js"></script>
</body>

</html>