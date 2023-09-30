<?php
require_once 'db.connection.php';
require_once 'sessions.php';
session_start();
$user = $_SESSION['superUser'];
$checkConnection = check_superUser_login($connector);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
    
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" defer href="static/bootstrap-icons/bootstrap-icons.css">
    
<style type="text/css" media="all">

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font: 17px "Century Gothic", "Times Roman", sans-serif;
    
}

body{
    /* background styling */
    background: url("static/images/bg.jpg");
    background-blend-mode: darken;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
}

 

#login-nav{

background: rgb(5, 69, 93);

}


#login-footer{

background: rgb(5, 69, 93);

}

#bg-con{
    border-radius: 30px;
}


</style>

        
</head>
<body>
    <section>
        <!-- navigation bar section -->
        <header>
            <nav class="nav navbar navbar-expand p-3" id="login-nav">
            <img src="static/images/OIP.jpg" class="rounded-circle" style="width: 70px" alt="">
               <p class="fs-4 text-light"> &nbsp;<?php echo $user ?></p>
               <a href="pm.dashboard.php" class="ms-auto bi bi-arrow-right-circle fs-2 text-light" ></a>
                </nav>
        </header>
</section>
<section id="" class="p-3 bg-secondary">
        <!-- <div class="container"> -->
            <h2 class="text-center text-white">
                Crime Report Summary
            </h2>
            <p class="lead text-center text-white mb-4">
                Avaliable crime reports from all settlements..
                
            </p>
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-light">
                        <div class="card-body text-center p-3">
                        <h3 class="fw-bold">Adagom 1</h3>
                        <br>
                        <span>
            <?php 
           $sql = "SELECT COUNT(*) FROM `crimes` WHERE reporter = 'Supervisor(Adagom1 settlement)'; ";
           if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
               
               
               echo "<p class=\"p-3 fs-1 alert alert-secondary text-secondary fw-bold\"
               style=\"\">$count[0]</p>";
           }
            
            ?>
         </span>

             

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                        <div class="card bg-light">
                            <div class="card-body text-center p-3">
                            <h3 class="fw-bold">Adagom 3</h3>
                <br>
         <span>
            <?php 
           $sql = "SELECT COUNT(*) FROM `crimes` WHERE reporter = 'Supervisor(Adagom3 settlement)'; ";
           if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
               
               
               echo "<p class=\"p-3 fs-1 alert alert-secondary text-secondary fw-bold\"
               style=\"\">$count[0]</p>";
           }
            
            ?>
         </span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                            <div class="card bg-light">
                                <div class="card-body text-center p-3">
                                <h3 class="fw-bold">Okende</h3>
                    <br>
            <span>
            <?php 
           $sql = "SELECT COUNT(*) FROM `crimes` WHERE reporter = 'Supervisor(Okende settlement)'; ";
           if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
               
               
               echo "<p class=\"p-3 fs-1 alert alert-secondary text-secondary fw-bold\"
               style=\"\">$count[0]</p>";
           }
            
            ?>
         </span>


                                </div>
                            </div>
                        </div>
                    <div class="col-md-6 col-lg-3">
                            <div class="card bg-light">
                                <div class="card-body text-center p-3">
                                <h3 class="fw-bold text-primary">Total</h3>
            <br>
            <span>
            <?php 
           $sql = "SELECT COUNT(*) FROM `crimes`; ";
           if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
               
               
               echo "<p class=\"p-3 fs-1 alert alert-primary text-secondary fw-bold\"
               style=\"\">$count[0]</p>";
           }
            
            ?>
         </span>

                   

                                </div>
                            </div>
                        </div>
                        
                <h2 class="text-center text-white">
                Complaint  Summary
                <p class="lead text-center text-white">
                    Avaliable complaints from all settlements..
                    
                    </p>
                </h2>

                    <div class="col-md-6 col-lg-3">
                            <div class="card bg-light">
                                <div class="card-body text-center p-3">
                                 
                                <h3 class="fw-bold">Adagom 1</h3>
                            <br>
                            <span>
                            <?php 
                            $sql = "SELECT COUNT(*) FROM `complaints` WHERE writer = 'Supervisor(Adagom1 settlement)'; ";
                            if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){


                            echo "<p class=\"p-3 fs-1 alert alert-secondary text-secondary fw-bold\"
                            style=\"\">$count[0]</p>";
                            }

                            ?>
                            </span>

                                </div>
                            </div>
                        </div>
                    <div class="col-md-6 col-lg-3">
                            <div class="card bg-light">
                                <div class="card-body text-center p-3">
                                <h3 class="fw-bold">Adagom 3</h3>
                                    <br>
                                    <span>
                                    <?php 
                                $sql = "SELECT COUNT(*) FROM `complaints` WHERE writer = 'Supervisor(Adagom3 settlement)'; ";
                                if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
                                    
                                    
                                    echo "<p class=\"p-3 fs-1 alert alert-secondary text-secondary fw-bold\"
                                    style=\"\">$count[0]</p>";
                                }
                                    
                                    ?>
                                </span>
                  
                 

                                </div>
                            </div>
                        </div>
                    <div class="col-md-6 col-lg-3">
                            <div class="card bg-light">
                                <div class="card-body text-center p-3">
                                <h3 class="fw-bold">Okende</h3>
                    <br>
                     <span>
                        <?php 
                        $sql = "SELECT COUNT(*) FROM `complaints` WHERE writer = 'Supervisor(Okende settlement)'; ";
                        if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
                            
                            
                            echo "<p class=\"p-3 fs-1 alert alert-secondary text-secondary fw-bold\"
                            style=\"\">$count[0]</p>";
                        }
                            
                            ?>
                        </span>
                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center p-3">
                                    <h3 class="fw-bold text-primary">Total</h3>
                                <br>
                                <span>
                                <?php 
                            $sql = "SELECT COUNT(*) FROM `complaints`; ";
                            if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
                                
                                
                                echo "<p class=\"p-3 fs-1 alert alert-primary text-secondary fw-bold\"
                                style=\"\">$count[0]</p>";
                            }
                                
                                ?>
                            </span>
                       
                                    </div>
                                </div>
                            </div>
                
            </div>
        </div>
    
    </section>

   <br>
   <br>
   <br>        
<section>

<!-- footer section -->
                <footer class="footer p-4 text-light fixed-bottom" id="login-footer">
                    <p>Powered by <span class="text-warning text-capitalize">DS Tech Hub</span></p>
                    <!-- Copyrights &copy; 2023 Digital Systems Technology Hub -->
                 
                </footer>
        
    </section>
    
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js'" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>
</body>   
  
</html>