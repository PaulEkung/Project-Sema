<?php
session_start();
require_once 'db.connection.php';
require_once 'sessions.php';

 if(isset($_SESSION["superUser"])){
    $user = $_SESSION['superUser'];

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
    height: 95%;
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
        top: -1.5rem;
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

    </style>

    <script type="text/javascript">
    function openNav(){
        document.getElementById("mySidenav").style.width ="420px";
        // document.getElementById("mySidenav").style.background = "rgba(0,0,0,0.5)";
        document.getElementById("main").style.marginLeft ="100px";
        // document.getElementById("main").style.opacity ="0.1";
        // document.getElementById("main").style.opacity ="0.1";
    }
    function closeNav(){
        document.getElementById("mySidenav").style.width ="0";
        document.getElementById("main").style.marginLeft ="0";
        // document.getElementById("main").style.opacity ="100";
    }
    </script>
</head>
<body>
<div class="loader_bg">
    <div class="preloader">

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
            <nav class="nav navbar navbar-expand p-4" id="nav">
                <img src="static/images/OIP.jpg" class="rounded-circle" style="width: 70px" alt="">
               <p class="fs-4 text-light"> &nbsp;<?php echo $user ?></p>
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
    <section class="main p-3">
    <table class='table table-bordered p-5 table-md text-center table-responsive text-dark fw-bold table-hover alert alert-secondary bg-transparent'>
        <tr>
        <th class="p-3 fs-4 text-dark fw-bold">Image</th>
        <th class="p-3 fs-4 text-dark fw-bold">Name</th>
        <th class="p-3 fs-4 text-dark fw-bold">Age</th>
        <th class="p-3 fs-4 text-dark fw-bold">Registration #</th>
        <th class="p-3 fs-4 text-dark fw-bold">Crime category</th>
        <th class="p-3 fs-4 text-dark fw-bold">Reporter</th>
        <th class="p-3 fs-5 fw-bold bg-secondary text-light">Action</th>
        </tr>
       <?php
       
       function allreports($connector)
       {
           $sql = $connector->query("SELECT * FROM `crimes` ORDER BY `crimeId` DESC");
           if($sql == true && $sql -> num_rows > 0){
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
                   ?>
                   <tr>
                   <td class="bg-transparent">
                    <?php  
                     if($image == ""){
                         echo "<img src='static/images/person.jpg' class='rounded-circle border border-secondary border-3' style='width:90px'>";
 
                     }else{
                     echo "<img src='uploads/$image' class='rounded-circle border border-secondary border-0' style='width:90px'>"; 
                     }
                     ?>
                
                    </td>
                   <td class="fw-bold"><br> <?php echo $fullname ?></td>
                   <td class="fw-bold"><br> <?php echo $age ?></td>
                   <td class="fw-bold"><br> <?php echo $progress ?></td>
                   <td class="fw-bold"><br> <?php
                   if($category == "Felony Category"){
                    $sevierity = "<progress id='felony' min='0' max='100' value='90'><progress>";
                       echo "<span class='p-2 fw-bold'>
                       $category
                    
                       </span>";
                       echo "<br>";
                       echo $sevierity;
                    }elseif($category == "Misdemeanor Category"){
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
                   <td class="fw-bold"><br> <?php 
                   echo $reporter;
                   echo "<br>";
                   if($status == "Approved"){
                    echo "<span class='bi bi-check fs-3 text-info'></span>";
                   }
                    ?>
                   </td>
                   <td style="background:none">
            
                   <form action="report.full_view.php" method="post">
                   <input type="hidden" name="viewId" value="<?php echo $id ?>">
                   <input type="submit" name="submit2" value="View all" class="btn btn-dark">
                   </form>
                   <br>
                   <form action="pm.update_report.php" method="post">
                   <input type="hidden" name="updateId" value="<?php echo $id ?>">
                   <input type="submit" name="update" value="update" class="btn btn-warning">
                   </form>
                 

                   </td> 
                   </tr>
       
                   <?php
               }
            }else{
               echo "<div class='text-center alert alert-warning offset-0 p-5 w-50'>No report has been added</div>";
           }
       }
       
       echo allreports($connector);

       ?>
        </table>

</section>

<div class="container">

        <div id="mySidenav" class="sidenav bg-secondary text-light">

        <div class="container p-3" style="margin-top: -6rem; background:rgb(5, 69, 83);">
            <br>
            <br>
        <a href="javascript:void(0)" class="closebtn text-light " onclick="closeNav()">&times;</a>

        <span class=" lead fw-semibold dashboard position-absolute  fs-5 text-light">
            
            <img src="static/images/OIP.jpg" class="rounded-circle"  alt="" style="width:50px">
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
        <a href="#">
        <span class="bi bi-people text-light fs-3"></span> &nbsp; Settlements
        <!-- <span class="badge position-absolute mb-5"> -->

     
        </span>
        </a>
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
        <a href="#rate" data-bs-toggle="modal">
        <span class="bi bi-bar-chart-fill text-light fs-3"></span> &nbsp; Statistical Summary</a>
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
<br>
<br>
 <footer class="footer p-3 fixed-bottom">

<p class="text-light">Powered by <a href="#" class="text-warning text-decoration-none">DS Technologies</a> </p>
</footer>
</div>
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