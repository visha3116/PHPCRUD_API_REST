<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-A  llow-Headers,Authorization, X-Request-with');

include('function.php'); 

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == 'POST'){

    $inputData = json_decode(file_get_contents("php://input"),true);
    if(empty($inputData)){

        $storecustomer = storecustomer($_POST);
        
    }else{

        $storecustomer = storecustomer($inputData);
    }
    echo $storecustomer;
    
}
else
{
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method not allowed',
    ];
    header("HTTP/1.0 405 not found");
    echo json_encode($data);
   
}
?>