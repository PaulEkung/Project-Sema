<?php
// To make sure users do not get direct access to profile without logging in. 

 function check_superUser_login($connector) //checks if the database connection is set.
{
    if(!isset($_SESSION["superUser"]))
    {
        header("Location: login.php");
        exit();
        
    }
        
  }


  function check_supervisor_Login($connector) //checks if the database connection is set.
 {
    if(!isset($_SESSION['sessionDashboard']))
    {
        header("Location: login.php");
        exit();
        
    }
        
}




