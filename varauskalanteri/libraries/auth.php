<?php
function isLoggedIn(){
    if(isset($_SESSION["name"],$_SESSION["userID"]) && ($_SESSION["session_id"] == session_id())){
        return true;
    }else{
        return false;
    }
}
