<?php
include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];

  $group_result = $mysqli->query("SELECT * FROM consumer_group WHERE user_id=$user_id");
  $group_row = $group_result->fetch_array();
  $group_id = $group_row['group_id'];

  $consumer_result = $mysqli->query("SELECT * FROM consumer INNER JOIN User ON consumer.user_id = User.user_id WHERE group_id=$group_id");

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
  <title>Ukulima | Loans</title>
  <script src="../js/jquery.js"></script>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png" />
  <!-- Custom Stylesheet -->
  <link href="../plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/custom_css/savings.css" />
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
    <div class="nav-header" style="border-bottom: 2px solid #00ff7f; padding: 0; height: fit-content">
      <div class="brand-logo my-0 py-0" style="
            background-color: #ffffffff;
            border-bottom: 3px solid #00ff7f;
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
    <div class="header" style="border-bottom: 5px solid #00ff7f">
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
              </div>
            </li>
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
    <div class="nk-sidebar" style="background-color: #00ff7f;">
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
              <i class="fa fa-users menu-icon"></i><span class="nav-text">Group Management</span>
            </a>
            <ul aria-expanded="false" class="" style="background: #00FF7F;">
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
      <!-- <div class="row page-titles mx-0 px-4">
                <h4 class="text-center col-10"><?php echo $group_name; ?></h4>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <button class="btn btn-sm btn-warning" id="show_group_form">Register a group</button>
                        </li>
                    </ol>
                </div>
            </div> -->
      <!-- <div class="container px-4" id="consumer_group_form">
                <h3 class="text-center col-12">Consumer groups</h3>
                <form class="col-md-8">
                    <div class="form-group col-md-6 px-4 row">
                        <label class="col-md-12">Group name<span class="text-danger">*</span></label>
                        <input class="form-control" id="group_name" />
                        <small class="col-md-12"></small>
                    </div>
                    <div class="form-group col-md-6 px-4 row">
                        <label class="col-md-12">Registration type<span class="text-danger">*</span></label>
                        <select class="form-control" id="registration_type">
                            <option value="">Select registration type</option>
                            <option value="Company">Company</option>
                            <option value="NGO">NGO</option>
                            <option value="CBO">CBO</option>
                        </select>
                        <small class="col-md-12"></small>
                    </div>
                    <div class="form-group col-md-6 px-4 row">
                        <label class="col-md-12">Registration number<span class="text-danger">*</span></label>
                        <input class="form-control" id="registration_number" />
                        <small class="col-md-12"></small>
                    </div>
                    <div class="form-group col-md-6 px-4 row">
                        <label class="col-md-12">Group type<span class="text-danger">*</span></label>
                        <select class="form-control" id="group_type">
                            <option value="">Select group type</option>
                            <option value="VSLA">VSLA</option>
                            <option value="ASCA">ASCA</option>
                            <option value="ROSCA">ROSCA</option>
                            <option value="FM Grp">FM Grp</option>
                        </select>
                        <small class="col-md-12"></small>
                    </div>

                    <div class="form-group col-md-6 row">
                        <input type="submit" value="submit" id="register_group" class="btn btn-success col-md-12" />
                    </div>

                </form>
            </div> -->
      <!-- row -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Group loans</h4>
                <div class="table-responsive">
                  <div id="add_user">
                    <p class="badge badge-pill gradient-1" id="add_saving"><i class="btn btn-sm fa fa-plus fa-2x p-2" id="" data-toggle="tooltip" data-placement="top" title="Add a loan"></i></p>
                    <p class="badge badge-pill gradient-1" id="add_loan_payment"><i class="btn btn-sm fa fa-minus fa-2x p-2" id="" data-toggle="tooltip" data-placement="top" title="Add loan payment"></i></p>
                  </div>
                  <?php
                  // $total_result = $mysqli->query("SELECT SUM(savings_amount) AS total FROM savings");
                  // $total_row = $total_result->fetch_array();
                  // echo $total_row['total'];
                  while ($consumer_row = $consumer_result->fetch_array()) :
                    // $group_row = $group_result->fetch_array();
                    $consumer_id = $consumer_row['consumer_id'];
                    $consumer_name = $consumer_row['first_name'];
                    $savings_result = $mysqli->query("SELECT * FROM loan WHERE consumer_id=$consumer_id");

                    $total_result = $mysqli->query("SELECT SUM(savings_amount) AS total FROM loan WHERE consumer_id=$consumer_id");
                    $total_row = $total_result->fetch_array();

                  ?>
                    <div class="d-flex justify-space-between mt-4 alert alert-info" style="justify-content: space-between; align-items: center;">
                      <h6><?php echo decrypt_data($consumer_row['first_name']) . " " . decrypt_data($consumer_row['last_name']) . " : " . decrypt_data($consumer_row['user_telephone']); ?></h6>
                      <h6>Total loan <?php echo " : " . number_format($total_row['total']); ?></h6>
                      <i class="fa fa-angle-right btn" style="font-size: 19px;color: black"></i>
                    </div>
                    <div id="consumer_group">
                      <table class="table table-bordered zero-configuration">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Taken by (name)</th>
                            <th>Taken by (phone number)</th>
                            <th>savings</th>
                            <!-- <th>Loan</th> -->
                            <!-- <th>Action</th> -->
                            <!-- <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th> -->
                          </tr>
                        </thead>

                        <tbody>
                          <?php while ($savings_row = $savings_result->fetch_array()) : ?>
                            <tr>
                              <td><?php echo $savings_row['savings_date']; ?></td>
                              <td><?php echo number_format($savings_row['savings_amount']); ?></td>
                              <td><?php echo decrypt_data($savings_row['brought_by_name']); ?></td>
                              <td><?php echo decrypt_data($savings_row['brought_by_phone']); ?></td>
                              <td>0</td>
                              <!-- <td>Online</td> -->
                              <!-- <td id="action_buttons">
                                                                <i class="fa fa-info btn btn-info" id="show-user-details<?php echo $user_row['user_id']; ?>" data-toggle="tooltip" data-placement="top" title="Details"></i>
                                                                <a href="./group_member_form.php?edit_member=2&user_id=<?php echo $user_row['user_id']; ?>&group_id=<?php echo $user_row['group_id']; ?>"><i class="fa fa-pencil btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                                <i class="fa fa-trash btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" id="delete_member<?php echo $user_row['user_id']; ?>"></i>
                                                            </td> -->
                            </tr>


                          <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Taken by (name)</th>
                            <th>Taken by (phone number)</th>
                            <th>Savings</th>
                            <!-- <th>Loan</th> -->
                            <!-- <th>Action</th> -->
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  <?php endwhile; ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="user-details">
        <div class="details-inner bg-light alert container my-4 mt-4 p-4 col-md-8">
          <i class="fa fa-times fa-2x" id="close-user"></i>
          <div class="d-flex justify-content-center align-items-center mx-4" style="position: relative;">
            <form class="col-md-6">
              <h4 class="text-center col-md-8 py-4">Add a member's loan</h4>
              <div class="form-group row">
                <label>Member's phone number <span class="text-danger">*</span></label>
                <input class="form-control" id="phone_number" />
                <small>error</small>
              </div>
              <div class="form-group row">
                <label>Amount <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="savings_amount" />
                <small>error</small>
              </div>
              <div class="form-group row">
                <label>Date <span class="text-danger">*</span></label>
                <input type="date" class=" form-control" id="savings_date" />
                <small>error</small>
              </div>
              <h4 class="text-success text-center my-4" id="next_of_kin">Signed by</h4>
              <div class="form-group row">
                <label>Full name <span class="text-danger">*</span></label>
                <input class="form-control" id="brought_full_name" />
                <small>error</small>
              </div>
              <div class="form-group row">
                <label>Phone number <span class="text-danger">*</span></label>
                <input class="form-control" id="brought_phone_number" />
                <small>error</small>
              </div>
              <div class="form-group row">
                <input type="submit" class="form-control btn btn-success btn-sm" id="save_saving" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- #/ container -->
  </div>
  <?php
  if (isset($_GET['error'])) {
  ?>
    <script>
      $(() => {
        alert("<?php echo $_GET['error']; ?>");
        window.location.href = "./consumer_group.php";
      })
    </script>
  <?php
  }
  ?>
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

  <!--**********************************
        Scripts
    ***********************************-->
  <script src="../plugins/common/common.min.js"></script>
  <script src="../js/custom.min.js"></script>
  <script src="../js/bootstrap/bootstrap.min.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/gleek.js"></script>
  <script src="../js/styleSwitcher.js"></script>
  <script src="../js/custom_js/loans.js"></script>

  <script src="../plugins/tables/js/jquery.dataTables.min.js"></script>
  <script src="../plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>