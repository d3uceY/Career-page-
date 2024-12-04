<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action'])){

        $defaultInstance = new defaults();
        $careerManageInstance = new CareerManager();

     if((int)($_POST["action"]) == $defaultInstance->getActions()["updateopening"]){
        
            
            if(isset($_POST["oID"]) && isset($_POST["title"]) && isset($_POST["subsidiary"]) && isset($_POST["location"]) && isset($_POST["jobDesc"]) && isset($_POST["jobResp"]) && isset($_POST["jobReq"])){

                $oID = $_POST['oID'];
                $title = $_POST['title'];
                $subsidiary = $_POST['subsidiary']."";
                $location = $_POST['location']."";
                $jobDesc = $_POST["jobDesc"];
                $jobResp = $_POST["jobResp"];
                $jobReq = $_POST["jobReq"];
                $duration = $_POST["duration"];
                die($careerManageInstance->updateJobOpening($oID, $title, $subsidiary, $location, $jobDesc, $jobResp, $jobReq, $duration));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["DeleteJobOpening"]){

         
            
            if(isset($_POST["openingID"])){

                
                $openingID = trim($_POST["openingID"]);
                die($careerManageInstance->deleteOpening($openingID));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["getOpenings"]){

            die($careerManageInstance->getOpenings());

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
$queryopeningIsActive = "active";

require "WebApp/HR/header.php"; ?>

<style>

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}

    .loaderCont, .loaderContUpdate{
        display: none;
    }
</style>

<div class="container-fluid" style="margin-bottom: 40px; padding: 20px;">
    <div class="row">
        
        <div class="col-sm-12" style="background-color: #FFFFFF !important; margin-top: 20px; margin-bottom: 20px;">
        <table id="opeingList" class="table table-sm" cellspacing="0">
        <thead>
            <tr>
                <th>S/N</th>
                <th>ID</th>
                <th>Title</th>
                <th>Subsidiary</th>
                <th>Location</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="openingTBody">
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>

    function editOpening(openingID, title, subList, locList, jobDesc, jobResp, jobReq, duration){
        $.sweetModal({
        title: 'Job Opening - '+openingID,
        content: '<form onsubmit="updateOpeningFunc();return false;">'+
                '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="firstName">Title&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="title" id="title" value="'+title+'" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="duration">Duration&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
                        '<input type="date" name="duration" id="duration" value="'+duration+'" style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="subsidiary">Company Subsidiary&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<select name="subsidiary" id="subsidiary" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+subList+'</select>'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="location">Company Location&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<select name="location" id="location" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+locList+'</select>'+
						'<br><br>'+
						'<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="jobDescUpdt">Job Summary&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<textarea name="jobDescUpdt"  id="jobDescUpdt" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+decodeURIComponent(atob(jobDesc))+'</textarea>'+
						'<br><br>'+
						'<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="jobRespcUpdt">Job Responsibilites&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<textarea name="jobRespcUpdt"  id="jobRespcUpdt" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+decodeURIComponent(atob(jobResp))+'</textarea>'+
						'<br><br>'+
						'<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="jobReqUpdt">Job Requirement&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<textarea name="jobReqUpdt"  id="jobReqUpdt" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+decodeURIComponent(atob(jobReq))+'</textarea>'+
						'<br><br>'+
						
                        
				        '<input required type="hidden" id="openingID" value="'+openingID+'">'+
                '<button type="submit" class="btn" style="background-color: #2F3390 !important; color: #FFFFFF !important;"><span class="updateText">Update</span><span class="loaderContUpdate"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>&nbsp;&nbsp;<button type="button" class="btn" onclick="deleteOpening('+openingID+')" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span>Delete</span></button>'+
            '</form>'
        });


        CKEDITOR.replace( 'jobDescUpdt' );
        CKEDITOR.replace( 'jobRespcUpdt' );
        CKEDITOR.replace( 'jobReqUpdt' );
    }

    function deleteOpening(openingID){
        $.sweetModal.confirm('Confirm Action', 'All application associated to this opening will also be deleted, \nDo you wish to proceed?', ()=>{
                
            var locationPostData = "openingID="+openingID+"&action=13";
                    $.ajax({ 
                    type:"POST",
                    url:"Query-Openings",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestOpening();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Opening successfully deleted."
                            });
                            $(".sweet-modal-close-link").click();
                            
                        }
                        else
                        {
                            BootstrapAlert.alert({
                            title:"Error",
                            message:serverResponse.message
                            });
                            $(".sweet-modal-close-link").click();
                        }
                        

                    }.bind(this),
                    error: function(xhr, status, err) {
                        BootstrapAlert.alert({
                        title:"Error",
                        message:"Something happened while processing your Log In\nPlease try again later."
                        });
                        $(".sweet-modal-close-link").click();
                    }.bind(this)
                });  

            }, 
            ()=>{
                BootstrapAlert.alert({
                    title:"Error",
                    message:"Operation Canceled"
                    });
                $(".sweet-modal-close-link").click();
            }
            );
    }

            function updateOpeningFunc(){
            
                $(".updateText").css("display", "none");
                $(".loaderContUpdate").css("display", "inline");
                var oID = $("#openingID").val();
                var title = $("#title").val();
                var duration = $('#duration').val();
                var subsidiary = $("#subsidiary").val();
                var location = $("#location").val();
                var jobDescU =  encodeURIComponent(CKEDITOR.instances['jobDescUpdt'].getSnapshot());
                var jobRespU =  encodeURIComponent(CKEDITOR.instances['jobRespcUpdt'].getSnapshot());
                var jobReqU =  encodeURIComponent(CKEDITOR.instances['jobReqUpdt'].getSnapshot());
                
                if(title == "" || subsidiary == "" || location == "" || jobDescU == "" || jobRespU == "" || jobReqU == ""){
                    BootstrapAlert.alert({
                    title:"Error",
                    message: "All Fields are compulsory"
                    });
                }
                else{
                    
                    var locationPostData = "oID="+oID+"&title="+title+"&subsidiary="+subsidiary+"&location="+location+"&jobDesc="+jobDescU+"&jobResp="+jobRespU+"&jobReq="+jobReqU+"&duration="+duration+"&action=34";
                    $.ajax({ 
                    type:"POST",
                    url:"Query-Openings",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestOpening();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Job Opening successfully updated."
                            });
                            $(".sweet-modal-close-link").click();
                            
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

                $(".loaderContUpdate").css("display", "none");
                $(".updateText").css("display", "inline"); 
            }

</script>
<?php require "WebApp/HR/footer.php"; ?>