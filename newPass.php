<?php
session_start();
require_once('template.php');
require_once('class/class_user.php');

$newUser = new User();


if (isset($_POST['password'])) {
    $id = $_SESSION['pass_id'];

    $val_pass = true;

    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    if ((strlen($password) < 6 || strlen($password) > 20)) {
        $val_pass = FALSE;
        $_SESSION['error_password'] = '<font color = "red" size = "2">Hasło musi zawierać od 6 do 20 znaków</font></br>';
    }

    if ($password != $password1) {
        $val_pass = FALSE;
        $_SESSION['error_password'] = '<font color = "red" size = "2">Hasła muszą być takie same</font></br>';
    }

    if ($val_pass == true && isset($_POST['change'])) {
       $newUser->newPasswordAdmin($id, $hash_password);


        $password = null;
        $password1 = null;
        unset($_SESSION['error_password']);


        echo "<script> swal('Zmieniono hasło','', 'success');</script>";
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
                        <h2>
                            <b><center> <?php echo $_SESSION['login']; ?></center></b>
                        </h2>

                        <h4>Nowe hasło</h4>
                        <br>
                        <form action="#" method="post">

                            <div class="form-group row">
                                <label class="col-6 col-form-label">Hasło:</label>
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
                                <label class="col-6 col-form-label">Powtórz hasło:</label>
                                <div class="col-6">
                                    <input class="form-control" type="password" placeholder="Hasło" name="password1" required> 
                                </div>
                            </div>



                            <div class="form-group row ">

                                <div class="col-12">
                                    <button onclick="" type="submit" name="change" class="btn btn-primary   ">Zmień</button>
                                    <a href="userEdit.php" class="btn btn-primary">Wróć</a>

                                </div>

                            </div>

                        </form>


                    </div>
                    <br><br>
                    <br>
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