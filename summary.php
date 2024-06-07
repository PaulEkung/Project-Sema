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
            <a href="pm.dashboard.php" class="bi bi-arrow-left-circle-fill fs-1 text-light" ></a>
                <span class="ms-auto">

                    <?php 
                if(isset($_SESSION["image"])){
                    $img = $_SESSION["image"];
                    echo $img;
                }
                ?>
                </span>
           
                </nav>
        </header>
</section>
<section id="" class="p-3 bg-secondary">
        <!-- <div class="container"> -->
            <h2 class="text-center text-white">
                Overall Crime Report Summary
            </h2>
            <p class="lead text-center text-white mb-4">
                The entire crime reports recorded..
                
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
                                <h3 class="fw-bold">Ukende</h3>
                    <br>
            <span>
            <?php 
           $sql = "SELECT COUNT(*) FROM `crimes` WHERE reporter = 'Supervisor(Ukende settlement)'; ";
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
                Overall Complaint  Summary
                <p class="lead text-center text-white">
                    The entire complaints recorded..
                    
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
                                <h3 class="fw-bold">Ukende</h3>
                    <br>
                     <span>
                        <?php 
                        $sql = "SELECT COUNT(*) FROM `complaints` WHERE writer = 'Supervisor(Ukende settlement)'; ";
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
       
        <section>

<!-- footer section -->
                <footer class="footer p-5 text-light" id="login-footer">
                    
                <p>Powered by <a href="" class="text-warning text-decoration-none">Digital Systems Technologies </a></p>

                </footer>
    
    </section>
    
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js'" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>
</body>   
  
</html>