<?php
class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $contact_num;
    private $status;

    public function set_user($id, $name, $email, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        }

    public function get_user()
    {
        $user = array(
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
        );
        return $user;
    }
    public function sign_up($name,$email, $password,$confirm_password, $db_conn)
    {
         $query = "INSERT INTO user (name,password,email) VALUES ('$name','$password', '$email');";
         var_dump($query);
        $result = $db_conn->query($query);
        if($result)
        {
            return true;
        }
        else{
            return false;
        }
         $db_conn->close();
    }
    public function sign_in($email, $password, $db_conn)
    {
      //create query
      $query = "SELECT name,email FROM user WHERE email='$email' AND password='$password'";
        $result = $db_conn->query($query);
        if($result)
        {
            return $result;
        }else{
            return false;
        }
         $db_conn->close();
    }
  
    public function set_new_pass($new_pass, $confirm_pass, $token, $db_conn)
    {
        $sql = "UPDATE user SET password ='$confirm_pass' WHERE Token=$token";

        if ($db_conn->query($sql) === TRUE) {
          $sql = "UPDATE user SET Token = NULL WHERE Token=$token";
          $db_conn->query($sql);
        return true;
       }
        else 
       {
        return false;
       }
         $db_conn->close();
    }

    public function get_merchant()
    {

    }


    public function get_second_user()
    {
        
    }

    public function get_payments()
    {
        
    }

    public function get_request()
    {
        
    }
}
