<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action'])){

        $defaultInstance = new defaults();
        $careerManageInstance = new CareerManager();

        if((int)($_POST["action"]) == $defaultInstance->getActions()["AddOpening"]){

           
            
            if(isset($_POST["jobTitle"]) && isset($_POST["jobSubID"]) && isset($_POST["jobLocID"]) && isset($_POST["jobDesc"]) && isset($_POST["jobResp"]) && isset($_POST["jobReq"])){

                
                $jobTitle = trim($_POST["jobTitle"]);
                $jobSubID = $_POST["jobSubID"];
                $jobLocID = $_POST["jobLocID"];
                $jobDesc = $_POST["jobDesc"];
                $jobResp = $_POST["jobResp"];
                $jobReq = $_POST["jobReq"];
                $duration = $_POST["duration"];

                die($careerManageInstance->addJob($jobTitle, $jobSubID, $jobLocID, $jobDesc, $jobResp, $jobReq, $duration));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
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
            "message" => "Invalid reuest attempt"
        );
        die(json_encode($response, 1));
    }
}


$jobOpeningsIsActive = "mm-active";
$addopeningIsActive = "active";
$dbInst = new database("dana-career");

require "WebApp/HR/header.php"; ?>

<style>

    .loaderCont, .loaderContUpdate{
        display: none;
    }
</style>





<div class="container-fluid" style="margin-bottom: 40px; padding: 20px;">
    <div class="row">

        <div class="col-sm-12" style="margin-top: 20px; margin-bottom: 20px;">
        
            <form id="aOpeningAdder">
                <div class="mb-3">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input required type="text" class="form-control" id="jobTitle">
                </div>
                <div class="mb-3">
                    <label for="subsidiary" class="form-label">Company Subsidiary</label>
                    <select required class="form-control" id="subsidiary">
                        <?php 
                        
                        $subList = $dbInst->execute_return("SELECT * FROM `sub-table` WHERE 1 ORDER BY id DESC");
                        if(isset($subList) && is_array($subList))
                        {
                            foreach($subList as $key=>$value)
                            {
                                if($key == 0){
                                    echo "<option value='".$value["id"]."' selected>".$value["sub-name"]."</option>";
                                }
                                else{
                                    echo "<option value='".$value["id"]."'>".$value["sub-name"]."</option>";
                                }
                            }
                        }
                        else{
                            echo "<option value='' selected>No company subsidiary available</option>";
                        }
                        ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Company location</label>
                    <select required class="form-control" id="location">
                        <?php 
                        
                        $subList = $dbInst->execute_return("SELECT * FROM `location-table` WHERE 1 ORDER BY id DESC");
                        if(isset($subList) && is_array($subList))
                        {
                            foreach($subList as $key=>$value)
                            {
                                if($key == 0){
                                    echo "<option value='".$value["id"]."' selected>".$value["location-state"].", ".$value["location-country"]."</option>";
                                }
                                else{
                                    echo "<option value='".$value["id"]."'>".$value["location-state"].", ".$value["location-country"]."</option>";
                                }
                            }
                        }
                        else{
                            echo "<option value='' selected>No company subsidiary available</option>";
                        }
                        ?>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="date" class="form-control" id="duration">
                </div>
                <div class="mb-3">
                    <label for="jobDesc" class="form-label">Job Summary</label>
                    <textarea required type="text" class="form-control" id="jobDesct"></textarea>
                    
                </div>
                <div class="mb-3">
                    <label for="jobResp" class="form-label">Job Responsibilities</label>
                    <textarea required type="text" class="form-control" id="jobRespt"></textarea>
                </div>

                <div class="mb-3">
                    <label for="jobReq" class="form-label">Job Requirement / Experience</label>
                    <textarea required type="text" class="form-control" id="jobReqt"></textarea>
                </div>
                <button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="addText">Add</span><span class="loaderCont"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>
            </form>
        </div>
    
    </div>
</div>

<?php require "WebApp/HR/footer.php"; ?>