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
    $s->set_sec_user($j_v['data']->email);

    if($j_v['data']->type=="Second_user")
    {
        $requests=$s->list_request($d);
        if($requests==false)
        {
            echo "\r\n";
            $res->set_response(NULL,"No Request list",406);
            $res->respond_api();
        }
        else
        {
            echo json_encode($requests);
            echo "\r\n";
            $res->set_response(NULL,"Requests list recieved",200);
            $res->respond_api();
        }
    
    }
    else
    {
        $res->set_response(null,"Only Second users have access",401);
        $res->respond_api();
    }
}



?>
