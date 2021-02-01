
<?php
session_start();
require_once('template.php');
require_once('class/class_customer.php');
require_once('class/class_service.php');
require_once('class/class_system.php');

$service = new Service ();
$customer = new Customer();
$setting = new System();
//$_SESSION['type'] = Jednorazowy; //name of type entry

if (isset($_POST['deposit'])) {
    $deposit = $_POST['deposit'];
    $zone = $_POST['zone'];
    $val_pass = true;
    $id_serivce = $_POST['id_service'];

    if ($customer->checkFreeDeposit($deposit) > 0) {
        $val_pass = false;
        echo "<script>swal('Ten nr już wykorzystano','', 'error')</script>";
        // $_SESSION['error_deposit'] = '<font color="red" size="2">Ten nr już wykorzystano</font><br />';
    }

    if (is_numeric($deposit) == FALSE) {
        $val_pass = false;
        $_SESSION['error_deposit'] = '<font color="red" size="2">Wpisz liczbe</font><br />';
    }

     if (($val_pass == true) && ($settings->getDeposit() <= $customer->customerInside() )) {

        echo "<script>swal('Brak wolnych szafek','', 'error')</script>";
        echo '<script>setTimeout(function () {document.location.href = "customers_no_card.php";}, 1200);</script>';
    }

    if (($val_pass == true) && ($settings->getDeposit() > $customer->customerInside() ) ) {
        $customer->noCardEnter($deposit, $zone);
        $customer->noCardEnterHistory($id_serivce);
        echo "<script>swal('Wprowadzono klienta','', 'success')</script>";
        echo '<script>setTimeout(function () {document.location.href = "customers_no_card.php";}, 1200);</script>';
    }
     
}
?>


<div class="container-fluid">
    <div class="row stat_margin">
        <div class="col-2">
            <!-- lewa kolumna-->          
        </div>
        <div class="col-8 ">
            <div class="row justify-content-center userRegistry_background rounded-top">

                <div class="col-4 justify-content">

                    <br><br>

                    <div class="userRegistry_border">
                        <h3>Jednorazowe wejście</h3>
                        
                        <form action="#" method="post">

                            <input class="form-control" type="text" placeholder="Id" name="id_service"  style="visibility: hidden;" id="id_service" value="6" required>


                            <div class="form-group row">
                                <label class="col-4 col-form-label">Strefa: </label>
                                <div class="col-6">
                                    <select class="form-control" type="text" name="zone" id="name"  onchange="getService();getServiceId();"  required>
                                        <?php $service->getName($_SESSION['type']); ?>                                             
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label">Taryfa: </label>
                                <div class="col-6">
                                    <select class="form-control" type="text" name="tariff" id="tariff"  onchange="getService();getServiceId();" required>
                                        <?php $service->getTariff($_SESSION['type']); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label">Cena:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="pln" name="price"  id="price" value="" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-4 col-form-label">Szafka:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="nr szafki" name="deposit" value="" required>

                                    <?php
                                    if (isset($_SESSION['error_deposit'])) {
                                        echo $_SESSION['error_deposit'];
                                        unset($_SESSION['error_deposit']);
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form-group row ">

                                <div class="col-10">
                                    <button onclick="" type="submit" class="btn btn-primary  btn-block">Zapłać</button>

                                </div>

                            </div>

                        </form>


                    </div>
                    <br><br>
                    <br>
                </div>

                <script type="text/javascript">
                    getService();
                </script>

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
</div>