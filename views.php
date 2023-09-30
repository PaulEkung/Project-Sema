<?php
session_start();
// checking if the user clicked submit button without providing some required data"
function emptyInputs($username, $password){
    $result = null;
    if(empty($username) || empty($password)){
        $result = true;

    }else{
        $result = false;
    }
    return $result;
}

// checking if given username exist in database
function checkUserExists($connector, $username){

    $result = null;
    $sql = "SELECT username FROM `users` WHERE username = ?;";
    $stmt = mysqli_stmt_init($connector);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        echo "<div class=\"alert alert-danger text-center\">Failed to connect!.</div>";
    }else{
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rowCount = mysqli_stmt_num_rows($stmt);
        if($rowCount == 0)
        {
            $result = true;
        }else{
            $result = false;
        }
        return $result;

        mysqli_stmt_close($stmt);
        mysqli_close($connector);
    }
     } 


        // crime report function
        function checkEmptyReportInputs($fullname, $progress_number, $age, $settlement, $address, $case, $description, $date){
            $result = null;
            if(empty($fullname) || empty($progress_number) || empty($age) || empty($settlement) || empty($address) || empty($case) || empty($description) || empty($date)){
                $result = true;
            }else{
                $result = false;
            }
            return($result);
        } 

function checkMaxWordsInDesField($description){
    $result = NULL;
    $maxwords = 250;

        $words = explode(" ", $description);
        if(count($words) > $maxwords){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }
   
function checkMaxWordsInContextField($complaint_context){
    $result = NULL;
    $maxwords = 300;

        $words = explode(" ", $complaint_context);
        if(count($words) > $maxwords){
            $result = true;
        }else{
            $result = false;
        }
        return $result; 
    }

   
   
// get user data and loggin the user
function redirectLogin($connector, $username, $password){
    $sql = "SELECT * FROM users where username = ? OR password = ?;";
    $stmt = mysqli_stmt_init($connector);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        die("Failed to connect to database");
    }else{

        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($result && mysqli_stmt_num_rows($stmt) == 0){
            if($row = mysqli_fetch_assoc($result)){
                $pwd = $row["password"];
                $user = $row["username"];
                $password_verify = password_verify($password, $pwd);
        
             if($password_verify === false){
                echo "<div class=' alert alert-danger text-center shadow'>
                <b>Access denied</b>
                <br/>
                Incorrect password provided
                </div>";
            
        }elseif($password_verify === true){

            if($user == "DGSEMA"){
                // redirect user as Director General
                $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
                $_SESSION['superUser'] = "Director General";
                header("Location: pm.dashboard.php");

            }elseif($user == "PMSEMA"){
                // redirect user as Project Manager
                $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
                $_SESSION['superUser'] = "Project Manager";
                header("Location: pm.dashboard.php");

            }elseif($user == "AD1SEMASUP"){
                // redirect user as Adagom 1 settlement supervisor
                $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
                $_SESSION['sessionDashboard'] = "Supervisor(Adagom1 settlement)";
                header("Location: sup.dashboard.php");

            }elseif($user == "AD3SEMASUP"){
                // redirect user as Adagom 3 settlement supervisor
                $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
                $_SESSION['sessionDashboard'] = "Supervisor(Adagom3 settlement)";
                header("Location: sup.dashboard.php");

            }elseif($user == "OKSEMASUP"){
                // redirect as Okende settlement supervisor
                $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
                $_SESSION['sessionDashboard'] = "Supervisor(Okende settlement)";
                header("Location: sup.dashboard.php");

            }

        }
    }
}

mysqli_stmt_close($stmt);
mysqli_close($connector);
}

    }

function checkEmptyComplaintInput($complaint_subject, $complaint_context){
    $result = null;
    if(empty($complaint_subject) || empty($complaint_context)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

    






