<?php
include("../database/connection.php");
//get
if (!isset($_POST['submit'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    if (empty($email) || empty($token)) {
        header("Location: 404.php");
        exit();
    }

    $result = $dbConn->query("SELECT id from reset_password where email = '$email' 
                                                            and token = '$token'
                                                            and createdAt >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
                                                            and available = 1");
    $user = $result->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        header("Location: 404.php");
        exit();
    }
}
//post
else {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        header("Location: 404.php");
        exit();
    }
    //token co the het han nen phai kiem tra lai
    $result = $dbConn->query("SELECT id from reset_password where email = '$email' 
    and token = '$token'
    and createdAt >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
    and available = 1");
    $user = $result->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        header("Location: 404.php");
        exit();
    }
    // cập nhật mật khẩu mới
    $password = password_hash($password, PASSWORD_BCRYPT);
    $dbConn->query("UPDATE users set password = '$password' WHERE email = '$email'");
    // hủy token
    $dbConn->query("UPDATE reset_password set available = 0 WHERE email ='$email' and token = '$token'");
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
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
                            <h3 class="card-title text-left mb-3">Reset Password</h3>
                            <form method="post" action="reset_password.php">

                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password *</label>
                                    <input type="password" name="confirm_password" class="form-control p_input">
                                </div>
                                <input type="hidden" name="email" value="<?php echo $_GET['email'] ?>">
                                <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>">
                                <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Reset</button>

                                <!-- <div class="d-flex">
                    <button class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div> -->
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