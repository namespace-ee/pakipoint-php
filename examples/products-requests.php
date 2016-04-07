<?php

// include the rmccue/requests library
include("../vendor/rmccue/requests/library/Requests.php");
Requests::register_autoloader();

// settings
$url_base = 'https://dev.pakipoint.ee/api/';
$token = '3aa9a21e42ddb067b2caa023ffef4ccd';
$account_code = '';

$url_products = $url_base . 'products/';
$headers = [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'Authorization' => 'Token ' . $token,
];
$options = [];

// create or update product information
$product_data = [
  "supplier_code" => $account_code,
  "sku_code" => "SKU123456",
  "ean_code" => "",
  "name" => "BrandName Sunglasses",
  "description" => "BrandName sunglasses with UV400 lens.",
  "manufacturer" => "BrandName Manufacturing Ltd",
  "trademark" => "BrandName",
  "sales_url" => "http://yourdomain.com/products/SKU123456/",
  "weight" => "0.10",
  "width" => "20.00",
  "height" => "5.00",
  "length" => "10.00",
  "units_in_box" => 1,
  "keep_upright" => false,
  "fragile" => true,
  "food_beverage" => false,
  "perishable" => false,
];

// send a HTTP POST request with JSON encoded data
$response = Requests::post($url_products, $headers, json_encode($product_data), $options);

if ($response->success) {
    print("Product created/updated:\r\n");
    $product = json_decode($response->body, true);
    var_dump($product);
}
else {
    print("Received validation errors:\r\n");
    $validation_errors = json_decode($response->body, true);
    var_dump($validation_errors);
}
