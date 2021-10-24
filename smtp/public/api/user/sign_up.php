<?php
require_once '../../../config/db/database.php';
require_once '../../model/user/user.php';
require_once '../../api_response/response.php';


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
     // If (DATA IS VALID)
     // {
     // create object of database class //$db=new DataBase();
     $d=new DataBase();

     // create &conn and call get_connection() to get connection identifier //$conn = $db->get_connection()
     $d=$d->get_connection();
     // create user object //$emp = new User();
     $u=new User();
     // call sign_up() method and pass required parameters //$user->sign_up(all required params)
     // $u->set_user('Haris','hkhurshid95@gmail.com','hkkgkh');
     $result=$u->sign_up($name,$email,$password,$confirm_password,$d);
     
     if($result==true)
     {
          $r->set_response(NULL,"sign up success",200);
          $r->respond_api();
     }
     
     if($result==false)
     {
          $r->set_response(NULL,"Unsuccessful signup",406);
          $r->respond_api();
     }
}
