<?php
// session_start();
require_once 'views.php';
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
            top: -50px;
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

#updateProfileImg{
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 100;
    top: 0;
    right: 0;
    /* background: black; */
     overflow-x: hidden;
    padding-top: 90px;
    transition: 0.2s;  

    }
    #updateProfileImg .closebutton{
        position: relative;
        top: -20px;
        right: 0;
        font-size: 30px;
        margin-left: 20rem;
        cursor: pointer; 
         /* float: right; */
    }
#notifications{
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    background-color: rgba(125, 125, 124, 0.931);
     overflow-x: hidden;
    padding-top: 90px;
    transition: 0.3s;  

    }
    #notifications .closebutton{
        position: relative;
        top: -1.5rem;
        right: 0;
        font-size: 30px;
        margin-left: 20rem;
        cursor: pointer; 
         /* float: right; */
    }

    #badge1{
        /* background:red; */
        border-radius:100%;
        margin-left:-7px;
        top: 20px;
    }

    #updateProfileImg span{
        top: 30px;
    }

    .trash{
        margin-top: -150px;
        margin-left: -22rem;
    }
    /* #display_pane{
        margin-top: -80px;
        margin-left: 40rem;
        display: none;
    } */

</style>

<script type="text/javascript" defer>

var carousel = document.querySelector('.carousel');

     carousel.addEventListener('slide.bs.carousel', function(event) {
    event.target.classList.add('carousel-fade-in-once');
});

function open_nav(){
    document.getElementById("updateProfileImg").style.width ="420px";
    
}

function close_nav(){
    document.getElementById("updateProfileImg").style.width ="0";
    // document.getElementById("main").style.marginLeft ="0";
    // document.getElementById("main").style.opacity ="100";

}
function openNotificationPane(){
    document.getElementById("notifications").style.width ="100%";
    
}

function closeNotificationPane(){
    document.getElementById("notifications").style.width ="0";
    // document.getElementById("main").style.marginLeft ="0";
    // document.getElementById("main").style.opacity ="100";
}

// function showDeletePane(){
//     document.getElementById("display_pane").style.display = "block";
//     document.getElementById("display_pane").style.transition = "0.3s";
// }
</script>

</head>
<body>
<?php

if(isset($_GET["complaintSuccess"])){

    echo "<script>window.alert('Complaint uploaded successfully')</script>";

}elseif(isset($_GET["uploadSuccess"])){
    echo "<script>window.alert('Profile image updated successfully!')</script>";
    
}elseif(isset($_GET["uploadFailed"])){
    echo "<script>window.alert('Failed to update profile image! Please try again.')</script>";

}elseif(isset($_GET["emptyInput"])){
    echo "<script>window.alert('Please select an image to upload')</script>";
    
}elseif(isset($_GET["typeError"])){
    echo "<script>window.alert('Cannot upload images of this type')</script>";
    
}elseif(isset($_GET["sizeError"])){
    
    echo "<script>window.alert('The image size is too large')</script>";

}elseif(isset($_GET["emptynumField"])){
    echo "<script>window.alert('Mobile number field cannot be empty')</script>";

}elseif(isset($_GET["invalidnum"])){
    echo "<script>window.alert('Invalid phone number')</script>";
    
}elseif(isset($_GET["containLetters"])){
    echo "<script>window.alert('Phone number cannot contain letters')</script>";

}elseif(isset($_GET["successUpdatePhone"])){
    echo "<script>window.alert('Phone number updated successfully.')</script>";

}elseif(isset($_GET["updatePhoneError"])){
    echo "<script>window.alert('Failed to update phone number! Something went wrong.')</script>";

}elseif(isset($_GET["codeErr"])){
    echo "<script>window.alert('The country code you entered is incorrect!')</script>";

}

