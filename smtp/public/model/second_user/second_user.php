<?php
require_once "../../../vendor/autoload.php";
use \Mailjet\Resources;
class Sec_user
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $token;
    public function set_sec_user($email)
    {
        $this->email = $email;
    }
    //get merchant properties as associative array
    public function get_sec_user()
    {
        $employee = array(
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "token" => $this->token
        );
        return $employee;
    }
    //sign up merchant record in database
    public function sign_up($name, $email, $password, $confirm_password, $db_conn)
    {
        $sql = "INSERT INTO
        secondary_user (name, email , password)
        VALUES ('$name', '$email', '$password')";

        if ($db_conn->query($sql) === TRUE)
        {
            return true;
        }
        else
        {
            echo $db_conn->error;
        }
        $db_conn->close();
    }

        //sign in merchant record in database
        public function sign_in($email, $password, $db_conn)
        {
            $this->email=$email;
            $query = "SELECT name,email FROM secondary_user WHERE email='$email' AND password='$password'";
            $result = $db_conn->query($query);
            if($result)
            {
                return $result;
            }else{
                return false;
            }
             $db_conn->close();
        }

            //send mail from secondary
    public function send_mail($from,$fname,$to,$tname,$cc,$cname,$bcc,$bname,$subject,$tpart,$hpart,$d)
    {
        $query = "SELECT * FROM secondary_user WHERE email='$this->email'";
        $result = $d->query($query);
        var_dump($result);
        $result=$result->fetch_assoc();
        $result=$result['send_mail'];
        if($result)
        {
            var_dump(true);
            $mj = new Mailjet\Client('dfbdeda82e4b22fdd89633908aca5c64','118a2111be257757e2406bc21fa33238',true,['version' => 'v3.1']);
            $body = [
              'Messages' => [
                [
                  'From' => [
                    'Email' => $from,
                    'Name' => $fname
                  ],
                  'To' => [
                    [
                      'Email' => $to,
                      'Name' => $tname
                    ]
                  ],
                  'Cc' => [
                    [
                      'Email' => $cc,
                      'Name' => $cname
                    ]
                  ],
                  'Bcc' => [
                    [
                      'Email' => $bcc,
                      'Name' => $bname
                    ]
                  ],
                  'Subject' => $subject,
                  'TextPart' => $tpart,
                  'HTMLPart' => $hpart,
                  'CustomID' => "AppGettingStartedTest"
                ]
              ]
            ];
            // var_dump($this->email);
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            // $response->success() && var_dump($response->getData());
                // var_dump($response->success());  
                // var_dump($response->getData());
            // if($response->success())
            if(true)
            {
                $query = "SELECT * FROM secondary_user WHERE email='$this->email'";
                $result = $d->query($query);
                var_dump($result);
                $result=$result->fetch_assoc();
                $merchant_id=$result['merchant_id'];
    
                $query = "SELECT * FROM merchant WHERE id='$merchant_id'";
                $result = $d->query($query);
                $result=$result->fetch_assoc();
                $credit=$result['credit']-0.0489;
    
                $query = "UPDATE merchant SET credit='$credit' WHERE id='$merchant_id' ";
                $result = $d->query($query);
                var_dump($result);
    
                $query = "INSERT INTO payments (Balance, merchant_id) VALUES ('$credit', '$merchant_id')";
                $result = $d->query($query);
                var_dump($result);
                $hpart=strip_tags("$hpart");
                $query = "INSERT INTO request (from_email,to_email,Cc,Bcc,subject,body,merchant_id) VALUES ('$from','$to','$cc','$bcc','$subject','$tpart.\n$hpart','$merchant_id')";
                var_dump($query);
                $result = $d->query($query);
                var_dump($result);
                return true;
            }
        }



        return false; 
        $d->close();
    }

        //get request's record
        public function list_request($d)
        {
            $query = "SELECT * FROM secondary_user WHERE email='$this->email'";
            $result = $d->query($query);
            var_dump($result);
            $result=$result->fetch_assoc();
            $result=$result['check_listing'];
            if($result)
            {
                $query = "SELECT * FROM secondary_user WHERE email='$this->email'";
                $result = $d->query($query);
                var_dump($result);
                $result=$result->fetch_assoc();
                $merchant_id=$result['merchant_id'];
                $query = "SELECT * FROM merchant WHERE id='$merchant_id'";
                $result = $d->query($query);
                $result=$result->fetch_assoc();
                $merchant_id=$result['id'];
                $query = "Select * from request where merchant_id='$merchant_id' ";
                $result=$d->query($query);
                if($result->num_rows>0)
                {
                    $data=array();
                    $i=0;
                    while ($row = $result->fetch_assoc()) {
                        $data[$i]['from_email']=$row["from_email"];
                        $data[$i]['to_email']=$row["to_email"];
                        $data[$i]['Cc']=$row["Cc"];
                        $data[$i]['Bcc']=$row["Bcc"];
                        $data[$i]['subject']=$row["subject"];
                        $data[$i]['body']=$row["body"];
                        $i++;
                    }
        
        
                    return $data;
                }
                else
                {
                    return false;
                }
            }
            return false;
            $d->close();
        }

            //get payments
    public function check_payment($d)
    {
        $query = "SELECT * FROM secondary_user WHERE email='$this->email'";
        $result = $d->query($query);
        var_dump($result);
        $result=$result->fetch_assoc();
        $result=$result['billing_info'];
        if($result)
        {
            $query = "SELECT * FROM secondary_user WHERE email='$this->email'";
            $result = $d->query($query);
            var_dump($result);
            $result=$result->fetch_assoc();
            $merchant_id=$result['merchant_id'];
            $query = "SELECT * FROM merchant WHERE id='$merchant_id'";
            $result = $d->query($query);
            $result=$result->fetch_assoc();
            $merchant_id=$result['id'];
            $query = "Select * from payments where merchant_id='$merchant_id' ";
            $result=$d->query($query);
            if($result->num_rows>0)
            {
                $data=array();
                $i=0;
                while ($row = $result->fetch_assoc()) {
                    $data[$i]['Balance']=$row["Balance"];
                    $data[$i]['payment_time']=$row["payment_time"];
                    $i++;
                }


                return $data;
            }
            else
            {
                return false;
            }
        }
        return false;
        $d->close();
    }

}
?>
