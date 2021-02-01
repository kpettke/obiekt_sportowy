<?php
if (isset($_POST['id_card'])) {
   

    require_once('../class/class_card.php');
    require_once('../class/class_customer.php');

    $customer = new Customer ();
    $card = new Card ();

    $id_card = $_POST['id_card'];


    if ($card->checkIdCard($id_card) == 1) {
        $_SESSION['id_card'] = $id_card;
        //header('Location: ../newCardPass.php');
        echo "1";
    }
    
 else {
    $_SESSION['error'] = error;
    print "0";
    }
}
?>
    