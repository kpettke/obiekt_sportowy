<?php

session_start();
require_once('template.php');
require_once('class/class_system.php');


 if ($_SESSION['permission'] == 1) {
    header('location: controlPanel.php');
}
$settings = new System();

if (isset($_POST['deposit']))
{
    $val_pass = true;
    $deposit = $_POST['deposit'];
    $user_info = $_POST['user_info'];
    
    if( $val_pass == TRUE && isset($_POST['edit']))
    {
        $settings->editSettings($deposit,$user_info);
        echo "<script>swal('Zapisano','', 'success')</script>";
        echo '<script>setTimeout(function () {document.location.href = "systemSettings.php";}, 1200);</script>';
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
                            <h3>Ustawienia </h3>
                            <br>
                            <form action="#" method="post">

                                <div class="form-group row">
                                    <label for="example-number-input" class="col-5 col-form-label">Ilość szafek</label>
                                    <div class="col-4">
                                        <input class="form-control" type="number" name="deposit" value="<?php echo $settings->getDeposit(); ?>" id="example-number-input">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea">Wiadomość dla pracowników:</label>
                                    <textarea class="col-9 form-control" name="user_info" id="user_info" rows="2"  ><?php $settings->getUser_info();?></textarea>
                                </div>

                          
                                <div class="form-group row ">

                                    <div class="col-11">                                                                                                          
                                        <button onclick="" type="submit" name="edit" class="btn btn-primary  btn-block">Zapisz zmiany</button>        
                                       
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

                     <!--//prawa strona -->                    

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
