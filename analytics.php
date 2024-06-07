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
    <title>Analysis</title>
    <link rel="stylesheet" href="apexcharts.js-main/dist/apexcharts.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" defer href="static/bootstrap-icons/bootstrap-icons.css">
    <style type="text/css" media="all" defer>
        /* #chart{
            width: 500px;
            height: 500px;
            border: 1px solid black;
        } */
   *{
        padding: 0;
        margin:0;
        box-sizing: border-box;
        user-select: none;
    font: 15px "Century Gothic", "Times Roman", sans-serif;

        /* font-family:sans-serif; */
    }


#chart{
    background: #ededec;
    border: 3px solid dodgerblue;
    border-left: none;
    border-right: none;
    border-top: none;
    top: -20px;
}
#chart2{
  
    background: #ededec;
    border: 3px solid dodgerblue;
    border-left: none;
    border-right: none;
    border-top: none;
    top:20px;
}

.table{
    background: #ededec;
}

nav{
    background: rgb(5, 69, 93);
   
        }
        nav img{
            float: left;
        }

        .footer{
            background: rgb(5, 69, 93);
        }

        h3{
            background: #ededec;
        }
        nav ul{
        height: 100%;
        width: 100%;
    }
    
    ul li{
        padding: 1.2rem;
        list-style: none;
        
    }

    ul li a{
        text-decoration:none;
        border-left:3px solid transparent;
        display: block;
        padding-left: 25px;
        width:100%;
        color: #fff;
        transition: 0.3s ease;
    }
    ul li a:hover{
        color: cyan;
        border-left-color: cyan;
        /* height: 50px; */
        transition: 0.3s ease;
        background: #5487a6be;
        padding:20px;
        color:white;
    }
    .sidebar{
        position: relative;
        height: 100%;
        color: #fff;
        background: #ededec;
        top:-20px;
        right:8px;
        width:105%;
    }

    #dash{
        background: rgba(5, 70, 93, 0.742);
    }
    #specify{
        margin-top:-13%;
        width: 10vw;
    }
    #show{
        display:none;
    }
    #divider{
        background: #afacafaf;
    }
    </style>

