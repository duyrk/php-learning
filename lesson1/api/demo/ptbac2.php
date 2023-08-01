<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//http://127.0.0.1:3456/api/demo/tinhtoan.php?a=2&b=2&c=4

$a = $_GET['a'];
$b = $_GET['b'];
$c = $_GET['c'];

$delta = ($b * $b) - 4 * $a * $c;
$ketqua = "";
$x1 = 0;
$x2 = 0;
if ($delta < 0) {
    $ketqua = "Phuong trinh vo nghiem";
} else if ($delta == 0) {
    $ketqua = "Phuong trinh co nghiem kep";
    $x1 = (-$b) / (2 * $a);
    $x2 = $x1;
} else if ($delta > 0) {
    $ketqua = "Phuong trinh co 2 nghiem";
    $x1 = (-$b + sqrt($delta)) / (2 * $a);
    $x2 = (-$b - sqrt($delta)) / (2 * $a);
}

echo json_encode(array(
    "ket qua" => $ketqua,
    "x1=" => $x1,
    "x2= " => $x2,
));
