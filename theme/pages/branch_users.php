<?php
// include "../objects/user_object.php";
include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";

session_start();
if (isset($_SESSION['user_id'])) {
  $user_name = $_SESSION['user_name'];
  $user_id = $_SESSION['user_id'];
  $user_category = $_SESSION['user_category'];

  if ($user_category == "producer") {
    $user_result = $mysqli->query("SELECT * FROM branch INNER JOIN producer ON branch.branch_id=producer.branch_id INNER JOIN User ON producer.user_id=User.user_id");
  } else {
    // $user_result = $mysqli->query("SELECT * FROM User INNER JOIN supplier ON User.user_id=supplier.user_id");
    $user_result = $mysqli->query("SELECT * FROM branch INNER JOIN supplier ON branch.branch_id=supplier.branch_id INNER JOIN User ON supplier.user_id=User.user_id");
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
  <title>Ukulima | Users</title>
  <script src="../js/jquery.js"></script>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png" />
  <!-- Custom Stylesheet -->
  <link href="../plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/custom_css/admin_users.css" />
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
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
              <a href="javascript:void(0)">users</a>
            </li>
          </ol>
        </div>
      </div> -->
      <!-- row -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Users</h4>
                <div class="table-responsive">
                  <div id="add_user">
                    <a href="./add_branch_user.php" class="badge badge-pill gradient-1"><i class="fa fa-plus fa-2x p-2 btn btn-sm" id="" data-toggle="tooltip" data-placement="top" title="Add user"></i></a>
                  </div>
                  <table class="table table-striped table-bordered zero-configuration">
                    <thead>
                      <tr>
                        <th>Branch number</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                        <!-- <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th> -->
                      </tr>
                    </thead>

                    <tbody>
                      <?php while ($user_row = $user_result->fetch_array()) : ?>
                        <tr>
                          <td><?php echo decrypt_data($user_row['branch_number']); ?></td>
                          <td><?php echo decrypt_data($user_row['first_name']) . " " . decrypt_data($user_row['last_name']); ?></td>
                          <td><?php echo $user_row['user_gender']; ?></td>
                          <td><?php echo decrypt_data($user_row['user_telephone']); ?></td>
                          <td><?php echo decrypt_data($user_row['user_email']); ?></td>
                          <td>Online</td>
                          <td id="action_buttons">
                            <i class="fa fa-info btn btn-info" id="show-user-details<?php echo $user_row['user_id']; ?>" data-toggle="tooltip" data-placement="top" title="Details"></i>
                            <a href="./add_branch_user.php?edit_user&user_id=<?php echo $user_row['user_id']; ?>&branch_id=<?php echo $user_row['branch_id']; ?>"><i class="fa fa-pencil btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>

                            <i class="fa fa-trash btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" id="delete_user<?php echo $user_row['user_id']; ?>"></i>
                          </td>
                        </tr>

                        <script>
                          $(() => {
                            $("#show-user-details<?php echo $user_row['user_id']; ?>").on('click', () => {
                              $("#user-details").addClass("show");
                              $("#user_id").text("<?php echo 'User_' . $user_row['user_id']; ?>");
                              $("#user_name").text("<?php echo decrypt_data($user_row['first_name']); ?> <?php echo decrypt_data($user_row['last_name']); ?>");
                              $("#user_email").text("<?php echo decrypt_data($user_row['user_email']); ?>");
                              $("#telephone").text("<?php echo decrypt_data($user_row['user_telephone']); ?>");
                              $("#gender").text("<?php echo $user_row['user_gender']; ?>");
                              $("#user_type").text("<?php echo $user_row['user_type']; ?>");
                            });

                            $("#delete_user<?php echo $user_row['user_id']; ?>").on('click', () => {
                              var confirm_delete = confirm("Are you sure you want to delete this user?");
                              if (confirm_delete === true) {
                                $.ajax({
                                  url: "../APIs/branch_user_api.php",
                                  type: "POST",
                                  dataType: "JSON",
                                  data: {
                                    delete_user: "",
                                    user_id: "<?php echo $user_row['user_id']; ?>"
                                  },
                                  Cache: false,
                                  success: res => {
                                    alert(res['message']);
                                    window.location.href = "./branch_users.php";
                                  }
                                })
                              }

                            })

                          })
                        </script>
                      <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Branch number</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Status</th>
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
      <div id="user-details">
        <div class="details-inner bg-light alert container my-4 mt-4 py-4 col-md-8">
          <i class="fa fa-times fa-2x" id="close-user"></i>
          <div class="row justify-content-center align-content-center py-5">
            <div class="left col-md-4">
              <h1 class="text-center text-success">User details</h1>
              <img src="../images/users/2.jpg" class="col-12" />
              <!-- <div class="col-md--12 row justify-content-center my-3 py-4">
                <a href="" class="btn btn-danger mx-1 p-2">Block</a>
                <a href="../add_admin_user" class="btn btn-info mx-1 p-2">Edit</a>
                <a href="" class="btn btn-danger mx-1 p-2">Delete</a>
              </div> -->
            </div>
            <div class="right col-md-6 row justify-content-left">
              <div class="left text-right alert col-6">
                <p><b>User_id: </b></p>
                <p><b>Name: </b></p>
                <p><b>Email: </b></p>
                <p><b>Telephone: </b></p>
                <p><b>Gender: </b></p>
                <!-- <p><b>Address: </b></p> -->
                <!-- <p><b>Nationality: </b></p> -->
                <!-- <p><b>Marital status: </b></p> -->
                <!-- <p><b>Identity type: </b></p> -->
                <!-- <p><b>Identity number: </b></p> -->
                <!-- <p><b>Date of Birth: </b></p> -->
                <p><b>Staff category: </b></p>
              </div>
              <div class="right alert col-6">
                <p id="user_id">Emp-0001</p>
                <p id="user_name">Anatoli kuwebwa</p>
                <p id="user_email">akuwebwa@gmail.com</p>
                <p id="telephone">0779320075</p>
                <p id="gender">Male</p>
                <!-- <p id="address">Lunguja Lubaga division</p> -->
                <!-- <p id="country">Uganda</p> -->
                <!-- <p id="marital_status">Single</p> -->
                <!-- <p id="id_type">National ID</p> -->
                <!-- <p id="id_number">CM92301933HEK</p> -->
                <!-- <p id="date_of_birth">28th/02/2014</p> -->
                <p id="user_type">Admin</p>
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

  <!--**********************************
        Scripts
    ***********************************-->
  <script src="../plugins/common/common.min.js"></script>
  <script src="../js/custom.min.js"></script>
  <script src="../js/bootstrap/bootstrap.min.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/gleek.js"></script>
  <script src="../js/styleSwitcher.js"></script>
  <script src="../js/custom_js/admin_users.js"></script>

  <script src="../plugins/tables/js/jquery.dataTables.min.js"></script>
  <script src="../plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>

</html>