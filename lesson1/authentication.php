<?php
include("../database/connection.php");

use PHPMailer\PHPMailer\PHPMailer;

include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/PHPMailer-master/src/PHPMailer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/PHPMailer-master/src/SMTP.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/PHPMailer-master/src/Exception.php';
if (isset($_POST['submit'])) {
    try {
        $email = $_POST['email'];
        $result = $dbConn->query("SELECT id from users where email = '$email'");
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            echo "<script>alert('Email not found');</script>";
        }
        // tao token
        $token = md5(time() . $email);
        //luu token vao database
        $dbConn->query("INSERT into verify_account(email,token) values('$email','$token')");



        $link = "<a href='http://127.0.0.1:3456/verify.php?email="
            . $email . "&token=" . $token . "'>Click to verify your account!</a>";
        $mail = new PHPMailer();
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Username = "duyvo761";
        $mail->Password = "ghqzxnebbambdjtk";
        $mail->SMTPSecure = "ssl";
        $mail->Host = "ssl://smtp.gmail.com";
        $mail->Port = "465";
        $mail->From = "duyvo761@gmail.com";
        $mail->FromName = "duyrk";
        $mail->addAddress($email, 'Hello');
        $mail->Subject = "Verify your account";
        $mail->isHTML(true);
        $mail->Body = "Click on this link to verify your account " . $link . " ";
        $res = $mail->Send();

        if ($res) {
            echo "<script> alert('Vui lòng kiểm tra email của bạn!') </script>";
        } else {
            header("Location: 404.php");
        }
    } catch (Exception $e) {
        header("Location: 404.php");
    }
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
                            <h3 class="card-title text-left mb-3">Verify your account</h3>
                            <form method="post" action="authentication.php">

                                <div class="form-group">
                                    <label for="password">Email *</label>
                                    <input type="text" name="email" class="form-control p_input">
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary btn-block enter-btn">Send now</button>

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