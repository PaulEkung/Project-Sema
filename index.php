<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" defer href="static/bootstrap-icons/bootstrap-icons.css">

    <style type="text/css" media="all" defer>

    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    user-select: none;
    font: 17px "Century Gothic", "Times Roman", sans-serif;
    /* outline: 2px solid red !important; */
    
    }
        nav{
            background: rgb(5, 69, 93);
        }

    #background-column{
    /* background styling */
    background: url("static/images/slider-img.jpg");
    background-blend-mode: darken;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 50vh;

}

#police{
    pointer-events : none;
}

#logo{
    width: 80px;
}

#index-footer{
    background: rgb(5, 69, 93);
}

.tag-column{
    background: rgba(125, 79, 55, 0.22);
}

.img-tag{
    background: rgba(2, 49, 67, 0.277);
}

.carousel-item{
            height: 32vh;
            width: 100%;
        }
.carousel-item img{
    top: -50%;
    pointer-events: none;
}
        .carousel-control-prev:hover{
            background:  #6b1e1e30;
        }
        
        .carousel-control-next:hover{
            background:  #6b1e1e30;
        }

        #btn{
            border-radius: 50px;
        }
.carousel-indicators{
    bottom:-65px;
}

.redirect-btn{
display: grid;
place-content: center;
}

.loader{
        pointer-events: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: #fff;
        animation: an1 1s ease infinite;
    }

/* @keyframes an1 {
    0%{
        transform: rotate(0turn);
    }
    100%{
        transform: rotate(1turn);
    }
} */

.loader_bg{
    position: fixed;
    z-index: 999999;
    background: #fff;
    width : 100%;
    height: 100%;
    background: rgb(177, 177, 176);
}
.preloader{
    border: 0 solid transparent;
    border-radius: 50%;
    width : 150px;
    height: 150px;
    background: white;
    position: absolute;
    top: calc(50vh - 75px);
    left: calc(50vw - 75px);
}

.preloader span{
    position: fixed;
    font-size: 80px;
    color: darkred;
    top: calc(55vh - 75px);
    left: calc(28vw - 75px);
}
.preloader p{
    position: fixed;
    color : black;
    font-weight: 700;
    font-size: 40px;
    top: calc(49vh - 75px);
    left: calc(45vw - 75px);
}
/* .preloader:before, .preloader:after{
    content: '';
    border: 1em solid dodgerblue;
    border-radius: 50%;
    width: inherit;
    height: inherit;
    position: absolute;
    top: 0;
    left: 0;
    animation: loader 2s linear infinite;
    opacity: 0;

} */
.preloader:before{
    animation-delay: .5s; 
}
/* @keyframes loader{
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
} */



</style>
    
</head>

<body>



<div class="loader_bg">
    <div class="preloader">
        <p>Powered by</p>
        <span class="fw-bold">DS TECHNOLOGIES</span>
        </div>

</div>
    <main>
        <section>
            <!-- navbar section -->
            <header>
                <nav class="nav p-3 index-nav" id="index-nav">
                    <img id="logo" src="static/images/logo.jpg" class="rounded-circle" alt="image">
                    <h1 class="text-uppercase text-light fw-bold">crsema</h1>
                 
                    <menu class="ms-auto">
                        <ul class="nav text-light ms-auto">

                        <li>
                            <br>
                        
                            <a href="#about" data-bs-toggle="modal" class="btn btn text-light">About Us</a>

                        </li>
                           
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                <img id="logo" src="static/images/logo2.jpg" class="rounded-circle" alt="image">
                            </li>
                           
                            
                        </ul>

                    </menu>
                </nav>
            </header>

        </section>

    
            <!-- bg-image container -->
           
            <div class="row g-0" id="background-column"  style="background-color: rgba(0, 0, 0, 0.431);">
                <div class="col-md-7 p-5 tag-column" >

                <br>
                <br>
                <h1 class="text-light fw-bold">First Step</h1>
                <h3 class="text-light">Security Information Management System</h3>
                <p class="text-warning lead">Shielding the agency with a better administrative performance</p>
                <hr>
                <a href="login.php" class="btn btn-outline-primary border border-primary border-2 text-light p-3 w-50 redirect-btn" id="btn">Click to proceed</a>
               
                </div>
                <script type="text/javascript">
                    
                        var r_btn = document.querySelector(".redirect-btn");
                        r_btn.onclick = function(){
                            this.innerHTML = " <div class='loader'></div>";
                            setTimeout(() =>{
                                
                            }, 2500);
                            
                        }
                    
                    
                    </script>
                 
                <div class="col-md-5 img-tag">
                    
                   
                    <img id="police" src="static/images/OPI.png" class="rounded-circle" alt="image" disable>
                </div>
            </div>

        
                <div class="container w-100">
                    <div class="row">
                        <div class="modal fade w-100" id="about" role="dialog">
                            <div class="modal-dialog w-100">
                                <div class="modal-content w-100">
                                    <div class="modal-header bg-dark text-warning">
                                    <h3>About CRSEMA</h3>    <span class="btn btn-close btn-close-white" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body w-100">
                                        <p class="lead">The Cross River State Emergency Management Agency(CRSEMA) is a government agency in Nigeria responsible for coordinating and managing emergency and disaster response efforts within the state. 
                                            <br>
                                            <br>
                                            <img src="static/images/event_tech 43.jpg" class="w-100" alt="">
                                            <br>
                                            <br>
                                            It is tasked with developing and implementing strategies to mitagate the impact of disasters, as well as providing relief and support to affected communities.
                                            <br>
                                            <br>
                                            <img src="static//images//graduates.jpg" class="w-100" alt=""><!-- double slashes can also be used to enter file directory-->
                                            <br>
                                            <br>
                                            SEMA works closely with various stakeholders, including government agencies, non-governmental organizations, and international partners, to ensure effective disaster preparedness and response. 
                                            <br>
                                            The agency plays a crucial role in safeguarding the lives and property of the residents of Cross River State during times of crisis.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        <footer class="footer text-light p-5 fs-1" id="index-footer">
           <p>Powered by <a href="" class="text-warning text-decoration-none">Digital Systems Technologies </a></p>
        </footer>
    </main>
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

<!-- carousel slider section -->



       