<?php

//header are required
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once '../../../config/db/database.php';
require_once '../../api_response/response.php';
require_once '../../helpers/jwt_validator.php';
require_once '../../model/user/user.php';

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
    $u=new User();
    if($j_v['data']->type=="admin")
    {
        $requests=$u->get_payments($d);
        if($requests==false)
        {
            echo "\r\n";
            $res->set_response(NULL,"No Payments list",406);
            $res->respond_api();
        }
        else
        {
            echo json_encode($requests);
            echo "\r\n";
            $res->set_response(NULL,"Payments list recieved",200);
            $res->respond_api();
        }
    
    }
    else
    {
        $res->set_response(null,"Only admin have access",401);
        $res->respond_api();
    }
}



?>
