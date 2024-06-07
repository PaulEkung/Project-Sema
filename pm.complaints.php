<?php 
session_start();
require_once 'db.connection.php';
require_once 'sessions.php';
$user = $_SESSION['superUser'];
$checkConnection = check_superUser_login($connector);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
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
.context-column{
    border-radius: 30px;
}

#login-nav{

background: rgb(5, 69, 93);

}

#login-footer{

background: #0f31517d;

}

.main{
            background: rgba(51, 29, 10, 0.700);
            /* rgba(127, 75, 29, 0.653); */
        }
</style>
</head>
<body style="background-color: rgba(0, 0, 0, 0.3);">
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
<!-- <br> -->
<div class="container context-container">
<?php 
if(isset($_POST["submit3"])){
    $search_result = strtolower($_POST["complaint_subject"]); 
    // $search_result = strtoupper($_POST["complaint_subject"]); 
    $match_pattern = $search_result[0] . $search_result[1] . $search_result[2] . $search_result[3] . $search_result[4] . $search_result[5] . $search_result[6] . $search_result[7] . $search_result[8] . $search_result[9];
    $sql = $connector -> query("SELECT * FROM `complaints` WHERE `subject` LIKE  '%$match_pattern%' OR '%$match_pattern%'; ");
    if($sql -> num_rows > 0){
        while($row = $sql -> fetch_assoc()){
            $search_subject = $row["subject"];
            $search_image = $row["image"];
            $search_context = $row["context"];
            $writer = $row["writer"];
            $date = $row["date"];
            ?>

            <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10 p-3 bg-light context-column">

            <h2 class="fs-2 fw-bold">

                <?php echo $search_subject ?>
                <span class="float-end text-secondary">
                    <?php echo $writer ?>

                    <p class="fw-bold text-primary"><?php echo $date ?></p>
                </span>
            </h2>
            <hr>
            <br>
            <p class="lead">
                <?php echo $search_context ?>
            </p>
            <center>

                <?php 
                if(empty($sample_image)){
                    echo null;
                }else{
                echo "<a href='uploads/$sample_image'><img src='uploads/$sample_image' class='border border-secondary border-0 w-50'></a>";
                }
                    ?>
            </center>
            
            </div>
            <br>
                <br>
            <div class="col-md-1">
                
            </div>
        </div>
                                
            <?php
        }
    }else{
        echo "<p class='alert alert-danger p-4 lead text-center w-50 offset-3'>No match result found</p>";
    }
    ?>
        
                    <?php
            }else{
                ?>
                <?php 
                    $query = $connector -> query("SELECT * FROM `complaints`ORDER BY `complaintId` DESC");
                    if($query == true){
                        while($row = mysqli_fetch_assoc($query)){
                            
                            $subject = $row["subject"];
                            $sample_image = $row["image"];
                            $context = $row["context"];
                            $c_date = $row["date"];
                            $complaintId = $row["complaintId"];
                            $writer = $row["writer"];
                            echo "<br><br>";
                            ?>
                                
                                <div class="row">
                                    <div class="col-md-1">
                                 </div>
                                    <div class="col-md-10 p-3 bg-light context-column">

                                    <h2 class="fs-2 fw-bold">

                                        <?php echo $subject ?>
                                        <span class="float-end text-secondary">
                                            <?php echo $writer ?>

                                            <p class="fw-bold text-primary"><?php echo $c_date ?></p>
                                        </span>
                                    </h2>
                                    <hr>
                                    <br>
                                    <p class="lead">
                                        <?php echo $context ?>
                        </p>
                                    <center>

                                        <?php 
                                        if(empty($sample_image)){
                                            echo null;
                                        }else{
                                        echo "<a href='uploads/$sample_image'><img src='uploads/$sample_image' class='border border-secondary border-0 w-50'></a>";
                                        }
                                         ?>
                                    </center>
                                   
                                    </div>
                                    <br>
                                     <br>
                                    <div class="col-md-1">
                                      
                                    </div>
                                </div>
                                
                                
                                <?php
                        }
                    }
                    ?>
                
                
                <?php

            }
            ?>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
                    <section>

<!-- footer section -->
                <footer class="footer p-4 text-light fixed-bottom" id="login-footer">
           <p>Powered by <a href="" class="text-warning text-decoration-none">Digital Systems Technologies </a></p>

                 
                </footer>
        
    </section>
</body>
</html>