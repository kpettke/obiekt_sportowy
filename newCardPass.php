
<?php
session_start();
require_once('template.php');
require_once('class/class_card.php');
require_once('class/class_service.php');
require_once('class/class_customer.php');

$service = new Service ();
$customer = new Customer();
$card = new Card();

$_SESSION['type'] = Miesięczny; //name of type entry
$type = $_SESSION['type'];
$id_card = $_SESSION['id_card'];
 unset($_SESSION['error_price']);


if (isset($_POST['price']) ) 
    {
        $price = $_POST['price'];
        $tariff = $_POST['tariff'];
        $zone = $_POST['zone'];
        $id_service = $_POST['id_service'];
        $id_customer = $_POST['id_customer'];
        $valid_from = $_POST['valid_from'] ;
        $valid_to =  $_POST['valid_to']." 23:59:59"; // to end of day


    $val_pass = true;

    if ((is_numeric($price) == FALSE) && $price != "" ) 
    {
        $_SESSION['error_price']="";
        $val_pass = false;
       
    }

    if ($val_pass == true)
    {
        
        
        $card->addPass($id_card, $id_customer, $id_service, $valid_from, $valid_to);
        unset($_SESSION['id_card']);
        $_SESSION['passAdd'] = TRUE; // to show alerbox that ADD is passed in customerSaleRegistry
         header('Location: customerSaleRegistry.php');
    }
}

if (isset($id_card))
{
    
}
else
{
    header('Location: customerSaleRegistry.php');
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
                        
                        <h3>Nowy karnet</h3>
                        <h4><?php $customer->getCustomerByCard($id_card); ?></h4>
                        
                        <form action="#" method="post">
                            
                         <input class="form-control" type="text" style="visibility: hidden;" name="id_service" id="id_service"  required>
                            
                            <div class="form-group row">
                                <label class="col-5 col-form-label">ID karty:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="id_card" id="id_card" readonly="readonly" value="<?php echo $id_card ?>" >

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Strefa: </label>
                                <div class="col-6">
                                    <select class="form-control" type="text" name="zone" id="name"  onchange="getService();getServiceId();"  required>
                                        <?php $service->getName($_SESSION['type']); ?>                                             
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Taryfa: </label>
                                <div class="col-6">
                                    <select class="form-control" type="text" name="tariff" id="tariff"  onchange="getService();getServiceId();" required>
                                        <?php $service->getTariff($_SESSION['type']); ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-5 col-form-label">Data rozpoczęcia:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="valid_from" id="datepicker_from"  value="" required>

                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-5 col-form-label">Data zakończenia:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" name="valid_to" id="datepicker_to"  value="" required >

                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-5 col-form-label">Cena:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="pln" name="price"  id="price" value="" required>

                                    <?php
                                    if (isset($_SESSION['error_price'])) {
                                        echo $_SESSION['error_price'];
                                        unset($_SESSION['error_price']);
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form-group row ">

                                <div class="col-10">
                                    <input class="form-control" type="text"  style="visibility: hidden;" name="id_customer" id="id_customer" value="<?php $customer->getCustomerIdByCard($id_card); ?>"  required> 
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
                    getServiceId();
                         
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