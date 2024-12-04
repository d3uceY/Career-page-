<?php

/*
 @ugoabuchi - @my github repo github.com/ugoabuchi
 */

class defaults
{
    private $accountTypes = null;
    private $accountStatuses = null;
    private $companyCategories = null;
    private $actions = null;
    private $expiryTimes = null;
    private $imageKB = null;
    private $imageTypes = null;
    private $uploadSubURI = null;
    private $gender = null;
    private $appStatus = null;
    private $jhuntStatus = null;
    
    //lets add regex defaults
     function __construct()
    {
         $this->accountTypes = array("Admin", "HR");
         $this->accountStatuses = array("Active", "In-Active");
         $this->companyCategories = array("Dana Group", "Dana Air", "Dana Pharmaceuticals", "Dana Plast", "Dana Motors");
         $this->gender = array("Male", "Female", "Others");
         $this->appStatus = array("NEW", "SHORTLISTED", "PENDING", "ACCEPTED", "REJECTED");
         $this->jhuntStatus = array("NEW", "PENDING", "OPENED");
         $this->expiryTimes = array(
             "verification" =>300, 
             "session" => 43200
             );
         $this->imageKB = 2000000; //in Bytes
         $this->imageTypes = array(".pdf", ".doc", ".docx", ".rtf");
         $this->uploadSubURI = "WebApp/"; //Attach link to uploads locals
         
         $this->actions = array(
           "login" => 0, //0 - Sign in user
           "register" => 1, //1 - sign up user
           "AddCompanyDep" => 2, //Add company Department
           "UpdateCompanyDep" => 3, //Update company Department
           "DeleteCompanyDep" => 4, //Delete company Department
           "AddJobOpeningRef" => 5, //Add company Department
           "UpdateJobOpeningRef" => 6, //Update company Department
           "DeleteJobOpeningRef" => 7, //Delete company Department
           "AddCoompanyLoc" => 8, //Add company location
           "UpdateCompanyLoc" => 9, //Update company location
           "DeleteCompanyLoc" => 10, //Delete company location
           "AddJobOpening" => 11, //Add job opening
           "UpdateJobOpening" => 12, //Update job opening
           "DeleteJobOpening" => 13, //Delete job opening
           "AddLocation" => 14, //Add location session
           "UpdateLocation" => 15, //Update Location
           "DeleteLocation" => 16, //Delete location session
           "GetLocations" => 17, //Get Locations
           "UpdateSession" => 18, //Update session, this attribute should only be used in the middleware classes
           "GetSubs" => 19, //Get Subsidiaries
           "GetRef" => 20, //Get Ref
           "GetEdu" => 21, //Get Edu
           "AddEdu" => 22, //Add Edu
           "UpdateEdu" => 23, //Updte Edu
           "DeleteEdu" => 24, //Delete Edu
           "GetInd" => 25, //Get Edu
           "AddInd" => 26, //Add Edu
           "UpdateInd" => 27, //Updte Edu
           "DeleteInd" => 28, //Delete Edu
           "AddOpening"=>29,
           "addapply"=>30,
           "getapply"=>31,
           "updateApplication"=>32,
           "getOpenings"=>33,
           "updateopening"=>34,
           "addTelentHunt"=>35,
           "getTalentHunt"=>36,
           "deleteTalentHunt"=>37,
           "updateTalentHunt"=>38,
           "deleteApplication"=>39
         );
    }
    public function getActions(){
        return $this->actions;
    }
    
    public function getAccountStatuses(){
        return $this->accountStatuses;
    }

    public function getCompanyCategories(){
        return $this->companyCategories;
    }
    public function getGenders(){
        return $this->gender;
    }
    public function getAccountTypes(){
        return $this->accountTypes;
    }
    
    public function getAppStatus(){
        return $this->appStatus;
    }

    public function getTHuntStatus(){
        return $this->jhuntStatus;
    }

    public function getVerificationExpTime(){
        return $this->expiryTimes["verification"];
    }
    
    public function getSessionExpTime(){
        return $this->expiryTimes["session"];
    }
    public function getImageUploadSize(){
        return $this->imageKB;
    }
    public function getImageTypes(){
        return $this->imageTypes;
    }
    public function getUploadSubURL(){
        return $this->uploadSubURI;
    }
    
    
    public function verifyAccountType($accountType)
    {
        $found = false;
        
        if($accountType != "" && $accountType != null)
        {
            if(in_array($accountType, $this->accountTypes, true))
            {
                $found = true;
            }
            else
            {
                $found = false;
            }
        }
        
        return $found;
    }

    public function verifyCompanyCategory($companyCategory)
    {
        $found = false;
        
        if($companyCategory != "" && $companyCategory != null)
        {
            if(in_array($companyCategory, $this->companyCategories, true))
            {
                $found = true;
            }
            else
            {
                $found = false;
            }
        }
        
        return $found;
    }

    public function verifyAccountStatus($accountStatus)
    {
        $found = false;
        
        if($accountStatus != "" && $accountStatus != null)
        {
            if(in_array($accountStatus, $this->accountStatuses, true))
            {
                $found = true;
            }
            else
            {
                $found = false;
            }
        }
        
        return $found;
    }
    
    
}

