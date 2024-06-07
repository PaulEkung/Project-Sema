<?php 
session_start();
require_once 'db.connection.php';

if(isset($_POST["submit2"])){

    $viewId = $_POST["viewId"];
    $sql = $connector -> query("SELECT * FROM `crimes` WHERE `progressNumber` = '$viewId' order by `crimeId` DESC");
    if($sql -> num_rows > 0){
        while($row = $sql -> fetch_assoc()){

    $search_id =  $row["crimeId"];

        }
    }
}
if(isset($_POST["submit1"])){

    $p_number = $_POST["p_number"];
    $sql = $connector -> query("SELECT * FROM `crimes` WHERE `progressNumber` = '$p_number' order by `crimeId` desc");
    if($sql -> num_rows > 0){
        while($row = $sql -> fetch_assoc()){

    $search_id =  $row["crimeId"];

        }
    }
}

if(isset($_GET["approve"])){
    $search_id = $_GET["approve"];
    
    $sql = $connector->query("UPDATE `crimes` SET `crimes`.`approvalStatus` = 'Approved' WHERE `crimes`.`crimeId` = '$search_id'; ");
    if($sql){
      header("Location: pm.dashboard.php?approved");
      
    }else{
        header("Location: pm.dashboard.php?failed");
        

    }
  }

 if(isset($_GET["decline"])){
    $search_id = $_GET["decline"];
    $retrieve_query = $connector -> query("SELECT * FROM `crimes` WHERE crimes.crimeId = '$search_id';" );
    if($retrieve_query -> num_rows > 0){
        $r = $retrieve_query -> fetch_assoc();
        $del_img = $r["offendersImage"];
        if($del_img == ""){
            $sql = $connector->query("DELETE FROM `crimes` WHERE `crimes`.`crimeId` = '$search_id'; ");
            if($sql){
                header("Location: pm.dashboard.php?deleted");
            }else{
                header("Location: pm.dashboard.php?delete_failed");

            }
        }else{
            $path = "./uploads/$del_img";
            $sql = $connector->query("DELETE FROM `crimes` WHERE `crimes`.`crimeId` = '$search_id'; ");
            if($sql){
                unlink($path);
                header("Location: pm.dashboard.php?deleted");

            }else{
                header("Location: pm.dashboard.php?delete_failed");

            }
                
            }
        }
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full report</title>
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
    
    background: url("static/images/bg.jpg");
    background-blend-mode: darken;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
        }
        .container{
            border-radius: 30px;
        }

        .bi-printer{
            background: rgba(181, 168, 143, 0.611);
            
        }

    </style>
