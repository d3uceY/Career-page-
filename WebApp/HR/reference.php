<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action'])){

        $defaultInstance = new defaults();
        $careerManageInstance = new CareerManager();

        if((int)($_POST["action"]) == $defaultInstance->getActions()["AddJobOpeningRef"]){

            
            
            if(isset($_POST["subName"])){

                $subName = trim($_POST["subName"]);

                die($careerManageInstance->addRef($subName));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["UpdateJobOpeningRef"]){
            
            if(isset($_POST["subID"]) && isset($_POST["subName"])){

                
                $subID = trim($_POST["subID"]);
                $subName = trim($_POST["subName"]);

                die($careerManageInstance->updateRef($subID, $subName));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["DeleteJobOpeningRef"]){

            
            
            if(isset($_POST["subID"])){

                
                $subID = trim($_POST["subID"]);
                die($careerManageInstance->deleteRef($subID));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["GetRef"]){

            die($careerManageInstance->getRefs());

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


$dashboardIsActive = "mm-active";
$refIsActive = "active";

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
        <div class="col-sm-5" style="margin-top: 20px; margin-bottom: 20px;">
            <form id="refAdder">
                <div class="mb-3">
                    <label for="refName" class="form-label">Reference Name</label>
                    <input required type="text" class="form-control" id="refName" aria-describedby="refNameDesc">
                    <div id="refNameDesc" class="form-text">Input Reference Name e.g LinkedIn, Indeed, etc.</div>
                </div>
                <button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="addText">Add</span><span class="loaderCont"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>
            </form>
        </div>
        <div class="col-sm-7" style="background-color: #FFFFFF !important; margin-top: 20px; margin-bottom: 20px;">
        <table id="refTableList" class="table table-sm" cellspacing="0">
        <thead>
            <tr>
                <th>S/N</th>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="refTBody">
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>

    function editRef(refID, refName){
        $.sweetModal({
        title: 'Update Reference - '+refID,
        content: '<form id="refUpdater" onsubmit="updateRefFunc();return false;">'+
                '<div class="mb-3">'+
                    '<label for="refNameUpdate" class="form-label">Reference\'s Name</label>'+
                    '<input required type="text" value="'+refName+'" class="form-control" id="refNameUpdate" aria-describedby="refNameDescUpdate">'+
                    '<div id="refNameDescUpdate" class="form-text">Input Reference Name  e.g LinkedIn, Indeed, etc.</div>'+
                '</div>'+
                '<input required type="hidden" id="refID" value="'+refID+'">'+
                '<button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="updateText">Update</span><span class="loaderContUpdate"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>'+
            '</form>'
        });
    }

    function deleteRef(subID){
        $.sweetModal.confirm('Confirm Action', 'Are you sure you want delete selected Reference?', function() {
                
            var locationPostData = "subID="+subID+"&action=7";
                    $.ajax({ 
                    type:"POST",
                    url:"Manage-Ref",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestRef();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Reference successfully deleted."
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

            }, function() {
                BootstrapAlert.alert({
                    title:"Error",
                    message:"Operation Canceled"
                    });
                $(".sweet-modal-close-link").click();
            });
    }

            function updateRefFunc(){
            
                $(".updateText").css("display", "none");
                $(".loaderContUpdate").css("display", "inline");
                var subID = $("#refID").val();
                var subName = $("#refNameUpdate").val();

                if(subName == ""){

                    BootstrapAlert.alert({
                    title:"Error",
                    message:"Both Fields are compulsory!"
                    });
                }
                else{

                    var locationPostData = "subID="+subID+"&subName="+subName+"&action=6";
                    $.ajax({ 
                    type:"POST",
                    url:"Manage-Ref",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestRef();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Reference successfully updated."
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