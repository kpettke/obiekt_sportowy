<!DOCTYPE html>
<html lang="pl">

    <?php
  
    require_once('class/class_customer.php');
    require_once('class/class_card.php');
    $customer = new Customer();
    $card = new Card();

 
    ?>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dane posiadacza karty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Imie i nazwisko:</label>
                            <input type="text" class="form-control" id="name" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">ID Karty:</label>
                            <input type="text" class="form-control" name="id_card" id="id_card" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Strefa:</label>
                            <input class="form-control" name="zone" id="zone" readonly="readonly"></input>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Nr szafki:</label>
                            <input class="form-control" name="deposit" id="message-text"></input>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                            <button type="submit" class="btn btn-primary">Wprowadź</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>