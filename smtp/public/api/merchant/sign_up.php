<?php

//header are required
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once '../../../config/db/database.php';
require_once '../../model/merchant/merchant.php';
require_once '../../api_response/response.php';
//follow procedural coding paradigm here
$data=json_decode(file_get_contents("php://input"));
$r= new Response();

$data = json_decode(file_get_contents("php://input"),true);
$name=$data['Name'];
$email=$data['Email'];
$password=$data['Password'];
$confirm_password=$data['Confirm_Password'];
$valid=true;
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
{
     $r->set_response(NULL,'invalid email format',409);
     $r->respond_api();
     $valid=false;
} 
if ($password != $confirm_password) 
{
     $r->set_response(NULL,'Password do not match',409);
     $r->respond_api();
     $valid=false;
}

if((isset($email)&&isset($password)&&isset($confirm_password)&&($valid==true)))
{

     $d=new DataBase();

     $d=$d->get_connection();

     $m=new Merchant();

     $result=$m->sign_up($name,$email,$password,$confirm_password,$d);
     
     if($result==true)
     {
          $r->set_response(NULL,"New Merchant sign up success",200);
          $r->respond_api();
     }
     
     if($result==false)
     {
          $r->set_response(NULL,"Unsuccessful signup New Merchant",406);
          $r->respond_api();
     }
}

?>
