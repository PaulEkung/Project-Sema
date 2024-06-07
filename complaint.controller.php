<?php 
function postComplaint($connector){

if(isset($_POST["submit"]) && isset($_FILES["img"]["name"]))
{
    $complaint_subject = $_POST["subject"];
    $complaint_context = $_POST["context"];
    $writer = $_POST["writer"];
    $__query = $connector -> query("SELECT `phone` FROM `users` WHERE users.username = 'PMSEMA';");
     if($__query == true){
        $_row = $__query -> fetch_assoc();
        $phone = $_row['phone'];
        }
        $image_name = $_FILES["img"]["name"];     
        $tmp_name = $_FILES["img"]["tmp_name"]; 
        $img_size = $_FILES["img"]["size"];  
        $img_error = $_FILES["img"]["error"]; 
        if($img_error === 0){
        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
        $img_ex_to_lc = strtolower($img_ex);
        $allowed_exs = array('jpg','png','jpeg','jfif');
        if(in_array($img_ex_to_lc, $allowed_exs)){
            $max_size = 50 * 1024 * 1024;
            if($img_size > $max_size){

                define("error", "<div class='alert alert-danger offset-0 shadow text-center'>The image size is too large</div>", false);
                echo error;
            }else{
        $new_img_name = uniqid("", true).'.'.$img_ex_to_lc;
        $img_upload_path = './uploads/'.$new_img_name;
       
        }

    }else{

        define("err", "<div class='alert alert-danger offset-0 shadow text-center'>You can't upload images of this type </div>", false);
    echo err;
    }
    }else{ 
        
        echo null;
    }

    if(checkEmptyComplaintInput($complaint_subject, $complaint_context) === true){

        echo "<div class=\"alert alert-danger text-center fw-bold error shadow\">All required fiels are compulsary</div>";
    }elseif(checkMaxWordsInContextField($complaint_context) === true){
        echo "<div class=\"alert alert-danger text-center fw-bold error shadow\">Maximum words for complaint textbox exceeded</div>";
    }else{
        $sql = $connector -> query("INSERT INTO `complaints`(subject, context, image, writer) VALUES('$complaint_subject', '$complaint_context', '$new_img_name', '$writer');");
        if($sql == true){
            move_uploaded_file($tmp_name, $img_upload_path);

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

                header("Location: sup.dashboard.php?complaintSuccess");
     
        }else{
            echo "<div class='text-center alert alert-danger offset-0 w-100'>Failed to add record! Something went wrong</div>";
        }
    }
}else{
    echo "<div class='text-center alert alert-warning offset-0 w-100 text-start'>Once you have submitted this form, you will not be able to edit your responses. Please make sure that all of the information you have provided is accurate and complete before clicking the submit button.</div>";
}
}
