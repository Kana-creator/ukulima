<?php
include "../objects/product_object.php";
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
} else {
  header("Location: ../APIs/logout_api.php");
}
if (isset($_GET['product_id'])) {
  $product_result = $mysqli->query("SELECT * FROM product WHERE product_id=" . $_GET['product_id'] . "");
  $product_row = $product_result->fetch_array();
  $product_id = $product_row['product_id'];
  $brand_name = decrypt_data($product_row['brand_name']);
  $product_manufacturer = decrypt_data($product_row['product_manufacturer']);
  $product_supplier = decrypt_data($product_row['product_supplier']);
  $point_of_origin = decrypt_data($product_row['point_of_origin']);
  $date_of_manufacture = $product_row['date_of_manufacture'];
  $expiry_date = $product_row['product_expiry_date'];
  $product_image = decrypt_data($product_row['product_image']);
  $unit_of_measure = decrypt_data($product_row['unit_of_measure']);
  $batch_number = decrypt_data($product_row['batch_number']);
  $serial_number = decrypt_data(($product_row['serial_number']));
  $unit_cost = decrypt_data($product_row['unit_cost']);
  $user_guid = decrypt_data($product_row['user_guid']);
} else {
  $product_id = "";
  $brand_name = "";
  $product_manufacturer = "";
  $product_supplier = "";
  $point_of_origin = "";
  $date_of_manufacture = "";
  $expiry_date = "";
  $product_image = "";
  $unit_of_measure = "";
  $batch_number = "";
  $serial_number = "";
  $unit_cost = "";
  $user_guid = "";
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
              <!-- <li><a href="./home.php">Home</a></li> -->
              <!-- <li><a href="./consumer_group.php">Group</a></li> -->
              <!-- <li><a href="./products.php">Products</a></li> -->
              <!-- <li><a href="./savings.php">Savings</a></li> -->
              <!-- <li><a href="./loans.php">Loans</a></li> -->
              <li><a href="./products.php">Products</a></li>
              <li><a href="./orders.php">Orders</a></li>
            </ul>
          </li>
          <!-- <li class="mega-menu mega-menu-sm">
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-globe-alt menu-icon"></i
                ><span class="nav-text">Layouts</span>
              </a>
              <ul aria-expanded="false">
                <li><a href="./layout-blank.html">Blank</a></li>
                <li><a href="./layout-one-column.html">One Column</a></li>
                <li><a href="./layout-two-column.html">Two column</a></li>
                <li><a href="./layout-compact-nav.html">Compact Nav</a></li>
                <li><a href="./layout-vertical.html">Vertical</a></li>
                <li><a href="./layout-horizontal.html">Horizontal</a></li>
                <li><a href="./layout-boxed.html">Boxed</a></li>
                <li><a href="./layout-wide.html">Wide</a></li>

                <li><a href="./layout-fixed-header.html">Fixed Header</a></li>
                <li><a href="layout-fixed-sidebar.html">Fixed Sidebar</a></li>
              </ul>
            </li>
            <li class="nav-label">Apps</li>
            <li>
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-envelope menu-icon"></i>
                <span class="nav-text">Email</span>
              </a>
              <ul aria-expanded="false">
                <li><a href="./email-inbox.html">Inbox</a></li>
                <li><a href="./email-read.html">Read</a></li>
                <li><a href="./email-compose.html">Compose</a></li>
              </ul>
            </li>
            <li>
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-screen-tablet menu-icon"></i
                ><span class="nav-text">Apps</span>
              </a>
              <ul aria-expanded="false">
                <li><a href="./app-profile.html">Profile</a></li>
                <li><a href="./app-calender.html">Calender</a></li>
              </ul>
            </li>
            <li>
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-graph menu-icon"></i>
                <span class="nav-text">Charts</span>
              </a>
              <ul aria-expanded="false">
                <li><a href="./chart-flot.html">Flot</a></li>
                <li><a href="./chart-morris.html">Morris</a></li>
                <li><a href="./chart-chartjs.html">Chartjs</a></li>
                <li><a href="./chart-chartist.html">Chartist</a></li>
                <li><a href="./chart-sparkline.html">Sparkline</a></li>
                <li><a href="./chart-peity.html">Peity</a></li>
              </ul>
            </li>
            <li class="nav-label">UI Components</li>
            <li>
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-grid menu-icon"></i
                ><span class="nav-text">UI Components</span>
              </a>
              <ul aria-expanded="false">
                <li><a href="./ui-accordion.html">Accordion</a></li>
                <li><a href="./ui-alert.html">Alert</a></li>
                <li><a href="./ui-badge.html">Badge</a></li>
                <li><a href="./ui-button.html">Button</a></li>
                <li><a href="./ui-button-group.html">Button Group</a></li>
                <li><a href="./ui-cards.html">Cards</a></li>
                <li><a href="./ui-carousel.html">Carousel</a></li>
                <li><a href="./ui-dropdown.html">Dropdown</a></li>
                <li><a href="./ui-list-group.html">List Group</a></li>
                <li><a href="./ui-media-object.html">Media Object</a></li>
                <li><a href="./ui-modal.html">Modal</a></li>
                <li><a href="./ui-pagination.html">Pagination</a></li>
                <li><a href="./ui-popover.html">Popover</a></li>
                <li><a href="./ui-progressbar.html">Progressbar</a></li>
                <li><a href="./ui-tab.html">Tab</a></li>
                <li><a href="./ui-typography.html">Typography</a></li>
                <!-</ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-layers menu-icon"></i><span class="nav-text">Components</span>
                        </a>
                        <ul aria-expanded="false"> 
                <li><a href="./uc-nestedable.html">Nestedable</a></li>
                <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                <li><a href="./uc-toastr.html">Toastr</a></li>
              </ul>
            </li>
            <li>
              <a href="widgets.html" aria-expanded="false">
                <i class="icon-badge menu-icon"></i
                ><span class="nav-text">Widget</span>
              </a>
            </li>
            <li class="nav-label">Forms</li>
            <li>
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-note menu-icon"></i
                ><span class="nav-text">Forms</span>
              </a>
              <ul aria-expanded="false">
                <li><a href="./form-basic.html">Basic Form</a></li>
                <li><a href="./form-validation.html">Form Validation</a></li>
                <li><a href="./form-step.html">Step Form</a></li>
                <li><a href="./form-editor.html">Editor</a></li>
                <li><a href="./form-picker.html">Picker</a></li>
              </ul>
            </li>
            <li class="nav-label">Table</li>
            <li>
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-menu menu-icon"></i
                ><span class="nav-text">Table</span>
              </a>
              <ul aria-expanded="false">
                <li>
                  <a href="./table-basic.html" aria-expanded="false"
                    >Basic Table</a
                  >
                </li>
                <li>
                  <a href="./table-datatable.html" aria-expanded="false"
                    >Data Table</a
                  >
                </li>
              </ul>
            </li>
            <li class="nav-label">Pages</li>
            <li>
              <a
                class="has-arrow"
                href="javascript:void()"
                aria-expanded="false"
              >
                <i class="icon-notebook menu-icon"></i
                ><span class="nav-text">Pages</span>
              </a>
              <ul aria-expanded="false">
                <li><a href="./page-login.html">Login</a></li>
                <li><a href="./page-register.html">Register</a></li>
                <li><a href="./page-lock.html">Lock Screen</a></li>
                <li>
                  <a
                    class="has-arrow"
                    href="javascript:void()"
                    aria-expanded="false"
                    >Error</a
                  >
                  <ul aria-expanded="false">
                    <li><a href="./page-error-404.html">Error 404</a></li>
                    <li><a href="./page-error-403.html">Error 403</a></li>
                    <li><a href="./page-error-400.html">Error 400</a></li>
                    <li><a href="./page-error-500.html">Error 500</a></li>
                    <li><a href="./page-error-503.html">Error 503</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
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
          <?php if (isset($_GET['product_id'])) : ?>
            <h4 class="text-center text-success">Edit Product Info</h4>
          <?php else : ?>

            <h4 class="text-center text-success">Add New Product</h4>
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
                  <form class="form-valide" action="../APIs/products_api.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="product_id" value="<?php echo $product_id; ?>" hidden />
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-brand-name">Brand name <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-brand-name" name="val-brand-name" placeholder="Enter a Brand name here" value="<?php echo $brand_name; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-manufacturer">Manufacturer <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-manufacturer" name="val-manufacturer" placeholder="Enter manufacturer here." value="<?php echo $product_manufacturer; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-supplier">Registered distributer / supplier<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-supplier" name="val-supplier" placeholder="Enter registered supplier here" value="<?php echo $product_supplier; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-point-of-origin">Point of Origin <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-point-of-origin" name="val-point-of-origin" placeholder="Enter product point of origin here." value="<?php echo $point_of_origin; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-date-of-manufacture">Date of manufacture
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="date" class="form-control" id="val-date-of-manufacture" name="val-date-of-manufacture" value="<?php echo $date_of_manufacture; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-date-of-expiry">Expiry date <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="date" class="form-control" id="val-date-of-expiry" name="val-date-of-expiry" value="<?php echo $expiry_date; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-product-image">Product Image <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="file" accept="image/*" class="form-control" id="val-product-image" name="val-product-image" value="<?php echo $product_image; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-confirm-password">Unit of measure <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <select class="form-control">
                          <option value="">Select unit of measure</option>
                          <option value="ltr">Litres</option>
                          <option value="ml">Miligrams</option>
                          <option value="g">Gramms</option>
                          <option value="Kg">Killogram</option>
                          <!-- <option value="">Select unit of measure</option>
                          <option value="">Select unit of measure</option>
                          <option value="">Select unit of measure</option> -->
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-confirm-password">Unit of measure <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-unit-of-measure" name="val-unit-of-measure" placeholder="Enter product unit of measure" value="<?php echo $unit_of_measure; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-batch-number">Batch number <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-batch-number" name="val-batch-number" placeholder="Enter batch number." value="<?php echo $batch_number; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-serial-number">Serial number <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="text" class="form-control" id="val-serial-number" name="val-serial-number" placeholder="Enter product serial number" value="<?php echo $serial_number; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-serial-number">Product Category<span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <select class="form-control" id="val-product-category" name="val-product-category">">
                          <option value="">Select product category</option>
                          <option value="animal husbandry">Animal husbandry</option>
                          <option value="crop husbandry">Crop husbandry</option>
                          <option value="aquar calture ">Aquar calture</option>
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-unit-cost">Unit cost <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <input type="number" class="form-control" id="val-unit-cost" name="val-unit-cost" placeholder="Enter product Unit cost" value="<?php echo $unit_cost; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-4 col-form-label text-right" for="val-e-extension">How to use the product
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-lg-6 inner-group">
                        <textarea class="form-control" id="val-e-extension" name="val-e-extension" rows="10" placeholder="Enter the product e-extension (How to use the product)"><?php echo $user_guid; ?></textarea>
                      </div>
                    </div>
                    <?php if (isset($_GET['product_id'])) : ?>
                      <div class="form-group row">
                        <div class="col-lg-8 ml-auto">
                          <input type="submit" class="btn btn-success" id="add_product" name="edit_product" value="Submit" />
                        </div>
                      </div>
                    <?php else : ?>
                      <div class="form-group row">
                        <div class="col-lg-8 ml-auto">
                          <input type="submit" class="btn btn-success" id="add_product" name="add_product" value="Submit" />
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

  if (isset($_GET['action'])) {
    $status = $_GET['status'];
  ?>
    <script>
      $(() => {
        $('#message_div').addClass('active');
        $("#alert_msg").text("<?php echo $_GET['message']; ?>");

        $("#ok").on('click', () => {
          $('#message_div').removeClass('active');
          var action = "<?php echo $_GET['status']; ?>";
          if (action === 'success') {
            window.location.href = "./products.php";
          } else {
            window.location.href = "./Add_product.php";
          }
        })
      });
    </script>

  <?php
    if ($_GET['status'] == "error") {
      $icon = "fa-warning";
    } else {
      $icon = "fa-check";
    }

    if ($_GET['action'] == 'edit') {
      header("Location: ./products.php");
    }
  }

  ?>



  <div id="message_div">
    <div class="alert msg row justify-center">
      <i class="fa <?php echo $icon; ?> fa-4x col-12 text-center" id="alert_icon"></i>
      <p class="text-center col-12" id="alert_msg">Sign up successfull</p>
      <input type="submit" id="ok" class="btn btn-primary m-auto" value="Ok" />
    </div>
    </dive>



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