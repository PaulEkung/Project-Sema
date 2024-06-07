<?php
// session_start();
require_once 'db.connection.php';
require_once 'views.php';
require_once 'sessions.php';

 if(isset($_SESSION["superUser"])){
    $user = $_SESSION['superUser'];
    
}

if(isset($_SESSION["name"])){
$username = $_SESSION["name"];
}
   
    $checkConnection = check_superUser_login($connector);
    // $checkConnection2 = check_dg_login($connector);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    background: rgba(0, 0, 0, 0.9);
    /* background styling */
    background: url("static/images/bg.jpg");
    background-blend-mode: darken;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
}

.sidenav{
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    /* background: black; */
    overflow-x: hidden;
    padding-top: 90px;
    transition: 0.1s;

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
    transition: 0.1s;  

    }
    #updateProfileImg .closebutton{
        position: relative;
        top: -1.5rem;
        right: 0;
        font-size: 30px;
        margin-left: 20rem;
        cursor: pointer; 
         /* float: right; */
    }



    .sidenav a{
        
    display: block;
    padding: 10px 8px 10px 10px;
    text-decoration: none;
    transition: 0.1s;
    color: #fff;
    
    text-transform: capitalize;
    
    
}

.sidenav li:hover{
    background: rgba(8, 159, 164, 0.549);
    transition: 0.2s ease;
    letter-spacing: 2px;
    transition: 0.1s ease;
    }

    

    .sidenav .closebtn{
        position: relative;
        top: -1.2rem;
        right: 0;
        font-size: 30px;
        margin-left: 20rem;
        cursor: pointer; 
         /* float: right; */
    }

    .sidenav .dashboard{
        margin-top: -4.7rem;
        /* margin-left: -0.5rem; */
    }

      #main{
        transition: margin-left .3s ease-in-out;
        overflow: hidden;
        width: 100%;
    }



nav{
    background: rgb(5, 69, 93);
            
        }
        .footer{
            background: rgb(5, 69, 93);
        }

        .main{
            background: rgba(51, 29, 10, 0.200);
            /* rgba(127, 75, 29, 0.653); */
        }

        td:hover{
            background:#fff;
            color: #fff;
        
        }
        #felony{
            accent-color: #7d0404e7;
            padding: 12px;
        }
        
        #misdemeanor{
            accent-color: #e5b506e7;
            padding: 12px;
        }

        #simple{
            accent-color: #054063e7;
            padding: 12px;


        }
        .loader_bg{
    position: fixed;
    z-index: 999999;
    background: #fff;
    width : 100%;
    height: 100%;
}
.preloader{
    border: 0 solid transparent;
    border-radius: 50%;
    width : 150px;
    height: 150px;
    position: absolute;
    top: calc(50vh - 75px);
    left: calc(50vw - 75px);

}
.preloader span{
    position: fixed;
    top: calc(65vh - 75px);
    left: calc(52.5vw - 75px);
}

.preloader:before, .preloader:after{
    content: '';
    border: 1em solid darkorange;
    border-radius: 50%;
    width: inherit;
    height: inherit;
    position: absolute;
    top: 0;
    left: 0;
    animation: loader 2s linear infinite;
    opacity: 0;

}
.preloader:before{
    animation-delay: .5s; 
}
@keyframes loader{
    0%{
        transform: scale(0);
        opacity: 0;
    }
    50%{
        opacity: 1;
    }
    100%{
        transform: scale(1);
        opacity: 0;
    }
}

#border-line{
   
    width: 200px;
    background: rgba(185, 185, 182, 0.729);
    
}

#adder{
    background: rgba(185, 185, 182, 0.602);
    
    
}

#dash-text{
    top:50px;
    margin: 0 0 0 25%;
}

    </style>

    <script type="text/javascript">
    function openNav(){
        document.getElementById("mySidenav").style.width ="420px";
        // document.getElementById("mySidenav").style.background = "rgba(0,0,0,0.5)";
        document.getElementById("main").style.marginLeft ="100px";
       
    }

    function closeNav(){
        document.getElementById("mySidenav").style.width ="0";
        document.getElementById("main").style.marginLeft ="0";
        // document.getElementById("main").style.opacity ="100";
    }

    function open_nav(){
        document.getElementById("updateProfileImg").style.width ="420px";
      
    }

    function close_nav(){
        document.getElementById("updateProfileImg").style.width ="0";
        // document.getElementById("main").style.marginLeft ="0";
        // document.getElementById("main").style.opacity ="100";
    }

    </script>
