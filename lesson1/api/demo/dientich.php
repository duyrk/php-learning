<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: 'POST'");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//http://127.0.0.1:3456/api/demo/dientich.php?
//method: post
// tinh dien tich 
// xu ly nghiep vu

$data = json_decode(file_get_contents('php://input'));

//doc du lieu tu body cua requuest
// chieu dai, chieu rong

$chieu_dai = $data->chieu_dai;
$chieu_rong = $data->chieu_rong;
$dien_tich = $chieu_dai * $chieu_rong;

echo json_encode(array(
    "dien_tich" => $dien_tich
));
