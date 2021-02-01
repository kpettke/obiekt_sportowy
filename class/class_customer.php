<?php

require_once 'connectDB.php';

class Customer extends Database {

    private $stmt;
    private $query;

    public function addCustomer($idCard, $name, $lastname, $sex, $mail) {

        $this->query = ("INSERT INTO customers VALUES (NULL,:id_card,:name,:lastname,:sex,:mail, NULL, NULL, NULL, NULL)");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":id_card", $idCard, PDO::PARAM_STR);
        $this->stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $this->stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
        $this->stmt->bindValue(":sex", $sex, PDO::PARAM_STR);
        $this->stmt->bindValue(":mail", $mail, PDO::PARAM_STR);

        $this->stmt->execute();

        return true;
    }
    
       public function editCustomer($id, $id_card, $name, $lastname, $sex, $mail) {
        $this->query = ("UPDATE customers SET id_card= :id_card, name= :name, lastname= :lastname, sex= :sex, mail= :mail WHERE id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);
        $this->stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $this->stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
        $this->stmt->bindValue(":sex", $sex, PDO::PARAM_STR);
        $this->stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
      

        $this->stmt->execute();

        return true;
    }

    public function deleteCustomer($id) {
        $this->query = (" DELETE FROM customers WHERE id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);

        $this->stmt->execute();
    }

    public function customerInside() { //count customer inside
        $this->query = ("SELECT * FROM customer_inside");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->execute();
        $row = $this->stmt->rowCount();

        return $row;
    }

    public function checkFreeDeposit($deposit) { 
        try {
            $this->query = ("SELECT deposit from customer_inside where lower(deposit) = lower(:deposit)");
            $this->stmt = $this->database->prepare($this->query);
            $this->stmt->bindValue(':deposit', $deposit, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function countFreeDeposit()
    {
        
    }

    public function noCardEnter($deposit, $zone) //customer without subscription card //
    { 
        $this->query = ("INSERT INTO customer_inside VALUES (NULL, NULL, :deposit, :zone) ");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":deposit", $deposit, PDO::PARAM_STR);
        $this->stmt->bindValue(":zone", $zone, PDO::PARAM_STR);

        $this->stmt->execute();
        return true;
    }
    
    public function noCardEnterHistory($id_service) { //customer without subscription card //
        $this->query = ("INSERT INTO history_inside VALUES (NULL, 0, 0, :id_service, NULL) ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id_service", $id_service, PDO::PARAM_INT);
        $this->stmt->execute();
        return true;
    }

    public function cardEnter($id_card, $deposit, $zone) { //customer without subscription card //
        $this->query = ("INSERT INTO customer_inside VALUES (NULL, :id_card, :deposit, :zone) ");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);
        $this->stmt->bindValue(":deposit", $deposit, PDO::PARAM_STR);
        $this->stmt->bindValue(":zone", $zone, PDO::PARAM_STR);

        $this->stmt->execute();
        return true;
    }

    public function customerExit($deposit) { // card or nocard exit
        $this->query = ("DELETE FROM customer_inside WHERE deposit= :deposit");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":deposit", $deposit, PDO::PARAM_STR);
        $this->stmt->execute();
    }

    public function checkFreeMail($mail) {
        try {
            $this->query = ("SELECT mail from customers where lower(mail) = lower(:mail)");
            $this->stmt = $this->database->prepare($this->query);

            $this->stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
     public function checkEditFreeMail($id) {
        $this->query = ("SELECT mail FROM customers WHERE id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row['mail'];
    }

    public function checkFreeIdCard($id_card) {
        try {
            $this->query = ("SELECT id_card from customers where id_card = :id_card");
            $this->stmt = $this->database->prepare($this->query);

            $this->stmt->bindValue(':id_card', $id_card, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function checkEditFreeIdCard($id) {
        $this->query = ("SELECT id_card FROM customers where id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id_card'];
    }
    
      public function checkInsideIdCard($id_card) { //check that only 1 card is inside
        try {
            $this->query = ("SELECT id_card from customer_inside where id_card = :id_card");
            $this->stmt = $this->database->prepare($this->query);

            $this->stmt->bindValue(':id_card', $id_card, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getCustomerList() { //table with users in edit section
        $this->query = ("SELECT id, id_card, name, lastname, sex, mail FROM customers ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->execute();

        echo '<table id="table" class="table-sm edit_table table-striped table-hover "><thead><tr><th width="3%"><center>#</center></th><th  width="3%">ID</th><th width="9%">ID Karty</th><th><center>Imie</center></th><th><center>Nazwisko</center></th><th><center>Płeć</center></th><th><center>E-mail</center></th></tr></thead><tbody>';

        foreach ($this->stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {

            $i++; //row count
            echo '<tr onclick="customerEditTable(this);" id="' . $i . '"><td style="font-weight: bold"; width="3%"><center>' . $i . '</center></td><td width="3%" style="font-weight: normal";>' . $result['id'] . '</td><td width="9%" style="font-weight: normal";>' . $result['id_card'] . '</td><td>' . $result['name'] . '</td><td style="text-align: center;">' . $result['lastname'] . '</td><td>' . $result['sex'] . '</td><td>' . $result['mail'] . '</td></tr>';
        }
        echo '</tbody></table>';
    }
    
    public function getCustomerByCard ($id_card)
    {
        $this->query = ("SELECT id,name,lastname FROM customers WHERE id_card= :id_card ");
         $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(':id_card', $id_card, PDO::PARAM_STR);
        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        echo "<b>".$row['name']." ".$row['lastname']."</b>";
    }
    
       public function getCustomerIdByCard($id_card) {
        $this->query = ("SELECT id FROM customers WHERE id_card= :id_card ");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(':id_card', $id_card, PDO::PARAM_STR);
        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        echo $row['id'];
    }
      public function customerToday() { //count customer inside today
        $this->query = ("SELECT * FROM history_inside WHERE date_in > CURRENT_DATE()");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->execute();
        $row = $this->stmt->rowCount();

        return $row;
    }

}
