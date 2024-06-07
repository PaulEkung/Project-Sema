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
    function checkEmptyReportInputs($fullname, $progress_number, $age, $settlement, $address, $u_case, $description, $date){
        $result = null;
        if(empty($fullname) || empty($progress_number) || empty($age) || empty($settlement) || empty($address) || empty($u_case) || empty($description) || empty($date)){
            $result = true;
        }else{
            $result = false;
        }
        return($result);
    } 
    function validProgressNumber($progress_number){
    $result = null;
    $reg_parts = explode('-', $progress_number);
    if(count($reg_parts) != 2){
        $result = false;
    }

    $pattern_1 = '/^[a-zA-Z0-9]{3}$/';
    $pattern_2 = '/^[a-zA-Z0-9]{8}$/';
    if(!preg_match($pattern_1, $reg_parts[0])){
        $result = false;
    }elseif(!preg_match($pattern_2, $reg_parts[1])){
        $result = false;
    }else{
        $result = true;
    }

    if(strlen($reg_parts[0]) != 3){
        $result = false;

    }elseif(strlen($reg_parts[1]) != 8){
        $result = false;
    }else{

        $result = true;
    }

    return $result;
    }

    function fieldWorkerNotification($connector){
        if(isset($_POST["forward"]))
        {
            
        $_username = $_POST["username"];
        $_message = $_POST["message"];
        $phone = null;
        $ad1_field_worker = "AD1FIELDWORKER";
        $ad3_field_worker = "AD3FIELDWORKER";
        $uk_field_worker = "UKFIELDWORKER";

        $q_1 = $connector -> query("SELECT `phone` FROM users WHERE `username` = 'AD1SEMASUP'; ");
        if($q_1 == true){
            $q_row = $q_1 -> fetch_assoc();
            $ad1sup = $q_row['phone'];
        }
        $q_2 = $connector -> query("SELECT `phone` FROM users WHERE `username` = 'AD3SEMASUP'; ");
        if($q_2 == true){
            $q_row_2 = $q_2 -> fetch_assoc();
            $ad3sup = $q_row_2['phone'];
        }
        $q_3 = $connector -> query("SELECT `phone` FROM users WHERE `username` = 'OKSEMASUP'; ");
        if($q_3 == true){
            $q_row_3 = $q_3 -> fetch_assoc();
            $oksup = $q_row_3['phone'];
        }
        $allowed_users = array($ad1_field_worker, $ad3_field_worker, $uk_field_worker);
        
        $image_name = $_FILES["img"]["name"];     
        $tmp_name = $_FILES["img"]["tmp_name"]; 
        $img_size = $_FILES["img"]["size"];  
        $img_error = $_FILES["img"]["error"]; 
        if($img_error === 0){
        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
        $img_ex_to_lc = strtolower($img_ex);
        $allowed_exs = array('jpg','png','jpeg','jfif','pdf');
        if(in_array($img_ex_to_lc, $allowed_exs)){
            $max_size = 50 * 1024 * 1024;
            if($img_size > $max_size){

                define("error", "<div class='alert alert-danger offset-0 shadow text-center'>The image size is too large</div>", false);
                echo error;
            }else{
        $new_img_name = uniqid("$_username", true).'.'.$img_ex_to_lc;
        $img_upload_path = './uploads/'. $new_img_name;
    
        }

    }else{

        define("err", "<div class='alert alert-danger offset-0 shadow text-center'>You can't upload images of this type </div>", false);
    echo err;
    }
    }else{ 
        
        echo null;
    }
        
    if(empty($_username) || empty($_message)){
        echo "
        <div class=\"p-3 alert alert-danger fw-bold\">
        The username and report fields are required..                           
        
        </div>
        ";
    }elseif(checkMaxWordsInFieldWorkerComplaintBox($_message) === true){
        echo "<div class=\"alert alert-danger text-center fw-bold error shadow\">Maximum words for report textbox exceeded</div>";
    }elseif(!in_array($_username, $allowed_users)){
        echo "
        <div class=\"p-3 alert alert-danger fw-bold\">
                                    
            The username provided is not recognized!
    </div>
    ";

    }else{

        if($_username == "AD1FIELDWORKER"){
            $reciever = "Supervisor(Adagom1 settlement)";
            $phone = $ad1sup;
        }elseif($_username == "AD3FIELDWORKER"){
            $reciever = "Supervisor(Adagom3 settlement)";
            $phone = $ad3sup;
        }elseif($_username == "UKFIELDWORKER"){
            $reciever = "Supervisor(Ukende settlement)";
            $phone = $oksup;
        }else{
            $reciever = null;
        }    
        if($image_name){
                $sql = $connector -> query("INSERT INTO `fieldworkernotifications`(username, message, img, reciever) VALUES('$_username', '$_message', '$new_img_name', '$reciever');");
        if($sql == true){
            move_uploaded_file($tmp_name, $img_upload_path);
            echo "
            <div class=\"p-3 alert alert-success\">
            Your report has been sent successfully! 
            <br>
            The $reciever will recieve an SMS notification shortly to view your report.                         
        
            </div>
            ";

            // sms 
                $api_key = "";
                $api_token = "";
                $sender_phone_num = "";
                $reciever_phone_num = $phone;
                $sms_message = "Dear supervisor, " . "\n" . "Your fieldworker just posted a new report. Kindly logging to your dashboard and view report.";
                $reciever_phone_num = [$reciever_phone_num];// set an array of multiple nubers to recieve sms.
            // store all variables in one.
                $content = [
                'to' => $reciever_phone_num,
                'from' => $sender_phone_num,
                'body' => $sms_message
                ];

                //convert the content to json
                $json_content = json_encode($content);
                //making http request in order to use the API service
                $ch = curl_init("https://sms.api.sinch.com/xms/v1/{$api_key}/batches");
                //use authentication(api) token
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-type: application/json',
                    'Authorization: Bearer ' . $api_token
                ));
                curl_setopt($ch, CURLOPT_POST, true);//post request
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_content);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                //makeexecute the HTTP request
                $curl_exec_result = curl_exec($ch); //returns whether HTTP was successful or not
                //check the result
                if(curl_errno($ch)){
                    echo "Failure";//first option
                    echo "Error " . curl_error($ch);//second option
                }else{
                    echo "Success"; //first option
                    echo $curl_exec_result; //second option
                }
                // close connection with server
                curl_close($ch);


              }else{
                echo "
                <div class=\"p-3 alert alert-danger\">
                Failed to send report! Something went wrong. 
                <br>
                kindly ensure you have an internet connection and try again later.           
            
                </div>
                ";
            }

            }else{
                $sql = $connector -> query("INSERT INTO `fieldworkernotifications`(username, message, reciever) VALUES('$_username', '$_message','$reciever');");
            if($sql == true){
                echo "
                <div class=\"p-3 alert alert-success\">
                Your report has been sent successfully! 
                <br>
                The $reciever will recieve a notification shortly to view your report.                         
            
                </div>
                ";
                
                //sms
                $sms_api_key = "";
                $sms_api_token = "";
                $sms_sender_phone_num = "";
                $sms_reciever_phone_num = $phone;
                $sms_notification = "Dear supervisor, " . "\n" . "Your fieldworker just posted a new report. Kindly logging to your dashboard and view report.";
                $sms_reciever_phone_num = [$sms_reciever_phone_num];// set an array of multiple nubers to recieve sms.
            // store all variables in one.
                $sms_content = [
                'to' => $sms_reciever_phone_num,
                'from' => $sms_sender_phone_num,
                'body' => $sms_notification
                ];

                //convert the content to json
                $json_en_content = json_encode($sms_content);
                //making http request in order to use the API service
                $ch_curl = curl_init("https://sms.api.sinch.com/xms/v1/{$sms_api_key}/batches");
                //use authentication(api) token
                curl_setopt($ch_curl, CURLOPT_HTTPHEADER, array(
                    'Content-type: application/json',
                    'Authorization: Bearer ' . $sms_api_token
                ));
                curl_setopt($ch_curl, CURLOPT_POST, true);//post request
                curl_setopt($ch_curl, CURLOPT_POSTFIELDS, $json_en_content);
                curl_setopt($ch_curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch_curl, CURLOPT_SSL_VERIFYPEER, false);

                //makeexecute the HTTP request
                $curl_exe_result = curl_exec($ch_curl); //returns whether HTTP was successful or not
                //check the result
                if(curl_errno($ch_curl)){  
                    echo "Failure";//first option
                    echo "Error " . curl_error($ch_curl);//second option
                }else{
                    echo "Success"; //first option
                    echo $curl_exe_result; //second option
                }
                // close connection with server
                curl_close($ch_curl);


            }else{
                echo "
                <div class=\"p-3 alert alert-danger\">
                Failed to send report! Something went wrong. 
                <br>
                kindly ensure you have an internet connection and try again later.           
            
                </div>
                ";
                }
                }}
                    }else{
                  echo "      
                <p class='alert alert-warning start-1'>
                <img src='static\\images\\messenger_logo.png' width='50px' alt='...'> Only fieldworkers are allowed to fill
                </p>
                    ";

                    }
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

        function checkMaxWordsInFieldWorkerComplaintBox($_message){
            $result = NULL;
            $maxwords = 250;

                $words = explode(" ", $_message);
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
                    $img = $row["image"];
                    $password_verify = password_verify($password, $pwd);
                    
                if($password_verify === false){
                    echo "<div class=' alert alert-danger text-center error'>
                    <b>Access denied</b>
                    <br/>
                    Incorrect password provided
                    </div>";
                
            }elseif($password_verify === true){

        if($user == "DGSEMA"){
            // redirect user as Director General
            $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
            $_SESSION['superUser'] = "Director General";
            $_SESSION['name'] = $row["username"];
            if($img == ""){
                $_SESSION["image"] =  "<a href='#'> <img src='static/images/OIP.jpg' class='rounded-circle border border-secondary border-3' style='width:70px'  onclick=\"open_nav()\" id='img'> </a>";
            }else{

                $_SESSION["image"] = "<a href='#'><img src='uploads/$img' class='rounded-circle border border-secondary border-0' style='width:70px'  onclick='open_nav()' id='img'></a>";

            }
            header("Location: pm.dashboard.php");

        }elseif($user == "PMSEMA"){
            // redirect user as Project Manager
            $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
            $_SESSION['superUser'] = "Project Manager";
            $_SESSION['name'] = $row["username"];
            if($img == ""){
                $_SESSION["image"] =  "<a href='#'> <img src='static/images/OIP.jpg' class='rounded-circle border border-secondary border-3' style='width:70px'  onclick=\"open_nav()\" id='img'> </a>";
            }else{

                $_SESSION["image"] = "<a href='#'><img src='uploads/$img' class='rounded-circle border border-secondary border-0' style='width:70px'  onclick='open_nav()' id='img'></a>";

            }
                    header("Location: pm.dashboard.php");
        }elseif($user == "AD1SEMASUP"){
            // redirect user as Adagom 1 settlement supervisor
            $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
            $_SESSION['sessionDashboard'] = "Supervisor(Adagom1 settlement)";
            $_SESSION['name'] = $row["username"];
            header("Location: sup.dashboard.php");

        }elseif($user == "AD3SEMASUP"){
            // redirect user as Adagom 3 settlement supervisor
            $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
            $_SESSION['sessionDashboard'] = "Supervisor(Adagom3 settlement)";
            $_SESSION['name'] = $row["username"];
            
            header("Location: sup.dashboard.php");

        }elseif($user == "OKSEMASUP"){
            // redirect as Okende settlement supervisor
            $_SESSION['sessionMessage'] = "<div class='text-light'>Login successful</div>";
            $_SESSION['sessionDashboard'] = "Supervisor(Ukende settlement)";
            $_SESSION['name'] = $row["username"];

            

            header("Location: sup.dashboard.php");

        }

    }
    }
    }

    // mysqli_stmt_close($stmt);
    // mysqli_close($connector);
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

    function UpdateCrimeRecords($connector){
    if(isset($_POST["confirmUpdate"])){
        $u_name = $_POST["fullname"];
            $u_progress = $_POST["progress"];
            $u_age = $_POST["age"];
                $u_settlement = $_POST["settlement"];
                $u_address = $_POST["address"];
                $u_case = $_POST["crime"];
                $u_description = $_POST["description"];
                $u_date = $_POST["crimeDate"];
                $u_id = $_POST["id"];

                $category = null;
                $placement = null;
                if(isset($_FILES["update_img"]["name"])){
                    $u_img = $_FILES["update_img"];
                $u_img_name = $_FILES["update_img"]["name"];
                $u_img_tmp = $_FILES["update_img"]["tmp_name"];
                $u_img_size = $_FILES["update_img"]["size"];
                $u_img_type = $_FILES["update_img"]["type"];
                $u_img_err = $_FILES["update_img"]["error"];
                $u_img_ext = explode(".", $u_img_name);
                $u_img_actualExt = strtolower(end($u_img_ext));

                $allowed_img_ext = array("jpg", "jpeg", "png", "pdf", "jfif");
                
            if(in_array($u_img_actualExt, $allowed_img_ext)){
                if($u_img_err === 0){
                    $max_size = 50 * 1024 * 1024;
                    if($u_img_size > $max_size){
                        header("Location: pm.dashboard.php?fileTooLargeError");
                    }else{
                        $u_img_new_name = uniqid("$u_progress", true). "." . $u_img_actualExt;
                        $fileDestination = ".\\uploads\\" . $u_img_new_name;
                        
                    }
                }else{
            header("Location: pm.dashboard.php?unknownError");

                }
         }else{
            header("Location: pm.dashboard.php?invalidFileType");
         }       

    if($u_case == "Murder"  || $u_case == "Manslaughter" || $u_case == "Kidnapping" || $u_case == "Assault" || $u_case == "Robbery"){
        $category = "Felony Category";
        $placement = "Violent Crime";
    }elseif($u_case == "Traficking" || $u_case == "Possesion with intent to distribute" || $u_case == "Manufacturing" || $u_case == "Cultivation" || $u_case == "Sale"){
        $category = "Felony Category";
        $placement = "Drug Crime";
    }elseif($u_case == "Burglary" || $u_case == "Larceny" || $u_case == "Arson" || $u_case == "Grand theft" || $u_case == "Identity theft"){
        $category = "Felony Category";
        $placement = "Property Crime";
    }elseif($u_case == "Fraud" || $u_case == "Embezzlement" || $u_case == "Tax evasion"){

        $category = "Felony Category";
        $placement = "Financial Crime";
    }elseif($u_case == "Inciting a riot" || $u_case == "Disturbing the peace"){
        $category = "Felony Category";
        $placement = "Public Order Crime";
    }elseif($u_case == "Human traficking" || $u_case == "Child molestation" || $u_case == "Rape" || $u_case == "Sexual harassment"){
        $category = "Felony Category";
        $placement = "Sex Crime";
    }elseif($u_case == "Acts of terrorism" || $u_case == "Conspiracy to commit terrorism" || $u_case == "Providing material support to terrorists"){
        $category = "Felony Category";
        $placement = "Terrorism Crime";
    }elseif($u_case == "Disorder conduct" || $u_case == "Petty theft" || $u_case == "Shoplifting" || $u_case == "Vandalism" || $u_case == "Assault and battery" || $u_case == "Possesion of a controlled substance" || $u_case == "Trespassing" || $u_case == "Harassment" || $u_case == "Public intoxication"){

        $category = "Misdemeanor Category";
        $placement = "Misdemeanor Crime";

    }elseif($u_case == "Littering" || $u_case == "Jaywalking" || $u_case == "Dog-walking" || $u_case == "Curfew violation" || $u_case == "Public urination" || $u_case == "Open container violation"){
        $category = "Simple Offense";
        $placement = "Simple crime";
    }else{
        $category = "Others";
        $placement = "Others";
    }   

    $query = $connector ->query("UPDATE  `crimes` SET  OffendersName = '$u_name', progressNumber = '$u_progress', age = '$u_age', offendersImage = '$u_img_new_name', settlement = '$u_settlement', houseAddress = '$u_address', crimeCase = '$u_case', crimeDescription = '$u_description', crimeCategory = '$category', crimePlacement = '$placement', crimeDate = '$u_date' WHERE crimes.crimeId = '$u_id'; ");
    if($query){
        move_uploaded_file($u_img_tmp, $fileDestination);
        header("Location: pm.dashboard.php?updated");
    }else{
        header("Location: pm.dashboard.php?updateFailed");

    }
    }else{
    
        if($u_case == "Murder"  || $u_case == "Manslaughter" || $u_case == "Kidnapping" || $u_case == "Assault" || $u_case == "Robbery"){
        $category = "Felony Category";
        $placement = "Violent Crime";
            }elseif($u_case == "Traficking" || $u_case == "Possesion with intent to distribute" || $u_case == "Manufacturing" || $u_case == "Cultivation" || $u_case == "Sale"){
                $category = "Felony Category";
                $placement = "Drug Crime";
            }elseif($u_case == "Burglary" || $u_case == "Larceny" || $u_case == "Arson" || $u_case == "Grand theft" || $u_case == "Identity theft"){
                $category = "Felony Category";
                $placement = "Property Crime";
            }elseif($u_case == "Fraud" || $u_case == "Embezzlement" || $u_case == "Tax evasion"){

                $category = "Felony Category";
                $placement = "Financial Crime";
            }elseif($u_case == "Inciting a riot" || $u_case == "Disturbing the peace"){
                $category = "Felony Category";
                $placement = "Public Order Crime";
            }elseif($u_case == "Human traficking" || $u_case == "Child molestation" || $u_case == "Rape" || $u_case == "Sexual harassment"){
                $category = "Felony Category";
                $placement = "Sex Crime";
            }elseif($u_case == "Acts of terrorism" || $u_case == "Conspiracy to commit terrorism" || $u_case == "Providing material support to terrorists"){
                $category = "Felony Category";
                $placement = "Terrorism Crime";
            }elseif($u_case == "Disorder conduct" || $u_case == "Petty theft" || $u_case == "Shoplifting" || $u_case == "Vandalism" || $u_case == "Assault and battery" || $u_case == "Possesion of a controlled substance" || $u_case == "Trespassing" || $u_case == "Harassment" || $u_case == "Public intoxication"){

                $category = "Misdemeanor Category";
                $placement = "Misdemeanor Crime";

            }elseif($u_case == "Littering" || $u_case == "Jaywalking" || $u_case == "Dog-walking" || $u_case == "Curfew violation" || $u_case == "Public urination" || $u_case == "Open container violation"){
                $category = "Simple Offense";
                $placement = "Simple crime";
            }else{
                $category = "Others";
                $placement = "Others";
            }   

            $query = $connector ->query("UPDATE  `crimes` SET  OffendersName = '$u_name', progressNumber = '$u_progress', age = '$u_age', settlement = '$u_settlement', houseAddress = '$u_address', crimeCase = '$u_case', crimeDescription = '$u_description', crimeCategory = '$category', crimePlacement = '$placement', crimeDate = '$u_date' WHERE crimes.crimeId = '$u_id'; ");
            if($query){
                header("Location: pm.dashboard.php?updated");
            }else{
                header("Location: pm.dashboard.php?updateFailed");

            }
            }
                        
            }
        }