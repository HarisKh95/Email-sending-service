<?php

//header are required
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once '../../../config/db/database.php';
require_once '../../api_response/response.php';
require_once '../../helpers/jwt_validator.php';
require_once '../../model/second_user/second_user.php';

//follow procedural coding paradigm here
//create response class object
$res = new Response();
$d=new DataBase();
$d = $d->get_Connection();
$j=new JWT_V($key);
//get the data from postman
$data = json_decode(file_get_contents("php://input"),true);

$jwt=$data['jwt'];

// if(!(isset($from)&&isset($fname)&&isset($to)&&isset($tname)&&isset($cc)&&isset($cname)&&isset($bcc)&&isset($bname)&&isset($subject)&&isset($tpart)&&isset($hpart)))
// {
//     $res->set_response(NULL,"Invalid mail input",406);
//     $res->respond_api();
// }

$j_v=$j->jwt_validate($jwt);

if($j_v['result'])
{
    $s=new Sec_user();
    $s->set_sec_user($j_v['email']->email);
    $requests=$s->list_request($d);
    if(isset($requests))
    {
        echo json_encode($requests);
    }
}



?>
