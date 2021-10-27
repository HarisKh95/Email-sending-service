<?php
require_once "../../../vendor/autoload.php";
use \Mailjet\Resources;
class Merchant
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $credit;
    private $token;

    //setting a merchant's properties
    public function set_merchant($email)
    {
        $this->email = $email;
    }
    //get merchant properties as associative array
    public function get_merchant()
    {
        $employee = array(
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "credit" => $this->credit,
            "token" => $this->token
        );
        return $employee;
    }
    //sign up merchant record in database
    public function sign_up($name, $email, $password, $confirm_password, $db_conn)
    {
        $sql = "INSERT INTO
        merchant (name, email , password)
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
            $query = "SELECT name,email FROM merchant WHERE email='$email' AND password='$password'";
            $result = $db_conn->query($query);
            if($result)
            {
                return $result;
            }else{
                return false;
            }
             $db_conn->close();
        }

    //send mail from merchant
    public function send_mail($from,$fname,$to,$tname,$cc,$cname,$bcc,$bname,$subject,$tpart,$hpart,$d)
    {


      $mj = new \Mailjet\Client('de3b38d401b829c2e7ce2f2087fcdd6f','851f311bce8cc3110d52464dd9885e55',true,['version' => 'v3.1']);
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
        // $response->success();

        if($response->success())
        {
            $query = "SELECT * FROM merchant WHERE email='$this->email'";
            $result = $d->query($query);
            $result=$result->fetch_assoc();
            $merchant_id=$result['id'];
            $credit=$result['credit']-0.0489;

            $query = "UPDATE merchant SET credit='$credit' WHERE email='$this->email' ";
            $result = $d->query($query);

            $query = "INSERT INTO payments (Balance, merchant_id) VALUES ('$credit', '$merchant_id')";
            $result = $d->query($query);
            // $hpart=strip_tags("$hpart");
            $query = "INSERT INTO request (from_email,to_email,Cc,Bcc,subject,body,merchant_id) VALUES ('$from','$to','$cc','$bcc','$subject','$tpart.\n$hpart','$merchant_id')";
            var_dump($query);
            $result = $d->query($query);
            var_dump($result);
            return true;
        }

        return false; 
        $d->close();
    }

    //get request's record
    public function list_request($d)
    {
        $query = "SELECT * FROM merchant WHERE email='$this->email'";
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
        $d->close();
    }

    
    //get payments
    public function check_payment($d)
    {
        $query = "SELECT * FROM merchant WHERE email='$this->email'";
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
        $d->close();
    }

    //add secondary user
    public function new_user($name,$email,$password,$check_r,$check_bill,$send_mail,$db_conn)
    {

        $query = "SELECT * FROM merchant WHERE email='$this->email'";
        $result = $db_conn->query($query);
        $result=$result->fetch_assoc();
        $merchant_id=$result['id'];
       //create query
       $sql = "INSERT INTO secondary_user (name, email , password,check_listing,billing_info,send_mail,merchant_id) VALUES ('$name', '$email', '$password','$check_r','$check_bill','$send_mail','$merchant_id')";
       $qury = $db_conn->query($sql);
       if ($qury == TRUE)
       {
           return true;
       }
       else
       {
           echo $db_conn->error;
       }
       $db_conn->close();
    }

    public function recharge_credit($number,$amount,$d)
    {

        $stripe = new \Stripe\StripeClient(
            'sk_test_51Joo3jDolkO6nB3NZvjowccRuPb7JccGbuTIurdoXVVg411AF70Oyx03ekJfPvnMQ0AFYIc0dxgmMYb9JabICd6M00VJITfElv'
          );
          
          $token=$stripe->tokens->create([
            'card' => [
            //   'number' => "4242424242424242",
            'number' => $number,
              'exp_month' => 10,
              'exp_year' => 2022,
              'cvc' => 314,
            ],
          ]);
          
          $customer=$stripe->customers->create([
            'email'=>$this->email,
            'description' => 'This merchant',
            'source' => $token->id,
          ]);
          
          
          $amount=$amount*100;
          
          $charge=$stripe->charges->create([
            // 'amount' => 10000,
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'Recharge credit',
            'customer' => $customer->id
          ]);

          if($charge==true)
          {
            $query = "SELECT * FROM merchant WHERE email='$this->email'";
            $result = $d->query($query);
            $result=$result->fetch_assoc();
            $merchant_id=$result['id'];
            $credit=$result['credit'];
            $credit=$credit+($charge->amount_captured/100);

            $query = "UPDATE merchant SET credit='$credit' WHERE email='$this->email' ";
            $result = $d->query($query);

            $query = "INSERT INTO payments (Balance, merchant_id,C_D) VALUES ('$credit', '$merchant_id',1)";
            $result = $d->query($query);

            return true;
          }
          else{
              return false;
          }
    }
}
?>
