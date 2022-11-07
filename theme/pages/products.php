<?php

include "../objects/product_object.php";
session_start();
if (isset($_SESSION['user_id'])) {
  $user_name = $_SESSION['user_name'];
} else {
  header("Location: ../../index.php");
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
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.PNG" />
  <!-- Custom Stylesheet -->
  <link href="../plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/custom_css/products.css" />
</head>

<body>
  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="loader">
      <img src="../assets/logo.PNG" alt="" class="logo" />
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
            <!-- <li class="icons dropdown">
                <a href="javascript:void(0)" data-toggle="dropdown">
                  <i class="mdi mdi-email-outline"></i>
                  <span class="badge gradient-1 badge-pill badge-primary"
                    >3</span
                  >
                </a>
                <div class="drop-down animated fadeIn dropdown-menu">
                  <div
                    class="dropdown-content-heading d-flex justify-content-between"
                  >
                    <span class="">3 New Messages</span>
                  </div>
                  <div class="dropdown-content-body">
                    <ul>
                      <li class="notification-unread">
                        <a href="javascript:void()">
                          <img
                            class="float-left mr-3 avatar-img"
                            src="images/avatar/1.jpg"
                            alt=""
                          />
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
                          <img
                            class="float-left mr-3 avatar-img"
                            src="images/avatar/2.jpg"
                            alt=""
                          />
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
                          <img
                            class="float-left mr-3 avatar-img"
                            src="images/avatar/3.jpg"
                            alt=""
                          />
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
                          <img
                            class="float-left mr-3 avatar-img"
                            src="images/avatar/4.jpg"
                            alt=""
                          />
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
              </li> -->
            <li class="icons dropdown" title="Notifications" data-toggle="tooltip" data-placement="top">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="badge badge-pill gradient-2 badge-primary">3</span>
              </a>
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
                    <li>
                      <a href="email-inbox.html"><i class="icon-envelope-open"></i> <span>Inbox</span>
                        <div class="badge gradient-3 badge-pill badge-primary">
                          3
                        </div>
                      </a>
                    </li>

                    <hr class="my-2" />
                    <li>
                      <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                    </li>
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
    <div class="nk-sidebar bg-success">
      <div class="nk-nav-scroll bg-success">
        <ul class="metismenu bg-success" id="menu">
          <li class="nav-label">Dashboard</li>
          <li>
            <a class="has-arrow bg-success" href="javascript:void()" aria-expanded="fals">
              <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
            </a>
            <ul aria-expanded="false" class="bg-success">
              <li><a href="./home.php">Home</a></li>
              <li><a href="./Admin_users.php">Users</a></li>
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
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
              <a href="javascript:void(0)">Products</a>
            </li>
          </ol>
        </div>
      </div>
      <!-- row -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Products</h4>
                <div class="table-responsive">
                  <div id="add_product">
                    <a href="./Add_product.php" class="badge badge-pill gradient-1"><i class="fa fa-plus fa-2x  p-2" id="" data-toggle="tooltip" data-placement="top" title="Add product"></i></a>
                    <a href="./Add_product.php" class="badge badge-pill gradient-3"><i class="fa fa-upload fa-2x p-2" id="" data-toggle="tooltip" data-placement="top" title="Upload list"></i></a>
                    <a href="./Add_product.php" class="badge badge-pill gradient-4"><i class="fa fa-download fa-2x p-2" id="" data-toggle="tooltip" data-placement="top" title="Download list"></i></a>
                  </div>
                  <table class="table table-striped table-bordered zero-configuration">
                    <thead>
                      <tr>
                        <th>Product ID</th>
                        <th>Brand Name</th>
                        <th>Batch number</th>
                        <th>Serial number</th>
                        <th>Date of manufacture</th>
                        <th>Expiry date</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $i = 1;
                      while ($product_row = $product_result->fetch_array()) :
                        $i += 1;
                        $product_status = "";
                        $status_title = "";
                        if ($i % 3 == 0) {
                          $product_status = "text-warning";
                          $status_title = "Soon expiring";
                        } else if ($i % 7 == 0) {
                          $product_status = "text-danger";
                          $status_title = "Expired";
                        } else {
                          $product_status = "text-success";
                          $status_title = "Current";
                        }
                      ?>
                        <tr>
                          <td>Prod-<?php echo $product_row['product_id']; ?></td>
                          <td><?php echo decrypt_data($product_row['brand_name']); ?></td>
                          <td><?php echo decrypt_data($product_row['batch_number']); ?></td>
                          <td><?php echo decrypt_data($product_row['serial_number']); ?></td>
                          <td><?php echo $product_row['date_of_manufacture']; ?></td>
                          <td class="badge-pill text-center <?php echo $product_status; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $status_title; ?>">
                            <?php echo $product_row['product_expiry_date']; ?>
                          </td>
                          <td id="action_buttons">
                            <i class="fa fa-info btn btn-info" id="show-user-details<?php echo $product_row['product_id']; ?>" data-toggle="tooltip" data-placement="top" title="Details"></i>
                            <a href="./Add_product.php?product_id=<?php echo $product_row['product_id']; ?>"><i class="fa fa-pencil btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                            <i class="fa fa-trash btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" id="delete_product<?php echo $product_row['product_id']; ?>"></i>
                          </td>
                        </tr>

                        <script>
                          $(() => {
                            $("#show-user-details<?php echo $product_row['product_id']; ?>").on('click', function() {
                              $("#product-details").addClass("show");
                              $("#p_product_id").text("Prod-<?php echo $product_row['product_id']; ?>");
                              $("#p_brand_name").text("<?php echo decrypt_data($product_row['brand_name']); ?>");
                              $("#p_manufacturer").text("<?php echo decrypt_data($product_row['product_manufacturer']); ?>");
                              $("#p_supplier").text("<?php echo decrypt_data($product_row['product_supplier']); ?>");
                              $("#p_point_of_origin").text("<?php echo decrypt_data($product_row['point_of_origin']); ?>");
                              $("#p_date_of_manufacture").text("<?php echo $product_row['date_of_manufacture']; ?>");
                              $("#p_expiry_date").text("<?php echo $product_row['product_expiry_date']; ?>");
                              $("#p_unit_of_measure").text("<?php echo decrypt_data($product_row['unit_of_measure']); ?>");
                              $("#p_batch_number").text("<?php echo decrypt_data($product_row['batch_number']); ?>");
                              $("#p_serial_number").text("<?php echo decrypt_data($product_row['serial_number']); ?>");
                              $("#p_unit_cost").text("<?php echo  decrypt_data($product_row['unit_cost']); ?>");
                              $("#p_user_guid").text("<?php echo decrypt_data($product_row['user_guid']); ?>");

                              $("#product_image").attr("src", "../assets/product_images/<?php echo decrypt_data($product_row['product_image']); ?>");

                            })

                            $("#close-user").on('click', () => {
                              $("#product-details").removeClass("show");
                            })


                            $("#delete_product<?php echo $product_row['product_id']; ?>").on('click', () => {
                              var choise = confirm("Confirm to delete this product!");
                              if (choise === true) {
                                $.ajax({
                                  url: "../APIs/products_api.php",
                                  type: "POST",
                                  dataType: "JSON",
                                  data: {
                                    delete_product: "delete_product",
                                    product_id: "<?php echo $product_row['product_id']; ?>",
                                  },
                                  Cache: false,
                                  success: (res) => {
                                    $("#message_div").addClass("active");
                                    $("#alert_msg").text("Product deleted successfully");
                                    $("#ok").on('click', () => {
                                      $("#message_div").removeClass("active");
                                      window.location.href = "./products.php";
                                    })
                                  },
                                })
                              }
                            })
                          })
                        </script>

                      <?php endwhile; ?>


                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Product ID</th>
                        <th>Brand Name</th>
                        <th>Batch number</th>
                        <th>Serial number</th>
                        <th>Date of manufacture</th>
                        <th>Expiry date</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="product-details">
        <div class="details-inner bg-light alert container py-5 pt-5h">
          <i class="fa fa-times fa-2x" id="close-user"></i>
          <div class="row justify-content-center align-content-center py-5">
            <div class="left col-md-4">
              <h1 class="text-success text-center">Product details</h1>
              <img class="col-12" id="product_image" />
              <!-- <div class="col-12 row justify-content-center my-3 py-4">
                <a href="" class="btn btn-danger mx-1">Delete</a>
                <a href="./Add_product.php" class="btn btn-info mx-1">Edit</a>
              </div> -->
            </div>
            <div class="right col-md-6 row justify-content-left">
              <div class="left text-right alert col-6">
                <p><b>Product ID: </b></p>
                <p><b>Brand Name: </b></p>
                <p><b>Manufacturer: </b></p>
                <p><b>Registered supplier: </b></p>
                <p><b>Point of origin: </b></p>
                <p><b>Date of manufacture: </b></p>
                <p><b>Expiry date: </b></p>
                <p><b>Unit of measure: </b></p>
                <p><b>Batch number: </b></p>
                <p><b>Serial number: </b></p>
                <p><b>Unit cost: </b></p>
                <p><b>E-Extension: </b></p>
              </div>
              <div class="right alert col-6">
                <p id="p_product_id">Prod-0001</p>
                <p id="p_brand_name">Weed master</p>
                <p id="p_manufacturer">Kakoola Ug ltd</p>
                <p id="p_supplier">K&M Traders</p>
                <p id="p_point_of_origin">Mukono industrial Area</p>
                <p id="p_date_of_manufacture">25th/06/2022</p>
                <p id="p_expiry_date">23th/06/2023</p>
                <p id="p_unit_of_measure">1.5ltr</p>
                <p id="p_batch_number">44545Y64</p>
                <p id="p_serial_number">RUE4466564RTT56</p>
                <p id="p_unit_cost">UGX. 17500</p>

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
          <a href="https://themeforest.net/user/quixlab">Anatoli</a> 2022
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


  <div id="message_div">
    <div class="alert msg row justify-center">
      <i class="fa fa-check fa-4x col-12 text-center" id="alert_icon"></i>
      <p class="text-center col-12" id="alert_msg">Sign up successfull</p>
      <input type="submit" id="ok" class="btn btn-primary m-auto" value="Ok" />
    </div>
    </dive>


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
          })
        });
      </script>

    <?php
      if ($_GET['status'] == "error") {
        $icon = "fa-warning";
      } else {
        $icon = "fa-check";
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
      <script src="../js/custom_js/products.js"></script>

      <script src="../plugins/tables/js/jquery.dataTables.min.js"></script>
      <script src="../plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
      <script src="../plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>