</head>
<body style="background-color: rgba(0, 0, 0, 0.2);">


    <br>
    &nbsp;&nbsp;&nbsp;
    <?php

        if(isset($_GET["searchId"])){
            $id = $_GET["searchId"];
            // selecting crime records from database
            $query = $connector -> query("SELECT * from `crimes`WHERE `crimeId` = '$id' ");
                if($query == true){
            $row = mysqli_fetch_assoc($query);
            $fullname = $row["OffendersName"];
            $age = $row["age"];
            $progress = $row["progressNumber"];
            $image = $row["offendersImage"];
            $settlement = $row["settlement"];
            $address = $row["houseAddress"];
            $case = $row["crimeCase"];
            $description = $row["crimeDescription"];
            $crimeDate = $row["crimeDate"];
            $status = $row["approvalStatus"];
            $category = $row["crimeCategory"];
            $placement = $row["crimePlacement"];
            $reporter = $row["reporter"];
            $reported_date = $row["date"];
            $approval_status = $row["approvalStatus"];
            
            
            
            ?>
            
            <!-- <a href="search.crimes.php" class="bi bi-arrow-left-circle fs-2  p-2 text-secondary"></a>
            <br> -->
            <div class="container alert alert-light w-50" id="print-area">
            
            <center>
                <?php
            if($image == ""){
                echo "<img src='static/images/person.jpg' class='border border-secondary rounded-circle border-3' style='width:150px; border-radius:100px'>";

            }else{
                
                echo "
                <a href='uploads\\$image'>
                <img src='uploads/$image' class='border rounded-circle border-secondary border-0' style='width:150px;border-radius:100px'>
                </a>
                ";
            
            }
            ?>
            </center>
            <br>
            <!-- <hr> -->
            <ul class="p-5 offset-1">
                <li class="lead fw-bold">
                    <b> Offender's name : </b> <span class="lead"> <?php echo $fullname ?> </span>
            </li>
            <br>
                <li class="lead fw-bold">
                    <b> Offender's Age : </b><span class="lead"> <?php echo $age ?> </span>
            </li>
            <br>
            <!-- <hr class="w-75"> --><br>
                <li class="lead fw-bold">
                    <b> Registration # :</b>  <span class="lead"> <?php echo $progress ?> </span>
            </li>
            <br>
            <!-- <hr class="w-75"> -->
                <li class="lead fw-bold">
                <b> Residential settlement :</b>   <span class="lead"> <?php echo $settlement ?> </span>
            </li>
            <!-- <hr class="w-75"> --><br>
                <li class="lead fw-bold">
                    <b>House address :</b>  <address class="lead"> <?php echo $address ?> </address>
            </li>
            <!-- <hr class="w-75"> --><br>
                <li class="lead fw-bold">
                    <b>Crime case :</b>  <span class="lead"> <?php echo $case ?> </span>
            </li>
            <br>
            <!-- <hr class="w-75"> -->
                <li class="lead fw-bold">
                    <b>Case description : </b>  
                    <br>
                    <span class="lead p-3 text-start"> <?php echo $description ?> </span>
            </li>
            <!-- <hr class="w-75"> -->
            <br>
                <li class="lead fw-bold">
                    <b>Date of act :</b>  <span class="lead"> <?php echo $crimeDate ?> </span>
            </li>
            <br>
            <!-- <hr class="w-75"> -->
                <li class="lead fw-bold">
                    <b>Crime category : </b>  <span class="lead"> <?php echo $category ?> </span>
            </li>
            <!-- <hr class="w-75"> --><br>
                <li class="lead fw-bold">
                    <b>Crime type : </b> <span class="lead"> <?php echo $placement ?> </span>
            </li>
            <!-- <hr class="w-75"> --><br>
                <li class="lead">
                    <b> Reporter : </b> <span class="lead"> <?php echo $reporter ?> </span>
            </li>
            <!-- <hr class="w-75"> -->
            <br>
                <li class="lead fw-bold">
                    <b>Reported on : </b> <span class="lead"> <?php echo $reported_date ?> </span>
            </li>
            <!-- <hr class="w-75"> --><br>
                <li class="lead fw-bold">
                    <b>Approval status : </b>  
                    <span class="lead fw-bold">

                        <?php 
                        if($approval_status == "Under investigation"){
                        echo "<span class='text-danger lead'>$approval_status</span>";
                        }else{
                        echo "<span class='text-success lead'>$approval_status
                        </span>";

                        }
                    
                        ?>
                        </span>
            </li>
                
                
            </ul>
            <?php
            
            
            }
                }elseif(isset($_GET["id"])){

            if(isset($_GET["id"])){
            $id = $_GET["id"];
            // selecting crime records from database
            $query = $connector -> query("SELECT * from `crimes`WHERE `crimeId` = '$id' ");
                if($query == true){
            $row = mysqli_fetch_assoc($query);
            $fullname = $row["OffendersName"];
            $age = $row["age"];
            $progress = $row["progressNumber"];
            $image = $row["offendersImage"];
            $settlement = $row["settlement"];
            $address = $row["houseAddress"];
            $case = $row["crimeCase"];
            $description = $row["crimeDescription"];
            $crimeDate = $row["crimeDate"];
            $status = $row["approvalStatus"];
            $category = $row["crimeCategory"];
            $placement = $row["crimePlacement"];
            $reporter = $row["reporter"];
            $reported_date = $row["date"];
            $approval_status = $row["approvalStatus"];
            
            
            
            ?>
    
    <!-- <a href="sup.dashboard.php" class="bi bi-arrow-left-circle fs-2  p-2 text-secondary"></a> -->
    <br>
    <div class="container alert alert-light w-50" id="print-area">
    
    <center>
        <?php
    if($image == ""){
        echo "<img src='static/images/person.jpg' class='border border-secondary rounded-circle border-3' style='width:150px;border-radius:100px'>";

    }else{
        echo "
        <a href='uploads\\$image'>
        <img src='uploads/$image' class='border rounded-circle border-secondary border-0' style='width:150px;border-radius:100px'>
        </a>
        ";
    
    }
    ?>
    </center>
    <br>
    <!-- <hr> -->
    <ul class="p-5 offset-1">
        <li class="lead fw-bold">
            <b> Offender's name :</b> <span class="lead"> <?php echo $fullname ?> </span>
    </li>
    <br>
        <li class="lead fw-bold">
            <b>Offender's age : </b>   <span class="lead"> <?php echo $age ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Registration # :</b>  <span class="lead"> <?php echo $progress ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Residential settlement : </b>  <span class="lead"> <?php echo $settlement ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b> House address :</b>  <address class="lead"> <?php echo $address ?> </address>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b>Crime case :</b>   <span class="lead"> <?php echo $case ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Case description : </b>  
            <br>
            <span class="lead p-3 text-start"> <?php echo $description ?> </span>
    </li>
    <!-- <hr class="w-75"> -->
    <br>
        <li class="lead fw-bold">
            <b>Date of act :</b>   <span class="lead"> <?php echo $crimeDate ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Crime category :</b>   <span class="lead"> <?php echo $category ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b>Crime type :</b>   <span class="lead"> <?php echo $placement ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b>Reporter :</b>    <span class="lead"> <?php echo $reporter ?> </span>
    </li>
    <!-- <hr class="w-75"> -->
    <br>
        <li class="lead fw-bold">
            <b>Reported on :</b>   <span class="lead"> <?php echo $reported_date ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b> Approval status  :</b>  
            <span class="lead fw-bold">

                <?php 
                if($approval_status == "Under investigation"){
                echo "<span class='text-danger lead'>$approval_status</span>";
                }else{
                echo "<span class='text-success lead'>$approval_status
                </span>";

                }
            
                ?>
                </span>
    </li>
        
        
    </ul>
    <?php
    
    
    }
}
}elseif(isset($_POST["submit2"])){

    $viewId = $_POST["viewId"];
    $sql = $connector -> query("SELECT * FROM `crimes` WHERE `crimeId` = '$viewId' order by `crimeId` desc");
    if($sql -> num_rows > 0){
    $row = $sql -> fetch_assoc();

    $fullname = $row["OffendersName"];
    $age = $row["age"];
    $progress = $row["progressNumber"];
    $image = $row["offendersImage"];
    $settlement = $row["settlement"];
    $address = $row["houseAddress"];
    $case = $row["crimeCase"];
    $description = $row["crimeDescription"];
    $crimeDate = $row["crimeDate"];
    $status = $row["approvalStatus"];
    $category = $row["crimeCategory"];
    $placement = $row["crimePlacement"];
    $reporter = $row["reporter"];
    $reported_date = $row["date"];
    $approval_status = $row["approvalStatus"];
    $search_id =  $row["crimeId"];

    ?>
        <a href="pm.dashboard.php" class="bi bi-arrow-left-circle-fill fs-2  p-2 text-secondary"></a> 
    <br>
    <center>
        <?php 
        if($approval_status == "Under investigation"){
            ?>
                <span class="btn btn-success bi bi-check-all" data-bs-target="#approve" data-bs-toggle="modal"> Approve</span>
        &nbsp;&nbsp;&nbsp;
        <span class="btn btn-danger bi bi-x-circle-fill" data-bs-target="#decline" data-bs-toggle="modal"> Decline</span>
            <?php
        }else{
            ?>
            <span class="text-success bi bi-check-all lead"> Approved</span>
            <?php

        }
        ?>
    
    </center>
    
    <br>
    <div class="container alert alert-light w-50" id="print-area">
    
    <center>
        <?php
    if($image == ""){
        echo "<img src='static/images/person.jpg' class='border border-secondary rounded-circle border-3' style='width:150px;border-radius:100px'>";

    }else{
        echo "
        <a href='uploads\\$image'>
        <img src='uploads/$image' class='border rounded-circle border-secondary border-0' style='width:150px;border-radius:100px'>
        </a>
        ";
    
    }
    ?>
    </center>
    <br>
    <!-- <hr> -->
    <ul class="p-5 offset-1">
        <li class="lead fw-bold">
            <b> Offender's name :</b> <span class="lead"> <?php echo $fullname ?> </span>
    </li>
    <br>
        <li class="lead fw-bold">
            <b>Offender's age : </b>   <span class="lead"> <?php echo $age ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Registration # :</b>  <span class="lead"> <?php echo $progress ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Residential settlement : </b>  <span class="lead"> <?php echo $settlement ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b> House address :</b>  <address class="lead"> <?php echo $address ?> </address>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b>Crime case :</b>   <span class="lead"> <?php echo $case ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Case description : </b>  
            <br>
            <span class="lead p-3 text-start"> <?php echo $description ?> </span>
    </li>
    <!-- <hr class="w-75"> -->
    <br>
        <li class="lead fw-bold">
            <b>Date of act :</b>   <span class="lead"> <?php echo $crimeDate ?> </span>
    </li>
    <br>
    <!-- <hr class="w-75"> -->
        <li class="lead fw-bold">
            <b>Crime category :</b>   <span class="lead"> <?php echo $category ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b>Crime type :</b>   <span class="lead"> <?php echo $placement ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b>Reporter :</b>    <span class="lead"> <?php echo $reporter ?> </span>
    </li>
    <!-- <hr class="w-75"> -->
    <br>
        <li class="lead fw-bold">
            <b>Reported on :</b>   <span class="lead"> <?php echo $reported_date ?> </span>
    </li>
    <!-- <hr class="w-75"> --><br>
        <li class="lead fw-bold">
            <b> Approval status  :</b>  
            <span class="lead fw-bold">

                <?php 
                if($approval_status == "Under investigation"){
                echo "<span class='text-danger lead'>$approval_status</span>";
                }else{
                echo "<span class='text-success lead'>$approval_status
                </span>";

                }
            
                ?>
                </span>
    </li>
        
        
    </ul>
    <?php


        
    }else{
        ?>
        <!-- &nbsp;&nbsp; <a href='pm.dashboard.php' class="bi bi-arrow-left-circle fs-2 text-secondary"></a> -->
        <?php
        echo "
        <h2 class='text-center alert alert-danger p-5 w-50 offset-3'>No search result avaliable..</h2>
        ";
    }

    
    
}


        ?>
        
        
    </div>

    

    <abbr title="Print"> <a href="#" onclick="printArea()" class="bi bi-printer fs-1 fixed-bottom offset-10 text-success  p-1"></a></abbr>
    <script>

    function printArea() {
    var printArea = document.getElementById("print-area");
    var w = window.open();
    w.document.write(printArea.innerHTML);
    w.print();
    w.close();
}