</head>
<body>
<?php
if(isset($_GET["uploadSuccess"])){
    echo "<script>window.alert('Profile image updated successfully! Changes will reflect after re-login')</script>";
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

}elseif(isset($_GET["country_codeErr"])){
    echo "<script>window.alert('The country code you entered is incorrect!')</script>";

}elseif(isset($_GET["fileTooLargeError"])){
    echo "<script>window.alert('The file size is too large. Please select a file size lesser than 50mb')</script>";

}elseif(isset($_GET["fileTooLargeError"])){
    echo "<script>window.alert('The file size is too large. Please select a file size lesser than 50mb')</script>";

}elseif(isset($_GET["unknownError"])){
    echo "<script>window.alert('Failed to update report due to an unknown image error! Please try again.')</script>";

}elseif(isset($_GET["invalidFileType"])){
    echo "<script>window.alert('Failed to update report! You can only upload images of the type: jpg,jpeg,png,pdf,jfif')</script>";

}elseif(isset($_GET["updated"])){
    echo "<script>window.alert('Report updated successfully')</script>";

}elseif(isset($_GET["updateFailed"])){
    echo "<script>window.alert('Failed to update report! Something went wrong')</script>";
}

?>
<div class="loader_bg">
    <div class="preloader">
        <span>Loading...</span>
    </div>

