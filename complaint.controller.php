<?php 
function postComplaint($connector){

if(isset($_POST["submit"]) && isset($_FILES["img"]["name"]))
{
    $complaint_subject = $_POST["subject"];
    $complaint_context = $_POST["context"];
    $writer = $_POST["writer"];
    $image_name = $_FILES["img"]["name"];     
        $tmp_name = $_FILES["img"]["tmp_name"]; 
        $img_size = $_FILES["img"]["size"];  
        $img_error = $_FILES["img"]["error"]; 
        if($img_error === 0){
        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
        $img_ex_to_lc = strtolower($img_ex);
        $allowed_exs = array('jpg','png','jpeg','jfif');
        if(in_array($img_ex_to_lc, $allowed_exs)){
            if($img_size > 4000000){

                define("error", "<div class='alert alert-danger offset-0 shadow text-center'>The image size is too large</div>", false);
                echo error;
            }else{
        $new_img_name = uniqid("$complaint_subject", true).'.'.$img_ex_to_lc;
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
        echo "<div class=\"alert alert-danger text-center fw-bold error shadow\">Maximum words for context exceeded</div>";
    }else{
        $sql = $connector -> query("INSERT INTO `complaints`(subject, context, image, writer) VALUES('$complaint_subject', '$complaint_context', '$new_img_name', '$writer');");
        if($sql == true){
            move_uploaded_file($tmp_name, $img_upload_path);

            // if($writer == "Supervisor(Adagom1 settlement)"){
                header("Location: sup.dashboard.php?complaint");

            // }elseif($writer == "Supervisor(Adagom3 settlement)"){
                
            //     header("Location: ad3.dashboard.php?complaint");

            // }else{
                
            //     header("Location: okende.dashboard.php?complaint");
            // }
            
        }else{
            echo "<div class='text-center alert alert-danger offset-0 w-100'>Failed to add record! Something went wrong</div>";
        }
    }
}else{
    echo "<div class='text-center alert alert-danger offset-0 w-100 text-start'>Once you have submitted this form, you will not be able to edit your responses. Please make sure that all of the information you have provided is accurate and complete before clicking the submit button.</div>";
}
}
