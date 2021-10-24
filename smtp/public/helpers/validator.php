<?php
class Validator
{
    public $name_pattern = "/[^a-z ]+/i";       //checks if name has any char except alphabets
    public $contact_num_pattern = "/[^0-9]+/";  //checks if contact_num has anyt char except integers

    public function contain_non_alphabet($name)
    {
        return preg_match($this->name_pattern, $name);
    }

    public function contain_non_integer($contact_num)
    {
        return preg_match($this->contact_num_pattern, $contact_num);
    }

    public function validate_email($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            return true;
        } else {
            return false;
        }
    }
}
