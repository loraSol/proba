<?php

include("../database/constants.php");
if(isset($_SESSION["id"])){
    session_destroy();
}

header("location: ../includes/index.php");      // vrati korisnika nazad na login

?>