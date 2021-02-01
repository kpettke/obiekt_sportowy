
<?php
session_start();
require_once('template.php');
require_once('class/class_card.php');
require_once('class/class_service.php');
require_once('class/class_customer.php');

$service = new Service ();
$customer = new Customer();
$card = new Card();


//$type = $_SESSION['type'];
$id_card = $_SESSION['id_card'];
unset($_SESSION['error_price']);


?>


<div class="container-fluid">
    <div class="row stat_margin">
        <div class="col-2">
            <!-- lewa kolumna-->          
        </div>
        <div class="col-8 ">
            <div class="row justify-content-center userRegistry_background rounded-top">

                <div class="col-5 justify-content">

                    <br><br>

                    <div class="userRegistry_border">

                       
                        <h4><?php $customer->getCustomerByCard($id_card); ?></h4><br>

                        <form action="#" method="post">


                            <div class="form-group row">
                                <label class="col-5 col-form-label">ID karty:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="id_card" id="id_card" readonly="readonly" value="<?php echo $id_card ?>" >


                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-5 col-form-label">Strefa:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="zone" id="zone" readonly="readonly" value="<?php $card->getCustomerSeviceByCard($id_card) ?>" >


                                </div>
                            </div>
                           

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Taryfa:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="tariff" id="tariff" readonly="readonly" value="<?php $card->getCustomerTariffByCard($id_card) ?>" >


                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Data rozpoczęcia:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="valid_from"   value="<?php $card->getCustomerValidFromByCard($id_card) ?>" readonly="readonly">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Data zakończenia:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="valid_to"   value="<?php $card->getCustomerValidToByCard($id_card) ?>"  readonly="readonly">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Ostatnia wizyta:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="last_visit"   value="<?php $card->getCustomerLastEntry($id_card) ?> "  readonly="readonly">

                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-5 col-form-label">Liczba wizyt (ostanie 30 dni):</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="visit_30"   value="<?php $card->getLastMonth($id_card) ?> "  readonly="readonly">

                                </div>
                            </div>
                         
                          

                            <div class="form-group row ">

                                <div class="col-10">
                                    

                                </div>

                            </div>

                        </form>
                        <a href="customerEdit.php" class="btn btn-primary">Wróć</a>


                    </div>
                    <br><br>
                    <br>
                </div>
<!-- prawa strona od tabeli -->

            </div>

            <div class="row justify-content-around userRegistry_background ">


            </div>
            <div class="row justify-content-around userRegistry_background rounded-bottom ">


            </div>

        </div>
        <div class="col-2">
            <!--prawa kolumna-->
        </div>
    </div>
</div>ł