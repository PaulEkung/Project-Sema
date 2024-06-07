<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search crimes</title>
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<br>
<br>
<br>
<div class="container bg-light w-50 p-4">
                <span class="lead">Please provide security key to access search crime records</span>
                <br>
                <br>
                <form action="security_key.php" method="post" class="p-4">
                    <div class="row">
                        <div class="col-md-6">

                            <input type="text" class="form-control form-control-lg w-100 offset-2" placeholder="Enter security key" name="sk">
                        </div>
                        <div class="col-md-6">
                            &nbsp;

                            <button type="submit" class="btn btn-primary offset-1 mt-1" name="check">Submit</button>
                        </div>
                    </div>
                    <br>
                    <br>
                    <?php 
                    $sk = "pksQr001xqvVw1";
                    if(isset($_POST["check"])){
                        $security_key = $_POST["sk"];
                        if(empty($security_key)){
                            echo "
                            <span class='alert alert-danger p-3 offset-1'>Please fill in your security key</span>
                            ";
                        }else{
                            if($security_key !== $sk){
                                echo "
                            <span class='alert alert-danger p-3 offset-1'>Incorrect security key provided!</span>
                            ";
                            }else{
                                header("Location:search.crimes.php"); 

                            }
                        }
                    }
                    
                    ?>
                </form>
            </div>
           

    
</body>
</html>