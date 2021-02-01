<?php
session_start();
require_once 'connectDB.php';

class Login extends Database
{
    private $stmt;
    private $query;
    private $result;

    public function getIn($login, $password)
    {
        
        $this->query = ("SELECT * FROM users WHERE login=:login limit 1");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":login",$login, PDO::PARAM_STR);
        $this->stmt->execute();
        $row = $this->stmt->rowCount();
        $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);

        if($row > 0 )
        {
            if (password_verify($password,$this->result['password'])){
            //if ($password == $this->result['password']) {
               return TRUE;
            }
        
        else 
        {
        return false;
        }
        }
        else
        {
        return false;
        }
        }
        
        public function getPermission($login)
        {
        $this->query = ("SELECT permission FROM users WHERE login=:login limit 1");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
       
        if ($this->result['permission'] == 1)
            {
            return 1;
        }
        
    }
}   




   

