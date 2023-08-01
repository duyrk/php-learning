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

    if (empty($cl_email) || empty($cl_password)) {
        echo json_encode(array(
            "status" => false,
        ));
        return;
    }

    $user = $dbConn->query("SELECT id, email, password from users where email='$cl_email'");
    if ($user->rowCount() > 0) {
        $row = $user->fetch(PDO::FETCH_ASSOC);
        $password = $row['password'];
        $email = $row['email'];
        $id = $row['id'];
        if (!password_verify($cl_password, $password)) {
            echo json_encode(array(
                "status" => false,
                "message" => "fail"
            ));
        } else {
            echo json_encode(array(
                "status" => true,
                "message" => "success"
            ));
        }
    } else {
        echo json_encode(array(
            "status" => false,
            "message" => "fail"
        ));
    }
} catch (Exception $e) {
    echo json_encode(array(
        "error" => $e->getMessage(),
        "status" => 403
    ));
}
