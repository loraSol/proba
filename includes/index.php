<?php
include("../database/constants.php");
if(isset($_SESSION["id"])){
    header("location: ./dashboard.php");          // NE PISI .DOMAIN."/includes/das..." 
                                                  // GLEDA SE IZ KOG FOLDERA KRECES< JA SAM VEC U INCLUDES
                                                  // Sa ovim ne mogu da se vratim na login preko url-a, moram da se izlogujem
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
    <link rel="stylesheet type="text/css" href="../style/style.css"/>
    <script src = "../js/main.js"></script>
    

</head>


<body style="background-color: #FFC06E;">



<!-- -->
<nav class="navbar" style="background-color: #01A66F;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="color:#F3E0DC;"><i class="fa fa-leaf"></i>Gardening World</a>
    <!-- dugme koje treba da se pojavi kad se smanji rezolucija pa meni treba da bude padajuci, NE RADI KAKO TREBA
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    -->
    <br>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php" style="color:#F3E0DC; padding-left:50px;"><i class="fa fa-home"></i>Home</a>
        
    </div>
    </div>
  </div>
</nav>


<div class="container" id = "card-login" style="background-color: #01A66F; padding: 2% 28%; box-shadow:20px 20px 20px 20px #01A66F;">

    <div id="login-card" class="card" style="width: 30vw; background-color: #FFC06E; padding-bottom:50px; ">
        <img src="../images/login.png" style="width:80%; padding: 1% 10% 1% 5%; class="card-img-top" alt="Login icon">
        <div class="card-body">

            <form id = "form_log" onsubmit = "return false">
                <!-- Email input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email" id = "log_email" name="log_email" class="form-control" required />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" id="log_password" name = "log_password" class="form-control" required/>
                </div>
                <br>

                <!-- Submit button -->
                <button id = "dugme" type="sumbit" style="width:100%; background-color: #01A66F;" class="btn btn-primary btn-block mb-4">Log in</button>
            </form>

        </div>
    </div>
</div>


</body>
</html>