</script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>

<div class="container">
<div class="row">
<div class="modal fade" role="dialog" id="approve">

<div class="modal-dialog">
<div class="col-md-0"></div>
<div class="col-md-12">
<div class="modal-content">
    <div class="modal-header bg-dark text-warning">
        <h4>Approve crime report</h4>
        <span class="btn btn-close btn-close-white" data-bs-dismiss="modal"></span>
    </div>
    <div class="modal-body">
    <p>
        Are you sure you want to approve this report?
    <br>
    <span>This will permenently save the report in the database. Once you have clicked the approve button, you cannot undo approval.</span>
    </p>
        <br>
                       
            <a href="?approve=<?php echo $search_id ?>" class="btn btn-success offset-3 w-50">Approve</a>
        
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-0"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="modal fade" role="dialog" id="decline">

            <div class="modal-dialog">
        <div class="col-md-0"></div>
        <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-warning">
                        <h4>Decline crime report</h4>
                        <span class="btn btn-close btn-close-white" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="modal-body">
                    <p>
                        Are you sure you want to decline this report?
                    <br>
                    <span>This will permenently delete the report from the database. Once you have clicked the decline button, you cannot undo decline.</span>
                    </p>
                        <br>
                       
                            <a href="?decline=<?php echo $search_id ?>" class="btn btn-danger offset-3 w-50">Decline</a>
                        
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-0"></div>
        </div>
    </div>
</div>

</body>

</html>