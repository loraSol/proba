<?php

include("../database/constants.php");

if(!isset($_SESSION["id"])){
    header("location: ./index.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <script src = "../js/main.js"></script>
    <script src = "../js/manage.js"></script>
    

</head>


<body>


    <!-- -->
    <nav class="navbar" style="background-color: beige;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inventory system</a>
            <!-- dugme koje treba da se pojavi kad se smanji rezolucija pa meni treba da bude padajuci, NE RADI KAKO TREBA
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            -->
            <br>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="../includes/dashboard.php"><i class="fa fa-home"></i>Home</a>

                    <!-- Vrati korisnika na Login kad pritisne Logout dugme -->
                    <?php
                        if(isset($_SESSION["id"])){
                    ?>
                    <!-- korisnik moze da vidi opciju Izloguj se, jedino ako je vec ulogovan -->
                        <a class="nav-link active" aria-current="page"href="../templates/logout.php"><i class="fa fa-user"></i>Logout</a>
                    <?php
                        }
                    ?>

                    
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="get_category">
        <!--
      <tr>
        <td>1</td>
        <td>Electronic</td>
        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
        <td>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
            <a href="#" class="btn btn-info btn-sm">Edit</a>
        </td>
      </tr>
                    -->
            </tbody>
        </table>
    </div>


    <?php include("update_category.php"); ?>

</body>
</html>