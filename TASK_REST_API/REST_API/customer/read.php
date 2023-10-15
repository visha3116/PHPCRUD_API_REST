<?php

header('Access-Control-Allow-Origin:*');
header('content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-A  llow-Headers,Authorization, X-Request-with');

include('function.php'); 

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){

    $customerList = getcustomerList();
    echo $customerList;  
}
else
{
    $data = [
        'status' => 405,
        'message' => $requestMethod. 'Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);
}

?>