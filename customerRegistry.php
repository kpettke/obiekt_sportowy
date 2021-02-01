<?php
session_start();
require_once('template.php');
require_once('class/class_customer.php');
require_once('class/class_card.php');

$newCustomer = new Customer();
$newCard = new Card();

$validation     = '^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$^';
$id_service    = "";
$valid_from     = "";
$valid_to       = "";
$id_customer    ="";



if (isset($_POST['name'])) {
    $val_pass = true;

    $id_card = $_POST['id_card'];
    $_SESSION['id_card'] = $id_card;
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $mail = $_POST['mail'];
    $mailB = filter_var($mail, FILTER_SANITIZE_EMAIL);

    
    if ($newCustomer->checkFreeIdCard($id_card) > 0) {
        $val_pass = false;
        $_SESSION['error_id_card'] = '<font color = "red" size = "2">Wprowadzony ID juz istanieje</font></br>';
    }

    if (is_numeric($id_card) == FALSE && $id_card != "") {
        $val_pass = false;
        $_SESSION['error_id_card'] = '<font color="red" size="2">ID może być tylko liczbą</font><br />';
    }

    if (preg_match($validation, $name) == false) { // only letters in name
        $val_pass = false;
        $_SESSION['error_name'] = '<font color="red" size="2">Imie może składać się tylko z liter </font><br />';
    }

    if (preg_match($validation, $lastname) == false) { // only letters in lastname
        $val_pass = false;
        $_SESSION['error_lastname'] = '<font color="red" size="2">Nazwisko może składać się tylko z liter </font><br />';
    }


    if ($newCustomer->checkFreeMail($mail) > 0) {
        $val_pass = false;
        $_SESSION['error_mail'] = '<font color = "red" size = "2">Wprowadzony mail juz istanieje</font></br>';
    }

    if ($mail != "")
    {
        
         if ((filter_var($mailB, FILTER_VALIDATE_EMAIL) == false || ($mailB != $mail))) { // mail validation
            $val_pass = false;
            $_SESSION['error_mail'] = '<font color="red" size="2">Podaj poprawny adres e-mail</font></br>';
        }
    }
    if ($val_pass == true && isset($_POST['add'])) {
        $newCustomer->addCustomer($id_card, $name, $lastname, $sex, $mail);
        $newCard->addCard($id_card, $id_service,$id_customer ,$valid_from, $valid_to);

        $mail = null;
        $name = null;
        $lastname = null;
        $id_card = null;


        unset($_SESSION['error_name']);
        unset($_SESSION['error_lastname']);
        unset($_SESSION['error_mail']);
        unset($_SESSION['error_id_card']);

        echo "<script> swal('Dodano nowego klienta','', 'success');</script>";
         echo '
            <script>setTimeout(function () {document.location.href = "customerRegistry.php";}, 1200);</script>';
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

                    <div class="col-5 justify-content">

                        <br><br>

                        <div class="userRegistry_border">
                            <h3>Nowy klient</h3>
                            <br>
                            <form action="#" method="post">

                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Nr karty:</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" placeholder="ID karty" name="id_card" id="id_card" value="<?php
                                               if (!isset($_SESSION['error_id_card'])) {
                                                   echo $id_card;
                                               }
                                               ?>" >

                                         <?php
                                        if (isset($_SESSION['error_id_card'])) {
                                            echo $_SESSION['error_id_card'];
                                            unset($_SESSION['error_id_card']);
                                        }
                                        ?>
                                        
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Imie:</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" placeholder="Imie" name="name" id="name" value="<?php
                                        if (!isset($_SESSION['error_name'])) {
                                            echo $name;
                                        }
                                        ?>" required>

                                        <?php
                                        if (isset($_SESSION['error_name'])) {
                                            echo $_SESSION['error_name'];
                                            unset($_SESSION['error_name']);
                                        }
                                        ?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Nazwisko:</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" placeholder="Nazwisko" name="lastname" id="lastname" value="<?php
                                        if (!isset($_SESSION['error_lastname'])) {
                                            echo $lastname;
                                        }
                                        ?>" required>
                                               <?php
                                               if (isset($_SESSION['error_lastname'])) {
                                                   echo $_SESSION['error_lastname'];
                                                   unset($_SESSION['error_lastname']);
                                               }
                                               ?>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-5 col-form-label">E-Mail:</label>
                                    <div class="col-6">
                                        <input class="form-control" type="text" placeholder="E-mail" name="mail" id="mail" value="<?php
                                        if (!isset($_SESSION['error_mail'])) {
                                            echo $mail;
                                        }else {echo "";}
                                        ?>">

                                        <?php
                                        if (isset($_SESSION['error_mail'])) {
                                            echo $_SESSION['error_mail'];
                                            unset($_SESSION['error_mail']);
                                        }
                                        ?>

                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-5 col-form-label">Płeć: </label>
                                    <div class="col-6">
                                        <select class="form-control" type="text" placeholder="płeć" name="sex" id="sex" required>
                                            <option  value=Mężczyzna <?php
                                            if (isset($_SESSION['sex']) && $_SESSION['sex'] == "m") {
                                                echo 'selected="selected"';
                                            }
                                            ?>    >Mężczyzna</option>
                                            <option <?php
                                            if (isset($_SESSION['sex']) && $_SESSION['sex'] == "k") {
                                                echo 'selected="selected"';
                                            }
                                            ?> value=Kobieta>Kobieta</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row ">

                                    <div class="col-11">                                                                                                          
                                        <button onclick="" type="submit" name="add" class="btn btn-primary  btn-block">Dodaj</button>                                
                                    </div>

                                </div>

                            </form>
                        </div>
                        <br>
                    </div>

                    <div class="col-7">
                        <br>
                        <a href="customerEdit.php" class="btn btn-info  btn-lg btn-block sale_margin_btn" type="button">
                            <h1>Przejdź do edycji</h1>
                        </a>
                                                
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