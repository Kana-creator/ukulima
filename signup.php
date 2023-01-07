<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ukulima</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="theme/assets/logo.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="theme/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="theme/css/custom_css/signup.css">

</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <img src="theme/assets/logo.png" alt="" class="logo" />

            <!-- <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
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
                    <div class="form-input-content m-4">
                        <div class="card login-form mb-0">
                            <a class="text-center logo-link" href="/"><img src="theme/assets/logo.png" alt="" class="logo"></a>
                            <div class="card-body pt-5">


                                <h1 class="col-12 text-center" style="margin-top: 100px">Create Account</h1>

                                <form class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <label for="first_name">First Name<sup>*</sup></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                        <small>Error</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name<sup>*</sup></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                        <small>Error</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email<sup>*</sup></label>
                                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email">
                                        <small>Error</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="telephone">Telephone<sup>*</sup></label>
                                        <input type="text" class="form-control" id="user_telephone" name="user_telephone" placeholder="Telephone">
                                        <small>Error</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="user-category">User category<sup>*</sup></label>
                                        <select class="form-control" id="user-category" name="user_category">
                                            <option value="">Select your user category</option>
                                            <option value="producer">Producer</option>
                                            <option value="SupPlier">Supplier</option>
                                            <option value="consumer">Consumer</option>
                                        </select>
                                        <small>Error</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_gender">Gender<sup>*</sup></label>
                                        <select class="form-control" id="user_gender" name="user_gender">
                                            <option value="">Select your gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <small>Error</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_password">Password<sup>*</sup></label>
                                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
                                        <small>Error</small>
                                        <i class="fa fa-eye fa-2x" id="show_password"></i>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password<sup>*</sup></label>
                                        <input type="text" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                        <small>Error</small>
                                    </div>
                                    <button class="btn btn-sm login-form__btn submit w-100" id="signup_btn">Signup</button>
                                </form>
                                <p class="mt-5 login-form__footer">Have account <a href="./index.html" class="text-primary">Login </a> now</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="message_div">
        <div class="alert msg row justify-center">
            <i class="fa fa-check fa-4x col-12 text-center" id="alert_icon"></i>
            <p class="text-center col-12" id="alert_msg">Sign up successfull</p>
            <input type="submit" id="ok" class="btn btn-primary m-auto" value="Ok" />
        </div>
        </dive>




        <!--**********************************
        Scripts
    ***********************************-->
        <script src="theme/plugins/common/common.min.js"></script>
        <script src="theme/js/custom.min.js"></script>
        <script src="theme/js/settings.js"></script>
        <script src="theme/js/gleek.js"></script>
        <script src="theme/js/styleSwitcher.js"></script>
        <script src="theme/js/custom_js/signup.js"></script>
</body>

</html>