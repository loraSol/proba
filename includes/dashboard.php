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
                    <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-home"></i>Home</a>

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
        <div class="row">

            <div class="col-md-4">

                <div class="card" style="width: 18rem;">
                    <img src="../images/user.png" class="card-img-top" style="width: 100%" alt="User">

                    <div class="card-body">
                        <h5 class="card-title">Profile info</h5>
                        <p class="card-text">Petar Petrovic</p>
                        <p class="card-text">Admin</p>
                        <p class="card-text">Last login: xxxx-xx-xxxx</p>
                        <a href="#" class="btn btn-primary">Edit profile</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="jumbotron">
                    <h2>Welcome Admin!</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe src="https://free.timeanddate.com/clock/i8khk3sx/n35/szw110/szh110/cf100/hnce1ead6" frameborder="0" width="110" height="110"></iframe>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">New orders</h5>
                                    <p class="card-text">Here you can make invoices and create new orders.</p>
                                    <a href="new_orders.php" class="btn btn-primary">New orders</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <p></p>
    <p></p>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Manage Categories</h3>
                        <p class="card-text">Here you can manage your categories.</p>
                        <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a>
                        <a href="../templates/manage_category.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Manage Brands</h3>
                        <p class="card-text">Here you can manage your brands.</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#form_brand">Add</a>
                        <a href="#" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" >
                    <div class="card-body">
                        <h3 class="card-title">Manage Products</h3>
                        <p class="card-text">Here you can manage your products.</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#form_products">Add</a>
                        <a href="../templates/manage_products.php" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?php
        include_once("../templates/category.php");
    ?>

    <?php
        include_once("../templates/brand.php");
    ?>

    <?php
        include_once("../templates/products.php");
    ?>

</body>


</html>