<?php

session_start();
require_once ('connectDB.php');

class System extends Database {

    private $stmt;
    private $query;
    
        public function editSettings($deposit, $user_info) 
        {
        $this->query = ("UPDATE system SET deposit_number= :deposit_number, user_info= :user_info WHERE id=1");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":deposit_number", $deposit, PDO::PARAM_INT);
        $this->stmt->bindValue(":user_info", $user_info, PDO::PARAM_STR);

        $this->stmt->execute();

        return true;
        }
        
        public function getDeposit() 
        {
        $this->query = ("SELECT deposit_number FROM system");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        return $row['deposit_number'];
        }
        
        public function getUser_info() 
        {
        $this->query = ("SELECT user_info FROM system");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        echo $row['user_info'];
    }

}
    