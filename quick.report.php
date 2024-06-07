<?php 
require_once 'db.connection.php';
require_once 'views.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Report</title>
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
    background: url("static/images/slider-img.jpg");
    background-blend-mode: darken;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
}

#logo{
    width: 80px;

}

.form-group{
    border-radius: 20px;
}

nav{
    background: rgb(5, 69, 93);
   
        }

        .footer{
            background: rgb(5, 69, 93);
        }

#btn{
    background: rgb(5, 69, 93);
}

</style>
</head>
<body style="background-color: rgba(0, 0, 0, 0.059);">
<section>
        <!-- navigation bar section -->
        <header>
            <nav class="nav navbar navbar-expand p-3" id="login-nav">
            <img id="logo" src="static/images/logo.jpg" class="rounded-circle" alt="image">

                <h1 class="text-uppercase text-light fw-bold">crsema</h1>
                <menu class="ms-auto nav">
                <ul class="nav navbar-nav p-4" id="login-ul">
                    <li class="nav-item active"><a href="login.php" class="text-light p-2 text-decoration-none">Login</a></li>
                    &nbsp;  &nbsp;
                    <li class="nav-item"><a href="security_key.php" class="text-light p-2 text-decoration-none">Search crime</a></li>
                      &nbsp;  &nbsp;
                    <li class="nav-item"><a href="quick.report.php" class="text-light p-2 text-decoration-none border border-light border-2 rounded-2">Quick report</a></li>
                      &nbsp;  &nbsp;
                   
                    <li class="nav-item"><a href="index.php" class="text-light text-decoration-none p-2">Home</a></li>
                </ul>
                    </menu>
                </nav>
        </header>
        </section>
        <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                
                <div class="form-group p-4 bg-light border border-secondary border-2">

                    <form action="quick.report.php" method="post" enctype="multipart/form-data">
                    
                        <?php 
                        $call_func = fieldWorkerNotification($connector);
                        
                        ?>
                        
                        <input type="text" name="username" id="" class="form-control-lg form-control" placeholder="Username">
                        <br>
                        <textarea name="message" id="" cols="30" rows="5" class="form-control form-control-lg" placeholder="Enter report here.."></textarea>
                        <br>
                        <label for="file" class="">Choose file(<span class="text-success">Optional</span>)</label>
                        <input type="file" name="img" id="" class="form-control form-control-lg">
                        <br>
                    <input type="submit" name="forward" value="Send report" class="btn btn-primary w-100 p-3" id="btn">
                </form>
            </div>
            </div>
                
                <div class="col-md-4"></div>
            </div>
            <br>
            <br>
            <footer class="footer p-4">

            <p class="text-light">Powered by <a href="#" class="text-warning text-decoration-none">Digital Systems Technologies</a> </p>
            </footer>          
</body>
</html>