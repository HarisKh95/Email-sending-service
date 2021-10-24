<?php
//DO NOT MANIPULATE THIS CLASS
class Response
{
    private $message;
    private $status_code;
    private $data;

    //setting response properties
    public function set_response($data, $message, $status_code)
    {
        $this->data = $data;
        $this->message = $message;
        $this->status_code = $status_code;
    }
    //getting response as associative array
    public function get_response_assoc()
    {
        $response = array(
            "data" => $this->data,
            "message" => $this->message,
            "status_code" => $this->status_code
        );
        return $response;
    }
    public function respond_api()
    {
        echo json_encode($this->get_response_assoc());
    }
}
