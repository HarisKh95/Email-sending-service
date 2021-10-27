<?php

//header are required
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once '../../../config/db/database.php';
require_once '../../api_response/response.php';
require_once '../../helpers/jwt_validator.php';
require_once '../../model/scheduler/scheduler.php';

//follow procedural coding paradigm here
//create response class object
$res = new Response();
$d=new DataBase();
$d = $d->get_Connection();


    $m=new Sechdule();
    // $name=rand(9999,1111)."Haris";
    // $time=date("h:i:s");
    // $result=$m->check_merchant($name,$time,$d);
    $result=$m->check_merchant($d);
    if($result)
    {
        $res->set_response(NULL,"Reminder Send",200);
        $res->respond_api();
    }
    else{
        $res->set_response(NULL,"No Reminder",200);
        $res->respond_api();
    }

?>
