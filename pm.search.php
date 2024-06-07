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
    <meta name="viewport" content=
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
.context-column{
    border-radius: 30px;
}

#login-nav{

background: rgb(5, 69, 93);

}
        
        .container{
            border-radius: 30px;
        }

        .bi-printer{
            background: rgba(181, 168, 143, 0.611);
            
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
 <br>

 
 <?php   
if(isset($_POST["submit1"])){
    
    $p_number = $_POST["p_number"];
  
    $sql = $connector -> query("SELECT * FROM `crimes` WHERE `progressNumber` = '$p_number' order by `crimeId` desc");
if($sql -> num_rows > 0){
while($row = $sql -> fetch_assoc()){

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
echo "<br>";

?>
 <div class="container alert alert-light w-50" id="print-area">
<br>


<br>

<center>
    <?php
if($image == ""){
    echo "<img src='static/images/person.jpg' class='border border-secondary rounded-circle border-3' style='width:150px;border-radius:100px'>";

}else{
    echo "<img src='uploads/$image' class='border rounded-circle border-secondary border-0' style='width:150px;border-radius:100px'>";

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
        </div>
<?php


    
 }

}else{

   
    echo "
    <h2 class='text-center alert alert-danger p-5 w-50 offset-3'>No search result avaliable..</h2>
    ";
}



}

?>
</body>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>
</html>