</div>
    <?php 
    
    if(isset($_GET["approved"])){

        echo "<script>window.alert('Report approved successfully')</script>";
        
    }elseif(isset($_GET["failed"])){
        
        echo "<script>window.alert('Failed to approve report. Something went wrong')</script>";
    }elseif(isset($_GET["deleted"])){
        echo "<script>window.alert('Report deleted successfully')</script>";

    }elseif(isset($_GET["delete_failed"])){
        echo "<script>window.alert('Failed to delete report. Something went wrong')</script>";

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

<div class="container">
    <div class="row">
        <div class="modal fade" role="dialog" id="search_crime">

        <div class="modal-dialog">
        <div class="col-md-0"></div>
        <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-warning">
                        <h3>Search crime report</h3>
                        <span class="btn btn-close btn-close-white" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="modal-body">
                      <form action="pm.search.php" method="post">
                        <input type="text" name="p_number" id="crime" class="form-control border border-2 form-control-lg placeholder-wave" placeholder="Enter progress number to search">
                        <br>
                        <input type="submit" name="submit1" class="btn btn-dark offset-3 w-50">
                      </form>
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
        <div class="modal fade" role="dialog" id="search_complaint">

        <div class="modal-dialog">
        <div class="col-md-0"></div>
        <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-warning">
                        <h3>Search complaint</h3>
                        <span class="btn btn-close btn-close-white" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="modal-body">
                      <form action="pm.complaints.php" method="post">
                        <input type="text" name="complaint_subject" id="crime" class="form-control border border-2 form-control-lg placeholder-wave" placeholder="Enter complaint subject to search">
                        <br>
                        <input type="submit" name="submit3" class="btn btn-primary offset-3 w-50">
                      </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-0"></div>
        </div>
    </div>
</div>

    <div id="main">
<section>
        <header>
            <nav class="nav navbar navbar-expand p-3" id="nav">
                <?php 
                if(isset($_SESSION["image"])){
                    $img = $_SESSION["image"];
                    echo $img;
                }
                ?>
                
               <p class="fs-4 text-light text-capitalize fw-bold"> &nbsp;<?php echo $user  ?>
            </p>
                <menu class="ms-auto nav">
                    <ul class="nav navbar-nav" id="login-ul">

                            <li class="nav-link">
                        <a href="#search_crime" data-bs-toggle="modal" class="text-light text-decoration-none">
                            Search crime
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#search_complaint" class="text-light text-decoration-none" data-bs-toggle="modal">Search complaint</a>
                    </li>

                  

                    <li class="nav-link">
                        <a href="#" onclick="openNav()" class="bi bi-person-fill text-black text-light fs-4 bg-warning p-2 rounded-circle"></a>
                    </li>
                </ul>
                    </menu>
                </nav>
        </header>
    </section>
<section>
   
</section>
    <section class="main">
   
       <?php
       
       function allreports($connector)
       {
           $sql = $connector->query("SELECT * FROM `crimes` ORDER BY `crimeId` DESC");
           if($sql == true && $sql -> num_rows > 0){
            ?>
             <table class='table table-bordered p-5 table-md text-center table-responsive text-dark fw-bold table-hover alert alert-secondary bg-transparent'>
        <tr>
        <th class="p-3 fs-4 text-dark fw-bold" id="border-line">Image</th>
        <th class="p-3 fs-4 text-dark fw-bold" id="adder">Name</th>
        <th class="p-3 fs-4 text-dark fw-bold" id="adder">Age</th>
        <th class="p-3 fs-4 text-dark fw-bold" id="adder">Registration #</th>
        <th class="p-3 fs-4 text-dark fw-bold" id="adder">Crime category</th>
        <th class="p-3 fs-4 text-dark fw-bold" id="adder">Reporter</th>
        <th class="p-3 fs-4 fw-bold text-dark" id="adder">Action</th>
        </tr>

            <?php
               while($row = mysqli_fetch_assoc($sql))
               {
                $fullname = $row["OffendersName"];
                $progress = $row["progressNumber"];
                $age = $row["age"];
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
                if($category == "Felony Category"){
                    $category = "Felony";
                }elseif($category == "Misdemeanor Category"){
                    $category = "Misdemeanor";
                }else{
                    $category = "Simple Offense";
                }
                   ?>
                   <tr>
                   <td class="" id="border-line">
                    <?php  
                     if($image == ""){
                         echo "<img src='static/images/person.jpg' class='rounded-circle border border-secondary border-3' style='width:90px' id='img'>";
 
                     }else{
                     echo "<img src='uploads/$image' class='rounded-circle border border-secondary border-0' style='width:90px' id='img'>"; 
                     }
                     ?>
                
                    </td>
                   <td class="fw-bold"><br> <?php echo $fullname ?></td>
                   <td class="fw-bold"><br> <?php echo $age ?></td>
                   <td class="fw-bold"><br> <?php echo $progress ?></td>
                   <td class="fw-bold"><br> <?php
                   if($category == "Felony"){
                    $sevierity = "<progress id='felony' min='0' max='100' value='90'><progress>";
                       echo "<span class='p-2 fw-bold'>
                       $category
                    
                       </span>";
                       echo "<br>";
                       echo $sevierity;
                    }elseif($category == "Misdemeanor"){
                        $sevierity = "<progress id='misdemeanor' min='0' max='100' value='60'><progress>";
                        echo "<span class='p-2 fw-bold'>
                        $category
                        </span>";
                        echo "<br>";
                        echo $sevierity;
                    }else{
                        $sevierity = "<progress id='simple' min='0' max='100' value='30'><progress>";
                        echo "<i class='fs-4 text-info'></i><span class=' p-2 fw-bold'>
                        $category
                        
                        </span>";
                        echo "<br>";
                        echo $sevierity;
                    }

                    echo '<br>';
                    echo '<br>';
                    // echo $placement;
                     ?>
                    </td>
                   <td class="fw-bold"><br> 
                   <?php 
                   if($reporter == "Supervisor(Adagom1 settlement)"){
                    $reporter = "Adagom 1";
                }elseif($reporter == "Supervisor(Ukende settlement)"){
                    $reporter = "Ukende";
                }else{
                    $reporter = "Adagom 3";
                }
                   echo $reporter;
                   echo "<br>";
                   if($status == "Approved"){
                    echo "<span class='bi bi-check fs-3 text-primary'></span>";
                   }
                    ?>
                   </td>
                   <td style="background:none">
            
                   <form action="report.full_view.php" method="post">
                   <input type="hidden" name="viewId" value="<?php echo $id ?>">
                   <input type="submit" name="submit2" value="View all" class="btn btn-dark">
                   </form>
                   <br>
                 <a href="pm.update_report.php?u_id=<?php echo $id ?>" class="btn btn-warning">Update</a>
                 
                   </td> 
                   </tr>
       
                   <?php
               }
            }else{
               echo "
               <center>
               <div class='text-center alert alert-warning offset-0 p-5 w-50'>No report has been added</div>
               </center>
               ";
           }
       }
       
       echo allreports($connector);

       ?>
        </table>
<br>
</section>

<div class="container">

        <div id="mySidenav" class="sidenav bg-secondary text-light">

        <div class="container p-3" style="margin-top: -6rem; background:rgb(5, 69, 83);">
            <br>
            <br>
        <a href="javascript:void(0)" class="closebtn text-light " onclick="closeNav()">&times;</a>

        <span class=" lead fw-semibold dashboard position-absolute text-light">
            
            <?php echo $img ?>
            <!-- <img src="static/images/OIP.jpg" class="rounded-circle"  alt="" style="width:50px"> -->
        </span>         
        <span class="position-absolute fs-6 text-light fw-semibold" id="dash-text">

            <?php echo $user ?>
        </span>           

        </div>
        <br>
        <ul>
        <li>
        <a href="pm.complaints.php">
        <span class="bi bi-exclamation-triangle-fill text-light fs-3 "></span> &nbsp; Complaints</a>
        </li>
        <hr>
        <li>
        <a href="summary.php">
        <span class="bi bi-clipboard-check text-light fs-3"></span>&nbsp;Total Summary
      
       </a>
        </li>

        <hr>
        <li>
        <a href="frequent.php">
        <span class="bi bi-star-fill text-warning fs-3"></span>&nbsp; Notorious Reports
      
       </a>
        </li>
        <hr>
       
        <li>
        <a href="analytics.php">
        <span class="bi bi-bar-chart-fill text-light fs-3"></span> &nbsp; Statistical Summary
    </a>
        </li>
        <hr>
        <li>
        <a href="#logout" data-bs-toggle="modal"
        class=" ">

        <span class="bi bi-lock text-light fs-3" data-bs-target="#logout" data-bs-toggle="modal"></span>  &nbsp; logout
        </a>
        </li>
        </ul>
        </div>
        </div>

        <!-- sidenav2 -->

        <div class="container">

        <div id="updateProfileImg" class="sidenav bg-secondary text-light">

        <div class="container p-2" style="margin-top: -6rem; background:rgb(5, 69, 83);">
            <br>
            
            <br>
        <a href="javascript:void(0)" class="closebutton text-light " onclick="close_nav()">&times;</a>   
        <br>             
        <span class=" lead fw-bold dashboard position-absolute  fs-5 text-light">
            
          <span class="bi bi-person fs-2"></span>  Update profile
         </span>  
        </div>
        
        <!-- <ul> -->
        <div class="container">
        <div class="container">

            <form action="profile.php" method="post" enctype="multipart/form-data" class="">
                <br>
                
                <label for="image" class="p-3">Select profile image</label>
                <input type="file" name="profileImage" class="form-control form-control-lg">
                <input type="hidden" name="username" value="<?php echo $username ?>">
                
                <hr>
                <input type="submit" value="Update" name="updateImage" class="btn btn-warning w-50">
            </form>
            <br>
            <hr class="p-5 bg-light">
            <br>

            <form action="profile.php" method="post">
              
              <label for="image" class="p-1">Update phone number</label>
                      <br>
                      <br>
                  <div class="row">
                      <div class="col-md-4">
                      <input type="tel" name="country_code" value="+234" class="form-control form-control-lg">
                      </div>
                      <div class="col-md-8">
                      <input type="tel" name="num" class="form-control form-control-lg" placeholder="9067476828">
                      </div>
                  </div>
               
                  <hr>
                  <input type="hidden" name="user" value="<?php echo $username ?>">
                  <input type="submit" value="Update" name="updateAdMobile" class="btn btn-dark w-50">
              </form>
              <br>
              <br>
            </div>
            </div>
            <!-- </ul> -->
            </div>
            </div>
            </div>

            <?php 
        
            $footer_display_query = $connector -> query("SELECT * FROM `crimes` ORDER BY `crimeId` DESC");
            if($footer_display_query == true){
                $q_row = mysqli_fetch_assoc($footer_display_query);
                if($q_row == 0){
                    ?>
                    <footer class="footer p-5 fixed-bottom">

                <p class="text-light">Powered by <a href="#" class="text-warning text-decoration-none">Digital Systems Technologies</a> </p>
                </footer>
                <?php

            }else{
                ?>
                 <footer class="footer p-5">

                <p class="text-light">Powered by <a href="#" class="text-warning text-decoration-none">Digital Systems Technologies</a> </p>
                </footer>

                <?php
            }

        }
            ?>

<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>
<script src="static/js/jquery.js"></script>
<script>
    setTimeout(function(){
        $('.loader_bg').fadeToggle();
    }, 3000);
</script>

</body>
</html>