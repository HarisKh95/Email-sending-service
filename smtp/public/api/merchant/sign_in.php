<?php

//header are required
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include_once '../../../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../../../libs/php-jwt-master/src/ExpiredException.php';
include_once '../../../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../../../libs/php-jwt-master/src/JWT.php';
require_once '../../../config/db/database.php';
require_once '../../../config/core.php';
require_once '../../model/merchant/merchant.php';
require_once '../../api_response/response.php';
require_once '../../../vendor/autoload.php';
use \Firebase\JWT\JWT;
//follow procedural coding paradigm here
$data=json_decode(file_get_contents("php://input"));

//create response class object
$res = new Response();

//get the data from postman
$data = json_decode(file_get_contents("php://input"),true);
$email=$data['Email'];
$password=$data['Password'];

//perform validation on email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
{
     $res->set_response(null,'invalid email format',409);
     $res->respond_api();
}
else{
     // create object of database class
     $database = new Database();
     // get database connection
     $db = $database->get_Connection();

     // create Merchant object
     $m = new Merchant();

     // call sign_in() method and pass required parameters 
     $result = $m->sign_in($email,$password,$db);

          if($result->num_rows > 0)
          {    
               $row = $result->fetch_assoc();
               $token = array(
                "iat" => $issued_at,
                "exp" => $expiration_time,
                "iss" => $issuer,
                "data" => array(
                    "email" => $email,
                    "password" => $password,
                    "type" => "Merchant"
                )
             );
          
               // Encode jwt
               $jwt = JWT::encode($token, $key);
               $msg= json_encode(
                         array(
                              "message" => "Merchant Successfully Login!",
                              "jwt" => $jwt
                         )
                    );
               $res->set_response(null,$msg,200);
               $res->respond_api();
          }
          else
          {
               $user_arr=array(
                    "status" => 406,
                    "message" => "Invalid Merchant name or Password!",
               );
               $res->set_response(null,$user_arr['message'],$user_arr['status']);
               $res->respond_api();
          }
     }

?>
