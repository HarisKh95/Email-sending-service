<?php
header("Content-Type: application/json");

require '../../../config/db/database.php';
require '../../model/user/user.php';
require '../../api_response/response.php';

   $data = json_decode(file_get_contents('php://input'));
    $res = new Response();
    $token = $data->token;
    $new_pass = $data->new_pass;
    $confirm_pass = $data->confirm_pass;
   
    $db=new DataBase();
    $conn = $db->get_connection();
    $user = new User();
    $qury = $conn->prepare("SELECT * FROM user where token=?");
    $qury->bind_param('s', $token);
    $qury->execute();
    $qury->store_result();

    if ($qury->num_rows() > 0) 
    {
       if($new_pass === $confirm_pass)
        {
            $boolean = $user->set_new_pass($new_pass, $confirm_pass, $token, $conn); 
            if($boolean === true)
            {
                $message = "Pass changed successfully";
                $status_code = "201";
                $res->set_response(null, $message, $status_code);
                http_response_code(201);
                $res->respond_api();
                $db->close_connection();
            }
            else if($boolean === false)
            {
                $message = "Invalid Credential";
                $status_code = "406";
                $res->set_response(null, $message, $status_code);
                $res->respond_api();
                $db->close_connection();
            }
        }
        else
        {
            $message = "password field does not match";
            $status_code = "401";
            $res->set_response(null, $message, $status_code);
            $res->respond_api();
            $db->close_connection();
        }
    }else{
        $res->set_response(null, "Token Expire Please Try Again With New One", "404");
                http_response_code(404);
                $res->respond_api();
                $db->close_connection();
    }
?>

