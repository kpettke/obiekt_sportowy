<!DOCTYPE html>
<html lang="pl">

<?php
session_start();
require_once('class/class_customer.php');
require_once('class/class_card.php');
require_once('class/class_system.php');
$customer = new Customer();
$card = new Card();
$settings = new System();

if (isset($_POST['id_card'])) {
    $id_card = $_POST['id_card'];
    $deposit = $_POST['deposit'];
    $zone = $_POST['zone'];
    $val_pass = true;
    $id_customer= 1;

    if ($customer->checkInsideIdCard($id_card) > 0) {
        $val_pass = false;
        echo "<script>swal('Klient został juz wprowadzony','', 'error');</script>";
        $_POST = array();
        }
    
    if($customer->checkFreeDeposit($deposit) > 0 )
    {
        $val_pass = false;
        
        echo "<script>swal('Wybrana szafka jest już zajęta','', 'error');</script>";
        $_POST = array();
            // header('Location: main.php');
    }


      if (($val_pass == true) && ($settings->getDeposit() <= $customer->customerInside() )) {

        echo "<script>swal('Brak wolnych szafek','', 'error')</script>";
        echo '<script>setTimeout(function () {document.location.href = "main.php";}, 1200);</script>';
    }

    if (($val_pass == true) && ($settings->getDeposit() > $customer->customerInside() )) {
        $card->cardEnter($id_card, $deposit, $zone);
        $card->historyAdd($id_card);
        echo "<script>swal('Wprowadzono klienta','', 'success');</script>";
       // echo '<script> document.location.href ="main.php";</script>';
        echo '
            <script>setTimeout(function () {document.location.href = "main.php";}, 1200);</script>';
        }
}
?>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dane posiadacza karty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Imie i nazwisko:</label>
                        <input type="text" class="form-control" id="name" readonly="readonly" />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">ID Karty:</label>
                        <input type="text" class="form-control" name="id_card" id="id_card" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">Strefa:</label>
                        <input class="form-control" name="zone" id="zone" readonly="readonly" />
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="form-control-label">Nr szafki:</label>
                        <input class="form-control" name="deposit" id="message-text"/>
                        
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-primary">Wprowadź</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>