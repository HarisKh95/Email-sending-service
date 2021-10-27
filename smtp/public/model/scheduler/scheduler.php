<?php
require_once "../../../vendor/autoload.php";
use \Mailjet\Resources;
class Sechdule
{

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

    // public function check_merchant($name,$time,$d)
    // {
    //     $insert="Insert into cron (name,time) values ('$name','$time')";
    //     // $d->query($insert);   
    //     if($d->query($insert))
    //     {
    //         return true;
    //     }
    //     else
    //     {
    //         return false;
    //     }

    // }

    public function check_merchant($d)
    {
        $query = "Select * from merchant where credit <= 10.00 ";
        $result=$d->query($query);
        if($result->num_rows>0)
        {
            $data=array();
            $i=0;
            while ($row = $result->fetch_assoc()) {
                echo $row['name']."\r\n";
                echo $row['email']."\r\n";
                echo $row['credit']."\r\n";

                if($row['credit']<10.00){
                    $mj = new \Mailjet\Client('de3b38d401b829c2e7ce2f2087fcdd6f','851f311bce8cc3110d52464dd9885e55',true,['version' => 'v3.1']);
                    $body = [
                      'Messages' => [
                        [
                          'From' => [
                            'Email' => "hkhurshid95@gmail.com",
                            'Name' => "SMTP_Haris"
                          ],
                          'To' => [
                            [
                              'Email' => $row['email'],
                              'Name' => $row['name']
                            ]
                          ],
                          'Subject' => "Reminder for Credit",
                          'TextPart' => "Please Recharge",
                          'HTMLPart' => "Dear Merchant please recharge your credit for it is necessary. If you want to use our services.",
                          'CustomID' => "AppGettingStartedTest"
                        ]
                      ]
                    ];
                    // var_dump($this->email);
                    $response = $mj->post(Resources::$Email, ['body' => $body]);
                    if($response->success())
                    {
                        echo "Reminder send\r\n";
                    }
                }
            }
            return true;             
        }


        return false; 
        $d->close();

    }


}
?>
