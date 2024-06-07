<?php

function postCrimeController($connector){

if(isset($_POST["submit"]) && isset($_FILES["image"]["name"])) {

    $fullname = $_POST["fullname"]; $progress_number = $_POST["progress"];
     $age = $_POST["age"];
     $settlement = $_POST["settlement"]; $address = $_POST["address"];  $case = $_POST["crime"]; $description = $_POST["description"]; $date = $_POST["crimeDate"]; $severity = null;
     $reporter = $_POST["reporter"];

     $__query = $connector -> query("SELECT `phone` FROM `users` WHERE users.username = 'PMSEMA';");
     if($__query == true){
        $_row = $__query -> fetch_assoc();
        $phone = $_row['phone'];
    }

      $image_name = $_FILES["image"]["name"];     
        $tmp_name = $_FILES["image"]["tmp_name"]; 
        $img_size = $_FILES["image"]["size"];  
        $img_error = $_FILES["image"]["error"]; 
        if($img_error === 0){
        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
        $img_ex_to_lc = strtolower($img_ex);
        $allowed_exs = array('jpg','png','jpeg');
        if(in_array($img_ex_to_lc, $allowed_exs)){
            $max_size = 50 * 1024 * 1024;
            if($img_size > $max_size){

                define("error", "<div class='alert alert-danger offset-0 shadow text-center'>The image size is too large</div>", false);
                echo error;
            }else{
        $new_img_name = uniqid("$progress_number", true).'.'.$img_ex_to_lc;
        $img_upload_path = './uploads/'.$new_img_name;
       
        }

    }else{

        define("err", "<div class='alert alert-danger offset-0 shadow text-center'>You can't upload images of this type </div>", false);
    echo err;
    }
    }else{ 
        
        echo null;
    }

    if(checkEmptyReportInputs($fullname, $progress_number, $age, $settlement, $address, $case, $description, $date) === true){
        echo "<div class=\"alert alert-danger text-center error shadow\">All required fiels are compulsary</div>";
    
    }elseif(checkMaxWordsInDesField($description) === true){
        echo "<div class=\"alert alert-danger text-center fw-bold error shadow\">Maximum words for description exceeded</div>";
    }elseif(validProgressNumber($progress_number !== true)){
        echo "<div class=\"alert alert-danger text-center fw-bold error shadow\">Invalid registration number format..</div>";
    }else{
            $approvalStatus = "Under investigation";
            $category = null;
            $placement = null;

            if($case == "Murder"  || $case == "Manslaughter" || $case == "Kidnapping" || $case == "Assault" || $case == "Robbery"){
                $category = "Felony Category";
                $placement = "Violent Crime";
            }elseif($case == "Traficking" || $case == "Possesion with intent to distribute" || $case == "Manufacturing" || $case == "Cultivation" || $case == "Sale"){
                $category = "Felony Category";
                $placement = "Drug Crime";
            }elseif($case == "Burglary" || $case == "Larceny" || $case == "Arson" || $case == "Grand theft" || $case == "Identity theft"){
                $category = "Felony Category";
                $placement = "Property Crime";
            }elseif($case == "Fraud" || $case == "Embezzlement" || $case == "Tax evasion"){

                $category = "Felony Category";
                $placement = "Financial Crime";
            }elseif($case == "Inciting a riot" || $case == "Disturbing the peace"){
                $category = "Felony Category";
                $placement = "Public Order Crime";
            }elseif($case == "Human traficking" || $case == "Child molestation" || $case == "Rape" || $case == "Sexual harassment"){
                $category = "Felony Category";
                $placement = "Sex Crime";
            }elseif($case == "Acts of terrorism" || $case == "Conspiracy to commit terrorism" || $case == "Providing material support to terrorists"){
                $category = "Felony Category";
                $placement = "Terrorism Crime";
            }elseif($case == "Disorder conduct" || $case == "Petty theft" || $case == "Shoplifting" || $case == "Vandalism" || $case == "Assault and battery" || $case == "Possesion of a controlled substance" || $case == "Trespassing" || $case == "Harassment" || $case == "Public intoxication"){

                $category = "Misdemeanor Category";
                $placement = "Misdemeanor Crime";

            }elseif($case == "Littering" || $case == "Jaywalking" || $case == "Dog-walking" || $case == "Curfew violation" || $case == "Public urination" || $case == "Open container violation"){
                $category = "Simple Offense";
                $placement = "Simple crime";
            }else{
                $category = "Others";
                $placement = "Others";
            }
            $query = $connector->query("SELECT * FROM crimes where progressNumber = '$progress_number'");
            if($query->num_rows >= 0){
            $sql = $connector ->query("INSERT IGNORE INTO `crimes`(OffendersName, progressNumber, age, offendersImage, settlement, houseAddress, crimeCase, crimeDescription, crimeCategory, crimePlacement, crimeDate, reporter, approvalStatus) VALUES ('$fullname', '$progress_number', '$age', '$new_img_name', '$settlement', '$address', '$case', '$description', '$category', '$placement', '$date', '$reporter','$approvalStatus');");
            
            if($sql == true)
            {
                
                move_uploaded_file($tmp_name, $img_upload_path); 

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

                    header("Location: sup.dashboard.php");

            
            }else{
                
                echo "<div class='text-center alert alert-danger offset-0 w-100'>Failed to add record! Something went wrong</div>";
                
            }
        }
        
        }
    
    }else{
        echo "<div class='text-center alert alert-warning offset-0 w-100 text-start'>Once you have submitted this form, you will not be able to edit your responses. Please make sure that all of the information you have provided is accurate and complete before clicking the submit button.</div>";
    }
}

function reportUpdate($connector){
    
}

