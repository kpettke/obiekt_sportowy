<?php  
if (isset ($_POST['taryfa']) && isset($_POST['strefa']))
 {
  
     require_once('../class/class_service.php');
     
      $service = new Service ();
    
    $tariff   = $_POST['taryfa'];
    $name = $_POST['strefa']; 
     
     
     print $service->getPriceTest($name, $tariff); 
    
    
}



?>


