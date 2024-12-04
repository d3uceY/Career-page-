<?php

if(isset($_SESSION["data"]))
{
    header('Location: HR-Dashboard');
    die();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action'])){

        $defaultInstance = new defaults();

        if((int)($_POST["action"]) == $defaultInstance->getActions()["login"]){

            $userManagerInstance = new UserManager();
            
            if(isset($_POST["HREmail"]) && isset($_POST["HRPassword"])){

                $HREmail = trim($_POST["HREmail"]);
                $HRPassword = $_POST["HRPassword"];

                die($userManagerInstance->setLoginSession($HREmail, $HRPassword));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Log In details are not set or inputted"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else{

            $response = array(
                "response" => "error",
                "message" => "Invalid query action"
            );
            die(json_encode($response, 1));
        }
        
    }
    else{

        $response = array(
            "response" => "error",
            "message" => "Invalid login attempt"
        );
        die(json_encode($response, 1));
    }
}
?>


<!DOCTYPE html>
<html lang="zxx">

<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Dana Group - Career Portal</title>
<link rel="icon" href="WebApp/HR/img/DGC-logo.png" type="image/png">

<link rel="stylesheet" href="WebApp/HR/css/bootstrap1.min.css" />
<link rel="stylesheet" href="WebApp/HR/vendors/font_awesome/css/all.min.css" />
<link rel="stylesheet" href="WebApp/HR/css/metisMenu.css">

<link rel="stylesheet" href="WebApp/HR/css/style1.css" />
<link rel="stylesheet" href="WebApp/HR/css/colors/default.css" id="colorSkinCSS">

<style>
    a.active {
        color: #2F3390 !important;
    }
    .menu-head{
        color: #2F3390 !important;
    }
    .logo{
        background-color: inherit !important;
    }
    .loaderCont{
        display: none;
    }
</style>


</head>
<body class="crm_body_bg" style="background-color: #EFEFEF !important;">






<div class="main_content_iner" style="width: 80% !important; margin: auto !important;">
<div class="container">
<div class="row justify-content-center">
<div class="logo d-flex justify-content-between" style="width: auto !important; margin: auto !important; padding: 20px !important;">
<a href="#"><img src="WebApp/HR/img/DGC-logo.png" width="100px" height="60px" alt></a>

</div>

<div class="modal-content cs_modal"  style="background-color: #EFEFEF !important; border: none !important;">
<div class="modal-header" style="background-color: #2F3390 !important;">
<h5 class="modal-title" style="color: #FFFFFF !important;">HR Career Portal</h5>
</div>
<div class="modal-body" style="background-color: #D9D9D9 !important;">
<form id="loginHR">


<div class>
<input type="email" id="HREmail" required class="form-control" style="width: 50% !important;" placeholder="Enter your email">
</div>
<div class>
<input type="password" id="HRPassword" required class="form-control" style="width: 50% !important;" placeholder="Password">
</div>
<button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="logText">Log In </span><span class="loaderCont"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>

</form>
</div>
</div>





<div class="footer_part">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="footer_iner text-center">
<p>2024 © Dana Group - HR Career Portal</p>
</div>
</div>
</div>
</div>
</div>



<script src="WebApp/HR/js/jquery1-3.4.1.min.js"></script>

<script src="WebApp/HR/js/popper1.min.js"></script>

<script src="WebApp/HR/js/bootstrap1.min.js"></script>
<script src="WebApp/HR/js/bootstrapAlert.min.js"></script>

<script>

$(document).ready(function() { 
    $("#loginHR").submit(function(){


        $(".logText").css("display", "none");
        $(".loaderCont").css("display", "inline");
        var HREmailVal = $("#HREmail").val();
        var HRPasswordVal = $("#HRPassword").val();
        var emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        
        if(HREmailVal == "" && HRPasswordVal == ""){

            BootstrapAlert.alert({
                title:"Error",
                message:"Both Fields are compulsory!"
            });
        }
        else if(!emailPattern.test(HREmailVal)){

            BootstrapAlert.alert({
                title:"Error",
                message:"Inputted email address is invalid"
            });

        }
        else{

            var HRPostData = "HREmail="+HREmailVal+"&HRPassword="+HRPasswordVal+"&action=0";
            $.ajax({ 
                type:"POST",
                url:"HR-Login",
                data: HRPostData, 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                        BootstrapAlert.success({
                        title:"Sussess",
                        message:"Your Log In is successful\nRedirecting in 5 seconds"
                        });
                        setTimeout(function() {
                        window.location.href = "HR-Dashboard";
                        }, 5000);
                    }
                    else
                    {
                        BootstrapAlert.alert({
                        title:"Error",
                        message:serverResponse.message
                        });
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                    BootstrapAlert.alert({
                    title:"Error",
                    message:"Something happened while processing your Log In\nPlease try again later."
                    });
                }.bind(this)
            });  
            

        }

        $(".loaderCont").css("display", "");
        $(".logText").css("display", "inline");
        return false;
    });
});

</script>

</body>

</html>