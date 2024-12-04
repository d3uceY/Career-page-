<?php
/*
 @ugoabuchi - @my github repo github.com/ugoabuchi
 */
require 'composer/vendor/autoload.php';
class CareerManager
{
    private $databaseInstance = null;
    private $token = null;
    private $codeGen = null;
    private $defaults = null;
    private $response = null;
    private $vCode = null;
    private $emailServices = null;

    function __construct()
    {
        $this->databaseInstance = new database("dana-career");
        $this->token = new tokengenerator();
        $this->codeGen = new codegenerator(10);
        $this->vCode = new codegenerator(6);
        $this->defaults = new defaults();
        $this->emailServices = new mailmanager("smtp.gmail.com", "465", "vacancies@danagroup.com", "frkv xskj ypkk aesm");
        $this->response = [];
        
        
        //create all needed table if they dont exist
        
        //check if location table exist
                if($this->databaseInstance->execute_count_table_no_return("location-table") == 0)
                {
                    $tableQuery = "
                    CREATE TABLE `location-table` ( 
                        `id` INT(16) NOT NULL AUTO_INCREMENT , 
                        `location-state` VARCHAR(160) NOT NULL , 
                        `location-country` VARCHAR(160) NOT NULL , 
                        `created` VARCHAR(160) NOT NULL ,
                        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                    $this->databaseInstance->execute_no_return($tableQuery);
                }

                 //check if Subsidiary table exist
                 if($this->databaseInstance->execute_count_table_no_return("sub-table") == 0)
                 {
                     $tableQuery = "
                     CREATE TABLE `sub-table` ( 
                         `id` INT(16) NOT NULL AUTO_INCREMENT , 
                         `sub-name` VARCHAR(160) NOT NULL , 
                         `icon` VARCHAR(160) NOT NULL ,
                         `created` VARCHAR(160) NOT NULL ,
                         PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                     $this->databaseInstance->execute_no_return($tableQuery);
                 }
                 //check if reference table exist
                 if($this->databaseInstance->execute_count_table_no_return("ref-table") == 0)
                 {
                     $tableQuery = "
                     CREATE TABLE `ref-table` ( 
                         `id` INT(16) NOT NULL AUTO_INCREMENT , 
                         `ref-name` VARCHAR(160) NOT NULL , 
                         `created` VARCHAR(160) NOT NULL ,
                         PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                     $this->databaseInstance->execute_no_return($tableQuery);
                 }
                 if($this->databaseInstance->execute_count_table_no_return("ind-table") == 0)
                 {
                     $tableQuery = "
                     CREATE TABLE `ind-table` ( 
                         `id` INT(16) NOT NULL AUTO_INCREMENT , 
                         `ind-name` VARCHAR(160) NOT NULL , 
                         `created` VARCHAR(160) NOT NULL ,
                         PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                     $this->databaseInstance->execute_no_return($tableQuery);
                 }

                  //check if educational level table exist
                  if($this->databaseInstance->execute_count_table_no_return("edu-table") == 0)
                  {
                      $tableQuery = "
                      CREATE TABLE `edu-table` ( 
                          `id` INT(16) NOT NULL AUTO_INCREMENT , 
                          `edu-name` VARCHAR(160) NOT NULL , 
                          `created` VARCHAR(160) NOT NULL ,
                          PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                      $this->databaseInstance->execute_no_return($tableQuery);
                  }
                  //check if industrial Category level table exist
                  if($this->databaseInstance->execute_count_table_no_return("job-opening") == 0)
                  {
                      $tableQuery = "
                      CREATE TABLE `job-opening` ( 
                        `id` INT(16) NOT NULL AUTO_INCREMENT , 
                        `title` VARCHAR(160) NOT NULL , 
                        `sub-id` VARCHAR(160) NOT NULL , 
                        `loc-id` VARCHAR(160) NOT NULL , 
                        `job-desc` LONGTEXT NOT NULL , 
                        `job-resp` LONGTEXT NOT NULL ,
                        `job-req` LONGTEXT NOT NULL ,
                        `duration` VARCHAR(160) NULL , 
                        `created` VARCHAR(160) NOT NULL ,
                        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                      $this->databaseInstance->execute_no_return($tableQuery);
                  }
                  if($this->databaseInstance->execute_count_table_no_return("job-apply") == 0)
                  {
                      $tableQuery = "
                      CREATE TABLE `job-apply` ( 
                        `id` INT(16) NOT NULL AUTO_INCREMENT , 
                        `job-id` VARCHAR(160) NOT NULL , 
                        `email` VARCHAR(160) NOT NULL , 
                        `first-name` VARCHAR(160) NOT NULL , 
                        `last-name` VARCHAR(160) NOT NULL , 
                        `phone-number` VARCHAR(160) NOT NULL ,
                        `address` TEXT NOT NULL ,
                        `ind-id` VARCHAR(160) NOT NULL ,
                        `ref-id` VARCHAR(160) NOT NULL ,
                        `edu-id` VARCHAR(160) NOT NULL ,
                        `notice` VARCHAR(160) NOT NULL ,
                        `salary` VARCHAR(160) NOT NULL ,
                        `status` VARCHAR(160) NOT NULL ,
                        `experience` VARCHAR(160) NOT NULL ,
                        `jlocation` VARCHAR(160) NOT NULL ,
                        `created` VARCHAR(160) NOT NULL ,
                        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                      $this->databaseInstance->execute_no_return($tableQuery);
                  }
                  if($this->databaseInstance->execute_count_table_no_return("talent-hunt-apply") == 0)
                  {
                      $tableQuery = "
                      CREATE TABLE `talent-hunt-apply` ( 
                        `id` INT(16) NOT NULL AUTO_INCREMENT , 
                        `email` VARCHAR(160) NOT NULL , 
                        `first-name` VARCHAR(160) NOT NULL , 
                        `last-name` VARCHAR(160) NOT NULL , 
                        `phone-number` VARCHAR(160) NOT NULL ,
                        `position` TEXT NOT NULL ,
                        `address` TEXT NOT NULL ,
                        `edu-id` VARCHAR(160) NOT NULL ,
                        `skills` VARCHAR(160) NOT NULL ,
                        `notice` VARCHAR(160) NOT NULL ,
                        `salary` VARCHAR(160) NOT NULL ,
                        `status` VARCHAR(160) NOT NULL ,
                        `experience` VARCHAR(160) NOT NULL ,
                        `created` VARCHAR(160) NOT NULL ,
                        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                      $this->databaseInstance->execute_no_return($tableQuery);
                  }
                                    //check if doc table exist
                                    if($this->databaseInstance->execute_count_table_no_return("doc-table") == 0)
                                    {
                                        $tableQuery = "
                                        CREATE TABLE `doc-table` ( 
                                            `id` INT(16) NOT NULL AUTO_INCREMENT , 
                                            `job-appy-id` VARCHAR(160) NOT NULL , 
                                            `doc-cat` VARCHAR(160) NOT NULL , 
                                            `ext` VARCHAR(160) NOT NULL ,
                                            PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                                        $this->databaseInstance->execute_no_return($tableQuery);
                                    }

                                     //check if doc table exist
                                     if($this->databaseInstance->execute_count_table_no_return("tdoc-table") == 0)
                                     {
                                         $tableQuery = "
                                         CREATE TABLE `tdoc-table` ( 
                                             `id` INT(16) NOT NULL AUTO_INCREMENT , 
                                             `job-appy-id` VARCHAR(160) NOT NULL , 
                                             `doc-cat` VARCHAR(160) NOT NULL , 
                                             `ext` VARCHAR(160) NOT NULL ,
                                             PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                                         $this->databaseInstance->execute_no_return($tableQuery);
                                     }
                
                
    }
    


    public function checkLocationExist($locationState, $locationCountry){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `location-table` WHERE `location-state` = '$locationState' AND `location-country` = '$locationCountry'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }

    public function checkApplyExist($jobID, $appEmail){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `job-apply` WHERE `job-id` = '$jobID' AND `email` = '$appEmail'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }

    public function checkTelentHuntExist($position, $appEmail){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `talent-hunt-apply` WHERE `position` = '$position' AND `email` = '$appEmail'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }
    public function checkJobExist($jobID){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `job-opening` WHERE `id` = '$jobID'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }

    public function checkSubsidiaryExist($subName){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `sub-table` WHERE `sub-name` = '$subName'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }

    public function checkRefExist($subName){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `ref-table` WHERE `ref-name` = '$subName'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }

    public function checkEduExist($subName){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `edu-table` WHERE `edu-name` = '$subName'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }

    public function jobApply($jobID, $email, $firstName, $lastName, $phoneNumber, $address, $industry, $ref, $notice, $salary, $resume, $cover, $edu, $experience, $jLocation){

        if($this->checkJobExist($jobID) == true && $this->checkApplyExist($jobID, $email) == false){

            

	        $status = $this->defaults->getAppStatus()[0];
            $appquery = "INSERT INTO `job-apply`(`job-id`, `email`, `first-name`, `last-name`, `phone-number`, `address`, `ind-id`, `ref-id`, `edu-id`, `notice`, `salary`, `status`, `experience`, `jlocation`, `created`) VALUES ('$jobID', '$email', '$firstName', '$lastName', '$phoneNumber', '$address', '$industry', '$ref', '$edu', '$notice', '$salary', '$status', '$experience', '$jLocation', now())";
            //die("hello");
            $this->databaseInstance->execute_no_return($appquery);
            $getNewID = $this->databaseInstance->execute_return("SELECT id FROM `job-apply` WHERE `email`= '$email' AND `job-id`= '$jobID'")[0]['id'];
            
            //upload file
            $target_dir_resume = "WebApp/File_Uploads/Resume";
            $target_file_resume = $target_dir_resume."/".$getNewID."";
            //$target_dir_cover = "WebApp/File_Uploads/Cover";
            //$target_file_cover = $target_dir_cover . "/".$getNewID.".".strtolower(explode('.', $cover['name'])[1]);
            //die(print_r($resume));strtolower(explode('.', $resume['name'])[1])
            $resumeExt = (explode(".", $resume['name']))[1];
            move_uploaded_file($resume["tmp_name"], "WebApp/File_Uploads/Resume/".$getNewID.".".(explode(".", $resume['name']))[1]);
            $this->databaseInstance->execute_no_return("INSERT INTO `doc-table`(`job-appy-id`, `doc-cat`, `ext`) VALUES ('$getNewID', 'RESUME', '$resumeExt')");
            //die(print_r($cover));
            if($cover['name'] != null && $cover != ""){
                $coverExt = (explode(".", $cover['name']))[1];
                move_uploaded_file($cover["tmp_name"], "WebApp/File_Uploads/Cover/".$getNewID.".".(explode(".", $cover['name']))[1]);
                $this->databaseInstance->execute_no_return("INSERT INTO `doc-table`(`job-appy-id`, `doc-cat`, `ext`) VALUES ('$getNewID', 'COVER', '$coverExt')");
            
            }
            $jobTitle = $this->databaseInstance->execute_return("SELECT `title` FROM `job-opening` WHERE `id`='$jobID'")[0]['title'];
            $subIDD = $this->databaseInstance->execute_return("SELECT `sub-id` FROM `job-opening` WHERE `id`='$jobID'")[0]['sub-id'];
            $subTitle = $this->databaseInstance->execute_return("SELECT `sub-name` FROM `sub-table` WHERE `id`='$subIDD'")[0]['sub-name'];
            //send mail
            $this->emailServices->send_mail_with_reply($email, $lastName." ".$firstName, $jobTitle." - Update on your Application.", $this->emailServices->careerJobAppliedSeeker($lastName." ".$firstName, $jobTitle, $subTitle));

            $this->response["response"] = "success";
            $this->response["message"] = "Your application was successful";

        }
        else{
            $this->response["response"] = "error";
            $this->response["message"] = "You have already applied for this job.";
        }

        return json_encode($this->response, 1);

    }





    public function talentHuntpply($position, $email, $firstName, $lastName, $phoneNumber, $address, $skills, $notice, $salary, $resume, $cover, $edu, $experience){

        
        if($this->checkTelentHuntExist($position, $email) == false){

            
           
	        $status = $this->defaults->getTHuntStatus()[0];
            $appquery = "INSERT INTO `talent-hunt-apply` (`email`, `first-name`, `last-name`, `phone-number`, `position`, `address`, `edu-id`, `skills`, `notice`, `salary`, `status`, `experience`, `created`) VALUES ('$email', '$firstName', '$lastName', '$phoneNumber', '$position', '$address', '$edu', '$skills', '$notice', '$salary', '$status', '$experience', now())";
            //die("hello");
            
            $this->databaseInstance->execute_no_return($appquery);
            $getNewID = $this->databaseInstance->execute_return("SELECT id FROM `talent-hunt-apply` WHERE `email` = '$email' AND `position`= '$position'")[0]['id'];
            
            $resumeExt = (explode(".", $resume['name']))[1];
            move_uploaded_file($resume["tmp_name"], "WebApp/File_Uploads/TResume/".$getNewID.".".(explode(".", $resume['name']))[1]);
            $this->databaseInstance->execute_no_return("INSERT INTO `tdoc-table`(`job-appy-id`, `doc-cat`, `ext`) VALUES ('$getNewID', 'RESUME', '$resumeExt')");
            //die(print_r($cover));
            if($cover['name'] != null && $cover != ""){
                $coverExt = (explode(".", $cover['name']))[1];
                move_uploaded_file($cover["tmp_name"], "WebApp/File_Uploads/TCover/".$getNewID.".".(explode(".", $cover['name']))[1]);
                $this->databaseInstance->execute_no_return("INSERT INTO `tdoc-table`(`job-appy-id`, `doc-cat`, `ext`) VALUES ('$getNewID', 'COVER', '$coverExt')");
            
            }
            
            //send mail
            $this->emailServices->send_mail_with_reply($email, $lastName." ".$firstName, $position." - Update on your Talent Hunt Application.", $this->emailServices->careerTalentHuntSeeker($lastName." ".$firstName, $position));

            $this->response["response"] = "success";
            $this->response["message"] = "Your talent hunt application was successful";

        }
        else{
            $this->response["response"] = "error";
            $this->response["message"] = "You have already applied with this talent hunt position.";
        }

        return json_encode($this->response, 1);

    }



    public function checkIndExist($subName){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `ind-table` WHERE `ind-name` = '$subName'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }
    public function checkOpeningExist($jobTitle, $subID, $locID){

        $found = false;
        $checkQuery = "SELECT COUNT(*) FROM `job-opening` WHERE `title` = '$jobTitle' AND `sub-id`='$subID' AND`loc-id`='$locID'";
        if($this->databaseInstance->execute_count_no_return($checkQuery) == 1){
            $found = true;
        }
        else{
            $found = false;
        }

        return $found;
    }


    public function addLocation($locationState, $locationCountry){

        if($this->checkLocationExist($locationState, $locationCountry) == true){
            $this->response["response"] = "error";
            $this->response["message"] = "Location parameters already exist.";
        }
        else{

            //add new location
            $addLocationQuery = "INSERT INTO `location-table` (`location-state`, `location-country`, `created`) VALUES ('$locationState', '$locationCountry', now())";
            $this->databaseInstance->execute_no_return($addLocationQuery);

            $this->response["response"] = "success";
            $this->response["message"] = "Location successfully added";
        }

        return json_encode($this->response, 1);
    }


    public function addSub($subName, $iconFile){

        if($this->checkSubsidiaryExist($subName) == true){
            $this->response["response"] = "error";
            $this->response["message"] = "Subsidiary parameters already exist.";
        }
        else{

            //add new location

            $iconImageExt = (explode(".", $iconFile['name']))[1];
            $addSubQuery = "INSERT INTO `sub-table` (`sub-name`, `icon`, `created`) VALUES ('$subName', '$iconImageExt', now())";
           
            $this->databaseInstance->execute_no_return($addSubQuery);

            $getID = $this->databaseInstance->execute_return("SELECT `id` FROM `sub-table` WHERE `sub-name`='$subName'")[0]['id'];
           
            move_uploaded_file($iconFile["tmp_name"], "WebApp/File_Uploads/subsidiary/".$getID.".".$iconImageExt);
            
            $this->response["response"] = "success";
            $this->response["message"] = "Subsidiary successfully added";
        }

        return json_encode($this->response, 1);
    }

    public function addRef($subName){

        if($this->checkRefExist($subName) == true){
            $this->response["response"] = "error";
            $this->response["message"] = "Ref  parameters already exist.";
        }
        else{

            //add new location
            $addRefQuery = "INSERT INTO `ref-table` (`ref-name`, `created`) VALUES ('$subName', now())";
            $this->databaseInstance->execute_no_return($addRefQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Ref successfully added";
        }

        return json_encode($this->response, 1);
    }

    public function addEdu($subName){

        if($this->checkEduExist($subName) == true){
            $this->response["response"] = "error";
            $this->response["message"] = "Educational level  parameters already exist.";
        }
        else{

            //add new location
            $addRefQuery = "INSERT INTO `edu-table` (`edu-name`, `created`) VALUES ('$subName', now())";
            $this->databaseInstance->execute_no_return($addRefQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Educational level successfully added";
        }

        return json_encode($this->response, 1);
    }

    public function addInd($subName){

        if($this->checkIndExist($subName) == true){
            $this->response["response"] = "error";
            $this->response["message"] = "Industrial category  parameters already exist.";
        }
        else{

            //add new location
            $addRefQuery = "INSERT INTO `ind-table` (`ind-name`, `created`) VALUES ('$subName', now())";
            $this->databaseInstance->execute_no_return($addRefQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Industrial category successfully added";
        }

        return json_encode($this->response, 1);
    }

    public function addJob($jobTitle, $subID, $locID, $desc, $resp, $req, $duration){

        $ndesc = $this->dataready($desc);
        $nresp = $this->dataready($resp);
        $nreq = $this->dataready($req);

        if($this->checkOpeningExist($jobTitle, $subID, $locID) == true){
            $this->response["response"] = "error";
            $this->response["message"] = "Job title already exist.";
        }
        else{

            //add new location
            $addRefQuery = "INSERT INTO `job-opening` (`title`, `sub-id`, `loc-id`, `job-desc`, `job-resp`,`job-req`, `duration`, `created`) VALUES ('$jobTitle', '$subID', '$locID', '$ndesc', '$nresp', '$nreq', '$duration', now())";
            $this->databaseInstance->execute_no_return($addRefQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Job Opening successfully added";
        }

        return json_encode($this->response, 1);
    }

    public function updateJobOpening($oID, $title, $subsidiary, $location, $jobDesc, $jobResp, $jobReq, $duration){
        
        //check that location exist
        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-opening` WHERE `id` = '$oID'") == 0){
            $this->response["response"] = "error";
            $this->response["message"] = "Job Opening ID does not exist";
        }
        else{

            $ndesc = $this->dataready($jobDesc);
            $nresp = $this->dataready($jobResp);
            $nreq = $this->dataready($jobReq);
            $updateLocationQuery = "UPDATE `job-opening` SET `title`='$title',`sub-id`='$subsidiary',`loc-id`='$location',`job-desc`='$ndesc',`job-resp`='$nresp',`job-req`='$nreq', `duration`='$duration' WHERE `id` = '$oID'";
            $this->databaseInstance->execute_no_return($updateLocationQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Job Opening updated successfully";
        }

        return json_encode($this->response, 1);
        
    }

    function dataready($data) {
        $mysqli = new mysqli("localhost","t6hwewxukvwz_new_root","Authority2018@","t6hwewxukvwz_dana-career");
        $data = $mysqli -> real_escape_string($data);
        return $data;
        }


    public function deleteLocation($llocationID){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `location-table` WHERE `id` = '$llocationID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "Location ID does not exist";
        }
        else{

            //it exist
            $this->databaseInstance->execute_no_return("DELETE FROM `location-table` WHERE `id` = '$llocationID'");
            $this->response["response"] = "success";
            $this->response["message"] = "Location successfully deleted";
        }

        return json_encode($this->response, 1);
    }

    public function deleteRef($llocationID){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `ref-table` WHERE `id` = '$llocationID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "Ref ID does not exist";
        }
        else{

            //it exist
            $this->databaseInstance->execute_no_return("DELETE FROM `ref-table` WHERE `id` = '$llocationID'");
            $this->response["response"] = "success";
            $this->response["message"] = "Ref successfully deleted";
        }

        return json_encode($this->response, 1);
    }
    
    public function deleteOpening($openingID){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-opening` WHERE `id` = '$openingID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "Opening ID does not exist";
        }
        else{
            //it exist
            $jobApplications = $this->databaseInstance->execute_return("SELECT `id` FROM `job-apply` WHERE `job-id` = '$openingID'");
            if(is_array($jobApplications) && count($jobApplications) > 0){

                foreach($jobApplications as $value){
                    $jobApplicationID = $value['id'];
                    $jobResumeExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `doc-table` WHERE `doc-cat`='RESUME' AND `job-appy-id`='$jobApplicationID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `doc-table` WHERE `job-appy-id`='$jobApplicationID' AND `doc-cat`='RESUME'")[0]["ext"] : "";
                    $jobCoverExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `doc-table` WHERE `doc-cat`='COVER' AND `job-appy-id`='$jobApplicationID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `doc-table` WHERE `job-appy-id`='$jobApplicationID' AND `doc-cat`='COVER'")[0]["ext"] : "";
               
                    $this->databaseInstance->execute_no_return("DELETE FROM `job-apply` WHERE `id` = '$jobApplicationID'");
                    $this->databaseInstance->execute_no_return("DELETE FROM `doc-table` WHERE `job-apply-id` = '$jobApplicationID'");

                    if(file_exists("WebApp/File_Uploads/Resume/".$jobApplicationID.".".$jobResumeExt)){
                        unlink("WebApp/File_Uploads/Resume/".$jobApplicationID.".".$jobResumeExt);
                    }
                    if(file_exists("WebApp/File_Uploads/Cover/".$jobApplicationID.".".$jobCoverExt)){
                        unlink("WebApp/File_Uploads/Cover/".$jobApplicationID.".".$jobCoverExt);
                    }
                }
                
            }
            $this->databaseInstance->execute_no_return("DELETE FROM `job-apply` WHERE `job-id` = '$openingID'");
            $this->databaseInstance->execute_no_return("DELETE FROM `job-opening` WHERE `id` = '$openingID'");
            $this->response["response"] = "success";
            $this->response["message"] = "Job opening successfully deleted";
        }

        return json_encode($this->response, 1);
    }

    public function deleteSub($subID, $iconExt){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `sub-table` WHERE `id` = '$subID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "Subsidiary ID does not exist";
        }
        else{

            //it exist
            $this->databaseInstance->execute_no_return("DELETE FROM `sub-table` WHERE `id` = '$subID'");
            $this->response["response"] = "success";
            $this->response["message"] = "Subsidiary successfully deleted";
            if(file_exists("WebApp/File_Uploads/subsidiary/".$subID.".".$iconExt)){
                unlink("WebApp/File_Uploads/subsidiary/".$subID.".".$iconExt);
            }
        }

        return json_encode($this->response, 1);
    }

    public function deleteEdu($subID){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `edu-table` WHERE `id` = '$subID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "Educational Level ID does not exist";
        }
        else{

            //it exist
            $this->databaseInstance->execute_no_return("DELETE FROM `edu-table` WHERE `id` = '$subID'");
            $this->response["response"] = "success";
            $this->response["message"] = "Educational Level successfully deleted";
        }

        return json_encode($this->response, 1);
    }

    public function deleteInd($subID){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `ind-table` WHERE `id` = '$subID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "In dustrial Category Level ID does not exist";
        }
        else{

            //it exist
            $this->databaseInstance->execute_no_return("DELETE FROM `ind-table` WHERE `id` = '$subID'");
            $this->response["response"] = "success";
            $this->response["message"] = "Industrial industry successfully deleted";
        }

        return json_encode($this->response, 1);
    }

    public function updateLocation($locationID, $locationState, $locationCountry){

        //check that location exist
        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `location-table` WHERE `id` = '$locationID'") == 0){
            $this->response["response"] = "error";
            $this->response["message"] = "Location ID does not exist";
        }
        else{
            $updateLocationQuery = "UPDATE `location-table` SET `location-state` = '$locationState', `location-country` = '$locationCountry' WHERE `id` = '$locationID'";
            $this->databaseInstance->execute_no_return($updateLocationQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Location updated successfully";
        }

        return json_encode($this->response, 1);
        
    }

    public function updateSub($subID, $subName, $iconFile){
        //check that location exist
        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `sub-table` WHERE `id` = '$subID'") == 0){
            $this->response["response"] = "error";
            $this->response["message"] = "Subsidiary ID does not exist";
        }
        else{

            if($iconFile == ""){
                $updateLocationQuery = "UPDATE `sub-table` SET `sub-name` = '$subName' WHERE `id` = '$subID'";
                $this->databaseInstance->execute_no_return($updateLocationQuery);
            }
            else{
                $oldIcon = $this->databaseInstance->execute_return("SELECT `icon` FROM `sub-table` WHERE `id` = '$subID'")[0]['icon'];
                $iconImageExt = (explode(".", $iconFile['name']))[1];
                $updateLocationQuery = "UPDATE `sub-table` SET `sub-name` = '$subName', `icon`='$iconImageExt' WHERE `id` = '$subID'";
                $this->databaseInstance->execute_no_return($updateLocationQuery);
                if(file_exists("WebApp/File_Uploads/subsidiary/".$subID.".".$oldIcon)){
                    unlink("WebApp/File_Uploads/subsidiary/".$subID.".".$oldIcon);
                }
                move_uploaded_file($iconFile["tmp_name"], "WebApp/File_Uploads/subsidiary/".$subID.".".$iconImageExt);
            

            }
            $this->response["response"] = "success";
            $this->response["message"] = "Subsidiary updated successfully";
        }

        return json_encode($this->response, 1);
        
    }

    public function updateRef($subID, $subName){
        //check that location exist
        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `ref-table` WHERE `id` = '$subID'") == 0){
            $this->response["response"] = "error";
            $this->response["message"] = "Ref ID does not exist";
        }
        else{

            $updateLocationQuery = "UPDATE `ref-table` SET `ref-name` = '$subName' WHERE `id` = '$subID'";
            $this->databaseInstance->execute_no_return($updateLocationQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Ref updated successfully";
        }

        return json_encode($this->response, 1);
        
    }

    public function updateEdu($subID, $subName){
        //check that location exist
        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `edu-table` WHERE `id` = '$subID'") == 0){
            $this->response["response"] = "error";
            $this->response["message"] = "Educational Level ID does not exist";
        }
        else{

            $updateLocationQuery = "UPDATE `edu-table` SET `edu-name` = '$subName' WHERE `id` = '$subID'";
            $this->databaseInstance->execute_no_return($updateLocationQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Educational Level updated successfully";
        }

        return json_encode($this->response, 1);
        
    }

    public function updateInd($subID, $subName){
        //check that location exist
        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `ind-table` WHERE `id` = '$subID'") == 0){
            $this->response["response"] = "error";
            $this->response["message"] = "Industrial category ID does not exist";
        }
        else{

            $updateLocationQuery = "UPDATE `ind-table` SET `ind-name` = '$subName' WHERE `id` = '$subID'";
            $this->databaseInstance->execute_no_return($updateLocationQuery);
            $this->response["response"] = "success";
            $this->response["message"] = "Education Levels updated successfully";
        }

        return json_encode($this->response, 1);
        
    }

    public function getLocations(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `location-table` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no location available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `location-table` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $this->response["data"][$key]["sn"] = $key + 1;
                $this->response["data"][$key]["actions"] = "<button class='btn btn-primary' onClick='editLocation(\"".$singleResponseValue['id']."\")'>edit</button>";
                unset($this->response["data"][$key]["created"]);
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["id"]."</td><td>".$singleResponseValue["location-state"]."</td><td>".$singleResponseValue["location-country"]."</td><td><button class='btn btn-primary' onClick='editLocation(\"".$singleResponseValue['id']."\", \"".$singleResponseValue["location-state"]."\", \"".$singleResponseValue["location-country"]."\")'>Edit</button>&nbsp;&nbsp;<button class='btn btn-danger' onClick='deleteLocation(\"".$singleResponseValue['id']."\")'>Del</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "Locations loaded successfully";

        }

        return json_encode($this->response, 1);
    }

    public function getSubs(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `sub-table` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no subsidiary available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `sub-table` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $this->response["data"][$key]["sn"] = $key + 1;
                $this->response["data"][$key]["actions"] = "<button class='btn btn-primary' onClick='editSub(\"".$singleResponseValue['id']."\")'>edit</button>";
                unset($this->response["data"][$key]["created"]);
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["id"]."</td><td>".$singleResponseValue["sub-name"]."</td><td><button class='btn btn-primary' onClick='editSub(\"".$singleResponseValue['id']."\", \"".$singleResponseValue["sub-name"]."\", \"".$singleResponseValue["icon"]."\")'>Edit</button>&nbsp;&nbsp;<button class='btn btn-danger' onClick='deleteSub(\"".$singleResponseValue['id']."\", \"".$singleResponseValue['icon']."\")'>Del</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "Subsidiaries loaded successfully";

        }

        return json_encode($this->response, 1);
    }

    public function getRefs(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `ref-table` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no ref available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `ref-table` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $this->response["data"][$key]["sn"] = $key + 1;
                $this->response["data"][$key]["actions"] = "<button class='btn btn-primary' onClick='editSub(\"".$singleResponseValue['id']."\")'>edit</button>";
                unset($this->response["data"][$key]["created"]);
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["id"]."</td><td>".$singleResponseValue["ref-name"]."</td><td><button class='btn btn-primary' onClick='editRef(\"".$singleResponseValue['id']."\", \"".$singleResponseValue["ref-name"]."\")'>Edit</button>&nbsp;&nbsp;<button class='btn btn-danger' onClick='deleteRef(\"".$singleResponseValue['id']."\")'>Del</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "References loaded successfully";

        }

        return json_encode($this->response, 1);
    }


    public function getOpenings(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `job-opening` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no opening available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `job-opening` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $this->response["data"][$key]["sn"] = $key + 1;
                $this->response["data"][$key]["actions"] = "<button class='btn btn-primary' onClick='editSub(\"".$singleResponseValue['id']."\")'>edit</button>";
                unset($this->response["data"][$key]["created"]);
                $subID = $singleResponseValue['sub-id'];
                $locID = $singleResponseValue['loc-id'];
                $subSTL = "";
                $subList = $this->databaseInstance->execute_return("SELECT * FROM `sub-table` WHERE 1 ORDER BY id DESC");
                if(isset($subList) && is_array($subList))
                {
                    foreach($subList as $subCont)
                    {
                        if($subCont['id'] == $subID){
                            $subSTL .= '<option value=\"'.$subID.'\" selected>'.$subCont['sub-name'].'</option>';
                        }
                        else{
                            $subSTL .= '<option value=\"'.$subID.'\">'.$subCont['sub-name'].'</option>';
                        }
                    }
                }
                else{
                    $subSTL .=  '<option value=\"\" selected>No Subsidiaries Added</option>';
                }

                $locSTL = "";
                $locList = $this->databaseInstance->execute_return("SELECT * FROM `location-table` WHERE 1 ORDER BY id DESC");
                if(isset($locList) && is_array($locList))
                {
                    foreach($locList as $locCont)
                    {
                        if($locCont['id'] == $locID){
                            $locSTL .= '<option value=\"'.$locID.'\" selected>'.$locCont['location-state'].', '.$locCont['location-country'].'</option>';
                        }
                        else{
                            $locSTL .= '<option value=\"'.$locID.'\">'.$locCont['location-state'].', '.$locCont['location-country'].'</option>';
                        }
                    }
                }
                else{
                    $locSTL .=  '<option value=\"\" selected>No Locations Added</option>';
                }

                //get duration in days
                // Creates DateTime objects 
                $datetime1 = date_create(date('Y-m-d')); 
                $datetime2 = date_create($singleResponseValue['duration']); 
                
                // Calculates the difference between DateTime objects 
                $interval = date_diff($datetime1, $datetime2); 
                
                $durationDay = $singleResponseValue['duration'] == null || $singleResponseValue['duration'] == "" ? "NONE" : $interval->format('%a days left');
                //get Sub name
                $subNAme =  $this->databaseInstance->execute_return("SELECT `sub-name` FROM `sub-table` WHERE id='$subID'")[0]["sub-name"];
                $locName =  $this->databaseInstance->execute_return("SELECT `location-state` FROM `location-table` WHERE id='$locID'")[0]["location-state"].", ".$this->databaseInstance->execute_return("SELECT `location-country` FROM `location-table` WHERE id='$locID'")[0]["location-country"];
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["id"]."</td><td>".$singleResponseValue["title"]."</td><td>".$subNAme."</td><td>".$locName."</td><td>".$durationDay."</td><td><button class='btn btn-primary' onClick='editOpening(\"".$singleResponseValue['id']."\", \"".$singleResponseValue["title"]."\", \"".$subSTL."\", \"".$locSTL."\", \"".base64_encode($singleResponseValue['job-desc'])."\", \"".base64_encode($singleResponseValue['job-resp'])."\", \"".base64_encode($singleResponseValue['job-req'])."\", \"".$singleResponseValue['duration']."\")'>Edit</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "Job openings loaded successfully";

        }

        return json_encode($this->response, 1);
    }



    public function getApplications(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no Applications available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `job-apply` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $indID = $singleResponseValue["ind-id"];
                $refID = $singleResponseValue["ref-id"];
                $eduID = $singleResponseValue["edu-id"];
                $jobID = $singleResponseValue["job-id"];
                $jApplyID = $singleResponseValue["id"];
                $indList = explode(",", $singleResponseValue["ind-id"]);

                foreach($indList as $keyIndList=>$indIDList){
                    $indList[$keyIndList] = $this->databaseInstance->execute_return("SELECT `ind-name` FROM `ind-table` WHERE id='$indIDList'")[0]["ind-name"];
                }
                $newIndustry = implode(',', $indList);
                $industry = $this->databaseInstance->execute_return("SELECT `ind-name` FROM `ind-table` WHERE id='$indID'")[0]["ind-name"];
                $education = $this->databaseInstance->execute_return("SELECT `edu-name` FROM `edu-table` WHERE id='$eduID'")[0]["edu-name"];
                $reference = $this->databaseInstance->execute_return("SELECT `ref-name` FROM `ref-table` WHERE id='$refID'")[0]["ref-name"];
                $jobTitle = $this->databaseInstance->execute_return("SELECT `title` FROM `job-opening` WHERE id='$jobID'")[0]["title"];
                $jobResumeExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `doc-table` WHERE `doc-cat`='RESUME' AND `job-appy-id`='$jApplyID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `doc-table` WHERE `job-appy-id`='$jApplyID' AND `doc-cat`='RESUME'")[0]["ext"] : "";
                $jobCoverExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `doc-table` WHERE `doc-cat`='COVER' AND `job-appy-id`='$jApplyID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `doc-table` WHERE `job-appy-id`='$jApplyID' AND `doc-cat`='COVER'")[0]["ext"] : "";
               $stL = "";
                foreach($this->defaults->getAppStatus() as $appStayus){

                    if($singleResponseValue['status'] == $appStayus){
                        $stL .= '<option value=\"'.$appStayus.'\" selected>'.$appStayus.'</option>';
                    }
                    else
                    {
                        $stL .= '<option value=\"'.$appStayus.'\">'.$appStayus.'</option>';
                    }
                }


                $statesList = array(
                    'FC' => 'Abuja',
                    'AB' => 'Abia',
                    'AD' => 'Adamawa',
                    'AK' => 'Akwa Ibom',
                    'AN' => 'Anambra',
                    'BA' => 'Bauchi',
                    'BY' => 'Bayelsa',
                    'BE' => 'Benue',
                    'BO' => 'Borno',
                    'CR' => 'Cross River',
                    'DE' => 'Delta',
                    'EB' => 'Ebonyi',
                    'ED' => 'Edo',
                    'EK' => 'Ekiti',
                    'EN' => 'Enugu',
                    'GO' => 'Gombe',
                    'IM' => 'Imo',
                    'JI' => 'Jigawa',
                    'KD' => 'Kaduna',
                    'KN' => 'Kano',
                    'KT' => 'Katsina',
                    'KE' => 'Kebbi',
                    'KO' => 'Kogi',
                    'KW' => 'Kwara',
                    'LA' => 'Lagos',
                    'NA' => 'Nassarawa',
                    'NI' => 'Niger',
                    'OG' => 'Ogun',
                    'ON' => 'Ondo',
                    'OS' => 'Osun',
                    'OY' => 'Oyo',
                    'PL' => 'Plateau',
                    'RI' => 'Rivers',
                    'SO' => 'Sokoto',
                    'TA' => 'Taraba',
                    'YO' => 'Yobe',
                    'ZA' => 'Zamfara'
                );
                
                $opTL = "";
                $opTLVal = "";
                if($singleResponseValue['jlocation'] == "" || $singleResponseValue['jlocation'] == null){
                    $opTLVal = "";
                    $opTL .= '<option value=\"\" selected>Select Preferred Location</option>';
                }
                foreach($statesList as $ii => $iival){

                    
                    if($singleResponseValue['jlocation'] == $ii){
                        $opTLVal = $iival;
                        $opTL .= '<option value=\"'.$ii.'\" selected>'.$iival.'</option>';
                    }
                    else
                    {
                        $opTL .= '<option value=\"'.$ii.'\">'.$iival.'</option>';
                    }
                }

                unset($this->response["data"][$key]["created"]);
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["first-name"]."</td><td>".$singleResponseValue["last-name"]."</td><td>".$jobTitle."</td><td>".$singleResponseValue['email']."</td><td>".$singleResponseValue['phone-number']."</td><td>".$newIndustry."</td><td>".$education."</td><td>".$singleResponseValue["experience"]."</td><td>".$opTLVal."</td><td>".$reference."</td><td>".$singleResponseValue['status']."</td><td><button class='btn btn-primary btn-sm' onClick='manageApp(\"".$singleResponseValue['id']."\", \"".$singleResponseValue['job-id']."\", \"".$singleResponseValue['first-name']."\", \"".$singleResponseValue['last-name']."\", \"".$jobTitle."\", \"".$singleResponseValue['email']."\", \"".$singleResponseValue['phone-number']."\", \"".$newIndustry."\", \"".$education."\", \"".$reference."\", \"".$stL."\", \"".$singleResponseValue['address']."\", \"".$singleResponseValue['notice']."\", \"".$singleResponseValue['salary']."\", \"".$singleResponseValue['address']."\", \"".$indID."\", \"".$eduID."\", \"".$refID."\", \"".$singleResponseValue['experience']."\", \"".$opTL."\")'>Manage</button><button class='btn btn-danger btn-sm' onClick='Documents(\"".$singleResponseValue['id']."\", \"".$jobResumeExt."\", \"".$jobCoverExt."\")'>Docs</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "Applications loaded successfully";

        }

        return json_encode($this->response, 1);
    }



    public function getTalentHUntApplications(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `talent-hunt-apply` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no Talent Hunt Application available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `talent-hunt-apply` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $eduID = $singleResponseValue["edu-id"];
                $tHuntID = $singleResponseValue["id"];
                
                $education = $this->databaseInstance->execute_return("SELECT `edu-name` FROM `edu-table` WHERE id='$eduID'")[0]["edu-name"];
                $tHuntjobResumeExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `tdoc-table` WHERE `doc-cat`='RESUME' AND `job-appy-id`='$tHuntID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `tdoc-table` WHERE `job-appy-id`='$tHuntID' AND `doc-cat`='RESUME'")[0]["ext"] : "";
                $jtHuntobCoverExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `tdoc-table` WHERE `doc-cat`='COVER' AND `job-appy-id`='$tHuntID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `tdoc-table` WHERE `job-appy-id`='$tHuntID' AND `doc-cat`='COVER'")[0]["ext"] : "";
               
                $stL = "";
                foreach($this->defaults->getTHuntStatus() as $appStayus){

                    if($singleResponseValue['status'] == $appStayus){
                        $stL .= '<option value=\"'.$appStayus.'\" selected>'.$appStayus.'</option>';
                    }
                    else
                    {
                        $stL .= '<option value=\"'.$appStayus.'\">'.$appStayus.'</option>';
                    }
                }

               
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["first-name"]."</td><td>".$singleResponseValue["last-name"]."</td><td>".$singleResponseValue["position"]."</td><td>".$education."</td><td>".$singleResponseValue["experience"]."</td><td>".$singleResponseValue['email']."</td><td>".$singleResponseValue['phone-number']."</td><td>".$singleResponseValue["status"]."</td><td><button class='btn btn-primary btn-sm' onClick='manageApp(\"".$singleResponseValue['id']."\", \"".$singleResponseValue['first-name']."\", \"".$singleResponseValue['last-name']."\", \"".$singleResponseValue['position']."\", \"".$singleResponseValue['email']."\", \"".$singleResponseValue['phone-number']."\", \"".$singleResponseValue['skills']."\", \"".$education."\", \"".$singleResponseValue['notice']."\", \"".$stL."\", \"".$singleResponseValue['address']."\", \"".$singleResponseValue['salary']."\", \"".$eduID."\", \"".$singleResponseValue['experience']."\")'>Manage</button><button class='btn btn-danger btn-sm' onClick='Documents(\"".$singleResponseValue['id']."\", \"".$tHuntjobResumeExt."\", \"".$jtHuntobCoverExt."\")'>Docs</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "Talent Hunt Applications loaded successfully";

        }

        return json_encode($this->response, 1);
    }


    public function deleteApplication($jobID){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-apply` WHERE `id` = '$jobID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "Job Application ID does not exist";
        }
        else{
            //die("hello Motors");

            $jobResumeExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `doc-table` WHERE `doc-cat`='RESUME' AND `job-appy-id`='$jobID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `doc-table` WHERE `job-appy-id`='$jobID' AND `doc-cat`='RESUME'")[0]["ext"] : "";
            $jobCoverExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `doc-table` WHERE `doc-cat`='COVER' AND `job-appy-id`='$jobID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `doc-table` WHERE `job-appy-id`='$jobID' AND `doc-cat`='COVER'")[0]["ext"] : "";
               
            //it exist
            $this->databaseInstance->execute_no_return("DELETE FROM `job-apply` WHERE `id` = '$jobID'");
            $this->databaseInstance->execute_no_return("DELETE FROM `doc-table` WHERE `job-apply-id` = '$jobID'");
            if(file_exists("WebApp/File_Uploads/Resume/".$jobID.".".$jobResumeExt)){
                unlink("WebApp/File_Uploads/Resume/".$jobID.".".$jobResumeExt);
            }
            if(file_exists("WebApp/File_Uploads/Cover/".$jobID.".".$jobCoverExt)){
                unlink("WebApp/File_Uploads/Cover/".$jobID.".".$jobCoverExt);
            }
            $this->response["response"] = "success";
            $this->response["message"] = "Application successfully deleted";
        }

        return json_encode($this->response, 1);
    }

    public function deleteTHuntApplication($tHuntID){

        if($this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `talent-hunt-apply` WHERE `id` = '$tHuntID'") == 0){

            //does not exist
            $this->response["response"] = "error";
            $this->response["message"] = "Talent Hunt Application ID does not exist";
        }
        else{

            $jobResumeExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `tdoc-table` WHERE `doc-cat`='RESUME' AND `job-appy-id`='$tHuntID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `tdoc-table` WHERE `job-appy-id`='$tHuntID' AND `doc-cat`='RESUME'")[0]["ext"] : "";
            $jobCoverExt = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `tdoc-table` WHERE `doc-cat`='COVER' AND `job-appy-id`='$tHuntID'") == 1 ? $this->databaseInstance->execute_return("SELECT `ext` FROM `tdoc-table` WHERE `job-appy-id`='$tHuntID' AND `doc-cat`='COVER'")[0]["ext"] : "";
               
            //it exist
            $this->databaseInstance->execute_no_return("DELETE FROM `talent-hunt-apply` WHERE `id` = '$tHuntID'");
            $this->databaseInstance->execute_no_return("DELETE FROM `tdoc-table` WHERE `job-apply-id` = '$tHuntID'");
            if(file_exists("WebApp/File_Uploads/TResume/".$tHuntID.".".$jobResumeExt)){
                unlink("WebApp/File_Uploads/TResume/".$tHuntID.".".$jobResumeExt);
            }
            if(file_exists("WebApp/File_Uploads/TCover/".$tHuntID.".".$jobCoverExt)){
                unlink("WebApp/File_Uploads/TCover/".$tHuntID.".".$jobCoverExt);
            }
            $this->response["response"] = "success";
            $this->response["message"] = "Talent Hunt Application successfully deleted";
        }

        return json_encode($this->response, 1);
    }


    public function getEdus(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `edu-table` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no Educational level available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `edu-table` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $this->response["data"][$key]["sn"] = $key + 1;
                $this->response["data"][$key]["actions"] = "<button class='btn btn-primary' onClick='editSub(\"".$singleResponseValue['id']."\")'>edit</button>";
                unset($this->response["data"][$key]["created"]);
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["id"]."</td><td>".$singleResponseValue["edu-name"]."</td><td><button class='btn btn-primary' onClick='editEdu(\"".$singleResponseValue['id']."\", \"".$singleResponseValue["edu-name"]."\")'>Edit</button>&nbsp;&nbsp;<button class='btn btn-danger' onClick='deleteEdu(\"".$singleResponseValue['id']."\")'>Del</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "Education level loaded successfully";

        }

        return json_encode($this->response, 1);
    }

    public function getInds(){

        $recordsTotal = $this->databaseInstance->execute_count_return("SELECT COUNT(*) FROM `ind-table` WHERE 1");
        if($recordsTotal < 1){

            $this->response["response"] = "error";
            $this->response["message"] = "There is no Industrial catgory available";

        }
        else{
            $this->response["tabler"] = "";
            $this->response["data"] = $this->databaseInstance->execute_return("SELECT * FROM `ind-table` WHERE 1 ORDER BY id DESC");
            foreach($this->response["data"] as $key => $singleResponseValue){
                $this->response["data"][$key]["sn"] = $key + 1;
                $this->response["data"][$key]["actions"] = "<button class='btn btn-primary' onClick='editSub(\"".$singleResponseValue['id']."\")'>edit</button>";
                unset($this->response["data"][$key]["created"]);
                $this->response["tabler"] .= "<tr><td>".($key + 1)."</td><td>".$singleResponseValue["id"]."</td><td>".$singleResponseValue["ind-name"]."</td><td><button class='btn btn-primary' onClick='editInd(\"".$singleResponseValue['id']."\", \"".$singleResponseValue["ind-name"]."\")'>Edit</button>&nbsp;&nbsp;<button class='btn btn-danger' onClick='deleteInd(\"".$singleResponseValue['id']."\")'>Del</button></td></tr>";
            }
            $this->response["response"] = "success";
            $this->response["recordsTotal"] = $recordsTotal;
            $this->response["recordsFiltered"] = $recordsTotal;
            $this->response["message"] = "Industray category loaded successfully";

        }

        return json_encode($this->response, 1);
    }


    public function updateQApplication($subID, $firstName, $lastName, $emailAddress, $phoneNumber, $education, $industry, $reference, $notice, $salary, $status, $jobID, $address, $experience, $jLocation){

        $checkIFApplicationExist = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-apply` WHERE id = '$subID'");
       if($checkIFApplicationExist != true){
        $this->response["response"] = "error";
        $this->response["message"] = "Application does not exist";
       }
       else{

        $updateApp = "UPDATE `job-apply` SET `job-id`='$jobID',`email`='$emailAddress',`first-name`='$firstName',`last-name`='$lastName',`phone-number`='$phoneNumber',`address`='$address',`ind-id`='$industry',`ref-id`='$reference',`edu-id`='$education',`notice`='$notice',`salary`='$salary',`status`='$status', `experience`='$experience', `jlocation`='$jLocation' WHERE id='$subID'";
        $this->databaseInstance->execute_no_return($updateApp);
        //die($this->defaults->getAppStatus()[4]);
        if($status == $this->defaults->getAppStatus()[4])
        {
            $jobData = $this->databaseInstance->execute_return("SELECT `title`, `sub-id` FROM `job-opening` WHERE `id` = '$jobID'")[0];
            $jobTitle = $jobData['title'];
            $jSubID = $jobData['sub-id'];
            $subTitle = $this->databaseInstance->execute_return("SELECT `sub-name` FROM `sub-table` WHERE `id` = '$jSubID'")[0]['sub-name'];
            $this->emailServices->send_mail_with_reply($emailAddress, $lastName." ".$firstName, $jobTitle." - Update on your Application.", $this->emailServices->careerJobRejected($lastName." ".$firstName, $jobTitle, $subTitle));
        }
        else if($status == $this->defaults->getAppStatus()[1]){
            
                $jobData = $this->databaseInstance->execute_return("SELECT `title`, `sub-id` FROM `job-opening` WHERE `id` = '$jobID'")[0];
            $jobTitle = $jobData['title'];
            $jSubID = $jobData['sub-id'];
            $subTitle = $this->databaseInstance->execute_return("SELECT `sub-name` FROM `sub-table` WHERE `id` = '$jSubID'")[0]['sub-name'];
            $this->emailServices->send_mail_with_reply($emailAddress, $lastName." ".$firstName, $jobTitle." - Update on your Application.", $this->emailServices->careerJobShortlisted($lastName." ".$firstName, $jobTitle, $subTitle));
        
            
        }
        
        
        
        $this->response["response"] = "success";
        $this->response["message"] = "Application successfully updated";
       }


        return json_encode($this->response, 1);
    }

    public function updateTalentHuntQApplication($tHuntID, $status){

        $checkIFApplicationExist = $this->databaseInstance->execute_count_no_return("SELECT COUNT(*) FROM `talent-hunt-apply` WHERE id = '$tHuntID'");
       if($checkIFApplicationExist != true){
        $this->response["response"] = "error";
        $this->response["message"] = "Talent Hunt Application does not exist";
       }
       else{

        $updateApp = "UPDATE `talent-hunt-apply` SET `status`='$status' WHERE id='$tHuntID'";
        $this->databaseInstance->execute_no_return($updateApp);
        //die($this->defaults->getAppStatus()[4]);
        if($status == $this->defaults->getTHuntStatus()[2])
        {
            $tHuntData = $this->databaseInstance->execute_return("SELECT * FROM `talent-hunt-apply` WHERE `id` = '$tHuntID'")[0];
            $this->emailServices->send_mail_with_reply($tHuntData['email'], $tHuntData['last-name']." ".$tHuntData['first-name'], $tHuntData['position']." - Update on your Talent Hunt Application.", $this->emailServices->careerTalentHuntOpened($tHuntData['last-name']." ".$tHuntData['first-name'], $tHuntData['position']));
        }
        
        
        
        $this->response["response"] = "success";
        $this->response["message"] = "Talent Hunt Application successfully updated";
       }


        return json_encode($this->response, 1);
    }
    
    
}