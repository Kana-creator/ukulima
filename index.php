<!DOCTYPE html>
<html class="h-100" lang="en" xmlns:th="http://www.thymleaf.org">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <script src="theme/js/jquery.js"></script>
  <script src="theme/js/bootstrap/bootstrap.min.js"></script>
  <link rel="stylesheet" href="theme/css/bootstrap/bootstrap.min.css" />
  <title>Ukulima | Login</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="theme/assets/logo.png" />
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
  <link href="theme/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="theme/css/custom_css/index.css" />
</head>

<body class="h-100">
  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="loader">
      <img src="theme/assets/logo.PNG" alt="" class="logo" />
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

  <div class="login-form-bg h-100">
    <div class="container h-100">
      <div class="row justify-content-center h-100">
        <div class="col-xl-6">
          <div class="form-input-content">
            <div class="card login-form mb-0">
              <div class="card-body pt-5">
                <a class="text-center logo-link" href="/"><img src="theme/assets/logo.PNG" alt="" class="logo" /></a>
                <form class="mt-5 mb-5 login-input">
                  <div class="form-group">
                    <i class="fa fa-user fa-2x p-2"></i>
                    <input type="text" class="form-control" placeholder="Email or Phone number" id="user_name" />
                  </div>
                  <div class="form-group">
                    <i class="fa fa-lock fa-2x p-2"></i>
                    <input type="password" class="form-control" placeholder="Password" id="password" />
                    <i class="fa fa-eye fa-2x" id="show_password"></i>
                  </div>
                  <button class="btn login-form__btn submit w-100" id="sign_in_btn">
                    Sign In
                  </button>
                </form>
                <p class="mt-5 login-form__footer">
                  Dont have account?
                  <a href="signup.php" class="text-primary">Sign Up</a>
                  now
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--**********************************
        Scripts
    ***********************************-->
  <script src="theme/plugins/common/common.min.js"></script>
  <script src="theme/js/custom.min.js"></script>
  <script src="theme/js/settings.js"></script>
  <script src="theme/js/gleek.js"></script>
  <script src="theme/js/styleSwitcher.js"></script>
  <script src="theme/js/custom_js/index.js"></script>
</body>

</html>