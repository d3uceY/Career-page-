<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action'])){

        $defaultInstance = new defaults();
        $careerManageInstance = new CareerManager();

    if((int)($_POST["action"]) == $defaultInstance->getActions()["getTalentHunt"]){

            die($careerManageInstance->getTalentHUntApplications());

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["updateTalentHunt"]){
            
            $tHuntID = $_POST['tHuntID'];
            $status = $_POST['status'];

           die($careerManageInstance->updateTalentHuntQApplication($tHuntID, $status));

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["deleteTalentHunt"]){
            
            $tHuntID = $_POST['tHuntID'];

           die($careerManageInstance->deleteTHuntApplication($tHuntID));

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


$applicationsIsActive = "mm-active";
$qTAppActive = "active";

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


.loaderContUpdate{

    display: none;
}


</style>

<div class="container-fluid" style="margin-bottom: 40px; padding: 20px;">
    <div class="row">

        <div class="col-sm-12" style="background-color: #FFFFFF !important; margin-top: 20px; margin-bottom: 20px;">
        <table id="tHintList" class="table table-sm" cellspacing="0">
        <thead>
            <tr>
                <th>S/N</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Education</th>
                <th>Experience</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tHuntTBody">
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>

    function manageApp(tHuntID, firstName, lastName, position, email, phoneNumber, skills, education, notice, statusList, address, salary, edu_ID, experience){
       // alert(statusList);
      // alert(experience);
        $.sweetModal({
        title: 'Manage Talent Hunt \nDesired Role / Position: '+position,
        content: '<form id="subUpdater" onsubmit="updateSubFunc();return false;">'+
                '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="firstName">First Name&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="firstName" readonly id="firstName" value="'+firstName+'" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

						'<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="lastName">Last Name&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="lastName" readonly value="'+lastName+'" id="lastName" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

						'<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="emailAddress">Email&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="email" name="emailAddress" readonly value="'+email+'" id="emailAddress" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

						'<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="phoneNumber">Phone Number&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="phoneNumber" readonly value="'+phoneNumber+'" id="phoneNumber" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="address">Address&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="address" readonly value="'+address+'" id="address" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="phoneNumber">Educational Qualification&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="education" readonly value="'+education+'" id="education" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="experience">Years of Relevant Experience&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="experience" readonly value="'+experience+'" id="experience" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="skills">Skills&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input readonly id="skills" value="'+skills+'" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="notice">Earliest Start Date&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="date" name="notice" readonly value="'+notice+'" id="notice" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="notice">Desired Salary / Role&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="notice" readonly value="'+salary+'" id="salary" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+

                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="status">Application Status&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<select name="status" id="status" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+statusList+'</select>'+
						'<br><br>'+
				        '<input required type="hidden" id="thuntID" value="'+tHuntID+'">'+
				        '<input required type="hidden" id="position" value="'+position+'">'+
                        '<input required type="hidden" id="edu_ID" value="'+edu_ID+'">'+
                        '<button type="submit" class="btn" style="background-color: #2F3390 !important; color: #FFFFFF !important;"><span class="updateText">Update</span><span class="loaderContUpdate"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>&nbsp;&nbsp;<button type="button" class="btn" onclick="deleteSub('+tHuntID+')" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span>Delete</span></button>'+
           '</form>'
        });
    }


    function deleteSub(tHuntID){
        $.sweetModal.confirm('Confirm Action', 'Are you sure you want delete selected Talent Hunt Application?', function() {
                
            var locationPostData = "tHuntID="+tHuntID+"&action=37";
                    $.ajax({ 
                    type:"POST",
                    url:"Query-Talent-Hunt",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            $.sweetModal({
                                content: "Talent Hunt Application successfully deleted.",
                                icon: $.sweetModal.ICON_SUCCESS,
                                onClose: ()=>{
                                    requestTalentHuntApp();
                                }
                            });
                            $(".sweet-modal-close-link").click();
                            
                        }
                        else
                        {

                            $.sweetModal({
                                content: serverResponse.message,
                                icon: $.sweetModal.ICON_WARNING
                            });
                            $(".sweet-modal-close-link").click();
                            
                        }
                        

                    }.bind(this),
                    error: function(xhr, status, err) {

                        $.sweetModal({
                                content: "Something happened while processing your Log In\nPlease try again later.",
                                icon: $.sweetModal.ICON_WARNING,
                            });
                            $(".sweet-modal-close-link").click();
                    }.bind(this)
                });  

            }, function() {
                 $.sweetModal({
                    content: "Operation Canceled",
                    icon: $.sweetModal.ICON_WARNING
                     });
                     $(".sweet-modal-close-link").click();
            });
    }

            function updateSubFunc(){
            
                $(".updateText").css("display", "none");
                $(".loaderContUpdate").css("display", "inline");
                
                var status = $("#status").val();
                var thuntID = $("#thuntID").val();

               
                var locationPostData = "tHuntID="+thuntID+"&status="+status+"&action=38";
                //console.log(locationPostData);
                                                                            $.ajax({ 
                                                                                type:"POST",
                                                                                url:"Query-Talent-Hunt",
                                                                                data: locationPostData, 
                                                                                contentType: 'application/x-www-form-urlencoded',
                                                                                success: function(res) {
                                                                                    var serverResponse = JSON.parse(res);
                                                                                    if(serverResponse.response == "success"){

                                                                                        $.sweetModal({
                                                                                            content: serverResponse.message,
                                                                                            icon: $.sweetModal.ICON_SUCCESS,
                                                                                            onClose: ()=>{location.reload();}
                                                                                            });

                                                                                    
                                                                                        
                                                                                    }
                                                                                    else
                                                                                    {

                                                                                        $.sweetModal({
                                                                                            content: serverResponse.message,
                                                                                            icon: $.sweetModal.ICON_WARNING
                                                                                        });

                                                                                    }
                                                                                    

                                                                                }.bind(this),
                                                                                error: function(xhr, status, err) {
                                                                                    $.sweetModal({
                                                                                        content: "Something happened while processing your Log In\nPlease try again later.",
                                                                                        icon: $.sweetModal.ICON_WARNING
                                                                                    });

                                                                                }.bind(this)
                                                                            }); 



                $(".loaderContUpdate").css("display", "none");
                $(".updateText").css("display", "inline");

            }


            function Documents(docID, resumeExt, coverExt){
                $.sweetModal({
                title: 'View Documents - ID: '+docID,
                content: '<div class="container"><div class="row"><div class="col-sm-6 text-center"><button class="btn btn-primary" onclick="loadCV(\''+docID+'\', \''+resumeExt+'\')">View Resume</button></div><div class="col-sm-6 text-center"><button class="btn btn-success" onclick="loadCover(\''+docID+'\',\''+coverExt+'\')">View Cover Letter</button></div></div><div class="row" id="docBox" style="height: 500px; background-color: #000000; margin: 10px;"><iframe id="docframe" src=""></iframe></div></div>'
                });

            }

            function loadCV(docID, resumeExt){

            //console.log("https://docs.google.com/viewer?embedded=true&url=https://career.danagroup.com/WebApp/File_Uploads/Resume/"+docID+"."+resumeExt);
                $("#docframe").attr("src", "https://docs.google.com/viewer?embedded=true&url=https://career.danagroup.com/WebApp/File_Uploads/TResume/"+docID+"."+resumeExt);
            }
            function loadCover(docID, coverExt){

            $("#docframe").attr("src", "https://docs.google.com/viewer?embedded=true&url=https://career.danagroup.com/WebApp/File_Uploads/TCover/"+docID+"."+coverExt);
            }

</script>
<?php require "WebApp/HR/footer.php"; ?>