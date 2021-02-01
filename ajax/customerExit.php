<?php

if (isset($_POST['deposit'])) {
    session_start();
    require_once('../class/class_customer.php');

    $customer = new Customer ();

    $deposit = $_POST['deposit'];
   


    if ($customer->checkFreeDeposit($deposit) == 1)
    {
        print 1;
        $customer->customerExit($deposit);
        
    }
    else 
    {
           print 0;

        //echo 'To jest wartość z inputa: '.$test;
      
        
    }
}
       
?>


