<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../../database/connection.php");


try {
    $data = json_decode(file_get_contents("php://input"));
    $cl_email = $data->email;
    $cl_password = $data->password;
    $cl_name = $data->name;

    if (empty($cl_email) || empty($cl_password) || empty($cl_name)) {
        echo json_encode(array(
            "status" => false,
            "message" => "Lỗi"
        ));
        return;
    }
    $user = $dbConn->query("SELECT id, email, password from users where email='$cl_email'");
    if ($user->rowCount() > 0) {
        echo json_encode(array(
            "status" => false,
            "message" => "Tạo tài khoản thất bại, email đã tồn tại"
        ));
    } else {
        $cl_password = password_hash($cl_password, PASSWORD_BCRYPT);
        $dbConn->query("INSERT INTO users (email, password, name) values ('$cl_email', '$cl_password', '$cl_name');");
        echo json_encode(array(
            "status" => true,
            "message" => "Tạo tài khoản thành công",
        ));
    }
} catch (Exception $e) {
    echo $e;
}
