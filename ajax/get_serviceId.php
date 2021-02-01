<?php

if (isset($_POST['tariff']) && isset($_POST['name'])) {
    session_start();
    require_once('../class/class_service.php');

    $service = new Service ();

    $tariff = $_POST['tariff'];
    $name = $_POST['name'];
    $type = $_SESSION['type'];



    print $service->getId($name, $tariff, $type);
}
?>


