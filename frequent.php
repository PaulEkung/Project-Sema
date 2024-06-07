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
    <title>Frequent</title>
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
$sql = $connector->query("SELECT progressNumber, OffendersName, COUNT(*) AS crime_count FROM `crimes` GROUP BY `progressNumber`, `OffendersName` HAVING count(*) > 1");
if($sql -> num_rows > 0){
    
    while($row = $sql -> fetch_assoc()){
        $name = $row["OffendersName"];
        $progress = $row["progressNumber"];
        $count = $row["crime_count"];
        $q = $connector->query("SELECT `offendersImage` FROM `crimes` WHERE `progressNumber` = '$progress'");
        if($q){
            $q_row = $q -> fetch_assoc();
            $image = $q_row["offendersImage"];
        }
        ?>

        <div class="row">
            <div class="col-md-0"></div>
            <div class="col-md-12">

                <table class="table table-responsive table-hover table-light table-bordered">
                        <center>
            <tr>
            <th class="fs-3 fw-bold p-2"></th>
            <th class="fs-4 p-2 fw-bold"></th>
            <th class="fs-4 p-2 fw-bold"></th>
            <th class="fs-4 p-2 fw-bold"></th>
            <th class="fs-4 p-2 fw-bold"></th>
            <th class="fs-4 p-2 fw-bold"></th>
            

        </tr>
                    
                       
       <!-- <tr> -->
            <td>
        <center>

            <h4>
                <?php 
                    if($image == ""){
                        echo "<img src='static/images/person.jpg' class='rounded-circle border border-secondary border-3' style='width:90px'>";

                    }else{
                    echo "<img src='uploads/$image' class='rounded-circle border border-secondary border-0' style='width:90px'>"; 
                    }
                    ?>
                     
                    </h4> 
                
            </center>
                
            </td>

            <td>
                <br>
                <?php echo $name; ?>
            </td>

            <td>
                    <br>
                    
            <span class="led">Registration #:  <b class="text-primary"><?php echo $progress ?></b> </span>  
               
            </td>

            <td class="text-center">
                <br>
            
            <?php
                echo "<span class='fs-3 text-secondary fw-bold'>$count reports</span>";

            ?>
            </td>
               
            <td class="">
          <center>
<br>
              <?php 
                
                   if($count  == 2){
                    ?>
                    <span class="bi bi-star fs-3 text-info"></span>
                    
                    <?php
                   }elseif($count == 3){

                    ?>
                    <span class="bi bi-star-half fs-3 text-dark"></span>
                    <span class="bi bi-star-half fs-3 text-dark"></span>
                    <?php
                   }elseif($count == 4){
                    ?>
                    <span class="bi bi-star-half fs-3 text-warning"></span>
                    <span class="bi bi-star-half fs-3 text-warning"></span>
                    <span class="bi bi-star-half fs-3 text-warning"></span>
                    <?php
                   }elseif($count >= 5){
                       ?>
                    <span class="bi bi-star-fill fs-3 text-danger"></span>
                    <span class="bi bi-star-fill fs-3 text-danger"></span>
                    <span class="bi bi-star-fill fs-3 text-danger"></span>
                    <span class="bi bi-star-fill fs-3 text-danger"></span>
                    <span class="bi bi-star-fill fs-3 text-danger"></span>
                   
                    <?php
                   }
                   
                   ?>       
                    
                </center>
            </td>
            <td class="text-center">
                <br>
                   <a href="frequent.full_report.php?p_number=<?php echo $progress ?>" class="btn btn-dark">See all <?php echo $count ?> reports</a>
            </td>
            </tr>

                    </center>  
                       
            </table>

            </div>
            <div class="col-md-0"></div>
        </div>
<?php


    }
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