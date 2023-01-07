<?php
include "../APIs/connection_api.php";
include "../APIs/encryption_api.php";
$product_result = $mysqli->query("SELECT * FROM Product");
session_start();

if (isset($_SESSION['user_id'])) {
  $user_name = $_SESSION['user_name'];
  $user_id = $_SESSION['user_id'];
  $cart_result = $mysqli->query("SELECT user_order.order_id AS order_id, user_order.user_id AS order_user_id, user_order.number_of_items AS number_of_items, user_order.order_date AS order_date, user_order.clearence_status AS clearence_status, user_order.product_id AS product_id, product.unit_of_measure AS unit_of_measure, product.brand_name AS brand_name, product.product_image AS product_image, product.unit_cost AS unit_cost FROM user_order INNER JOIN product ON product.product_id = user_order.product_id  WHERE product.user_id=$user_id AND user_order.check_out_status=1 GROUP BY user_order.product_id");

  
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
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.PNG" />
  <!-- Custom Stylesheet -->
  <link href="../plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/custom_css/orders.css" />
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
                      <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
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
            Side bar start
        ***********************************-->
    <div class="nk-sidebar bg-success" style="background-color: #00FF7F">
      <div class="nk-nav-scroll" style="background-color: #00FF7F">
        <ul class="metismenu" id="menu" style="background-color: #00FF7F">
          <li class="nav-label">Dashboard</li>
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="fals" style="background-color: #00FF7F">
              <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
            </a>
            <ul aria-expanded="false" class="" style="background-color: #00FF7F">
              <!-- <li><a href="./consumer_page.php">Home</a></li> -->
              <!-- <li><a href="./Admin_users.php">Users</a></li> -->
              <li><a href="./products.php">Products</a></li>
              <li><a href="./orders.php">Orders</a></li>
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
              <a href="javascript:void(0)">Orders</a>
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
                <h4 class="card-title">Orders</h4>
                <div class="table-responsive">
                  <div id="add_product">
                    <a href="#" class="badge badge-pill gradient-3" onclick="tableToCSV()"><i class="btn btn-sm fa fa-download fa-2x p-2" id="" data-toggle="tooltip" data-placement="top" title="Download orders list"></i></a>
                    <!-- <a href="./Add_product.php"
                        ><i
                          class="fa fa-upload fa-2x btn btn-success"
                          id=""
                          title="Upload list"
                        ></i
                      ></a>
                      <a href="./Add_product.php"
                        ><i
                          class="fa fa-download fa-2x btn btn-success"
                          id=""
                          title="Download list"
                        ></i
                      ></a> -->
                  </div>
                  <table class="table table-striped table-bordered zero-configuration">
                    <thead>
                      <tr>
                        <!-- <th>Order ID</th> -->
                        <th>Customer Name</th>
                        <th>Telephone number</th>
                        <th>Email address</th>
                        <th>Order date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $i = 0;
                      while ($cart_row = $cart_result->fetch_array()) :
                        $i += 1;
                        $product_status = "";
                        $status_title = "";
                        if ($cart_row['clearence_status'] == 1) {
                          $product_status = "gradient-1";
                          $status_title = "cleared";
                        } else {
                          $product_status = "gradient-3";
                          $status_title = "pending";
                        }

                        $cart_users_id = $cart_row['order_user_id'];
                        $user_result = $mysqli->query("SELECT * FROM User WHERE user_id=$cart_users_id");
                        $cart_user_row = $user_result->fetch_array();


                        $product_id = $cart_row['product_id'];
                        $order_results = $mysqli->query("SELECT SUM(number_of_items) AS number_of_items FROM user_order WHERE product_id=$product_id AND check_out_status=1");
                        $order_row = $order_results->fetch_array();

                      ?>
                        <tr>
                          <!-- <td>Order-<?php echo $i; ?></td> -->
                          <td><?php echo decrypt_data($cart_user_row['first_name']); ?></td>
                          <td><a href="tel: <?php echo decrypt_data($cart_user_row['user_telephone']); ?>"><?php echo decrypt_data($cart_user_row['user_telephone']); ?></a></td>
                          <td><?php echo decrypt_data($cart_user_row['user_email']); ?></td>
                          <td><?php echo $cart_row['order_date']; ?></td>
                          <td class="" data-toggle="tooltip" data-placement="top" title="<?php echo $status_title; ?>">
                            <!-- <?php echo $cart_row['number_of_items']; ?> -->
                            <div class="progress" style="height: 10px">
                              <div class="progress-bar <?php echo $product_status; ?>" style="width: 70%;" role="progressbar"><?php echo $status_title ?><span class="sr-only">70% Complete</span>
                              </div>
                            </div>
                          </td>
                          <td id="action_buttons">
                            <i class="fa fa-info btn btn-info" id="show-order-details<?php echo $cart_row['order_id']; ?>" data-toggle="tooltip" data-placement="top" title="Details"></i>

                          </td>
                        </tr>

                        <script>
                          $(() => {
                            $("#show-order-details<?php echo $cart_row['order_id']; ?>").on('click', () => {
                              $("#order-details").addClass("show");
                              $("#input_order_id").val("<?php echo $cart_row['order_id']; ?>");
                              $("#product_image").attr("src", "../assets/product_images/<?php echo decrypt_data($cart_row['product_image']); ?>");
                              $("#p_brand_name").text("<?php echo decrypt_data($cart_row['brand_name']); ?>");
                              $("#p_number_of_items").text("<?php echo $order_row['number_of_items']; ?>");
                              $("#p_unit_of_measure").text("<?php echo decrypt_data($cart_row['unit_of_measure']); ?>");
                              $("#p_unit_cost").text("<?php echo number_format(decrypt_data($cart_row['unit_cost'])); ?>");
                              $("#p_total_cost").text("<?php echo number_format(decrypt_data($cart_row['unit_cost']) * $order_row['number_of_items']); ?>");
                            })

                            $("#close-order").on("click", () => {
                              $("#order-details").removeClass("show");

                            })
                          })
                        </script>

                      <?php endwhile; ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <!-- <th>Order ID</th> -->
                        <th>Customer name</th>
                        <th>Telephone number</th>
                        <th>Email addres</th>
                        <th>Order date</th>
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
      <div id="order-details">
        <div class="details-inner bg-light alert container py-5 pt-5h">
          <i class="fa fa-times fa-2x" id="close-order"></i>
          <div class="row justify-content-center align-content-center py-5">
            <div class="left col-md-4">
              <h1 class="text-success text-center">Order details</h1>
              <img src="../images/products/weed master powder.jpg" class="col-12" id="product_image" height="300" width="250" />
              <div class="col-12 row justify-content-center my-3 py-4">
                <input type="number" id="input_order_id" hidden />
                <a href="#" id="clear_order" class="btn btn-small btn-danger mx-1">Clear Order</a>
              </div>
            </div>
            <div class="right col-md-6 row justify-content-left">
              <div class="left text-right alert col-6">
                <!-- <p><b>Product ID: </b></p> -->
                <p><b>Brand name: </b></p>
                <p><b>Unit of measure: </b></p>
                <p><b>Number of Items: </b></p>
                <p><b>Unig cost: </b></p>
                <p><b>Total cost: </b></p>
                <p><b>Order date: </b></p>
                <p><b>Order status: </b></p>
                <p><b>Name of customer: </b></p>
                <p><b>Telephone number: </b></p>
                <p><b>Email: </b></p>
                <p><b>Address: </b></p>
              </div>
              <div class="right alert col-6">
                <!-- <p>Prod-0001</p> -->
                <p id="p_brand_name">Weed master</p>
                <p id="p_unit_of_measure">1.5ltr</p>
                <p id="p_number_of_items">15</p>
                <p id="p_unit_cost">13000</p>
                <p id="p_total_cost">758000</p>
                <p>25th/03/2022</p>
                <p>Pending</p>
                <p>Anatoli Kuwebwa</p>
                <p>0779320075</p>
                <p>akuwenwa@gmail.com</p>
                <p>-</p>

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
  <script src="../js/settings.js"></script>
  <script src="../js/gleek.js"></script>
  <script src="../js/styleSwitcher.js"></script>
  <script src="../js/custom_js/orders.js"></script>

  <script src="../plugins/tables/js/jquery.dataTables.min.js"></script>
  <script src="../plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/tables/js/datatable-init/datatable-basic.min.js"></script>



  <script>
    function tableToCSV() {
      var csv_data = [];
      var rows = document.getElementsByTagName('tr');

      for (var i = 0; i < rows.length; i++) {
        var cols = rows[i].querySelectorAll('td, th');
        var csvrow = [];
        for (var j = 0; j < cols.length; j++) {
          csvrow.push(cols[j].innerText);

        }
        csv_data.push(csvrow.join(","));
      }
      csv_data = csv_data.join('\n');

      downloadCSVFile(csv_data);
    }


    function downloadCSVFile(csv_data) {
      CSVFile = new Blob([csv_data], {
        type: "text/csv"
      });
      var temp_link = document.createElement('a');
      temp_link.download = "Orders.csv";
      var url = window.URL.createObjectURL(CSVFile);
      temp_link.href = url;
      temp_link.style.display == "none";
      temp_link.click();
      document.body.removeChild(temp_link);

    }
  </script>


</body>

</html>