if(isset($_GET["delete_id"])){
    $get_del = $_GET["delete_id"];
    $retrieve_query = $connector -> query("SELECT `img` FROM `fieldworkernotifications` WHERE fieldworkernotifications.notificationId = '$get_del';" );
    if($retrieve_query -> num_rows > 0){
        $r = $retrieve_query -> fetch_assoc();
        $del_img = $r["img"];
        if($del_img == ""){
            $sql = $connector->query("DELETE FROM `fieldworkernotifications` WHERE fieldworkernotifications.notificationId = '$get_del'; ");
            if($sql){
                echo "
                    <script type=\"text/javascript\">
                        window.alert(\"Report deleted successfully!\");
                    </script>
                    ";
            }else{
                echo "
                    <script type=\"text/javascript\">
                        window.alert(\"Failed to delete report! Something went wrong. Please try again\");
                    </script>
                    ";

            }
        }else{
            $path = "./uploads/$del_img";
            $sql = $connector->query("DELETE FROM `fieldworkernotifications` WHERE fieldworkernotifications.notificationId = '$get_del'; ");
            if($sql){
                unlink($path);
                echo "
                    <script type=\"text/javascript\">
                        window.alert(\"Report deleted successfully!\");
                    </script>
                    ";

            }else{
                echo "
                    <script type=\"text/javascript\">
                        window.alert(\"Failed to delete report! Something went wrong. Please try again later\");
                    </script>
                    ";
                 }
                }
            }else{
                echo "
                    <script type=\"text/javascript\">
                        window.alert(\"Failed to delete report! Something went wrong. Please try again\");
                    </script>
                    ";
            }
        }

        ?>
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
                    <nav class="nav navbar navbar-expand p-3" id="nav">
                    <?php 
                    if(isset($_SESSION["name"])){
                        $username = $_SESSION["name"];
                        
                        }
                $query = $connector -> query("SELECT image FROM users WHERE username = '$username'; ");
                if($query){
                    $row = $query -> fetch_assoc();
                    $profile = $row["image"];
                    if($profile == ""){

                        echo "<a href='#'><img src='static/images/OPI.png' class='rounded-circle border border-secondary border-3' style='width:75px' id='img' onclick= 'open_nav()'></a>";
                    }else{

                        echo "<a href='#'><img src='uploads/$profile' class='rounded-circle border border-secondary border-0' style='width:75px' id='img' onclick='open_nav()'></a>"; 
                    }
                }
                
                ?>
                &nbsp;
                <p class="fs-4 text-light"><?php echo $user ?></hp>
                <menu class="ms-auto nav">
                    <ul class="nav navbar-nav" id="login-ul">
                      
                        <li class="nav-item">
                            
                            <a href="#" onclick="openNotificationPane()" class="btn  p-2 fs-4 p-1 text-light bi bi-bell-fill">
                            <?php
                    $result = $connector->query("SELECT count(*) FROM `fieldworkernotifications` WHERE `reciever` = '$user';");
                        if(!$result -> num_rows == 0){
                            if($count = mysqli_fetch_array($result))
                            {
                        echo "<span class='text-light position-absolute p-2' id='badge1'>$count[0]</span>";
                        
                    }
                }
                
                ?>
           
                        </a>
                        </li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="nav-item">
                            
                            <a href="#logout" data-bs-toggle="modal"  class="btn btn-warning fs text-liht">Log Out</a>
                        </li>
                        
                </ul>
                    </menu>
                </nav>
        </header>
    </section>

    <section class="p-5">
    
    <div id="slides" class="carousel slide carousel-fade-in-once">
        <center>
       <div class="carousel-indicators p-2">

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

                }elseif($user == "Supervisor(Ukende settlement)"){
                    $default_settlement = "Ukende settlement";
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
                <th class="fs-4 p-2 fw-bold">

                <img src='static\\images\\messenger_logo.png' width='70px' class="offset-0">
               

            </th>
            <th class="fs-4 p-2 fw-bold"></th>
            <th> 
            <h5 class="text-success">Shared <span class="bi bi-star-fill text-success"></span>
            <br>
            
        </h5>

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
                <?php echo "<p class='text-danger fs-5'>$case</p>" ?>
                <br>
                <?php 
                if($reporter == "Supervisor(Adagom1 settlement)"){
                    echo "<p class='text-success lead'>Posted from Adagom I settlement</p>";
                }elseif($reporter == "Supervisor(Adagom3 settlement)"){
                    echo "<p class='text-success lead'>Posted from Adagom III settlement</p>";

                }else{
                    echo "<p class='text-success lead'>Posted from Ukende settlement</p>";

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

                }elseif($reporter == "Supervisor(Ukende settlement)" && $reporter == $user){
                    $default_settlement = "Ukende settlement";
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
                        $query = $connector -> query("SELECT * from `crimes` WHERE `reporter` = '$user' ORDER BY `crimeId`DESC");
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
                        echo "<img src='static/images/icon.png' class='rounded-circle border border-secondary border-3' style='width:90px'>";

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
                <?php echo "<p class='text-danger fs-5'>$case</p>" ?>
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

                }elseif($reporter == "Supervisor(Ukende settlement)" && $reporter == $user){
                    $default_settlement = "Ukende settlement";
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
                   
            <div class="carousel-item">
                
           
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
                    <br>
                    
                <?php 
                    $query = $connector -> query("SELECT * FROM `complaints` WHERE writer = '$user' ORDER BY `complaintId` DESC");
                    if($query == true){
                        if($query -> num_rows > 0){
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
                                        if($sample_image == ""){
                                            echo null;
                                        }else{
                                        echo "
                                        <a href='uploads/$sample_image'>
                                        <img src='uploads/$sample_image' class='border border-secondary border-0 w-50'>
                                        </a>
                                        ";
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
                    }else{
                        echo "
                        <img src='static\\images\\messenger_logo.png' width='100px'>
                    <h2 class='text-center alert alert-secondary p-5 w-50'>No search result avaliable..</h2>
                    ";
                    }
                }
                    ?>
                
                    </div>
           
           </div>
       
        </div>
            </div>
            </section>

        <div class="container">

        <div id="updateProfileImg" class="sidenav bg-secondary text-light">

        <div class="container p-2 dashboard" style="margin-top: -5rem; background:rgb(5, 69, 83);">
            <span class="bi bi-menu-app fs-3 position-absolute"></span>
            <span class="lead fw-bold txt fs-3 offset-1 position-absolute text-light">
                 Dashboard
             </span>  
            
            <br>
        <a href="javascript:void(0)" class="closebutton text-light btn" onclick="close_nav()">&times;</a>   
        <br>             
        </div>
        
        <br>
        <br>
        <div class="container">
        <div class="container">

            <form action="profile.php" method="post" enctype="multipart/form-data" class="">
                
                <label for="image" class="p-1">Update profile image</label>
                <br>
                <br>
                <input type="file" name="Image" class="form-control form-control-lg">
                <hr>
                <input type="hidden" name="username" value="<?php echo $username ?>">
                <input type="submit" value="Update" name="updateSupImage" class="btn btn-warning w-50">
            </form>
        
            <hr class="p-5 bg-light">

            <form action="profile.php" method="post" enctype="multipart/form-data" class="">
              
            <label for="image" class="p-1">Update phone number</label>
                    <br>
                    <br>
                <div class="row">
                    <div class="col-md-4">
                    <input type="tel" name="code" value="+234" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-8">
                    <input type="tel" name="number" class="form-control form-control-lg" placeholder="9067476828">
                    </div>
                </div>
             
                <hr>
                <input type="hidden" name="username" value="<?php echo $username ?>">
                <input type="submit" value="Update" name="updateMobile" class="btn btn-dark w-50">
            </form>
        </div>
        
        </div>
        
        </div>
        </div> 

        <div class="container">

        <div id="notifications" class="sidenav">

        <div class="w-100 p-3" style="background:rgba(185, 185, 182, 0.602);margin-top:-90px">
          
        <a href="javascript:void(0)" class="closePaneBtn bg-secondary btn btn btn-close btn-close fs-4" onclick="closeNotificationPane()"></a>   
         <span class="text-center offset-3 text-dark">You can find all reports posted from your feildworkers here...</span> 

        </div>
        
        <br>
        <center>
                    <div class="container">

            <?php 

            $sql = $connector -> query("SELECT * FROM `fieldworkernotifications` WHERE `reciever` = '$user' ORDER BY `notificationId` DESC;");
            if($sql -> num_rows > 0){
               while($row = $sql -> fetch_assoc()){
                $report_img = $row["img"];
                $message = $row["message"];
                $date = $row["date"];
                $report_id = $row["notificationId"]
                ?>
              
                        <div class='container alert alert-light w-50'>
                            <p  class='bg-light p-1 text-black'>
                            <strong>
                        Message: 
                     </strong>&nbsp;  <?php echo $message ?>
               </p>
                        <p class='p-2 dark'>
                    
                        &nbsp; 
                        <?php
                        if($report_img == ""){
                        echo null;

                    }else{
                    echo "<a href='uploads/$report_img'>" . "<img src='uploads/$report_img' class='border border-secondary border-2' style='width:350px'> " . "</a>"; 
                    }
                    ?>
                    <br>
                    <p class='text-dark float-end'><b>Reported on:</b> <?php echo $date ?> </p>
                    
                </p>
                <br>
             
             
            </div>
            <abbr title="Delete this report?">

                <a href="?delete_id=<?php echo $report_id ?>"  class="bi bi-trash-fill btn btn-danger trash fs-4 position-absolute offset-0 mb-5" id="del_btn"></a>
            </abbr>

            <br>
                
                <?php
               } 
            }else{
                echo "
                        <img src='static\\images\\messenger_logo.png' width='100px'>
                    <h2 class='text-center alert alert-warning p-5 w-50'>No notifications available yet</h2>
                    ";
            }
            
         
            ?>
        </div>
        </center>
        
        
        </div>
        </div> 

        <?php 
        
        $footer_display_query = $connector -> query("SELECT comp.*, crm.* FROM `complaints`comp, `crimes`crm WHERE comp.writer = '$user' AND crm.reporter = '$user' ORDER BY `crimeId`DESC");
        if($footer_display_query == true){
            $q_row = mysqli_fetch_assoc($footer_display_query);
            
            if($q_row === 0){
                ?>
                <footer class="footer p-4 fixed-bottom">

                <p class="text-light">Powered by <a href="#" class="text-warning text-decoration-none">Digital Systems Technologies</a> </p>
                </footer>
                <?php

            }else{
                ?>
                 <footer class="footer p-4">

                <p class="text-light">Powered by <a href="#" class="text-warning text-decoration-none">Digital Systems Technologies</a> </p>
                </footer>

                <?php
            }

        }
            ?>
            
            
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>

</body>
</html>