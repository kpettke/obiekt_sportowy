<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//if (isset($_POST['id'])) {
   
    
    require_once('../class/class_card.php');

   
    $card = new Card();

    $id = "100"; //$_POST['id'];
    
    //print_r($_POST);
    //print $id;
    
    $card->getCustomerSeviceByCard($id);
    //print "dupa";
//}
?>


