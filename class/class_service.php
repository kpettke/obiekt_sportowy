<?php

require_once ('connectDB.php');

class Service extends Database {

    private $stmt;
    private $query;

    public function getName ($type) // for ajax function in single and pas sell,  to get name of service
    {
         $this->query = ("SELECT DISTINCT name FROM services WHERE type= :type");
         $this->stmt = $this->database->prepare($this->query);
         $this->stmt->bindValue(':type', $type, PDO::PARAM_STR);
         $this->stmt->execute();
         
         foreach ($this->stmt->fetchAll(PDO::FETCH_ASSOC) as $result)
         {
           echo '<option value="'.$result['name'].'">'.$result['name'].'</option>';          
         }
    }
         
    public function getTariff($type) //for ajax function to get tariff for single and pass salle
    {
        $this->query = ("SELECT DISTINCT tariff FROM services WHERE type= :type");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':type', $type, PDO::PARAM_STR);
        $this->stmt->execute();

        foreach ($this->stmt->fetchAll(PDO::FETCH_ASSOC) as $result)
        {                
                echo '<option value="'.$result['tariff'].'">'.$result['tariff'].'</option>';
        }
    }
    
    public function getPrice() 
    {
        $this->query = ("SELECT price FROM services ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->execute();

        foreach ($this->stmt->fetchAll(PDO::FETCH_ASSOC) as $result)
        {           
        echo $result['price'];
        }
    }
    
        public function getPriceSingle($name, $tariff, $type) //get price for ajax function in single and pass sell
    {
        $this->query = ("SELECT price FROM services WHERE name= :name AND tariff= :tariff AND type= :type  LIMIT 1");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $this->stmt->bindValue(':tariff', $tariff, PDO::PARAM_STR);
        $this->stmt->bindValue(':type', $type, PDO::PARAM_STR);
        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['price'];
			
    }
    
        public function getId($name, $tariff, $type) { //to get serivce id
        $this->query = ("SELECT id FROM services WHERE name= :name AND tariff= :tariff AND type= :type  LIMIT 1");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $this->stmt->bindValue(':tariff', $tariff, PDO::PARAM_STR);
        $this->stmt->bindValue(':type', $type, PDO::PARAM_STR);
        $this->stmt->execute();
        $this->result = $this->stmt->fetch();
        print $this->result['id'];
    }
    
        public function checkFreeService($name, $tariff, $type) { //to check that serivce is free
        $this->query = ("SELECT name,tariff,type FROM services WHERE name= :name AND tariff= :tariff AND type= :type");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $this->stmt->bindValue(':tariff', $tariff, PDO::PARAM_STR);
        $this->stmt->bindValue(':type', $type, PDO::PARAM_STR);

        $this->stmt->execute();
        $this->result = $this->stmt->rowCount();
        return $this->result;
    }
    
        public function checkEditFreeService($id) {
        $this->query = ("SELECT name,tariff,type FROM services WHERE id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row['name'];
    }

    public function addService($name, $tariff ,$price, $type) {

        $this->query = ("INSERT INTO services VALUES (NULL,:name,:tariff,:price,:type)");
        $this->stmt = $this->database->prepare($this->query);

        $this->stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $this->stmt->bindValue(":tariff", $tariff, PDO::PARAM_STR);
        $this->stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $this->stmt->bindValue(":type", $type, PDO::PARAM_STR);
        

        $this->stmt->execute();

         return true;
    }
    
      public function deleteService($id) {
        $this->query = (" DELETE FROM services WHERE id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);

        $this->stmt->execute();
    }

    public function getServiceList() { //table with services in service edit
        $this->query = ("SELECT id, name, tariff, price, type FROM services ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->execute();

        echo '<table id="table" class="table-sm edit_table table-striped table-hover "><thead><tr><th width="4%"><center>#</center></th><th  width="4%">ID</th><th width="9%">Strefa</th><th><center>Taryfa</center></th><th><center>Typ</center></th><th><center>Cena</center></th></tr></thead><tbody>';

        foreach ($this->stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {

            $i++; //row count
            echo '<tr onclick="serviceEditTable(this);" id="' . $i . '"><td style="font-weight: bold"; width="4%"><center>' . $i . '</center></td><td width="4%" style="font-weight: normal";>' . $result['id'] . '</td><td width="9%" style="font-weight: normal";>' . $result['name'] . '</td><td>' . $result['tariff'] . '</td><td style="text-align: center;">' . $result['type'] . '</td><td>' . $result['price'] . '</td></tr>';
        }
        echo '</tbody></table>';
    }
    
       public function editService($id, $name, $tariff, $price, $type) {
        $this->query = ("UPDATE services SET name= :name, tariff= :tariff, price= :price, type= :type WHERE id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $this->stmt->bindValue(":tariff", $tariff, PDO::PARAM_STR);
        $this->stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $this->stmt->bindValue(":type", $type, PDO::PARAM_STR);
        

        $this->stmt->execute();

        return true;
    }

}