<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../database/connectDB.php");


try {
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    $name = $data->name;
    if (empty($email) || empty($name)) {
        echo json_encode(array(
            "status" => 400,
        ));
    }
    $avatar = "";
    $substring = stristr($email, '@', true);
    $student_code = substr($substring, -7, 7);
    $gender = true;
    $birthday = '1999-01-01';
    $address = "Hà Nội";
    $course = "Mobile";
    $user = $dbConn->query("SELECT id, email, name, avatar, student_code, gender, birthday, address, course from users where email='$email'");
    if ($user->rowCount() <= 0) {
        $dbConn->query("INSERT INTO users (email, name, avatar, student_code, gender, birthday, address, course) values( '$email', '$name','$avatar', '$student_code', $gender, '$birthday', '$address', '$course')");
    }
    $user = $dbConn->query("SELECT id, email, name, avatar, student_code, gender, birthday, address, course from users where email='$email'");
    $row = $user->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $email = $row['email'];
    $name = $row['name'];
    $avatar = $row['avatar'];
    $student_code = $row['student_code'];
    $gender = $row['gender'];
    $birthday = $row['birthday'];
    $address = $row['address'];
    $course = $row['course'];

    echo json_encode(array(
        "status" => 200,
        "message" => "Login Successfully!",
        "user" => array(
            "id" => $id,
            "email" => $email,
            "name" => $name,
            "avatar" => $avatar,
            "student_code" => $student_code,
            "gender" => $gender,
            "birthday" => $birthday,
            "address" => $address,
            "course" => $course
        )
    ));
} catch (Exception $e) {
    echo json_encode(array(
        "error" => $e->getMessage(),
        "status" => 403
    ));
}
