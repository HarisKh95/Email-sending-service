<?php

class Merchant
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $credit;
    private $token;

    //setting an employee's properties
    public function set_employee($id, $name, $email, $password, $credit, $token)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->credit = $credit;
        $this->token = $token;
    }
    //get employee properties as associative array
    public function get_employee()
    {
        $employee = array(
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "designation" => $this->designation,
            "salary" => $this->salary,
            "contact_num" => $this->contact_num
        );
        return $employee;
    }
    //adding employee record in database
    public function add_employee($name, $email, $designation, $salary, $contact, $db_conn)
    {
        $sql = "INSERT INTO
        employee (name, email , designation, contact_num, salary)
        VALUES ('$name', '$email', '$designation','$salary','$contact')";

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

    //deleting employee from database
    public function delete_employee($id, $db_conn)
    {
      //create query
        $query = $db_conn -> prepare("DELETE FROM employee WHERE id = '$id'");
        
       //sanitize
        $id = htmlspecialchars(strip_tags($id));
        
        //bind id of employee to delete
        $query -> bind_param("i", $id);

        //execute query
        if($query->execute())
        {
            return true;
        }

        return false; 
    }

    //updating employee's record
    public function update_employee($id, $name, $email, $password, $credit, $token, $db_conn)
    {
            // query 
       // $query_object=$db_conn->mysqli_qury()->execute();
        $query = "UPDATE employee Set name, email,password, credit, token VALUE('".$name."','".$email."','".$password."','".$credit."','".$token."') where id='".$id."'";  
        if($db_conn->query($query));
        {
            return true;
        }
        {
            return false;
        }
    }

    
    //searching employee
    public function search_employee($keywords, $db_conn)
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

    //displaying record of all employees
    public function list_employee($db_conn)
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
                $data['designation']=$row['designation'];
                $data['contact_num']=$row['contact_num'];
                $data['salary']=$row['salary']; 
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
