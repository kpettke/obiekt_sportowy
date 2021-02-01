<?php

if (isset($_POST['id'])) {

    
    require_once('../class/class_card.php');

   
    $card = new Card();

    $id = $_POST['id'];




    print $card->getCustomerNameByCard($id);
}
?>


