<?php 

require_once('../class/class_card.php');
if (isset ($_POST['id_card']))
{
        //zapytanie do bazy sparwdzające 1 karta ok  0 nie
            
    $card = new Card ();
    $id_card = $_POST['id_card'];
    $_SESSION['id_card'] = $id_card;
    
    
    if ($card->checkValidCard($id_card) == 1 )
    {
        
    print $id_card;
    //echo "<script> $('#exampleModal') . modal(); </script>";
    }
    else
    {
        print "0";
    }

    //$test = $_POST['check'];
    
    //echo 'To jest wartość z inputa: '.$test;
    
   // echo $test;
    
    
}


?>


