<?php

Class Logout
{
    public function getOut()
    {
    session_unset();
    header('Location: index.php');
    }
}
