<head></head>
<?php
session_start();
require_once('template.php');
require_once('class/class_customer.php');
require_once('class/class_card.php');

$customer = new Customer();
$card = new Card();

$validation = '^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$^';

if (isset($_POST['id_card'])) {
    $val_pass = true;
    $deposit = $_POST['deposit'];


    if (isset($_POST['delete'])) {
        $customer->customerExit($deposit);
      

        echo "<script> swal('Klient został wylogowany','', 'success');</script>";
    }
}
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</head>
<div class="container-fluid">
    <div class="row stat_margin">
        <div class="col-1">
            <!-- lewa kolumna-->          
        </div>
        <div class="col-10 ">
            <div class="row justify-content userRegistry_background rounded-top">

                <div class="col-4 justify-content">

                    <br><br>

                    <div class="userRegistry_border">
                        <h3>Klient</h3>
                        <br>

                        <form action="#" method="post">
                                                       
                            <div class="form-group row">
                                <label class="col-5 col-form-label">ID karty:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" placeholder="Id karty" name="id_card" id="id_card" value="" readonly="readonly" required>


                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-5 col-form-label">Imie:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="Imie" name="name" id="name" value="" readonly="readonly" required>

                                

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Nazwisko:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="Nazwisko" name="lastname" id="lastname" value="" readonly="readonly" required>
                                      

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Strefa:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="Strefa" name="zone" id="zone" value="" readonly="readonly" required>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-5 col-form-label">Szafka:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="Numer" name="deposit" id="deposit" value="" readonly="readonly" required>


                                </div>
                            </div>

                          
                             
                            <div class="form-group row ">

                                <div class="col-11">

                                   <button onclick="" type="submit" name="delete" class="btn btn-primary  btn-block">Wyloguj</button>
                                    


                                </div>

                            </div>

                </form>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>

                <div class="col-8">
                    <br><br>

                    <h3>Klienci</h3><br>

                    <input type="text" id="searchBox" onkeyup="searchCustomerInside();" placeholder="Szukaj...">

                    <input type="text" id="searchBoxId" onkeyup="searchCustomerId();" placeholder="Wprowadz nr szafki">

                    <?php $card->getCustomerInsideList(); ?>

                </div>
                
                

            </div>

            <div class="row justify-content-around userRegistry_background ">


            </div>
            <div class="row justify-content-around userRegistry_background rounded-bottom ">


            </div>

        </div>
        <div class="col-1">
            <!--prawa kolumna-->
        </div>
    </div>
</div>
