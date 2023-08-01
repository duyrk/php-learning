<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

?>

<?php
include_once("../database/connection.php");
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $user = $dbConn->query("SELECT id, email, password, isVerify FROM users where email='$email'");

    if ($user->rowCount() > 0) {
        $row = $user->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
        $email = $row['email'];
        $password = $row['password'];
        $isVerify = $row['isVerify'];
        if (!password_verify($pswd, $password)) {
            echo "
            <script>
                alert('Sai mật khẩu. vui lòng nhập lại');
            </script>
            ";
        } else {
            if (!$isVerify) {
                echo "
                <script>
                    alert('Bạn chưa xác nhận tài khoản. Vui lòng nhập email của bạn và tiến hành xác thực');
                </script>
                ";
                header("Location: authentication.php");
            } else {
                $_SESSION['email'] = $email;
                header("Location: index.php");
            }
        }
    } else {
        echo "
        <script>
            alert('Email không tồn tại, hãy thử lại');
        </script>
        ";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="./assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Login</h3>
                            <form method="post" action="login.php">
                                <div class="form-group">
                                    <label for="email">Username or email *</label>
                                    <input type="email" id="email" name="email" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label for="pswd">Password *</label>
                                    <input type="text" id="pswd" name="pswd" class="form-control p_input">
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input"> Remember me </label>
                                    </div>
                                    <a href="#" class="forgot-pass">Forgot password</a>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Login</button>

                                <!-- <div class="d-flex">
                    <button class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div> -->
                                <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="./assets/js/off-canvas.js"></script>
    <script src="./assets/js/hoverable-collapse.js"></script>
    <script src="./assets/js/misc.js"></script>
    <script src="./assets/js/settings.js"></script>
    <script src="./assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>