<?php
 require_once 'db.connection.php';
 require_once 'views.php';
 require_once 'login.controller.php';
 if(isset($_GET["success"])){
    echo "<script>window.alert('Report sent successfully!')</script>";
 }elseif(isset($_GET["smsSuccess"])){
    echo "<script>window.alert('sms notification sent successfully!')</script>";
 }elseif(isset($_GET["smsFailed"])){
    echo "<script>window.alert('Failed to send sms notification')</script>";
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" defer href="static/bootstrap-icons/bootstrap-icons.css">
    
<script type="text/javascript" defer>
        // let x = showPass();
        function showPass(element){
    var x = document.getElementById("pwd");
        if(x.type ==="password"){

     x.type ="text";

        }else{
            x.type="password";
        }
        var y = element.style.color;
       if(y == "darkred"){
           element.style.color = "darkblue";
       }else{
           element.style.color = "darkred";
       }
       var z = document.getElementById("eye");
        if(z.className == "bi bi-eye fs-4 offset-3")
        {
            z.className = "bi bi-eye-slash fs-4 offset-3";
        }else{
            z.className = "bi bi-eye fs-4 offset-3";
        }

        }

        </script>
       

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

#login-nav{

background: rgb(5, 69, 93);

}


#login-footer{

background: rgb(5, 69, 93);

}

#login-icon{
    background-color: rgb(5, 69, 93);
}

.btn-submit{
    background-color: rgb(5, 69, 93);
    font-size: 20px;
}

input[type="password"]:focus{
    outline: none;
}

.form-group span{
    position: relative;
    top: -40px;
    left: 64%;
    
}

.form-group{
    border-radius: 20px;

}

.col-md-5{
    border-radius: 30px;
    margin-left: 3rem;
}


</style>

        
</head>
<body style="background-color: rgba(0, 0, 0, 0.059);">
<div class="loader_bg">
    <div class="preloader">

    </div>

</div>
    <section>
        <!-- navigation bar section -->
        <header>
            <nav class="nav navbar navbar-expand p-3" id="login-nav">
            <img id="logo" src="static/images/logo.jpg" class="rounded-circle" alt="image">

                <h1 class="text-uppercase text-light fw-bold">crsema</h1>
                <menu class="ms-auto nav">
                <ul class="nav navbar-nav p-4" id="login-ul">
                    <li class="nav-item active"><a href="login.php" class="text-light p-2 text-decoration-none border border-light border-2 rounded-2">Login</a></li>
                    &nbsp;  &nbsp;
                    <li class="nav-item"><a href="security_key.php" class="text-light p-2 text-decoration-none">Search crime</a></li>
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
        <div class="container" id="bg-con">
   
<div class="row g-0">

<div class="col-md-3">
   
</div>
    
    <div class="col-md-5">
        <!-- login form -->

            <?php
            $call_script = UserLogin($connector);
            ?>      
        <div class="form-group position-relative bg-light">
            <form action="login.php"  method="post" class="p-5 rounded-2" autocomplete="off">
                
                <input type="text" name="username" class="form-control form-control-lg border-2" placeholder="Enter username">
                <br>
                
                <input type="password" name="password" class="form-control-lg form-control" placeholder="Enter password" id="pwd">
                
                <span class="bi bi-eye-slash offset-3 fs-4" id="eye" style="cursor:pointer;color:darkred" onclick="showPass(this)"></span>
            
                <br>
                <script type="text/javascript">
                var check_pass_input = document.querySelector("#pwd");
        
                check_pass_input.addEventListener("keyup", function(){
                if(check_pass_input.value.length == 0 || check_pass_input.value.length < 8){
                check_pass_input.style.border = "3px solid rgba(177, 13, 13, 0.726)";
                
                }else{
                    check_pass_input.style.border = "3px solid dodgerblue";

                }
            })

                // var pwd_strenth = document.querySelector("#pwd-strenth");
                // pwd_strenth.addEventListener("keyup", function(){
                //     if(check_pass_input)
                // })
            
            </script>

                
                <input type="submit" name="submit" class="btn btn w-100 text-light btn-submit p-2">

                
            </form>


        </div>
        
    </div>

<div class="col-md-4"></div>
</div>
</div>
<br>
<br>
    
<section>

<!-- footer section -->
                <footer class="footer p-5 text-light fixed-botto" id="login-footer">
           <p>Powered by <a href="" class="text-warning text-decoration-none">Digital Systems Technologies </a></p>

               
        </footer>
        
    </section>
    
    <script src="js/jquery.js" defer type="text/javascript"></script>
    <script src="js/bootstrap.min.js" defer  type="text/javascript"></script>

<script src="static/bootstrap-5.1.3/dist/js/bootstrap.js'" defer></script>
<script src="static/bootstrap-5.1.3/dist/js/bootstrap.min.js" defer></script>


</body>   
  
</html>