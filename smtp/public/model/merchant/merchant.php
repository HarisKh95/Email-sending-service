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
            $query = "INSERT INTO request (from_email,to_email,Cc,Bcc,subject,merchant_id) VALUES ('$from','$to','$cc','$bcc','$subject','$merchant_id')";
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
            // query 
       // $query_object=$db_conn->mysqli_qury()->execute();
        $query = "Select * from request where merchant_id='$merchant_id' ";
        $result=$d->query($query);
        // $result=$result->fetch_assoc();  
        if($result->num_rows>0)
        {
            // while($result=$result->fetch_array()) {
            //     $name[]=array('Id'=>$result['id']); 
                // here you want to fetch all 
                // records from table like this. 
                // then you should get the array 
                // from all rows into one array 
            // }
            $data=array();

            while($row=$result->fetch_all())
            {
                $data['from_email']=$row[1];
                $data['to_email']=$row[2];
                $data['Cc']=$row[3];
                $data['Bcc']=$row[4];
                $data['subject']=$row[5];
            }
            var_dump($data);
            return $data;
        }
        else
        {
            return false;
        }
        $d->close();
    }

    
    //get payments
    public function check_payment($keywords, $db_conn)
    {
        // create query
        $sql_query = $db_conn->query("SELECT * FROM employee where name Like '$keywords'");
        if($sql_query->num_rows>0)
        {
            $data=array();
            while($row=$sql_query->fetch_assoc())
            {
                $data['id']=$row['id'];
                $data['name']=$row['name'];
                $data['email']=$row['email'];
                $data['designation']=$row['designation'];
                $data['contact_num']=$row['contact_num'];
                $data['salary']=$row['salary'];
            }
            return $data;

        }
        else
        {
            return false;
        }
        $db_conn->close();
    }

    //add secondary user
    public function new_user($db_conn)
    {
       //create query
       $qury = $db_conn->query("select * from employee");
        if ($qury->num_rows > 0) {
            $data=array();
            while($row=$qury->fetch_assoc()) 
            {
                $data['id']=$row['id'];
                $data['name']=$row['name'];
                $data['email']=$row['email'];

            }
            return $data;
        }else
        {
            return false;
        }
         $db_conn->close();
    }
}
?>
