<?php

require '../inc/dbcon.php';

function error422($message){

    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 unprocessable Entity");
    echo json_encode($data);
    exit();
}

function storecustomer($customerInput){

    global $conn;

    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);

    if(empty(trim($name))){
        return error422('Enter your name');
    }elseif(empty(trim($email))){
        return error422('Enter your email');
    }elseif(empty(trim($phone))){
        return error422('Enter your phone');

    }
    else {
        $query = "INSERT INTO customer (name,email,phone) VALUES ('$name','$email','$phone')";
        $result=mysqli_query($conn, $query);

        if ($result){
            $data = [
                'status' => 201,
                'message' => 'Customer Created successfully',
            ];
            header("HTTP/1.0 201 created");
            echo json_encode($data);
        }else{
            $data = [
                'status' => 500,
                'message' => $requestMethod. 'Method not allowed',
            ];
            header("HTTP/1.0 500 Internal server Error");
            echo json_encode($data);
        }
        }
    }

function getcustomerList(){

    global $conn;

    $query = "SELECT * FROM customer";
    $query_run = mysqli_query($conn,$query);

    if($query_run){

        if(mysqli_num_rows($query_run) > 0){

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' =>  'CUSTOMER LIST FETCHED SUCCESFULLY',
                'data' => $res
            ];
            header("HTTP/1.0 200 CUSTOMER LIST FETCHED SUCCESFULLY");
            echo json_encode($data);
        
        }else{
            $data = [
                'status' => 405,
                'message' => $requestMethod. 'Method not allowed',
            ];
            header("HTTP/1.0 404 not found");
            return json_encode($data);
        }    
    }
    else
    {
        $data = [
            'status' => 500,
            'message' => $requestMethod. 'Method not allowed',
        ];
        header("HTTP/1.0 500 Internal server Error");
        echo json_encode($data);
    }

}

?>