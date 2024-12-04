<?php
/*
 @ugoabuchi - @my github repo github.com/ugoabuchi
 */
require 'composer/vendor/autoload.php';
class UserManager
{
    private $databaseInstance = null;
    private $token = null;
    private $codeGen = null;
    private $defaults = null;
    private $response = null;
    private $vCode = null;
    function __construct()
    {
        $this->databaseInstance = new database("dana-career");
        $this->token = new tokengenerator();
        $this->codeGen = new codegenerator(10);
        $this->vCode = new codegenerator(6);
        $this->defaults = new defaults();
        $this->response = [];
        
        
        //create all needed table if they dont exist
        
        //check if hr user table exist table exist
                if($this->databaseInstance->execute_count_table_no_return("hr-user-table") == 0)
                {
                    $tableQuery = "
                    CREATE TABLE `hr-user-table` ( 
                        `id` INT(16) NOT NULL AUTO_INCREMENT , 
                        `first-name` VARCHAR(160) NOT NULL , 
                        `last-name` VARCHAR(160) NOT NULL , 
                        `middle-name` VARCHAR(160) NOT NULL , 
                        `gender` VARCHAR(160) NOT NULL , 
                        `email` VARCHAR(160) NOT NULL ,
                        `phone-number` VARCHAR(160) NOT NULL ,
                        `account-type` VARCHAR(160) NOT NULL ,
                        `company-category` VARCHAR(160) NOT NULL ,
                        `account-status` VARCHAR(160) NOT NULL ,
                        `created` VARCHAR(160) NOT NULL ,
                        `ltimein` VARCHAR(160) NOT NULL ,
                        `token` TEXT NOT NULL,
                        `passkey` VARCHAR(160) NOT NULL,
                        `salt` VARCHAR(160) NOT NULL,
                        PRIMARY KEY (`id`), 
                        UNIQUE (`email`)) ENGINE = InnoDB;";
                    $this->databaseInstance->execute_no_return($tableQuery);
                }
                
                 //check if usersession table exist
                if($this->databaseInstance->execute_count_table_no_return("hr-user-session") == 0)
                {
                    $tableQuery = "
                    CREATE TABLE `hr-user-session` ( 
                        `id` INT(16) NOT NULL AUTO_INCREMENT , 
                        `userid` VARCHAR(160) NOT NULL , 
                        `taction` VARCHAR(160) NOT NULL , 
                        `token` TEXT NOT NULL ,
                        `created` VARCHAR(160) NOT NULL ,
                        `validity` VARCHAR(160) NOT NULL , 
                        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                    $this->databaseInstance->execute_no_return($tableQuery);
                }
                
    }
    
    public function checkIfEmailExist($email)
    {
        $result = false;
            //check if user exist in users table
            $userIDQuery= "SELECT COUNT(*) FROM `hr-user-table` WHERE email='$email'";
            
            if($this->databaseInstance->execute_count_no_return($userIDQuery) == 1)
            {
                //User exist
                $result = true;
            }
            else
            {
                    $result = false;
            }
            
            return $result;

    }

    public function verifyTokenValidity($email, $token)
    {
       //verify $token exist with user is valid
        $verifyTokenValidityQuery = "SELECT id FROM `hr-user-table` WHERE email='$email' AND token='$token'";
        if(count($this->databaseInstance->execute_return($verifyTokenValidityQuery)) > 0)
        {
            $dbAdminID = $this->databaseInstance->execute_return($verifyTokenValidityQuery)[0]['id'];
            //Token is correct in user's table, check if it is current is user session
            
            $adminSessionQuery = "SELECT created FROM `hr-user-session` WHERE userid='$dbAdminID' AND token='$token' AND validity='true'";
            $adminSessionQueryResult = $this->databaseInstance->execute_return($adminSessionQuery);
            if(count($adminSessionQueryResult) > 0){
                
                //Token exist to be valid in DB
                //Verify token validity
                $myTimeStamp = date_create($adminSessionQueryResult[0]['created'])->getTimestamp() + $this->defaults->getSessionExpTime();
                if ($myTimeStamp > time() ){
                    
                    //Token is verified
                    $this->response["response"] = "success";
                    $this->response["message"] = "Your session is still valid";
                    $this->response['email'] = $email;
                    $this->response['token'] = $token;
                    
                }
                else
                {
                    //Token is expired, update login session
                    $this->deleteLoginSession($dbAdminID);
                    $this->response["response"] = "error";
                    $this->response["message"] = "Token Expired, Sign in again to continue your session";
                    
                }
                
                
            }
            else
            {
                //Token not valid in DB
                    $this->response["response"] = "error";
                    $this->response["message"] = "Invalid token, action dismissed ";
                
            }   
            
        }
        else
        {
            //Token is not current in user profile
                    $this->response["response"] = "error";
                    $this->response["message"] = "Invalid token credentials ";
            
        }
        
        return json_encode($this->response, 1);
               
    }
    
    
    public function deleteLoginSession($dbUserID)
    {
        //delete login session
        if($dbUserID != null && $dbUserID != "")
        {
            $DeleteSessionQuery = "UPDATE `hr-user-session` set validity = 'false' WHERE userid='$dbUserID' AND validity ='true'";
            $this->databaseInstance->execute_no_return($DeleteSessionQuery);
        }

    }

    public function logout($emailAddress, $token){

        if($this->verifyTokenValidity($emailAddress, $token) == true){

            $dbUserID = $this->databaseInstance->execute_return("SELECT id FROM `hr-user-table` WHERE email='$emailAddress'")[0]["id"];
            //delete login session
            $this->deleteLoginSession($dbUserID);
        }
        if(isset($_SESSION["data"])){
            unset($_SESSION["data"]);
        }


    }

    public function updateusersessionaction($dbUserID, $token, $action)
    {
        $updateSessionQuery = "INSERT INTO `hr-user-session` (userid, taction, token, created, validity) VALUES('$dbUserID', '$action', '$token', now(), 'true')";
        $this->databaseInstance->execute_no_return($updateSessionQuery); 
    }
    
       
    public function setPasscode($email, $currentPassword, $newPassword){
       
       $setPasswordQuery = $this->databaseInstance->execute_return("SELECT passkey, salt, id FROM `hr-user-table` WHERE email='$email'")[0];
       $dbPassKey = $setPasswordQuery['passkey'];
       $dbSalt = $setPasswordQuery['salt'];
       
       //verify old passkey
       $currentPassKey = md5($currentPassword)."-DanaGroup-".md5((md5("-DanaGroup-").$dbSalt)).md5($currentPassword);
       if($currentPassKey == $dbPassKey)
       {
            $salt = $this->vCode->getCode();
            $newPassKey = md5($newPassword)."-DanaGroup-".md5((md5("-DanaGroup-").$salt)).md5($newPassword);
            
            $this->databaseInstance->execute_no_return("UPDATE `hr-user-table` SET passkey='$newPassKey', salt='$salt' WHERE email='$email'");
            $this->response["response"] = "success";
       }
       else
       {
            $this->response["response"] = "error";
            $this->response["message"] = "Incorrect password combination,\nplease browse the website properly";
       }
       
       
       return json_encode($this->response, 1);
   }

    public function addNewAdminUser($adminEmail, $adminSessionToken,  $firstName, $lastName, $gender, $phoneNumber, $emailAddress, $accountType, $companyCategory, $accountStatus, $password, $middleName = "")
    {
        
            //check if email has valid session
            if(($this->verifyTokenValidity($adminEmail, $adminSessionToken))["response"] == "error"){
                $this->response["response"] = "error";
                $this->response["message"] = "Your login session is not authorized for this action,\ncontact administrator";
            }
            else if($this->checkIfEmailExist($emailAddress) == true){

                //email to be registered already exist
                $this->response["response"] = "error";
                $this->response["message"] = "The email address to be registered already exist,\ntry again with a different email address.";
            
            }
            else  if($this->defaults->verifyAccountType($accountType) == false){
                $this->response["response"] = "error";
                $this->response["message"] = "Account type does not have a valid input,\nplease use the website properly";
            }
            else  if($this->defaults->verifyCompanyCategory($companyCategory) == false){
                $this->response["response"] = "error";
                $this->response["message"] = "Company category does not have a valid input,\nplease use the website properly";
            }
            else  if($this->defaults->verifyAccountStatus($accountStatus) == false){
                $this->response["response"] = "error";
                $this->response["message"] = "Account status does not have a valid input,\nplease use the website properly";
            }
            else{

                $salt = $this->codeGen->getCode();
                $generatedPasskey = md5($password)."-DanaGroup-".md5((md5("-DanaGroup-").$salt)).md5($password);
                
                //register new admin user details
                $registerNewAdminQuery = "INSERT INTO `hr-user-table`(`first-name`, `last-name`, `middle-name`, `gender`, `email`, `phone-number`, `account-type`, `company-category`, `account-status`, `created`, `ltimein`, `token`, `passkey`, `salt`) VALUES ('$firstName','$lastName','$middleName','$gender','$emailAddress','$phoneNumber','$accountType','$companyCategory','$accountStatus',now(),now(),'', '$generatedPasskey','$salt')";
                $this->databaseInstance->execute_no_return($registerNewAdminQuery);
                $this->response["response"] = "success";
                $this->response["message"] = "Registration for user: ".$emailAddress." was sucessful";
            }
            
            
            return json_encode($this->response, 1);

    }
    
    public function setLoginSession($email, $password)
    {
            //check if user exist in users table
            if($this->checkIfEmailExist($email) == false){
                $this->response["response"] = "error";
                $this->response["message"] = "User does not exist";
            }
            else
            {
               $selectUserDetailsQuery = "SELECT * FROM `hr-user-table` WHERE email='$email'";
               $dbUserID = $this->databaseInstance->execute_return($selectUserDetailsQuery)[0]['id'];
               $email = $this->databaseInstance->execute_return($selectUserDetailsQuery)[0]['email'];
               $accountStatus = $this->databaseInstance->execute_return($selectUserDetailsQuery)[0]['account-status'];
               
               
               if($accountStatus == "In-Active")
               {
                    $this->response["response"] = "error";
                    $this->response["message"] = "Account In-Active, contact administrators";
               }
               else{
                    //check if password hash is correct
                $userDBDetails = $this->databaseInstance->execute_return($selectUserDetailsQuery)[0];
                $dbPassKey = $userDBDetails['passkey'];
                $dbSalt = $userDBDetails['salt'];
                
                $generatedPassKey = md5($password)."-DanaGroup-".md5((md5("-DanaGroup-").$dbSalt)).md5($password);
                if($dbPassKey == $generatedPassKey)
                {
                    $this->deleteLoginSession($dbUserID);
                    $newToken = $this->token->getToken();
                     
                    //update login token, coords, PNID & ltimein
                    $updateLoginToken = "UPDATE `hr-user-table` SET `token`='$newToken', `ltimein`=now() WHERE email='$email'";
                    $this->databaseInstance->execute_no_return($updateLoginToken);
                    $this->updateusersessionaction($dbUserID, $newToken, $this->defaults->getActions()["UpdateSession"]);
                    
                    $dbResult = $this->databaseInstance->execute_return($selectUserDetailsQuery)[0];
                    
                    unset($dbResult['salt']);
                    unset($dbResult['id']);
                    unset($dbResult['passkey']);
                    $this->response["response"] = "success";
                    $this->response["message"] = "Signed in";
                    $_SESSION['data'] = $dbResult;
                   
                    
                }
                else{
                    $this->response["response"] = "error";
                    $this->response["message"] = "Passkey is incorrect";
                }
                
               }
              
                
            }
            
            return json_encode($this->response, 1);

    }
    
    
}