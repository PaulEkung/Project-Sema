<?php
session_start();
require_once 'db.connection.php';
require_once 'sessions.php';
 if(isset($_SESSION["sessionDashboard"])){
 $user = $_SESSION['sessionDashboard'];
 }
 $checkConnection = check_supervisor_login($connector);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" defer href="static/bootstrap-icons/bootstrap-icons.css">

    <style type="text/css" media="all" defer>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font: 17px "Century Gothic", "Times Roman", sans-serif;
    
}

body{
    background: rgba(0, 0, 0, 0.12);
}


.carousel-item{
            height: 100%;
            width: 100%;
        }

        .carousel-inner{
            height: 100%;
            /* width: 100%; */
        }

        nav{
            background: rgb(5, 69, 93);
            opacity: 0.8;
        }


        .carousel-indicators{
            background: rgba(99, 59, 3, 0.030);
            top: 42rem;
        }

        .context-column{
            border-radius: 10px;
        }
        .context-container{
            border-radius: 30px;
        }

        
 .carousel-fade-in-once {
  animation: fade-in-once 1s ease-in-out forwards;
}

@keyframes fade-in-once {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
} 
       
.carousel-fade-in-once.carousel-item.active {
  animation: fade-in-once 1s ease-in-out forwards;
}

@keyframes fade-in-once {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

.carousel-inner {
  transition-duration: 0.100s;
}

.crime-bg{
    border-radius: 40px;
}

.table-1{
    border-radius: 30px;
}

.footer{
    background: rgb(5, 69, 93);
    opacity: 0.8;;
}

</style>

<script type="text/javascript" defer>

var carousel = document.querySelector('.carousel');

     carousel.addEventListener('slide.bs.carousel', function(event) {
    event.target.classList.add('carousel-fade-in-once');
});
</script>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="modal fade" role="dialog" id="logout">

            <div class="modal-dialog">
        <div class="col-md-0"></div>
        <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-warning">
                        <h3>Ready to leave!</h3>
                        <span class="btn btn-close btn-close-white" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to logout?
                        <a href="logout.php" class="btn btn-warning">Yes! Log me out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-0"></div>
        </div>
    </div>
</div>
    <!-- navbar section -->
    <section>
        <header>
            <nav class="nav navbar navbar-expand p-4 position-sticky sticky-top" id="nav">
                <img src="static/images/OPI.png" class="" style="width: 70px" alt="">
               <p class="fs-4 text-light"><?php echo $user ?></hp>
                <menu class="ms-auto nav">
                    <ul class="nav navbar-nav" id="login-ul">
                        <li class="nav-item">
                            
                            <a href="#logout" data-bs-toggle="modal" class="btn btn-outline-dark p-2 fs-5 p-1 text-light">Log Out</a>
                        </li>
                </ul>
                    </menu>
                </nav>
        </header>
    </section>

    <section class="p-5">
    
    <div id="slides" class="carousel slide carousel-fade-in-once">
        <center>
       <div class="carousel-indicators position-fixed p-2">

            <button type="button" id="btn1" data-bs-target="#slides" data-bs-slide-to="0" class="active bg-primary"></button>
            <button type="button" id="btn2" data-bs-target="#slides" data-bs-slide-to="1" class="bg-primary"></button>
            
        </div>
      
               
    <div class="carousel-inner bg-transparent w-100">
        
        <div class="carousel-item active alert alert-light bg-light p-3 crime-bg">
        <center>
                    <table class="table table-responsive table-hover">
                    <tr>
            <th class="fs-3 fw-bold p-3">
                <?php
                if($user == "Supervisor(Adagom1 settlement)"){

                    $default_settlement = "Adagom1 settlement";

                }elseif($user == "Supervisor(Okende settlement)"){
                    $default_settlement = "Okende settlement";
                }else{
                    $default_settlement = "Adagom3 settlement";
                }

                   $sql = "SELECT COUNT(*) FROM `crimes` WHERE `settlement` = '$default_settlement' and `shareStatus`= 'Yes';";
                   if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
                       
                       
                       echo "<span class=\"p-0 fs-1 rounded-circle text-danger position-absolute fw-bold\"
                       style=\"\">$count[0]</span>";
                       
                       if($count[0] == 1){
                           echo " &nbsp;&nbsp;&nbsp;
                           recieved report";
                        }else{
                            echo " &nbsp;&nbsp;&nbsp;
                            recieved reports ";
                        }
                    }else{
                        echo null;
                    }
                    
                    ?>
                   
            </th>
            <th class="fs-4 p-2 fw-bold"></th>
            <th class="fs-4 p-2 fw-bold"></th>
            <th> 
            <h5 class="text-success">Shared <span class="bi bi-star-fill text-success"></span></h5>

            </th>
        </tr>
                    <?php
                    // selecting crime records from database
                        $query = $connector -> query("SELECT * from `crimes`WHERE `settlement` = '$default_settlement' and `shareStatus` = 'Yes' ORDER BY `crimeId`DESC");
                        if($query == true){
                            while($row = mysqli_fetch_assoc($query)){
                            $fullname = $row["OffendersName"];
                            $progress = $row["progressNumber"];
                            $image = $row["offendersImage"];
                            $settlement = $row["settlement"];
                            $address = $row["houseAddress"];
                            $case = $row["crimeCase"];
                            $status = $row["approvalStatus"];
                            $category = $row["crimeCategory"];
                            $placement = $row["crimePlacement"];
                            $reporter = $row["reporter"];
                            $date = $row["date"];
                            $id = $row["crimeId"];
                            
                          
                        ?>
                       
       <!-- <tr> -->
            <td>
                <a href="report.full_view.php?id=<?php echo $id ?>" class="text-decoration-none text-black">


                    <h4>
                    <?php 
                    if($image == ""){
                        echo "<img src='static/images/person.jpg' class='rounded-circle border border-secondary border-3' style='width:90px'>";

                    }else{
                    echo "<img src='uploads/$image' class='rounded-circle border border-secondary border-0' style='width:90px'>"; 
                    }
                    ?>
                     <?php echo $fullname ?>
                    </h4> 
                
                    
                    <p>Registration #:  <b class="text-primary"><?php echo $progress ?></b> </p>  
                    <strong>Report created on:  <i><?php echo $date ?></i>  </strong>
                </a> 
            </td>
            <td>
            <?php echo "<p class='fw-bold fs-5'>$category</p>" ?>
                <?php echo "<p class='text-danger fs-5'>$placement</p>" ?>
                <br>
                <?php 
                if($reporter == "Supervisor(Adagom1 settlement)"){
                    echo "<p class='text-success lead'>Posted from Adagom I settlement</p>";
                }elseif($reporter == "Supervisor(Adagom3 settlement)"){
                    echo "<p class='text-success lead'>Posted from Adagom III settlement</p>";

                }else{
                    echo "<p class='text-success lead'>Posted from Okende settlement</p>";

                }
                ?>
            </td>
            <td>
                <br>
                <?php 
                if($status == "Under investigation"){
                    echo "<span class='bi bi-hourglass-bottom text-danger'> $status</span>";
                }else{
                    echo "<span class='bi bi-check2-all text-success lead'> $status</span>";

                }
                ?>
            <td>
                <br>
                <a href="report.full_view.php?id=<?php echo $id ?>" class="btn btn-primary">Check out full report</a>
                <br>
                <br>
                <br>
                <?php
                if($reporter == "Supervisor(Adagom1 settlement)" && $reporter == $user){

                    $default_settlement = "Adagom1 settlement";

                }elseif($reporter == "Supervisor(Okende settlement)" && $reporter == $user){
                    $default_settlement = "Okende settlement";
                }else{
                    $default_settlement = "Adagom3 settlement";
                }

            
                ?>
            </td>
            </tr>

                    <?php

                            }
                        }
                            ?>
                       
            </table>
            </center>
        <!-- jshshshshshsh -->
        <br>
        <br>
                    <center>
                    <table class="table table-responsive table-hover">
                    <tr>
            <th class="fs-3 fw-bold p-2">
                <?php
                   $sql = "SELECT COUNT(*) FROM `crimes` WHERE reporter = '$user' order by crimeId desc;";
                   if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
                       
                       
                       echo "<span class=\"p-0 fs-1 rounded-circle text-danger position-absolute fw-bold\"
                       style=\"\">$count[0] </span>";
                    }

                    echo "&nbsp;";

                    if($count[0] == 1){
                        echo " &nbsp;&nbsp;&nbsp;
                        avaliable posted report";
                    }else{
                        echo " &nbsp;&nbsp;&nbsp;
                        avaliable posted reports";
                    }
                    
                    ?>
                   
            </th>
            <th class="fs-4 p-2 fw-bold">Category/Type</th>
            <th class="fs-4 p-2 fw-bold">Approval Status</th>
            <th class="fs-4 p-2"> 
            <a href="sup.add_crime.php" class="offset-0 bi bi-plus-circle btn btn-secondary"> Add report</a>
            </th>

        </tr>
                    <?php
                    // selecting crime records from database
                        $query = $connector -> query("SELECT * from `crimes`WHERE `reporter` = '$user' ORDER BY `crimeId`DESC");
                        if($query == true){
                            while($row = mysqli_fetch_assoc($query)){
                            $fullname = $row["OffendersName"];
                            $progress = $row["progressNumber"];
                            $image = $row["offendersImage"];
                            $settlement = $row["settlement"];
                            $address = $row["houseAddress"];
                            $case = $row["crimeCase"];
                            $status = $row["approvalStatus"];
                            $category = $row["crimeCategory"];
                            $placement = $row["crimePlacement"];
                            $reporter = $row["reporter"];
                            $date = $row["date"];
                            $id = $row["crimeId"];
                            
                          
                        ?>
                       
       <!-- <tr> -->
            <td>
                <a href="report.full_view.php?id=<?php echo $id ?>" class="text-decoration-none text-black">


                    <h4>
                    <?php 
                    if($image == ""){
                        echo "<img src='static/images/person.jpg' class='rounded-circle border border-secondary border-3' style='width:90px'>";

                    }else{
                    echo "<img src='uploads/$image' class='rounded-circle border border-secondary border-0' style='width:90px'>"; 
                    }
                    ?>
                     <?php echo $fullname ?>
                    </h4> 
                
                    
                    <p>Registration #:  <b class="text-primary"><?php echo $progress ?></b> </p>  
                    <strong>Report created on:  <i><?php echo $date ?></i>  </strong>
                </a> 
            </td>
            <td>
            <?php echo "<p class='fs-5'>$category</p>" ?>
                <?php echo "<p class='text-danger fs-5'>$placement</p>" ?>
            </td>
            <td>
                <br>
            
                <?php 
                if($status == "Under investigation"){
                    echo "<span class='bi bi-hourglass-bottom text-danger'> $status</span>";
                }else{
                    echo "<span class='bi bi-check2-all text-success lead'> $status</span>";

                }
                ?>
            <td>
                <br>
                <a href="report.full_view.php?id=<?php echo $id ?>" class="btn btn-danger">View full report</a>
                <br>
                <br>
                <br>
                <?php
            

                if($reporter == "Supervisor(Adagom1 settlement)" && $reporter == $user){

                    $default_settlement = "Adagom1 settlement";

                }elseif($reporter == "Supervisor(Okende settlement)" && $reporter == $user){
                    $default_settlement = "Okende settlement";
                }else{
                    $default_settlement = "Adagom3 settlement";
                }

                if($default_settlement != $settlement){
                    // lll
                    $q = $connector -> query("SELECT * FROM `crimes` WHERE `crimes`.`crimeId` = '$id'");
                        if($q){
                            while($row = mysqli_fetch_assoc($q)){
                                $shared = $row["shareStatus"];
                            if($shared == "Yes"){
                                echo "
                                &nbsp;&nbsp;
                                <abbr title='shared'
                                <a href='?share=<?php echo $id ?>' class='bi bi-share text-secondary disabled fs-4 offset-2' style='cursor:none'>
                                </a>
                                </abbr>
                                ";

                            }else{
                                ?>
                                &nbsp;&nbsp;
                                <abbr title="The offender of this crime case is not an inhabitant of <?php echo $default_settlement ?>. By clicking this button, you're likely to share this report with the supervisor of <?php echo $settlement ?>"> 
                                <a href="?share=<?php echo $id ?>" class="bi bi-share text-primary fs-4 offset-2"></a></abbr>
                                <?php
                        }
            }
        }
                }
                    ?>
            </td>
            </tr>

                    <?php

                            }
                        }
                            ?>
                       
            </table>
                        
                    </center>

                    <?php
                    if(isset($_GET["share"])){
                        $share_id = $_GET["share"];
                        
                        $query = $connector -> query("SELECT * FROM `crimes` WHERE `crimes`.`crimeId` = '$share_id'");
                        if($query){
                            while($row = mysqli_fetch_assoc($query)){
                                $shared_status = $row["shareStatus"];
                            if($shared_status == "Yes"){
                                echo "<script type='text/javascript'>window.alert('This report has already been shared by you.')</script>";

                            }else{
                            $sql = $connector -> query("UPDATE `crimes` SET `crimes`.`shareStatus` = 'Yes' WHERE `crimes`.`crimeId` = '$share_id'");
                            if($sql == true){
                                echo "<script type='text/javascript'>window.alert('Report shared succeefully!')</script>";
                            }
                        }
            }
        }
        }
                
                    ?>
                       
                    </div>
                   
            <div class="carousel-item ">
                
           
            <h3>
            <?php
                   $sql = "SELECT COUNT(*) FROM `complaints` WHERE writer = '$user' order by complaintId desc;";
                   if($count = mysqli_fetch_array(mysqli_query($connector, $sql))){
                       
                       
                       echo "<span class=\"p-0 fs-1 rounded-circle text-secondary position-absolute fw-bold\"
                       style=\"\">$count[0]</span>";
                    }

                    if($count[0] == 1){
                        echo " &nbsp;&nbsp;&nbsp;
                        posted complaint avaliable";
                    }else{
                        echo " &nbsp;&nbsp;&nbsp;
                        posted complaints avaliable";
                    }
                    
                    ?>

            </h3>
                <a href="sup.add_complaint.php" class="bi bi-plus-circle btn btn-primary float-end p-2 offset-2"> Add complaint</a>
                <br>
                <br>
                <br>
                
                <div class="container context-container alert alert-secondary">
                <?php 
                    $query = $connector -> query("SELECT * FROM `complaints` WHERE writer = '$user' ORDER BY `complaintId` DESC");
                    if($query == true){
                        while($row = mysqli_fetch_assoc($query)){
                            
                            $subject = $row["subject"];
                            $sample_image = $row["image"];
                            $context = $row["context"];
                            $c_date = $row["date"];
                            $complaintId = $row["complaintId"];
                            echo "<br><br>";
                            ?>
                                
                                <div class="row">
                                    <div class="col-md-2">
                                 </div>
                                    <div class="col-md-8 p-3 bg-light context-column">

                                    <h2 class="fs-2 fw-bold">

                                        <?php echo $subject ?>
                                        <span class="float-end text-secondary">You posted <i class="fs-0">.</i>

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
                                    <div class="col-md-2">
                                      
                                    </div>
                                </div>
                                
                                
                                <?php
                        }
                    }
                    ?>
                
                    </div>
           
           </div>
       
        </div>
            </div>
            </section>
            <footer class="footer p-3">

                <p class="text-light">Powered by <a href="#" class="text-warning text-decoration-none">DS Technologies</a> </p>
            </footer>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>
    
</body>
</html>