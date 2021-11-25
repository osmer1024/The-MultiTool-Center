<?php
    session_start();
    unset($_SESSION["uid"]);
    unset($_SESSION["fname"]);
    unset($_SESSION["lname"]);
    unset($_SESSION["phone"]);
    unset($_SESSION["email"]);
    unset($_SESSION["address"]);
    unset($_SESSION["district"]);
    unset($_SESSION["password"]);
    unset($_SESSION["purchEntries"]);
    
    header("Location:../index.php");
?>