<?php
class Database
{
public $isConn;
protected $database;

//connect to db
public function __construct($username = "root", $password = "", $host = "localhost", $dbname = "sport", $options =[])
{
    $this->isConn = TRUE;
    try
    {
        
        $this->database = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) 
    {
        throw new Exception($e->getMessage());
    }
}

//disconnect db
public function Disconnect()
{
    $this->database = NULL;
    $this->isConn = FALSE;
}

}
/*
$host = 'mysql:host=localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'dbname=sport';
*/
?>