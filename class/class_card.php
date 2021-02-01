<?php
session_start();
require_once ('connectDB.php');

class Card extends Database {

    private $stmt;
    private $query;

    
        public function addCard($id_card,$id_customer, $id_service, $valid_from, $valid_to) {

        $this->query = ("INSERT INTO cards VALUES (NULL,:id_card,:id_customer,:id_service,:valid_from,:valid_to)");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);
        $this->stmt->bindValue(":id_customer", $id_customer, PDO::PARAM_STR);
        $this->stmt->bindValue(":id_service", $id_service, PDO::PARAM_STR);
        $this->stmt->bindValue(":valid_from", $valid_from, PDO::PARAM_STR);
        $this->stmt->bindValue(":valid_to", $valid_to, PDO::PARAM_STR);
        
        $this->stmt->execute();

        return true;
    }
    
        public function editCard($id_card, $id_card_old) {
        $this->query = ("UPDATE cards SET id_card= :id_card WHERE id_card= :id_card_old");
        $this->stmt = $this->database->prepare($this->query);
        
        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);
        $this->stmt->bindValue(":id_card_old", $id_card_old, PDO::PARAM_STR);


        $this->stmt->execute();

        return true;
    }
    
    public function deleteCard($id_card) {
        $this->query = (" DELETE FROM cards WHERE id_card= :id_card ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);

        $this->stmt->execute();
    }
    
    public function addPass($id_card,$id_customer,$id_service, $valid_from, $valid_to) //add pass to card
    {
        $this->query = ("UPDATE cards SET id_customer= :id_customer, id_service= :id_service, valid_from= :valid_from, valid_to= :valid_to WHERE id_card= :id_card");
        $this->stmt = $this->database->prepare($this->query);

        
        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);
        $this->stmt->bindValue(":id_customer", $id_customer, PDO::PARAM_STR);
        $this->stmt->bindValue(":id_service", $id_service, PDO::PARAM_STR);
        $this->stmt->bindValue(":valid_from", $valid_from, PDO::PARAM_STR);
        $this->stmt->bindValue(":valid_to", $valid_to, PDO::PARAM_STR);


        $this->stmt->execute();

        return true;
    }
    
     public function checkIdCard($id_card) { //check that card exists
        try {
            $this->query = ("SELECT id_card from cards WHERE id_card = :id_card");
            $this->stmt = $this->database->prepare($this->query);
            $this->stmt->bindValue(':id_card', $id_card, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
               
    }
    
      public function checkValidCard($id_card) { //check that card is valid to enter
        try {
            $this->query = ("SELECT id_card, valid_from, valid_to FROM cards WHERE id_card = :id_card AND valid_from <= CURDATE() AND valid_to >= CURDATE()");
            $this->stmt = $this->database->prepare($this->query);
            $this->stmt->bindValue(':id_card', $id_card, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
     public function cardEnter($id_card ,$deposit, $zone) { //customer with subscription card ->
        $this->query = ("INSERT INTO customer_inside VALUES (NULL, :id_card, :deposit, :zone) ");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);
        $this->stmt->bindValue(":deposit", $deposit, PDO::PARAM_STR);
        $this->stmt->bindValue(":zone", $zone, PDO::PARAM_STR);

        $this->stmt->execute();
        
        
        
        return true;
    }
    
      public function historyAdd($id_card) { //customer with subscription card ->
        $this->query = ("INSERT INTO history_inside (id_card, id_customer, id_service) SELECT id_card, id_customer, id_service FROM cards WHERE id_card= :id_card");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":id_card", $id_card, PDO::PARAM_STR);
      
    

        $this->stmt->execute();



        return true;
    }

    public function getCustomerSeviceByCard($id) // service name in eneter modal
    {
        try{
        $this->query = ("SELECT s.name FROM cards c join services s on (c.id=s.id) WHERE s.id = c.id_service AND c.id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $this->stmt->execute();
        
        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['name'];
        }
         catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
        
    }
    
     public function getCustomerNameByCard($id) { //customer name in enter modal
        $this->query = ("SELECT customers.name, customers.lastname FROM cards, customers WHERE customers.id = cards.id_customer AND cards.id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['name'];
        print " ";
        print $this->result['lastname'];
    }
    
    public function getCustomerTariffByCard($id) {  //tariff name in extra customer info
        $this->query = ("SELECT services.tariff FROM cards, services WHERE services.id = cards.id_service AND cards.id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['tariff'];
       
    }
    
     public function getCustomerValidFromByCard($id) { // valid inf in extra customer info
        $this->query = ("SELECT valid_from FROM cards WHERE id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['valid_from'];
    }
    
     public function getCustomerValidToByCard($id) { //valid info in extra customer info
        $this->query = ("SELECT valid_to FROM cards WHERE id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['valid_to'];
    }
    
     public function getCustomerLastEntry($id) { //last entry of customer
        $this->query = ("SELECT date_in FROM history_inside  WHERE id_card= :id ORDER BY date_in DESC LIMIT 1");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['date_in'];
    }
    
      public function getCustomerInsideList() { //table with inside customers
        $this->query = ("SELECT ci.id_card, ci.deposit, ci.zone, cu.name, cu.lastname FROM customer_inside ci LEFT JOIN customers cu ON (cu.id_card=ci.id_card) ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->execute();

        echo '<table id="table" class="table-sm edit_table table-striped table-hover "><thead><tr><th width="3%"><center>#</center></th><th width="8%"><center>ID Karty</center></th><th>Szafka</th><th><center>Strefa</center></th><th><center>Imie</center></th><th><center>Nazwisko</center></th></tr></thead><tbody>';

        foreach ($this->stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {

            $i++; //row count
            echo '<tr onclick="customerInsideTable(this);" id="' . $i . '"><td style="font-weight: bold"; width="3%"><center>' . $i . '</center></td><td width="8%" style="font-weight: normal";>' . $result['id_card'] . '</td><td  style="font-weight: normal";>' . $result['deposit'] . '</td><td>' . $result['zone'] . '</td><td style="text-align: center;">' . $result['name'] . '</td><td>' . $result['lastname'] . '</td></tr>';
        }
        echo '</tbody></table>';
    }
    
      public function getLastMonth($id_card) { //numbers of visit last month
        
            $this->query = ("SELECT id FROM history_inside WHERE now() - interval 1 month < date_in AND id_card= :id_card");
            $this->stmt = $this->database->prepare($this->query);
            $this->stmt->bindValue(':id_card', $id_card, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            print $this->result;
    }

}