</head>
<body class="bg-light">
<section>
        <header>
            <nav class="nav navbar navbar-expand p-4" id="nav">
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
                        <main id="swup" class="transition-fade">

                        <div class="row g-4 m-0">
                           
                        <div class="col-md-3">

                    <div class="sidebar text-light">
                    <div class="p-4 text-light text-dark fw-bold" id="dash">
                    <h2 class="fw-bold text-light">
                    <span class="bi bi-list fs-2"></span>
                        Dashboard
                    </h2>
                    </div> 
                    <menu>
                    <!-- <li> -->
                        <br>
                        <div class="container">

        <form action="analytics.php" method="post">
            <label for="crimeCategory" class="p-2 text-dark fw-bold">Select Crime Category</label>
        <select name="crimeCategory" id="category" class="form-control form-control-lg placeholder-wave form-select">
            <option value="All">All</option>
            <option value="Felony Category">Felony Category</option>
            <option value="Misdemeanor Category">Misdemeanor Category</option>
            <option value="Simple Offense">Simple Offense</option>

        </select>
        <hr>
        <label for="crimeCategory" class="p-2 text-dark fw-bold">Select Month</label>

        <select  name="month" id="category" class="form-control form-control-lg w-50 placeholder-wave form-select">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
            
            
            </select> <span class="btn btn-dark offset-0 float-end" onclick="openPane()" id="specify">Specify</span>
            <br>
            <input type="submit" class="btn btn-primary w-50" id="btn" name="submit1">
            <br>
            <br>
            <br>
            <hr class="p-5" id="divider">
            <div id="show">
            <label for="crimeCategory" class="p-2 text-dark fw-bold">From :</label> <span class="btn-close float-end btn btn" onclick="closePane()"></span>
            
                        <input type="date" class="form-control form-control-lg placeholder-wave" name="from">
                        <br>
                    <label for="crimeCategory" class="p-2 text-dark fw-bold">To :</label>
                        
                        <input type="date" class="form-control form-control-lg placeholder-wave" name="to">
                        <br>
                    <input type="submit" class="btn btn-primary w-50" id="btn2" name="submit2">

                    </div>
                </form>
                            <!-- </li> -->
                        </div>
                        </menu>


            </div>
            </div>

                     <div class="col-md-4">
                        <h3 class="p-3 fw-bold text-uppercase text-center alert alert-secondary">Settlement Statistics</h3>
                            <div id="chart" class="shadow p-3 w-100">
                                <br>
    
                        <?php 

                            if(isset($_POST["submit1"])){

                            $current_year = date('Y');

                            $p_category = $_POST["crimeCategory"];

                            $month = $_POST["month"];

                            if($p_category == "All"){

                                $sql= "SELECT COUNT(*) AS settlementCount from `crimes` WHERE MONTH(date) = '$month' AND YEAR(date) = '$current_year' GROUP BY `reporter` ORDER BY settlementCount DESC";
                            }else{
                                 
                                $sql= "SELECT COUNT(*) AS settlementCount from `crimes` WHERE MONTH(date) = '$month' AND YEAR(date) = '$current_year' AND `crimeCategory` = '$p_category' GROUP BY `reporter` ORDER BY settlementCount DESC";
                            }

                            $result = $connector->query($sql);
                            if($result -> num_rows > 0){
                            // $chartDataName = [];
                            // $chartData = [];
                            while($row = $result->fetch_assoc()){
    
                            $chartDataFrequencyForSettlement[] = $row["settlementCount"];
                            $chartDataReporter[] = $row["reporter"];

    
                            if($chartDataReporter[0] == "Supervisor(Adagom1 settlement)"){
                                $chartDataReporter[0] = "Adagom 1";
    
                            }elseif($chartDataReporter[0] == "Supervisor(Ukende settlement)"){
                                $chartDataReporter[0] = "Ukende";
    
                            }elseif($chartDataReporter[0] == "Supervisor(Adagom3 settlement)"){
                                $chartDataReporter[0] = "Adagom 3";
    
                            }elseif($chartDataReporter[1] == "Supervisor(Adagom1 settlement)"){
                                $chartDataReporter[1] = "Adagom 1";
    
                            }elseif($chartDataReporter[1] == "Supervisor(Ukende settlement)"){
                                $chartDataReporter[1] = "Ukende";
    
                            }elseif($chartDataReporter[1] == "Supervisor(Adagom3 settlement)"){
                                $chartDataReporter[1] = "Adagom 3";
    
                            }elseif($chartDataReporter[2] == "Supervisor(Adagom1 settlement)"){
                                $chartDataReporter[2] = "Adagom 1";
    
                            }elseif($chartDataReporter[2] == "Supervisor(Ukende settlement)"){
                                $chartDataReporter[2] = "Ukende";
                            }elseif($chartDataReporter[2] == "Supervisor(Adagom3 settlement)"){
                                $chartDataReporter[2] = "Adagom 3";
                            }
    
                            }
                             }else{
                            echo "No analysis was found for selected month";
                        }
                    
                        
                    }elseif(isset($_POST["submit2"])){
                        $current_year = date('Y');
                        $p_category = $_POST["crimeCategory"];

                        $from = $_POST["from"];
                        $to = $_POST["to"];
                        

                            if($p_category == "All"){

                               $sql = "SELECT reporter, COUNT(*) AS settlementCount FROM crimes WHERE date BETWEEN '$from' AND '$to' OR YEAR(date) = '$current_year' GROUP BY `reporter` ORDER BY settlementCount DESC";
                                
                            }else{
                                
                                $sql = "SELECT reporter, COUNT(*) AS settlementCount FROM crimes WHERE date BETWEEN '$from' AND '$to' AND crimeCategory = '$p_category' GROUP BY `reporter` ORDER BY settlementCount DESC";
                               
                            }

                                $result = $connector->query($sql);
                                if($result -> num_rows > 0){
                                // $chartDataName = [];
                                // $chartData = [];
                                while($row = $result->fetch_assoc()){
    
                                $chartDataFrequencyForSettlement[] = $row["settlementCount"];
                                $chartDataReporter[] = $row["reporter"];
        
                            if($chartDataReporter[0] == "Supervisor(Adagom1 settlement)"){
                                $chartDataReporter[0] = "Adagom 1";
    
                            }elseif($chartDataReporter[0] == "Supervisor(Ukende settlement)"){
                                $chartDataReporter[0] = "Ukende";
    
                            }elseif($chartDataReporter[0] == "Supervisor(Adagom3 settlement)"){
                                $chartDataReporter[0] = "Adagom 3";
    
                            }elseif($chartDataReporter[1] == "Supervisor(Adagom1 settlement)"){
                                $chartDataReporter[1] = "Adagom 1";
    
                            }elseif($chartDataReporter[1] == "Supervisor(Ukende settlement)"){
                                $chartDataReporter[1] = "Ukende";
    
                            }elseif($chartDataReporter[1] == "Supervisor(Adagom3 settlement)"){
                                $chartDataReporter[1] = "Adagom 3";
    
                            }elseif($chartDataReporter[2] == "Supervisor(Adagom1 settlement)"){
                                $chartDataReporter[2] = "Adagom 1";
    
                            }elseif($chartDataReporter[2] == "Supervisor(Ukende settlement)"){
                                $chartDataReporter[2] = "Ukende";
                            }elseif($chartDataReporter[2] == "Supervisor(Adagom3 settlement)"){
                                $chartDataReporter[2] = "Adagom 3";
                            }
    
                            }

                        }else{
                            echo "No analysis was found for selected month";
                        }
                    
                        }else{
                        // $current_year = date('Y');
                        $sql= "SELECT `reporter`, COUNT(*) AS settlementCount from `crimes`  GROUP BY `reporter` ORDER BY settlementCount DESC";
                    
                    
                    $result = $connector->query($sql);
                    if($result -> num_rows > 0){    
                    while($row = $result->fetch_assoc()){

                    $chartDataFrequencyForSettlement[] = $row["settlementCount"];
                    $chartDataReporter[] = $row["reporter"];

                    if($chartDataReporter[0] == "Supervisor(Adagom1 settlement)"){
                        $chartDataReporter[0] = "Adagom 1";

                    }elseif($chartDataReporter[0] == "Supervisor(Ukende settlement)"){
                        $chartDataReporter[0] = "Ukende";

                    }elseif($chartDataReporter[0] == "Supervisor(Adagom3 settlement)"){
                        $chartDataReporter[0] = "Adagom 3";

                    }elseif($chartDataReporter[1] == "Supervisor(Adagom1 settlement)"){
                        $chartDataReporter[1] = "Adagom 1";

                    }elseif($chartDataReporter[1] == "Supervisor(Ukende settlement)"){
                        $chartDataReporter[1] = "Ukende";

                    }elseif($chartDataReporter[1] == "Supervisor(Adagom3 settlement)"){
                        $chartDataReporter[1] = "Adagom 3";

                    }elseif($chartDataReporter[2] == "Supervisor(Adagom1 settlement)"){
                        $chartDataReporter[2] = "Adagom 1";

                    }elseif($chartDataReporter[2] == "Supervisor(Ukende settlement)"){
                        $chartDataReporter[2] = "Ukende";
                    }elseif($chartDataReporter[2] == "Supervisor(Adagom3 settlement)"){
                        $chartDataReporter[2] = "Adagom 3";
                    }

                        }
                    }else{
                        echo "No data avaliable to analyze";
                    }
                }
                        
                         ?>
                    </div>
                    <br>
                   
                    <?php
                    if(isset($_POST["submit1"])){
                        $current_year = date('Y');

                            $p_category = $_POST["crimeCategory"];

                            $month = $_POST["month"];

                            if($p_category == "All"){

                                $sql= "SELECT `reporter`, COUNT(*) AS settlement_count from `crimes` WHERE MONTH(date) = '$month' AND YEAR(date) = '$current_year' GROUP BY `reporter` ORDER BY settlement_count DESC";
                            }else{
                                 
                                $sql= "SELECT `reporter`, COUNT(*) AS settlement_count from `crimes` WHERE MONTH(date) = '$month' AND YEAR(date) = '$current_year' AND `crimeCategory` = '$p_category' GROUP BY `reporter` ORDER BY settlement_count DESC";
                            }

                            $result = $connector->query($sql);
                            if($result -> num_rows > 0){
                           
                            while($row = $result->fetch_assoc()){
    
                            $settlementCount = $row["settlement_count"];
                            $reporter = $row["reporter"];

                    if($reporter == "Supervisor(Adagom1 settlement)"){
                        $reporter = "Adagom 1";

                    }elseif($reporter == "Supervisor(Ukende settlement)"){
                        $reporter = "Ukende";

                    }elseif($reporter == "Supervisor(Adagom3 settlement)"){
                        $reporter = "Adagom 3";

                    }

                    if($settlementCount == 1){
                        $settlementCount = "$settlementCount report";
                    }else{
                        $settlementCount = "$settlementCount reports";

                    }
                    
                            }
                            }                            
                    }elseif(isset($_POST["submit2"])){

                        $current_year = date('Y');
                        $get_category = $_POST["crimeCategory"];

                        $from_date = $_POST["from"];
                        $to_date = $_POST["to"];
                        

                            if($p_category == "All"){

                               $sql = "SELECT reporter, COUNT(*) AS settlementCount FROM crimes WHERE date BETWEEN '$from' AND '$to' OR YEAR(date) = '$current_year' GROUP BY `reporter` ORDER BY settlementCount DESC";
                                
                            }else{
                                
                                $sql = "SELECT reporter, COUNT(*) AS settlementCount FROM crimes WHERE date BETWEEN '$from' AND '$to' OR YEAR(date) = '$current_year' AND crimeCategory = '$p_category' GROUP BY `reporter` ORDER BY settlementCount DESC";
                               
                            }

                                $result = $connector->query($sql);
                                if($result -> num_rows > 0){
                                // $chartDataName = [];
                                // $chartData = [];
                                while($row = $result->fetch_assoc()){
    
                                $get_count = $row["settlementCount"];
                                $get_settlement = $row["reporter"];
        
                            if($get_settlement == "Supervisor(Adagom1 settlement)"){
                                $get_settlement = "Adagom 1";
    
                            }elseif($get_settlement == "Supervisor(Ukende settlement)"){
                                $get_settlement = "Ukende";
    
                            }elseif($get_settlement == "Supervisor(Adagom3 settlement)"){
                                $get_settlement = "Adagom 3";
    
                            }

                            if($get_count == 1){
                                $get_count = "$get_count report";
                            }else{
                                $get_count = "$get_count reports";
    
                            }

                            }

                        }else{
                            echo "No analysis was found for selected month";
                        }
                    }else{
                        $current_year = date('Y');
                        $sql= "SELECT `reporter`, COUNT(*) AS settlementCount from `crimes` GROUP BY `reporter` ORDER BY settlementCount DESC";
                    
                    
                    $result = $connector->query($sql);
                    if($result -> num_rows > 0){
                    while($row = $result->fetch_assoc()){

                        $settlement_3 = $row["reporter"];
                        $frequency_3 = $row["settlementCount"];
                        
                        if($settlement_3 == "Supervisor(Adagom1 settlement)"){
                            $settlement_3 = "Adagom 1";
    
                        }elseif($settlement_3 == "Supervisor(Ukende settlement)"){
                            $settlement_3 = "Ukende   ";
    
                        }elseif($settlement_3 == "Supervisor(Adagom3 settlement)"){
                            $settlement_3 = "Adagom 3";
    
                        }

                        if($frequency_3 == 1){
                            $frequency_3 = "$frequency_3 report";
                        }else{
                            $frequency_3 = "$frequency_3 reports";

                        }
    
                    
                    }
                    }else{
                        echo "No summary reports avaliable from settlements ";
                    }
                    }
                    ?>
                    <br>
                 </div>
    
                        <div class="col-md-5">
                        <h3 class="p-3 fw-bold text-center alert alert-secondary">CRIME STATISTICS</h3>

                        <div id="chart2" class="shadow p-3 w-100">
                                <br>
    
                        <?php 
                        
                        // $current_month = date('m');
                        if(isset($_POST["submit1"])){
                            $current_year = date('Y');
                            $p_category = $_POST["crimeCategory"];

                            $month = $_POST["month"];

                        if($p_category == "All"){

                            $sql= "SELECT `crimeCategory`, COUNT(*) AS crimeCount from `crimes` WHERE MONTH(date) = '$month' AND YEAR(date) = '$current_year' GROUP BY `crimeCategory` ORDER BY crimeCount DESC";
                            }else{
                                
                                $sql= "SELECT `crimeCategory`, COUNT(*) AS crimeCount from `crimes` WHERE MONTH(date) = '$month' AND YEAR(date) = '$current_year' AND `crimeCategory` = '$p_category' GROUP BY `crimeCategory` ORDER BY crimeCount DESC";
                               
                            }
                          
                         $result = $connector->query($sql);
                         if($result -> num_rows > 0){
                         
                        //   $chartDataName = [];
                        //   $chartData = [];
                         while($row = $result->fetch_assoc()){
    
                            $chartDataFrequency[] = $row["crimeCount"];
                            $chartDataCategory[] = $row["crimeCategory"];
    
                           
    
                            if($chartDataCategory[0] == "Felony Category"){
                                $chartDataCategory[0] = "Felony";
    
                            }elseif($chartDataCategory[0] == "Misdemeanor Category"){
                                $chartDataCategory[0] = "Misdemeanor";
    
                            }elseif($chartDataCategory[0] == "Simple Offense"){
                                $chartDataCategory[0] = "Simple Offense";
    
                            }elseif($chartDataCategory[1] == "Felony Category"){
                                $chartDataCategory[1] = "Felony";
    
                            }elseif($chartDataCategory[1] == "Misdemeanor Category"){
                                $chartDataCategory[1] = "Misdemeanor";
    
                            }elseif($chartDataCategory[1] == "Simple Offense"){
                                $chartDataCategory[1] = "Simple Offense";

                            }elseif($chartDataCategory[2] == "Felony Category"){
                                $chartDataCategory[2] = "Felony";
    
                            }elseif($chartDataCategory[2] == "Misdemeanor Category"){
                                $chartDataCategory[2] = "Misdemeanor";
                            }elseif($chartDataCategory[2] == "Simple Offense"){
                                $chartDataCategory[2] = "Simple Offense";
                            }
                        
                        
                         }
                         
                        }else{
                            echo "No analysis was found for selected month";

                        }
                             

                        }elseif(isset($_POST["submit2"])){
                            $current_year = date('Y');
                            $p_category = $_POST["crimeCategory"];

                            $from = $_POST["from"];
                            $to = $_POST["to"];
    
                                if($p_category == "All"){
    
                                    $sql= "SELECT crimes.crimeCategory, COUNT(*) AS crimeCount from `crimes` WHERE date BETWEEN  '$from' AND '$to' GROUP BY crimes.crimeCategory  ORDER BY crimeCount DESC";
                                }else{
                                    
                                    $sql= "SELECT crimes.crimeCategory, COUNT(*) AS crimeCount from `crimes` WHERE date BETWEEN '$from'  AND '$to'  AND `crimeCategory` = '$p_category' GROUP BY crimes.crimeCategory ORDER BY crimeCount DESC";
                                
                                }

                                $result = $connector->query($sql);

                                if($result -> num_rows > 0){
                              
                                while($row = $result->fetch_assoc()){
        
                                $chartDataFrequency[] = $row["crimeCount"];
                                $chartDataCategory[] = $row["crimeCategory"];
        
                                if($chartDataCategory[0] == "Felony Category"){
                                    $chartDataCategory[0] = "Felony";
        
                                }elseif($chartDataCategory[0] == "Misdemeanor Category"){
                                    $chartDataCategory[0] = "Misdemeanor";
        
                                }elseif($chartDataCategory[0] == "Simple Offense"){
                                    $chartDataCategory[0] = "Simple Offense";
        
                                }elseif($chartDataCategory[1] == "Felony Category"){
                                    $chartDataCategory[1] = "Felony";
        
                                }elseif($chartDataCategory[1] == "Misdemeanor Category"){
                                    $chartDataCategory[1] = "Misdemeanor";
        
                                }elseif($chartDataCategory[1] == "Simple Offense"){
                                    $chartDataCategory[1] = "Simple Offense";
        
                                }elseif($chartDataCategory[2] == "Felony Category"){
                                    $chartDataCategory[2] = "Felony";
        
                                }elseif($chartDataCategory[2] == "Misdemeanor Category"){
                                    $chartDataCategory[2] = "Misdemeanor";

                                }elseif($chartDataCategory[2] == "Simple Offense"){
                                    $chartDataCategory[2] = "Simple Offense";
                                }
        
                                }
    
                            }else{
                                echo "No analysis was found for selected month";
                            }
                        }else{

                    // $current_year = date('Y');
                    $sql= "SELECT `crimeCategory`, COUNT(*) AS crimeCount from `crimes` GROUP BY `crimeCategory` ORDER BY crimeCount DESC";
            
                    $result = $connector->query($sql);
                    if($result -> num_rows > 0){
                  
                    while($row = $result ->fetch_assoc()){

                    $chartDataFrequency[] = $row["crimeCount"];
                    $chartDataCategory[] = $row["crimeCategory"];

                    if($chartDataCategory[0] == "Felony Category"){
                        $chartDataCategory[0] = "Felony";

                    }elseif($chartDataCategory[0] == "Misdemeanor Category"){
                        $chartDataCategory[0] = "Misdemeanor";

                    }elseif($chartDataCategory[0] == "Simple Offense"){
                        $chartDataCategory[0] = "Simple Offense";

                    }elseif($chartDataCategory[1] == "Felony Category"){
                        $chartDataCategory[1] = "Felony";

                    }elseif($chartDataCategory[1] == "Misdemeanor Category"){
                        $chartDataCategory[1] = "Misdemeanor";

                    }elseif($chartDataCategory[1] == "Simple Offense"){
                        $chartDataCategory[1] = "Simple Offense";

                    }elseif($chartDataCategory[2] == "Felony Category"){
                        $chartDataCategory[2] = "Felony";

                    }elseif($chartDataCategory[2] == "Misdemeanor Category"){
                        $chartDataCategory[2] = "Misdemeanor";

                    }elseif($chartDataCategory[2] == "Simple Offense"){
                        $chartDataCategory[2] = "Simple Offense";
                    }

                    }
                        }else{
                            echo "No data avaliable to analyze";
                        }
                    }
                     
                         ?>
                        </div>
                        <br>
                    
                            
        
            <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script> 
            <!-- <script src="apexcharts.js-main/dist/apexcharts.min.js"></script> -->
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script src="https://cdnjsdelivr.net/npm/chart.js@2.9.3/dist/chart.min.js"></script>
            </body>

            <script>
            var chart = document.querySelector('#chart')
            var options ={
                chart:{
                    height: 400,
                    type: 'area',
                    colors: ['red']
            
                },
        plotOptions:{
            bar:{
                horizontal: false,
                colors: ['red'],
                
            }
            
        },
        dataLabels:{
            enabled:true
            },
            series:[{
                data: <?php echo json_encode($chartDataFrequencyForSettlement) ?>

            }],
            
            xaxis:{
                categories: <?php echo json_encode($chartDataReporter) ?>
            },
        }
      
        // chart2
    var chartElement = new ApexCharts(chart, options)
    chartElement.render()
    var chart = document.querySelector('#chart2')
    var options ={
        chart:{
            height: 400,
            type: 'bar',
            colors: ['#33b2df'],

        },
        plotOptions:{
            bar:{
                horizontal: false,

            }
        },
            dataLabels:{
                enabled:true
            },
            series:[{
                data: <?php echo json_encode($chartDataFrequency) ?>
            }],
            
            xaxis:{
                categories: <?php echo json_encode($chartDataCategory) ?>
            },
          
        }
    var chartElement = new ApexCharts(chart, options)
    chartElement.render()

    
</script>
<script>
    function openPane(){
        var x = document.getElementById("show").style.display ="block";
        var y = document.getElementById("btn").style.display = "none";

    }
        function closePane(){
            var z = document.getElementById("show").style.display = "none";
            var q = document.getElementById("btn").style.display = "block";
        }
</script>
</html>