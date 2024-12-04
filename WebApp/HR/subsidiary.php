<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){
//die(print_r($_POST));
    if(isset($_POST['action'])){

        $defaultInstance = new defaults();
        $careerManageInstance = new CareerManager();


        if((int)($_POST["action"]) == $defaultInstance->getActions()["AddCompanyDep"]){
            
            
            if(isset($_POST["subName"]) && isset($_FILES['iconSub'])){

                $subName = trim($_POST["subName"]);
                $iconSub = $_FILES['iconSub'];
                die($careerManageInstance->addSub($subName, $iconSub));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["UpdateCompanyDep"]){
            
            
            if(isset($_POST["subID"]) && isset($_POST["subName"])){

                //die(print_r($_POST));
                
                $subID = trim($_POST["subID"]);
                $subName = trim($_POST["subName"]);
                $iconFile = isset($_FILES['iconFIle']) && is_array($_FILES['iconFIle']) && $_FILES['iconFIle']['name'] != "" ? $_FILES['iconFIle'] : "";
                die($careerManageInstance->updateSub($subID, $subName, $iconFile));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["DeleteCompanyDep"]){

            
            
            if(isset($_POST["subID"]) && isset($_POST['subExt'])){

                
                $subID = trim($_POST["subID"]);
                $iconExt = $_POST['subExt'];
                die($careerManageInstance->deleteSub($subID, $iconExt));

            }
            else{

                $response = array(
                    "response" => "error",
                    "message" => "Request parameter are invalid\nplease use the website properly"
                );
                die(json_encode($response, 1));
            }
            
            

        }
        else if((int)($_POST["action"]) == $defaultInstance->getActions()["GetSubs"]){

            die($careerManageInstance->getSubs());

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
$subIsActive = "active";

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
            <form id="subAdder">
                <div class="mb-3">
                    <label for="subName" class="form-label">Subsidiary's Name</label>
                    <input required type="text" name="subName" required class="form-control" id="subName" aria-describedby="subNameeDesc">
                    <div id="subNameeDesc" class="form-text">Input Subsidiary's Name e.g Dana Group, Dana Plast, etc.</div>
                </div>
                <div class="mb-3">
                <label for="iconSub" class="form-label">Subsidiary's Icon</label>
                <input type="file" class="form-control" required id="iconSub" name="iconSub" accept=".png, .jpg, .jpeg" aria-describedby="subIConDesc"/>
                    <div id="subIConDesc" class="form-text">Upload Subsidiary's Icon e.g ext (.jpg, .png, jpeg)</div>
                </div>
                <input id="action" type="hidden" required name="action" value="2" />
                <button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="addText">Add</span><span class="loaderCont"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>
            </form>
        </div>
        <div class="col-sm-7" style="background-color: #FFFFFF !important; margin-top: 20px; margin-bottom: 20px;">
        <table id="subTableList" class="table table-sm" cellspacing="0">
        <thead>
            <tr>
                <th>S/N</th>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="subTBody">
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>

    function editSub(subID, subName, subExt){
        $.sweetModal({
        title: 'Update Subsidiary - '+subID,
        content: '<form id="subUpdater" onsubmit="updateSubFunc();return false;">'+
                '<div class="mb-3">'+
                    '<label for="subNameUpdate" class="form-label">Subsidiary\'s Name</label>'+
                    '<input required type="text" name="subName" value="'+subName+'" class="form-control" id="subNameUpdate" aria-describedby="subNameDescUpdate">'+
                    '<div id="subNameDescUpdate" class="form-text">Input Subsidiary\'s Name e.g Dana Group, Dana Plast, etc.</div>'+
                '</div>'+
                '<div class="mb-3">'+
                '<label for="iconSub" class="form-label">Subsidiary\'s Icon : <img src="WebApp/File_Uploads/subsidiary/'+subID+'.'+subExt+'" height="80px" width="80px" /></label>'+
                '<input type="file" class="form-control" name="iconFIle" id="iconSubUpdate" accept=".png, .jpg, .jpeg" aria-describedby="subIConDescUpdate"/>'+
                '<div id="subIConDescUpdate" class="form-text">Upload Subsidiary\'s Icon e.g ext (.jpg, .png, jpeg)</div>'+
                '</div>'+
                '<input required type="hidden" name="subID" id="subID" value="'+subID+'"/>'+
                '<input required type="hidden" name="action" id="action" value="3"/>'+
                '<button type="submit" class="btn" style="background-color: #EE2326 !important; color: #FFFFFF !important;"><span class="updateText">Update</span><span class="loaderContUpdate"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading</span></button>'+
            '</form>'
        });
    }

    function deleteSub(subID, subExt){
        $.sweetModal.confirm('Confirm Action', 'Are you sure you want delete selected Subsidiary?', function() {
                
            var locationPostData = "subID="+subID+"&subExt="+subExt+"&action=4";
                    $.ajax({ 
                    type:"POST",
                    url:"Manage-Sub",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestSub();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Subsidiary successfully deleted."
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

            function updateSubFunc(){
            
                $(".updateText").css("display", "none");
                $(".loaderContUpdate").css("display", "inline");
                var subID = $("#subID").val();
                var subName = $("#subNameUpdate").val();
                var iconSubUpdt = $("#iconSubUpdate").val();

                if(subName == ""){

                    BootstrapAlert.alert({
                    title:"Error",
                    message:"Both Fields are compulsory!"
                    });
                }
                else{

                    var form = $('#subUpdater')[0];
                    var formData = new FormData(form);
                    $.ajax({ 
                    type:"POST",
                    data: formData,
                    contentType: false,
				    cache: false,
					processData: false,
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            requestSub();
                            BootstrapAlert.success({
                            title:"Sussess",
                            message:"Subsidiary successfully updated."
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