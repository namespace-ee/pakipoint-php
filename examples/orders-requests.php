<?php

// include the rmccue/requests library
include("../vendor/rmccue/requests/library/Requests.php");
Requests::register_autoloader();

// settings
$url_base = 'https://dev.pakipoint.ee/api/';
$token = '3aa9a21e42ddb067b2caa023ffef4ccd';
$account_code = '';

$url_orders = $url_base . 'orders/';
$headers = [
    'Accept' => 'application/json',
    'Content-Type' => 'application/json',
    'Authorization' => 'Token ' . $token,
];
$options = [];

// publish order information
$order_data = [
    "merchant_code" => $account_code,
    "customer" => [
        "company" => "",
        "name" => "Customer Name",
        "street1" => "",
        "street2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => "",
        "country" => "EE",
        "phone" => "+37256123456",
        "email" => "customer@domain.com"
    ],
    "recipient" => [
        "company" => "",
        "name" => "Customer Name",
        "street1" => "Street Name 123a",
        "street2" => "",
        "city" => "Tallinn",
        "state" => "Harjumaa",
        "postal_code" => "12345",
        "parcel_terminal_code" => "",
        "parcel_terminal_name" => "",
        "country" => "EE",
        "phone" => "+37256123456",
        "email" => "customer@domain.com"
    ],
    "items" => [
        [
            "code" => "00042-1",
            "name" => "BrandName Sunglasses",
            "description" => "BrandName sunglasses with UV400 lens.",
            "supplier_code" => $account_code,
            "sku_code" => "SKU123456",
            "quantity" => 1,
            "currency" => "EUR",
            "unit_price" => "14.90",
            "shipping_price" => "0.00",
            "tax" => "0.00",
            "total" => "17.90",
            "weight" => "0.10"
        ]
    ],
    "code" => "00042",
    "shipping_method" => "dhl",
    "shipping_service" => "courier_standard",
    "paid_at" => "2015-05-14T13:02:29.363057Z",
    "total" => "17.90",
    "shipping_price" => "0.00",
    "notes" => "",
];

// send a HTTP POST request with JSON encoded data
$response = Requests::post($url_orders, $headers, json_encode($order_data), $options);

if ($response->success) {
    print("order created:\r\n");
    $order = json_decode($response->body, true);
    var_dump($order);
}
else {
    print("Received validation errors:\r\n");
    $validation_errors = json_decode($response->body, true);
    var_dump($validation_errors);
}
