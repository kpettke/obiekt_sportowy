<?php
session_start();
require_once 'connectDB.php';

class User extends Database
{
    private $stmt;
    private $query;
    
    

    public function getUserInfo($login) // info from right user panel in dashboard
    {
        $this->query = ("SELECT * FROM users WHERE login=:login limit 1");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

      // echo '<img src = "'.$row[img].'" class = "rounded-circle profile_border" width = "100" height = "100" ><br><br>'; //avatar
       echo 'Imie: '.ucfirst($row['name']).'<br>Nazwisko: '.ucfirst($row['lastname']).'<br>E-mail: '.$row['mail'].'<br>Stanowisko: '.ucfirst($row['position']); 
    }
    
       public function getUserId($login) {
        $this->query = ("SELECT id FROM users where login=:login");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($login, $hash_password, $name, $lastname, $mail, $permission, $position, $img)
    {
            $this->query = ("INSERT INTO users VALUES (NULL,:name,:lastname,:login,:password,:mail,:permission,:position,:img)");
            $this->stmt = $this->database->prepare($this->query);

            $this->stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $this->stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $this->stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $this->stmt->bindValue(":password", $hash_password, PDO::PARAM_STR);
            $this->stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
            $this->stmt->bindValue(":permission", $permission, PDO::PARAM_STR);
            $this->stmt->bindValue(":position", $position, PDO::PARAM_STR);
            $this->stmt->bindValue(":img", $img, PDO::PARAM_STR);
            $this->stmt->execute();
            
            return true;
    }
    
 
    public function  editUser($id,$name,$lastname,$login,$mail,$permission, $position)
    {
        $this->query = ("UPDATE users SET name= :name, lastname= :lastname, login= :login, mail= :mail,permission= :permission, position= :position WHERE id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $this->stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
        $this->stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $this->stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $this->stmt->bindValue(":permission", $permission, PDO::PARAM_STR);
        $this->stmt->bindValue(":position", $position, PDO::PARAM_STR);

        $this->stmt->execute();

        return true;
    }
    
    public function deleteUser($id)
    {
        $this->query = (" DELETE FROM users WHERE id= :id ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
            
        $this->stmt->execute();
    }
    
    public function newPasswordAdmin($id,$hash_password) //pwd reset by admin
    {
        $this->query = (" UPDATE users SET password= :password WHERE id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->bindValue(":password", $hash_password, PDO::PARAM_STR);
        
        $this->stmt->execute();
    }
    
     public function newPasswordUser($login, $hash_password) { //pwd reset by admin
        $this->query = (" UPDATE users SET password= :password WHERE login= :login");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $this->stmt->bindValue(":password", $hash_password, PDO::PARAM_STR);

        $this->stmt->execute();
    }

    public function checkEditFreeMail($id)
    {
        $this->query = ("SELECT mail from users where id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->execute();
        
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row['mail'];
    }
    
    public function checkFreeMail($mail) 
    {
        try {
            $this->query = ("SELECT mail from users where lower(mail) = lower(:mail)");
            $this->stmt = $this->database->prepare($this->query);
            
            $this->stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        }   
            catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function checkFreeLogin($login) 
    {
        try {
            $this->query = ("SELECT login from users where lower(login) = lower(:login)");
            $this->stmt = $this->database->prepare($this->query);

            $this->stmt->bindValue(':login', $login, PDO::PARAM_STR);
            $this->stmt->execute();
            $this->result = $this->stmt->rowCount();
            return $this->result;
        } 
            catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    

    public function checkEditFreeLogin($id) { 
        $this->query = ("SELECT login from users where id= :id");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $this->stmt->execute();

        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row['login'];
    }

    public function getUserList () //table with users in edit section
    {
        $this->query = ("SELECT id, mail, name, lastname, login, position, permission from users ");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->execute();
        
        echo '<table id="table" class="table-sm edit_table table-striped table-hover "><thead><tr><th width="3%"><center>#</center></th><th width="3%">ID</th><th><center>Login</center></th><th><center>E-Mail</center></th><th><center>Imie</center></th><th><center>Nazwisko</center></th><th><center>Stanowisko</center></th><th ><center>Uprawnienia</center></th></tr></thead><tbody>' ;
        
            foreach(array_slice($this->stmt->fetchAll(PDO::FETCH_ASSOC),2,1000) as $result)
                {
               
                $i++; //row count
                echo '<tr onclick="userEditTable(this);" id="'.$i.'"><td style="font-weight: bold"; width="3%"><center>'.$i.'</center></td><td width="3%" style="font-weight: normal";>'.$result['id'].'</td><td>'.$result['login'].'</td><td>'.$result['mail'].'</td><td style="text-align: center;">'.$result['name'].'</td><td>'.$result['lastname'].'</td><td>'.$result['position'].'</td><td>'.$result['permission'].'</td></tr>';
                    
                }
                echo '</tbody></table>';
    }
    
    public function checkPwd($login, $password) {  //check password for change user password

        $this->query = ("SELECT * FROM users WHERE login=:login limit 1");
        $this->stmt = $this->database->prepare($this->query);
        $this->stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $this->stmt->execute();
        $row = $this->stmt->rowCount();
        $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);

        if ($row > 0) {
            if (password_verify($password, $this->result['password'])) {
                //if ($password == $this->result['password']) {
                return TRUE;
            }
                    
            }
    }
}
