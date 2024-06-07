<?php
    require_once 'db.connection.php';
    function UpdateImg($connector){
    if(isset($_POST["updateImage"]) && isset($_FILES["profileImage"]["name"])){
        $username = $_POST["username"];
        $image_name = $_FILES["profileImage"]["name"];     
        $tmp_name = $_FILES["profileImage"]["tmp_name"]; 
        $img_size = $_FILES["profileImage"]["size"];  
        $img_error = $_FILES["profileImage"]["error"]; 
        if($img_error === 0){
        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
        $img_ex_to_lc = strtolower($img_ex);
        $allowed_exs = array('jpg','png','jpeg', 'jfif');
        if(in_array($img_ex_to_lc, $allowed_exs)){
            $max_size = 50 * 1024 * 1024;
        if($img_size > $max_size){

            header("Location: pm.dashboard.php?sizeError");

        }else{
        $new_img_name = uniqid("$username", true).'.'.$img_ex_to_lc;
        $img_upload_path = './uploads/'.$new_img_name;

        }

        }else{

            header("Location: pm.dashboard.php?typeError");
        }
        }else{ 

        echo null;
        }

            if(empty($image_name)){
                
                header("Location: pm.dashboard.php?EmptyInput");
               
            }else{
                $sql = $connector -> query("UPDATE `users` SET image = '$new_img_name' WHERE `users`.`username` = '$username'; ");
                if($sql == true){
                    move_uploaded_file($tmp_name, $img_upload_path); 
                    header("Location: pm.dashboard.php?uploadSuccess");

                }else{
                    
                    header("Location: pm.dashboard.php?uploadFailed");

                }
            }
            }
        }
        UpdateImg($connector);

function UpdateSupImage($connector){
    if(isset($_POST["updateSupImage"]) && isset($_FILES["Image"]["name"])){
        $username = $_POST["username"];
        $image_name = $_FILES["Image"]["name"];     
        $tmp_name = $_FILES["Image"]["tmp_name"]; 
        $img_size = $_FILES["Image"]["size"];  
        $img_error = $_FILES["Image"]["error"]; 
        if($img_error === 0){
        $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
        $img_ex_to_lc = strtolower($img_ex);
        $allowed_exs = array('jpg','png','jpeg', 'jfif');
        if(in_array($img_ex_to_lc, $allowed_exs)){
            $max_size = 50 * 1024 * 1024;
        if($img_size > $max_size){

            header("Location: sup.dashboard.php?sizeError");
        
        }else{
        $new_img_name = uniqid("$username", true).'.'.$img_ex_to_lc;
        $img_upload_path = './uploads/'.$new_img_name;

        }

        }else{
            header("Location: sup.dashboard.php?typeError");

        echo err;
        }
        }else{ 

        echo null;
        }

            if(empty($image_name)){

                header("Location: sup.dashboard.php?emptyInput");
               
               
            }else{
                $sql = $connector -> query("UPDATE `users` SET image = '$new_img_name' WHERE `users`.`username` = '$username'; ");
                if($sql == true){
                    move_uploaded_file($tmp_name, $img_upload_path); 
                    // echo "<script>window.alert('Profile image updated successfully')<script>";
                    header("Location: sup.dashboard.php?uploadSuccess");

                }else{
                    header("Location: pm.dashboard.php?uploadFailed");
                  

                }
            }
            }
        }

        UpdateSupImage($connector);

            function UpdateMobileNumber($connector){
                if(isset($_POST["updateMobile"])){
                    $code = $_POST["code"]; 
                    $number = $_POST["number"];
                    $supervisor = $_POST["username"];
                    if(empty($number)){
                        header("Location: sup.dashboard.php?emptynumField");
                        
                    }elseif(strlen($number) < 10 || strlen($number) > 11){
                       
                        header("Location: sup.dashboard.php?invalidnum");

                    }elseif(!preg_match('/\d+/', $number) || !is_numeric($number)){
                        
                        header("Location: sup.dashboard.php?containLetters");
                  
                    }elseif($code !== "+234"){
                        header("Location: sup.dashboard.php?codeErr");

                    }else{

                        // if($number[0] === '0'){
                        //     $number = substr($number, 1);
                        //     $num_format = $code . $number;
                        // }else{
                        // $num_format = $code . $number; 
                        // }
                        if(substr($number, 0, 1) !== "0"){
                            $number = "0" . $number;
                            $num_format = $number;
                        }elseif(substr($number, 0, 1) === "0"){
                            $num_format = $number;
                        }
                        $sql = $connector -> query("UPDATE `users` SET `users`.`phone` = '$num_format' WHERE `users`.`username` = '$supervisor';");
                        if($sql == true){
                        header("Location: sup.dashboard.php?successUpdatePhone");
                    }else{
                        header("Location: sup.dashboard.php?updatePhoneError");

                    }

                }
            }
        }
            UpdateMobileNumber($connector);

            function UpdateSuperAdminMobileNum($connector){

                if(isset($_POST["updateAdMobile"])){

                    $country_code = $_POST["country_code"]; $num = $_POST["num"];

                    $admin = $_POST["user"];

                    if(empty($num)){

                        header("Location: pm.dashboard.php?emptynumField");
                        
                    }elseif(strlen($num) < 10 || strlen($num) > 11){
                       
                        header("Location: pm.dashboard.php?invalidnum");

                    }elseif(!preg_match('/\d+/', $num) || !is_numeric($num)){
                        
                        header("Location: pm.dashboard.php?containLetters");

                    }elseif($country_code !== "+234"){
                        
                            header("Location: pm.dashboard.php?country_codeErr");
    
                    }else{

                            if(substr($num, 0, 1) !== "0"){
                                $num = "0" . $num;
                                $number_format = $num;
                            }elseif(substr($num, 0, 1) === "0"){
                                $number_format = $num;
                            }
                            // if($num[0] === '0'){
                            // $num = substr($num, 1);
                            // $number_format = $country_code . $num;
                            // }else{
                            // $number_format = $country_code . $num;
                            // }
                    
                        $sql = $connector -> query("UPDATE `users` SET `users`.`phone` = '$number_format' WHERE `users`.`username` = '$admin';");
                        if($sql == true){
                            header("Location: pm.dashboard.php?successUpdatePhone");
                        }else{
                            header("Location: pm.dashboard.php?updatePhoneError");
                            
                    }
                }
            }
        }
            UpdateSuperAdminMobileNum($connector);

