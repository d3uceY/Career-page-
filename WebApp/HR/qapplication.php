<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action'])){

        $defaultInstance = new defaults();
        $careerManageInstance = new CareerManager();

    if((int)($_POST["action"]) == $defaultInstance->getActions()["getapply"]){

            die($careerManageInstance->getApplications());

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["updateApplication"]){
            $subID = $_POST['subID'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $emailAddress = $_POST['emailAddress'];
            $phoneNumber = $_POST['phoneNumber'];
            $education = $_POST['education'];
            $industry = $_POST['industry'];
            $reference = $_POST['reference'];
            $notice = $_POST['notice'];
            $salary = $_POST['salary'];
            $status = $_POST['status'];
            $jobID = $_POST['jobID'];
            $experience = $_POST['experience'];
            $address = $_POST['address'];
            $ind_ID = $_POST['ind_ID'];
            $edu_ID = $_POST['edu_ID'];
            $ref_ID = $_POST['ref_ID'];
            $jlocation = $_POST['jobLocalevar'];

           die($careerManageInstance->updateQApplication($subID ,$firstName, $lastName, $emailAddress, $phoneNumber, $edu_ID, $ind_ID, $ref_ID, $notice, $salary, $status, $jobID, $address, $experience, $jlocation));

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["deleteApplication"]){
            //die(print_r($_POST));
            $jobID = $_POST['jobID'];

           die($careerManageInstance->deleteApplication($jobID));

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
$qAppActive = "active";

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
        <table id="appList" class="table table-sm" cellspacing="0">
        <thead>
            <tr>
                <th>S/N</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Title</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Industry</th>
                <th>Qualification</th>
                <th>Experience</th>
                <th>Preferred Location</th>
                <th>Reference</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="appTBody">
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>

    function manageApp(subID, jobID, firstName, lastName, jobTitle, email, phoneNumber, industry, education, reference, statusList, address, notice, salary, address, ind_ID, edu_ID, ref_ID, experience, jlocation){
       // alert(statusList);
      // alert(experience);
        $.sweetModal({
        title: 'Manage Application - ID: '+subID+"\nTitle - "+jobTitle,
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
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="experience">Years of Experience&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="experience" readonly value="'+experience+'" id="experience" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="phoneNumber">industry&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="industry" readonly value="'+industry+'" id="industry" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="reference">How Did You Get To Know About Us&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="industry" readonly value="'+reference+'" id="reference" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="notice">Notice Period&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="notice" readonly value="'+notice+'" id="notice" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="notice">Salary Expectation&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<input type="text" name="notice" readonly value="'+salary+'" id="salary" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;" />'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="jobLocale">Preferred Job Location&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<select name="jobLocale" id="jobLocale" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+jlocation+'</select>'+
						'<br><br>'+
                        '<label style="font-weight: bold; text-transform: capitalize; margin-bottom: 5px;" for="status">Application Status&nbsp;&nbsp;<span style="color: #FF0000 !important;">*</span></label>'+
						'<select name="status" id="status" required style="background-color: #E8CACB; height: 40px; border: none !important; border-radius: 15px; width: 100%; padding: 5px;">'+statusList+'</select>'+
						'<br><br>'+
				        '<input required type="hidden" id="subID" value="'+subID+'">'+
                        '<input required type="hidden" id="jobID" value="'+jobID+'">'+
                        '<input required type="hidden" id="ind_ID" value="'+ind_ID+'">'+
                        '<input required type="hidden" id="edu_ID" value="'+edu_ID+'">'+
                        '<input required type="hidden" id="ref_ID" value="'+ref_ID+'">'+
                '<button type="submit" class="btn" style="background-color: #2F3390 !important; color: #FFFFFF !important;"><span class="updateText">Update</span><span class="loaderContUpdate"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>&nbsp;&nbsp;<button type="button" class="btn" onclick="deleteSub('+subID+')" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span>Delete</span></button>'+
            '</form>'
        });
    }


    function deleteSub(jobID){
        $.sweetModal.confirm('Confirm Action', 'Are you sure you want delete selected Application?', function() {
                
            var locationPostData = "jobID="+jobID+"&action=39";
                    $.ajax({ 
                    type:"POST",
                    url:"Query-Application",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            $.sweetModal({
                                content: "Application successfully deleted.",
                                icon: $.sweetModal.ICON_SUCCESS,
                                onClose: ()=>{
                                    requestApp();
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
                var subID = $("#subID").val();
                var firstNAme = $("#firstName").val();
                var lastName = $("#lastName").val();
                var emailAddress = $("#emailAddress").val();
                var phoneNumber = $("#phoneNumber").val();
                var education = $("#education").val();
                var industry = $("#industry").val();
                var reference = $("#reference").val();
                var notice = $("#notice").val();
                var salary = $("#salary").val();
                var status = $("#status").val();
                var jobID = $("#jobID").val();
                var address = $("#address").val();
                var ind_ID = $("#ind_ID").val();
                var edu_ID = $("#edu_ID").val();
                var ref_ID = $("#ref_ID").val();
                var experience = $("#experience").val();
                var jobLocalevar = $("#jobLocale").val();

               
                var locationPostData = "subID="+subID+"&action=32"+"&firstName="+firstNAme+"&lastName="+lastName+"&emailAddress="+emailAddress+"&phoneNumber="+phoneNumber+"&education="+education+"&industry="+industry+"&reference="+reference+"&notice="+notice+"&salary="+salary+"&status="+status+"&jobID="+jobID+"&address="+address+"&ind_ID="+ind_ID+"&edu_ID="+edu_ID+"&ref_ID="+ref_ID+"&jobLocalevar="+jobLocalevar+"&experience="+experience;
                //console.log(locationPostData);
                                                                            $.ajax({ 
                                                                                type:"POST",
                                                                                url:"Query-Application",
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
                $("#docframe").attr("src", "https://docs.google.com/viewer?embedded=true&url=https://career.danagroup.com/WebApp/File_Uploads/Resume/"+docID+"."+resumeExt);
            }
            function loadCover(docID, coverExt){

            $("#docframe").attr("src", "https://docs.google.com/viewer?embedded=true&url=https://career.danagroup.com/WebApp/File_Uploads/Cover/"+docID+"."+coverExt);
            }

</script>
<?php require "WebApp/HR/footer.php"; ?>