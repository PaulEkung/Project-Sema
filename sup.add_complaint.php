<?php
require_once 'db.connection.php';
require_once 'views.php';
require_once 'complaint.controller.php';
require_once 'sessions.php';

if(isset($_SESSION["sessionDashboard"])){
    $user = $_SESSION["sessionDashboard"];
}
$checkConnection = check_supervisor_login($connector);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
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

.form-group, .form-control, textarea {
    width: 95.4%;
    padding: 10px 10px 10px 10px;
    font-weight: normal;
    border: none;
	/* background: rgba(235, 235, 235, 0.20); */
    outline: none;
    margin: 6px 0 17px 0px;
    transition: 0.5s all;
     -webkit-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
    -moz-transition: 0.5s all; 
     
 
}

.form-bg{
    border-radius: 10px;
}
.heading{
    background: rgb(5, 69, 93);
    border-radius: 30px 30px 0 0;
}

.btn{
    background: rgb(5, 69, 93);
}



</style>

</head>
<body class="alert alert-secondary">


<div class="container form-bg">

    <a href="sup.dashboard.php" class="p-2 text-dark bi bi-arrow-left fs-2"></a>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

                <div class="form">
                <div class="form-group">
                
                    <form action="sup.add_complaint.php" method="post" autocomplete="off" enctype="multipart/form-data" class="p-4 shadow-lg" style="background:rgba(5, 5, 5, 0.371);">
                    <?php $caller = postComplaint($connector) ?>
                    <!-- <label for="image" class="text-light">Enter complaint subject</label> -->
                    <input type="text" name="subject" class="form-control form-control-lg placeholder-glow placeholder-wave" placeholder="Complaint subject">
                    <br>
                    <label for="image" class="text-light">Sample image(<span class="text-danger">Optional</span>)</label>
                    <input type="file" name="img" class="form-control form-control-lg placeholder-glow placeholder-wave">
                    <br>
                    <!-- <label for="image" class="text-light">Write complaint</label> -->
                    <textarea name="context" id="" cols="30" rows="10" class="form-control form-control-lg placeholder-wave" placeholder="Write complaint here..(maximum of 300 words)"></textarea>
                    <input type="hidden" name="writer" value="<?php echo $user ?>">
                    <br>
                    <center>

                        <input type="submit" name="submit" class="btn btn-dark w-50 p-3">
                    </center>
                    </form>
                </div>
            </div>

             
           
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
    
</body>
</html>