<?php 
if(isset($_SESSION["data"]) && is_array($_SESSION["data"])){

    $userManagerInstance = new UserManager();
    $userManagerInstance->logout($_SESSION["data"]["email"], $_SESSION["data"]["token"]);
}

header('Location: HR-Login');
 die();


?>