<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['action'])){

        $defaultInstance = new defaults();
        $careerManageInstance = new CareerManager();

        if((int)($_POST["action"]) == $defaultInstance->getActions()["AddLocation"]){

            
            
            if(isset($_POST["locationState"]) && isset($_POST["locationCountry"])){

                $locationState = trim($_POST["locationState"]);
                $locationCountry = $_POST["locationCountry"];

                die($careerManageInstance->addLocation($locationState, $locationCountry));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["UpdateLocation"]){

            
            
            if(isset($_POST["locationID"]) && isset($_POST["locationState"]) && isset($_POST["locationCountry"])){

                
                $locationID = trim($_POST["locationID"]);
                $locationState = trim($_POST["locationState"]);
                $locationCountry = $_POST["locationCountry"];

                die($careerManageInstance->updateLocation($locationID, $locationState, $locationCountry));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["DeleteLocation"]){

            
            
            if(isset($_POST["locationID"])){

                
                $locationID = trim($_POST["locationID"]);
                die($careerManageInstance->deleteLocation($locationID));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["GetLocations"]){

            die($careerManageInstance->getLocations());

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
$locationIsActive = "active";

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
            <form id="locationAdder">
                <div class="mb-3">
                    <label for="locationState" class="form-label">Location's State</label>
                    <input required type="text" class="form-control" id="locationState" aria-describedby="locStateDesc">
                    <div id="locStateDesc" class="form-text">Input Location's State e.g Lagos, Ibadan, etc.</div>
                </div>
                <div class="mb-3">
                    <label for="locationCountry" class="form-label">Location's Country</label>
                    <input required type="text" class="form-control" id="locationCountry" aria-describedby="locCountryDesc">
                    <div id="locCountryDesc" class="form-text">Input Location's Country e.g Nigeria, United States of America, etc.</div>
                </div>
                <button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="addText">Add</span><span class="loaderCont"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>
            </form>
        </div>
        <div class="col-sm-7" style="background-color: #FFFFFF !important; margin-top: 20px; margin-bottom: 20px;">
        <table id="tableList" class="table table-sm" cellspacing="0">
        <thead>
            <tr>
                <th>S/N</th>
                <th>ID</th>
                <th>State</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="locationTBody">
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>

    function editLocation(locationID, locationState, locationCountry){
        $.sweetModal({
        title: 'Update Location - '+locationID,
        content: '<form id="locationUpdater" onsubmit="updateLocationFunc();return false;">'+
                '<div class="mb-3">'+
                    '<label for="locationStateUpdate" class="form-label">Location\'s State</label>'+
                    '<input required type="text" value="'+locationState+'" class="form-control" id="locationStateUpdate" aria-describedby="locStateDescUpdate">'+
                    '<div id="locStateDescUpdate" class="form-text">Input Location\'s State e.g Lagos, Ibadan, etc.</div>'+
                '</div>'+
                '<div class="mb-3">'+
                    '<label for="locationCountryUpdate" class="form-label">Location\'s Country</label>'+
                    '<input required type="text" value="'+locationCountry+'" class="form-control" id="locationCountryUpdate" aria-describedby="locCountryDescUpdate">'+
                    '<input required type="hidden" id="locationID" value="'+locationID+'">'+
                    '<div id="locCountryDescUpdate" class="form-text">Input Location\'s Country e.g Nigeria, United States of America, etc.</div>'+
                '</div>'+
                '<button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="updateText">Update</span><span class="loaderContUpdate"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>'+
            '</form>'
        });
    }

    function deleteLocation(locationID){
        $.sweetModal.confirm('Confirm Action', 'Are you sure you want delete selected location?', function() {
                
            var locationPostData = "locationID="+locationID+"&action=16";
                    $.ajax({ 
                    type:"POST",
                    url:"Manage-Locations",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestLocation();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Location successfully deleted."
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

            function updateLocationFunc(){
            
                $(".updateText").css("display", "none");
                $(".loaderContUpdate").css("display", "inline");
                var locationID = $("#locationID").val();
                var locationState = $("#locationStateUpdate").val();
                var locationCountry = $("#locationCountryUpdate").val();

                if(locationState == "" && locationCountry == ""){

                    BootstrapAlert.alert({
                    title:"Error",
                    message:"Both Fields are compulsory!"
                    });
                }
                else{

                    var locationPostData = "locationID="+locationID+"&locationState="+locationState+"&locationCountry="+locationCountry+"&action=15";
                    $.ajax({ 
                    type:"POST",
                    url:"Manage-Locations",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestLocation();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Location successfully updated."
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