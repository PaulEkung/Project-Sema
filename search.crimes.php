<?php 
require_once 'db.connection.php';
$sql = "SELECT * FROM `crimes` ORDER BY `crimeId` ASC";
            $result = $connector->query($sql);
            $data = array();
            foreach($result as $row){
                $data[] = array(
                    'label' => $row["OffendersName"],
                    'value' => $row["OffendersName"]
                );
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seach Crimes</title>
    <script src="js/jquery.js" defer type="text/javascript"></script>
    <script src="js/bootstrap.min.js" defer  type="text/javascript"></script>
    <script src="js.js" defer></script>

<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js'" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>

    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" defer href="static/bootstrap-icons/bootstrap-icons.css">

    <style type="text/css" media="all">
    
   * {
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
    min-height: 100%;

}
    #logo{
    width: 80px;
}

#nav{
    background: rgb(5, 69, 93);
}


#footer{
    
    background: rgb(5, 69, 93);
    
}

.form-group button{
    background: transparent;
    position: absolute;
    top: 0;
    left: 45%;

}



</style>

</head>
<body  style="background-color: rgba(0, 0, 0, 0.459);">
<section>
        <header>
            <nav class="nav navbar navbar-expand p-3" id="nav">
            <img id="logo" src="static/images/logo.jpg" class="rounded-circle" alt="image">
            <h1 class="text-uppercase text-light fw-bold">crsema</h1>
                <menu class="ms-auto nav">
                <ul class="nav navbar-nav p-4" id="login-ul">
                    <li class="nav-item active"><a href="login.php" class="text-light p-2 text-decoration-none">Login</a></li>
                    &nbsp;  &nbsp;
                    <li class="nav-item"><a href="search.crimes.php" class="text-light p-2 text-decoration-none border border-light border-2 rounded-2">Search crime</a></li>
                      &nbsp;  &nbsp;
                    <li class="nav-item"><a href="quick.report.php" class="text-light p-2 text-decoration-none">Quick report</a></li>
                      &nbsp;  &nbsp;
                   
                    <li class="nav-item"><a href="index.php" class="text-light text-decoration-none p-2">Home</a></li>
                </ul>
                    </menu>
                </nav>
        </header>
    </section>
     <br>
    <br>

<div class="container shadow alert alert-secondary p-5 w-75" id="crimes">
                <div class="header">

                    <form action="search.crimes.php" method="POST">
                        <div class="form-group position-relative">
                            <input type="text" name="progress" class="form-control form-control-lg w-50" id="search_box" placeholder="Search by progress number or name" onkeyup="javascript:load_data(this)"/>
                            <button type="submit" name="submit" class="border-0 bi bi-search offset-0 fs-4 p-2">
                                
                                </button> 
                                </div> 
                                
                            </form>
                            </div>
                            <hr>
                            <span id="search_result">
                                 
                            </span>
 
                            <div class="container w-100" id="crime">
                <?php 
                if(isset($_POST["submit"])){
                    $get_result = $_POST["progress"];
                    if(empty($get_result)){
                        echo "<div class=' alert alert-danger alert-dismissible w-50 text-center shadow'>
                        Please provide a progress/registration number
                        </div>";
                    }else{
                        $sql = $connector -> query("SELECT * FROM `crimes` WHERE crimes.progressNumber = '$get_result' or crimes.OffendersName = '$get_result' or crimes.OffendersName LIKE '%$get_result%' or crimes.progressNumber LIKE '%$get_result%'");
                        #select the required rows
                        if($sql -> num_rows > 0){
                           while($row = $sql->fetch_assoc()){
                            $name = $row["OffendersName"];
                            $age = $row["age"];
                            $progress = $row["progressNumber"];
                            $image = $row["offendersImage"];
                            $settlement = $row["settlement"];
                            $id = $row["crimeId"];

                            ?>
                            <table class="table table-responsive table-hover">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>

                        <tr>
                            <td>
                                <a href="#" class="text-decoration-none text-black">

                                <?php

                                 if($image == ""){
                                    echo "<img src='static/images/person.jpg' class='border border-secondary rounded-circle border-2' style='width:80px'>";
            
                                }else{
                                   
                                    echo "<img src='uploads/$image' class='border-dark rounded-circle border rounded-circle border-0' style='width:80px'>";
                               
                                }
                                ?>
                                    
                                 
                                </a> 
                            </td>
                          
                            <td>

                            <?php echo "<span class='fw-bold lead'>$progress</span>"; ?>
                            </td>
                            <td>
                            <?php echo "<span class='lead'>$name</span>"; ?>

                            </td>
                            <td>
                            <?php echo "<span class='lead'>$age</span>"; ?>

                            </td>
                            <td><a href="report.full_view.php?searchId=<?php echo $id ?>" class="btn btn-primary float-end" >See full result</a>
                        </td>
                        </tr>

                        
                    </table>

                            <?php

                           }
                     
                }else{
                    echo "<span class='lead'>No result was found</span>";
                }
            }
        }
                ?>
            </div>

            </div>


            <section>
                <br>
            
                <footer class="footer p-4 text-light fixed-bottom" id="footer">
           <p>Powered by <a href="" class="text-warning text-decoration-none">Digital Systems Technologies </a></p>

               
        </footer>
        
    </section>
    
</body>
</html>
