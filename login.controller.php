<?php

function UserLogin($connector){
if(isset($_POST["submit"])){
    $username = stripslashes($_POST["username"]);
    $password = stripslashes($_POST["password"]);

    if(emptyInputs($username, $password) === true){

        echo "<div class=\"alert alert-danger text-center error shadow\">Username and password required.</div>";
}elseif(checkUserExists($connector, $username) === true){
    echo "<div class=\"alert alert-danger text-center error shadow\">
    <b>Access denied </b>
    <br/>
    Unknown user information.
    </div>";
    

}else{
    redirectLogin($connector, $username, $password);
}

}
}

