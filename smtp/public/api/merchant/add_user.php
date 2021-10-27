<?php

//header are required
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once '../../../config/db/database.php';
require_once '../../api_response/response.php';
require_once '../../helpers/jwt_validator.php';
require_once '../../model/merchant/merchant.php';

//follow procedural coding paradigm here
//create response class object
$res = new Response();
$d=new DataBase();
$d = $d->get_Connection();
$j=new JWT_V($key);
//get the data from postman
$data = json_decode(file_get_contents("php://input"),true);
$name=$data['name'];
$email=$data['email'];
$password=$data['password'];
$check_r=$data['check_request'];
$check_b=$data['check_bill'];
$send_m=$data['send_mail'];
$jwt=$data['jwt'];

var_dump($data);
// if(!(isset($from)&&isset($fname)&&isset($to)&&isset($tname)&&isset($cc)&&isset($cname)&&isset($bcc)&&isset($bname)&&isset($subject)&&isset($tpart)&&isset($hpart)))
// {
//     $res->set_response(NULL,"Invalid mail input",406);
//     $res->respond_api();
// }

$j_v=$j->jwt_validate($jwt);
$m=new Merchant();
$m->set_merchant($j_v['data']->email);

if($j_v['result'])
{

    $requests=$m->new_user($name,$email,$password,$check_r,$check_b,$send_m,$d);
    if($requests==false)
    {
        $res->set_response(NULL,"No User created",406);
        $res->respond_api();
    }
    else
    {
        echo json_encode($requests);
        echo "\r\n";
        $res->set_response(NULL,"New User Created",200);
        $res->respond_api();
    }


}
else
{
    $res->set_response(null,"Only merchant have access",401);
    $res->respond_api();
}





?>
