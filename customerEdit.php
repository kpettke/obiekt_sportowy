<head></head>
<?php
session_start();
require_once('template.php');
require_once('class/class_customer.php');
require_once('class/class_card.php');

$customer = new Customer();
$card = new Card();

$validation = '^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$^';

if (isset($_POST['id'])) {
    $val_pass = true;

    $id = $_POST['id'];
    $id_card = $_POST['id_card'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $mailB = filter_var($mail, FILTER_SANITIZE_EMAIL);
    $sex = $_POST['sex'];
    $id_card_old = $_POST['id_card_old'];

    if (is_numeric($id_card) == FALSE) {
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


    if ((filter_var($mailB, FILTER_VALIDATE_EMAIL) == false || ($mailB != $mail))) { // mail validation
        $val_pass = false;
        $_SESSION['error_mail'] = '<font color="red" size="2">Podaj poprawny adres e-mail</font></br>';
    }

    if (($customer->checkFreeIdCard($id_card) > 0 ) && ( $customer->checkEditFreeIdCard($id) != $id_card )) {  // customer can change id card only for free or actualy
        $val_pass = false;
        $_SESSION['error_id_card'] = '<font color="red" size="2">Wprowadzony nr ID karty już istnieje</font></br>';
    }
    
      if (($customer->checkFreeMail($mail) > 0 ) && ( $customer->checkEditFreeMail($id) != $mail )) {
        $val_pass = false;
        $_SESSION['error_mail'] = '<font color="red" size="2">Wprowadzony mail juz istanieje</font></br>';
    }



    if ($val_pass == true && isset($_POST['edit']) && $id_card_old != "") {

        // $newUser->getUserId($login);
        $customer->editCustomer($id, $id_card, $name, $lastname, $sex, $mail);
        $card->editCard($id_card, $id_card_old);
      

        $mail = null;
        $id_card = null;
        $name = null;
        $lastname = null;

        unset($_SESSION['error_name']);
        unset($_SESSION['error_lastname']);
        unset($_SESSION['error_mail']);

        echo "<script> swal('Dane zostały zmienione','', 'success');</script>";
    }

  
    if (isset($_POST['delete'])) {
        $customer->deleteCustomer($id);
        $card->deleteCard($id_card);

        $id_card = null;
        $id   =null;
        $mail = null;
        $name = null;
        $lastname = null;


        unset($_SESSION['error_name']);
        unset($_SESSION['error_lastname']);
        unset($_SESSION['error_mail']);
        unset($_SESSION['error_id_card']);


        echo "<script> swal('Klient został usunięty','', 'success');</script>";
    }
    
    if (isset($_POST['more'])) {
        
       $_SESSION['id_card'] = $id_card;
       header('Location: customerMoreInfo.php');
        
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
                        
                        <form action="#" method="post">
                            <input class="form-control" style="visibility: hidden;" type="text" name="id_card_old" id="id_card_old" value="" readonly="readonly" required>
                            <div class="form-group row">
                                <label class="col-5 col-form-label">ID:</label>
                                <div class="col-6">
                                    
                                    <input class="form-control"  type="text" placeholder="id" name="id" id="id" value="<?php if (isset($_SESSION['error_id_card']) || ($_SESSION['error_mail'])) echo $id; ?>" readonly="readonly" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">ID karty:</label>
                                <div class="col-6">

                                    <input class="form-control" type="text" placeholder="id karty" name="id_card" id="id_card" value="<?php if (!isset($_SESSION['error_id_card'])) echo $id_card; ?>" required>
                                
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
                                    }
                                    ?>" required>

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

                                    <button onclick="" type="submit" name="edit" class="btn btn-primary  btn-block">Zapisz zmiany</button>
                                    <button onclick="" type="submit" name="delete" class="btn btn-primary  btn-block">Usuń</button>
                                    <button onclick=""  type="submit"  name="more" id="more" class="btn btn-primary  btn-block">Dane szczegółowe</button>
       

                                </div>

                            </div>

                        </form>
                    </div>
                    <br>
                </div>

                <div class="col-8">
                    <br><br>

                    <h3>Klienci</h3><br>

                    <input type="text" id="searchBox" onkeyup="searchCustomer();" placeholder="Szukaj...">
                    
                    <input type="text" id="searchBoxId" onkeyup="searchCustomerId();" placeholder="Wprowadz ID karty">

                    <?php $customer->getCustomerList(); ?>

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
