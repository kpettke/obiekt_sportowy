<head></head>
<?php
session_start();
require_once('template.php');

require_once('class/class_service.php');

if ($_SESSION['permission'] == 1) {
    header('location: controlPanel.php');
}

$service = new Service();


$validation = '^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$^';
$id_service = "";



if (isset($_POST['name'])) {
    $val_pass = true;

    $id = $_POST['id'];
    $price = $_POST['price'];
    $name = ucfirst($_POST['name']);
    $tariff = $_POST['tariff'];
    $type = $_POST['type'];


    if (($service->checkFreeService($name, $tariff, $type) > 0) &&( $service->checkEditFreeService($id) != $name ) ) {
       $val_pass = false;
        $_SESSION['error_name'] = '<font color = "red" size = "2">Wprowadzona usługa już istnieje</font></br>';
    }

    if (is_numeric($price) == FALSE && $price != "") {
        $val_pass = false;
        $_SESSION['error_price'] = '<font color="red" size="2">Cena może być tylko liczbą</font><br />';
    }

    if (preg_match($validation, $name) == false) { // only letters in name
        $val_pass = false;
        $_SESSION['error_name'] = '<font color="red" size="2">Nazwa może składać się tylko z liter </font><br />';
    }


    if ($val_pass == true && isset($_POST['edit'])) {
        $service->editService($id,$name, $tariff, $price, $type);
        echo "<script> swal('Usługa została zmieniona','', 'success');</script>";
    }
    
     if ($val_pass == true && isset($_POST['delete'])) {
        $service->deleteService($id);
        echo "<script> swal('Usługa została usunięta','', 'success');</script>";
    }
}
?>





<body>
    <div class="container-fluid">
        <div class="row stat_margin">
            <div class="col-2">
                <!-- lewa kolumna-->          
            </div>
            <div class="col-8">
                <div class="row justify-content userRegistry_background rounded-top">

                    <div class="col-4 justify-content">

                        <br><br>

                        <div class="userRegistry_border">
                            <br>
                            <h3>Usługa</h3>
                            <br>
                            <form action="#" method="post">

                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Id:</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" placeholder="Nazwa" name="id" id="id" readonly="readonly" value="" required>
                                   

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Nazwa usługi:</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" placeholder="Nazwa" name="name" id="name" value="" required>

                                        <?php
                                        if (isset($_SESSION['error_name'])) {
                                            echo $_SESSION['error_name'];
                                            unset($_SESSION['error_name']);
                                        }
                                        ?>

                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Taryfa: </label>
                                    <div class="col-6">
                                        <select class="form-control" type="text" placeholder="taryfa" name="tariff" id="tariff" required>
                                            <option  value=Normalna <?php
                                            if (isset($_SESSION['sex']) && $_SESSION['sex'] == "m") {
                                                echo 'selected="selected"';
                                            }
                                            ?>    >Normalna</option>
                                            <option <?php
                                            if (isset($_SESSION['sex']) && $_SESSION['sex'] == "k") {
                                                echo 'selected="selected"';
                                            }
                                            ?> value=Ulgowa>Ulogowa</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Typ: </label>
                                    <div class="col-6">
                                        <select class="form-control" type="text" placeholder="typ" name="type" id="type" required>
                                            <option  value=Miesięczny <?php
                                            if (isset($_SESSION['sex']) && $_SESSION['sex'] == "m") {
                                                echo 'selected="selected"';
                                            }
                                            ?>    >Miesięczny</option>
                                            <option <?php
                                            if (isset($_SESSION['sex']) && $_SESSION['sex'] == "k") {
                                                echo 'selected="selected"';
                                            }
                                            ?> value=Jednorazowy>Jednorazowy</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Cena:</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" placeholder="Cena" name="price" id="price" value="" required>
                                        <?php
                                        if (isset($_SESSION['error_price'])) {
                                            echo $_SESSION['error_price'];
                                            unset($_SESSION['error_price']);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row ">

                                    <div class="col-11">                                                                                                          
                                        <button onclick="" type="submit" name="edit" class="btn btn-primary  btn-block">Zapisz zmiany</button>        
                                        <button onclick="" type="submit" name="delete" class="btn btn-primary  btn-block">Usuń</button>   
                                    </div>
                                                                        
                                </div>

                            </form>
                           
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                      
                    </div>

                    <div class="col-8">
                        <br><br>

                        <h3>Usługi</h3><br>

                        <input type="text" id="searchBox" onkeyup="searchService()" placeholder="Szukaj...">

                        <?php $service->getServiceList(); ?>

                    </div>

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
</body>
</html>

