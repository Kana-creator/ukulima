<?php
include "../objects/product_object.php";
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
} else {
  header("Location: ../APIs/logout_api.php");
}
if (isset($_GET['branch_id'])) {
  $branch_result = $mysqli->query("SELECT * FROM branch WHERE branch_id=" . $_GET['branch_id'] . "");
  $branch_row = $branch_result->fetch_array();

  $branch_id = $branch_row['branch_id'];
  $branch_name = decrypt_data($branch_row['branch_name']);
  $branch_number = decrypt_data($branch_row['branch_number']);
  $branch_address = decrypt_data($branch_row['branch_address']);
  $agency_number = decrypt_data($branch_row['agency_number']);
  $contact_name = decrypt_data($branch_row['contact_name']);
  $contact_number = decrypt_data($branch_row['contact_number']);
  $contact_email = decrypt_data($branch_row['email_address']);
  $branch_location = $branch_row['branch_location'];
} else {
  $branch_id = "";
  $branch_name = "";
  $branch_number = "";
  $branch_address = "";
  $agency_number = "";
  $contact_name = "";
  $contact_number = "";
  $contact_email = "";
  $branch_location = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Ukulima</title>
  <script src="../js/jquery.js"></script>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png" />
  <!-- Custom Stylesheet -->
  <link href="../css/style.css" rel="stylesheet" />
  <link href="../css/custom_css/add_product.css" rel="stylesheet" />
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
        <a href="./home.php">
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
                <img src="../images/user/1.png" height="40" width="40" alt="" />
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
          <li class="nav-label">Dashboard</li>
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
      <div class="row page-titles mx-0">
        <div class="col p-md-0">
          <?php if (isset($_GET['branch_id'])) : ?>
            <h4 class="text-center text-success">Edit Branch Info</h4>
          <?php else : ?>

            <h4 class="text-center text-success">Add New Branch</h4>
          <?php endif; ?>
          <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
              <a href="javascript:void(0)">Product form</a>
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
                  <form class="form-valide" action="../APIs/branches_api.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="branch_id" value="<?php echo $branch_id; ?>" hidden />
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-branch-number">Branch number <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-branch-number" name="val-branch-number" placeholder="Enter a Branch number here" value="<?php echo $branch_number; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-branch-name">Branch name <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-branch-name" name="val-branch-name" placeholder="Enter branch name here." value="<?php echo $branch_name; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-agency-number">Agency number<span class="text-danger"></span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-agency-number" name="val-agency-number" placeholder="Enter registered agency-number here" value="<?php echo $agency_number; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-branch-address">Branch address <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-branch-address" name="val-branch-address" placeholder="Enter product point of origin here." value="<?php echo $branch_address; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-contact-name">Contact name
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-contact-name" name="val-contact-name" placeholder="Enter contact name here." value="<?php echo $contact_name; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-contact-number">Contact number <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-contact-number" name="val-contact-number" placeholder="Enter contact number here." value="<?php echo $contact_number; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-contact-email">Contact email <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-contact-email" placeholder="Enter contact email here." name="val-contact-email" value="<?php echo $contact_email; ?>" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-branch-location">Branch location <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <select class="form-control" id="val-branch-location" name="val-branch-location">
                          <option value="urban">Urban</option>
                          <option value="rural">Rural</option>
                        </select>
                      </div>
                    </div>

                    <?php if (isset($_GET['branch_id'])) : ?>
                      <div class="form-group row">
                        <div class="col-lg-8 ml-auto">
                          <input type="submit" class="btn btn-success" id="edit_branch" name="edit_branch" value="Submit" />
                        </div>
                      </div>
                    <?php else : ?>
                      <div class="form-group row">
                        <div class="col-lg-8 ml-auto">
                          <input type="submit" class="btn btn-success" id="add_branch" name="add_branch" value="Submit" />
                        </div>
                      </div>
                    <?php endif; ?>
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
    <div class=" footer">
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


  <?php

  if (isset($_GET['status'])) {
    $status = $_GET['status'];
  ?>
    <script>
      $(() => {
        alert("<?php echo $_GET['message']; ?>");
        //   $('#message_div').addClass('active');
        //   $("#alert_msg").text("<?php echo $_GET['message']; ?>");

        //   $("#ok").on('click', () => {
        //     $('#message_div').removeClass('active');
        var status = "<?php echo $_GET['status']; ?>";
        if (status === 'success') {
          window.location.href = "./branches.php";
        } else {
          window.location.href = "./add_branch.php?branch_id=<?php echo $branch_id; ?>";
        }
        //   })
      });
    </script>

  <?php

  }

  ?>



  <div id="message_div">
    <div class="alert msg row justify-center">
      <i class="fa <?php echo $icon; ?> fa-4x col-12 text-center" id="alert_icon"></i>
      <p class="text-center col-12" id="alert_msg">Sign up successfull</p>
      <input type="submit" id="ok" class="btn btn-primary m-auto" value="Ok" />
    </div>
  </div>



  <!--**********************************
        Scripts
    ***********************************-->
  <script src="../plugins/common/common.min.js"></script>
  <script src="../js/custom.min.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/gleek.js"></script>
  <script src="../js/styleSwitcher.js"></script>
  <!-- <script src="../js/custom_js/products.js"></script> -->

  <script src="../plugins/validation/jquery.validate.min.js"></script>
  <script src="../plugins/validation/form-validation-product.js"></script>

</body>

</html>