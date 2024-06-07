<?php

function UserLogin($connector){
if(isset($_POST["submit"])){
    $username = stripslashes($_POST["username"]);
    $password = stripslashes($_POST["password"]);

    if(emptyInputs($username, $password) === true){

        echo "<div class=\"alert alert-danger text-center error p-4 fw-bold\">Username and password required.</div>";
}elseif(checkUserExists($connector, $username) === true){
    echo "<div class=\"alert alert-danger text-center error\">
    <b>Access denied </b>
    <br/>
    Unknown user information.
    </div>";
    

}else{
    redirectLogin($connector, $username, $password);
}

}
}

