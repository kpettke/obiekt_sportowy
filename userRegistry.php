<?php
session_start();
require_once('template.php');
require_once('class/class_user.php');

$newUser = new User();
$validation = '^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$^';

  if ($_SESSION['permission'] == 1)
 {
      header('location: controlPanel.php');
 }
    if (isset($_POST['login'])) 
    {
    $val_pass = true;

    $login                  = $_POST['login'];
    $password               = $_POST['password'];
    $password1              = $_POST['password1'];
    $hash_password          = password_hash($password, PASSWORD_DEFAULT);
    $name                   = $_POST['name'];
    $lastname               = $_POST['lastname'];
    $mail                   = $_POST['mail'];
    $mailB                  = filter_var($mail, FILTER_SANITIZE_EMAIL);
    $permission             =  $_POST['permission'];
    $_SESSION['permission'] = $permission;
    $position               = $_POST['position'];
    $img                    = "img/avatar.jpg"; //default avatar
        
     
    if (preg_match($validation, $name) == false) { // only letters in name
        $val_pass = false;
        $_SESSION['error_name'] = '<font color="red" size="2">Imie może składać się tylko z liter </font><br />';
    }

    if (preg_match($validation, $lastname) == false) { // only letters in lastname
        $val_pass = false;
        $_SESSION['error_lastname'] = '<font color="red" size="2">Nazwisko może składać się tylko z liter </font><br />';
    }

    if (ctype_alnum($login) == false) { //special letters in login
        $val_pass = FALSE;       
        $_SESSION['error_login'] = '<font color = "red" size = "2">Może zawierać tylko litery i cyfry (bez polskich znaków)</font></br>';
    }

    if (strlen($login) < 3 || strlen($login) > 20) {
        $val_pass = false;        
        $_SESSION['error_login'] = '<font color = "red" size = "2">Musi zawierać od 3 do 20 znaków</font></br>';
    }

    if ((strlen($password) < 6 || strlen($password) > 20)) {
        $val_pass = FALSE;        
        $_SESSION['error_password'] = '<font color = "red" size = "2">Hasło musi zawierać od 6 do 20 znaków</font></br>';
    }

    if ($password != $password1) {
        $val_pass = FALSE;
        $_SESSION['error_password'] = '<font color = "red" size = "2">Hasła muszą być takie same</font></br>';
    }


    if ($newUser->checkFreeMail($mail) > 0) {
        $val_pass = false;
        $_SESSION['error_mail'] = '<font color = "red" size = "2">Wprowadzony mail juz istanieje</font></br>';
    }

    if ((filter_var($mailB, FILTER_VALIDATE_EMAIL) == false || ($mailB != $mail))) { /// mail validation
        $val_pass = false;        
        $_SESSION['error_mail'] = '<font color="red" size="2">Podaj poprawny adres e-mail</font></br>';
    }

       if ($newUser->checkFreeLogin($login) > 0  ) {
       $val_pass = false;
       $_SESSION['error_login'] = '<font color = "red" size = "2">Wprowadzony login juz istanieje</font></br>';
    }
  

    if ($val_pass == true && isset($_POST['add'])) 
        {
        $newUser->addUser($login, $hash_password, $name, $lastname, $mail, $permission, $position, $img);
        $login = null;
        $mail = null;
        $name = null;
        $lastname = null;
        $position = null;
        $permission = null;
        unset($_SESSION['error_login']);
        unset($_SESSION['error_name']);
        unset($_SESSION['error_lastname']);
        unset($_SESSION['error_mail']);
        unset($_SESSION['error_position']);
        unset($_SESSION['permission']);
              
        echo "<script> swal('Dodano nowego pracownika','', 'success');</script>";
       }
}
?>

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
                        <h3>Nowy pracownik</h3>
                        <br>
                        <form action="#" method="post">

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Login:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="Login" name="login" id="login" value="<?php if (!isset($_SESSION['error_login'])) {echo $login;} ?>" required>

                                    <?php
                                    if (isset($_SESSION['error_login'])) {
                                        echo $_SESSION['error_login'];
                                        unset($_SESSION['error_login']);
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Hasło:</label>
                                <div class="col-6">
                                    <input class="form-control" type="password" placeholder="Hasło" name="password" required> 
                                    <?php
                                    if (isset($_SESSION['error_password'])) {
                                        echo $_SESSION['error_password'];
                                        unset($_SESSION['error_password']);
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Powtórz hasło:</label>
                                <div class="col-6">
                                    <input class="form-control" type="password" placeholder="Hasło" name="password1" required> 
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">E-Mail:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="E-mail" name="mail" id="mail" value="<?php if (!isset($_SESSION['error_mail'])) { echo $mail;}  ?>" required>

                                    <?php
                                    if (isset($_SESSION['error_mail'])) {
                                        echo $_SESSION['error_mail'];
                                        unset($_SESSION['error_mail']);
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Imie:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="Imie" name="name" id="name" value="<?php if (!isset($_SESSION['error_name'])) {echo $name;} ?>" required>

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
                                    <input class="form-control" type="text" placeholder="Nazwisko" name="lastname" id="lastname" value="<?php if (!isset($_SESSION['error_lastname'])) {echo $lastname;} ?>" required>
                                    <?php
                                    if (isset($_SESSION['error_lastname'])) {
                                        echo $_SESSION['error_lastname'];
                                        unset($_SESSION['error_lastname']);
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Stanowisko:</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" placeholder="Stanowisko" name="position"id="position" value="<?php echo $position; ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-5 col-form-label">Uprawnienia: </label>
                                <div class="col-6">
                                    <select class="form-control" type="text" placeholder="Stanowisko" name="permission" id="permission" required>
                                        <option  value=0 <?php if (isset($_SESSION['permission']) && $_SESSION['permission'] == 0) {echo 'selected="selected"';} ?>    >Administrator</option>
                                        <option <?php if (isset($_SESSION['permission']) && $_SESSION['permission'] == 1) {echo 'selected="selected"';} ?> value=1>Pracownik</option>
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
                    <br><br>
                    <a href="userEdit.php" class="btn btn-info  btn-lg btn-block sale_margin_btn" type="button">
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