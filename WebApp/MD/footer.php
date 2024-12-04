







</div>
</div>
</div>





<div class="footer_part">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="footer_iner text-center">
<p>2024 © Dana Group - HR Career Portal</p>
</div>
</div>
</div>
</div>
</div>
</section>



<script src="WebApp/HR/js/jquery1-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="WebApp/HR/js/popper1.min.js"></script>

<script src="WebApp/HR/js/bootstrap1.min.js"></script>
<script src="WebApp/HR/js/bootstrapAlert.min.js"></script>

<script src="WebApp/HR/js/jquery.sweet-modal.min.js"></script>
<script src="WebApp/HR/ckeditor/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.js" integrity="sha512-XgJh9jgd6gAHu9PcRBBAp0Hda8Tg87zi09Q2639t0tQpFFQhGpeCgaiEFji36Ozijjx9agZxB0w53edOFGCQ0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.6.0/tips_data.min.js"></script>
<script src="WebApp/HR/js/metisMenu.js"></script>

<script src="WebApp/HR/vendors/count_up/jquery.waypoints.min.js"></script>

<script src="WebApp/HR/vendors/chartlist/Chart.min.js"></script>

<script src="WebApp/HR/vendors/count_up/jquery.counterup.min.js"></script>

<script src="WebApp/HR/vendors/swiper_slider/js/swiper.min.js"></script>

<script src="WebApp/HR/vendors/niceselect/js/jquery.nice-select.min.js"></script>

<script src="WebApp/HR/vendors/owl_carousel/js/owl.carousel.min.js"></script>

<script src="WebApp/HR/vendors/gijgo/gijgo.min.js"></script>

<script src="WebApp/HR/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="WebApp/HR/vendors/datatable/js/pdfmake.min.js"></script>
<script src="WebApp/HR/vendors/datatable/js/vfs_fonts.js"></script>
<script src="WebApp/HR/js/chart.min.js"></script>

<script src="WebApp/HR/vendors/progressbar/jquery.barfiller.js"></script>

<!--[if IE]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
<!--<script language="javascript" type="text/javascript" src="jquery.min.js"></script>-->
<script language="javascript" type="text/javascript" src="WebApp/HR/jqpilot/jquery.jqplot.min.js"></script>

<script type="text/javascript" src="WebApp/HR/jqpilot/plugins/jqplot.logAxisRenderer.js"></script>
<script type="text/javascript" src="WebApp/HR/jqpilot/plugins/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="WebApp/HR/jqpilot/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
<script type="text/javascript" src="WebApp/HR/jqpilot/plugins/jqplot.canvasAxisTickRenderer.js"></script>
<script type="text/javascript" src="WebApp/HR/jqpilot/plugins/jqplot.dateAxisRenderer.js"></script>
<script type="text/javascript" src="WebApp/HR/jqpilot/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="WebApp/HR/jqpilot/plugins/jqplot.barRenderer.js"></script>




<script src="WebApp/HR/vendors/tagsinput/tagsinput.js"></script>

<script src="WebApp/HR/vendors/text_editor/summernote-bs4.js"></script>
<script src="WebApp/HR/vendors/apex_chart/apexcharts.js"></script>

<script src="WebApp/HR/js/custom.js"></script>
<script src="WebApp/HR/vendors/apex_chart/bar_active_1.js"></script>
<script src="WebApp/HR/vendors/apex_chart/apex_chart_list.js"></script>

<script>



/*var locationTable = $("#tableList").DataTable({
            dom: 'QBlrtip',
            processing: true,
            serverSide: true,
            ajax: {
                url: 'Manage-Locations',
                type: 'POST',
                data: {action: 17}
            },
            columns: [
                { data: 'sn' },
                { data: 'id' },
                { data: 'location-state' },
                { data: 'location-country' },
                { data: 'actions' }
            ],
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child',
                headerCheckbox: false
            },
            scrollY: "200px",
            scrollCollapse: true,
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                searchable: false,
                targets: 0
            } ],
            order: [[0, 'asc']],
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
        });
*/
function inititalizeLoctable(){

    $("#tableList").DataTable({
            dom: 'QBlrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child',
                headerCheckbox: false
            },
            scrollY: "400px",
            scrollCollapse: true,
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                searchable: false,
                targets: 0
            } ],
            order: [[0, 'asc']],
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
        });
    
}

function inititalizeSubtable(){

$("#subTableList").DataTable({
        dom: 'QBlrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        scrollY: "400px",
        scrollCollapse: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            searchable: false,
            targets: 0
        } ],
        order: [[0, 'asc']],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });

}

function inititalizeReftable(){

$("#refTableList").DataTable({
        dom: 'QBlrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        scrollY: "400px",
        scrollCollapse: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            searchable: false,
            targets: 0
        } ],
        order: [[0, 'asc']],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });

}

function inititalizeEdutable(){

$("#eduTableList").DataTable({
        dom: 'QBlrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        scrollY: "400px",
        scrollCollapse: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            searchable: false,
            targets: 0
        } ],
        order: [[0, 'asc']],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });

}

function inititalizeIndtable(){

$("#indTableList").DataTable({
        dom: 'QBlrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        scrollY: "400px",
        scrollCollapse: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            searchable: false,
            targets: 0
        } ],
        order: [[0, 'asc']],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });

}
function inititalizeApptable(){

$("#appList").DataTable({
        dom: 'QBlrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        scrollY: "400px",
        scrollCollapse: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            searchable: false,
            targets: 0
        } ],
        order: [[0, 'asc']],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });

}

function inititalizeOpeningtable(){

$("#opeingList").DataTable({
        dom: 'QBlrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        scrollY: "400px",
        scrollCollapse: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            searchable: false,
            targets: 0
        } ],
        order: [[0, 'asc']],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });

}

function inititalizeTalentHuntAppTable(){

$("#tHintList").DataTable({
        dom: 'QBlrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        select: {
            style: 'multi',
            selector: 'td:first-child',
            headerCheckbox: false
        },
        scrollY: "400px",
        scrollCollapse: true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            searchable: false,
            targets: 0
        } ],
        order: [[0, 'asc']],
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
    });

}

function requestLocation(){

    $.ajax({ 
                    type:"POST",
                    url:"Manage-Locations",
                    data: "action=17", 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                        $("#tableList").DataTable().destroy();
                        $("#locationTBody").html(serverResponse.tabler);
                        inititalizeLoctable();
                            
                        }
                        else
                        {
                            
                            $("#tableList").DataTable().destroy();
                            $("#locationTBody").html("");
                            inititalizeLoctable();
                        }
                        

                    }.bind(this),
                    error: function(xhr, status, err) {
                            $("#tableList").DataTable().destroy();
                            $("#locationTBody").html("");
                            inititalizeLoctable();
                    }.bind(this)
                }); 
}


function requestOpening(){

$.ajax({ 
                type:"POST",
                url:"Query-Openings",
                data: "action=33", 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                    $("#opeingList").DataTable().destroy();
                    $("#openingTBody").html(serverResponse.tabler);
                    inititalizeOpeningtable();
                        
                    }
                    else
                    {
                        
                        $("#opeingList").DataTable().destroy();
                        $("#openingTBody").html("");
                        inititalizeOpeningtable();
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                        $("#opeingList").DataTable().destroy();
                        $("#openingTBody").html("");
                        inititalizeOpeningtable();
                }.bind(this)
            }); 
}



function requestSub(){

$.ajax({ 
                type:"POST",
                url:"Manage-Sub",
                data: "action=19", 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                    $("#subTableList").DataTable().destroy();
                    $("#subTBody").html(serverResponse.tabler);
                    inititalizeSubtable();
                        
                    }
                    else
                    {
                        
                        $("#subTableList").DataTable().destroy();
                        $("#subTBody").html("");
                        inititalizeSubtable();
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                        $("#subTableList").DataTable().destroy();
                        $("#subTBody").html("");
                        inititalizeSubtable();
                }.bind(this)
            }); 
}


function requestRef(){

$.ajax({ 
                type:"POST",
                url:"Manage-Ref",
                data: "action=20", 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                    $("#refTableList").DataTable().destroy();
                    $("#refTBody").html(serverResponse.tabler);
                    inititalizeReftable();
                        
                    }
                    else
                    {
                        
                        $("#refTableList").DataTable().destroy();
                        $("#refTBody").html("");
                        inititalizeReftable();
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                        $("#refTableList").DataTable().destroy();
                        $("#refTBody").html("");
                        inititalizeReftable();
                }.bind(this)
            }); 
}



function requestEdu(){

$.ajax({ 
                type:"POST",
                url:"Manage-Edu",
                data: "action=21", 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                    $("#eduTableList").DataTable().destroy();
                    $("#eduTBody").html(serverResponse.tabler);
                    inititalizeEdutable();
                        
                    }
                    else
                    {
                        
                        $("#eduTableList").DataTable().destroy();
                        $("#eduTBody").html("");
                        inititalizeEdutable();
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                        $("#eduTableList").DataTable().destroy();
                        $("#eduTBody").html("");
                        inititalizeEdutable();
                }.bind(this)
            }); 
}


function requestInd(){

$.ajax({ 
                type:"POST",
                url:"Manage-Ind",
                data: "action=25", 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                    $("#indTableList").DataTable().destroy();
                    $("#indTBody").html(serverResponse.tabler);
                    inititalizeIndtable();
                        
                    }
                    else
                    {
                        
                        $("#indTableList").DataTable().destroy();
                        $("#indTBody").html("");
                        inititalizeIndtable();
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                        $("#indTableList").DataTable().destroy();
                        $("#indTBody").html("");
                        inititalizeIndtable();
                }.bind(this)
            }); 
}

function requestApp(){

$.ajax({ 
                type:"POST",
                url:"Query-Application",
                data: "action=31", 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                    $("#appList").DataTable().destroy();
                    $("#appTBody").html(serverResponse.tabler);
                    inititalizeApptable();
                        
                    }
                    else
                    {
                        
                        $("#appList").DataTable().destroy();
                        $("#appTBody").html("");
                        inititalizeApptable();
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                        $("#appList").DataTable().destroy();
                        $("#appTBody").html("");
                        inititalizeApptable();
                }.bind(this)
            }); 
}

function requestTalentHuntApp(){

$.ajax({ 
                type:"POST",
                url:"Query-Talent-Hunt",
                data: "action=36", 
                contentType: 'application/x-www-form-urlencoded',
                success: function(res) {
                    var serverResponse = JSON.parse(res);
                    if(serverResponse.response == "success"){

                    $("#tHintList").DataTable().destroy();
                    $("#tHuntTBody").html(serverResponse.tabler);
                    inititalizeTalentHuntAppTable();
                        
                    }
                    else
                    {
                        
                        $("#tHintList").DataTable().destroy();
                        $("#tHuntTBody").html("");
                        inititalizeTalentHuntAppTable();
                    }
                    

                }.bind(this),
                error: function(xhr, status, err) {
                        $("#tHintList").DataTable().destroy();
                        $("#tHuntTBody").html("");
                        inititalizeTalentHuntAppTable();
                }.bind(this)
            }); 
}

function getAttritionTableData(option){

    var line1 = [];

    var JAN = '01';
    var FEB = '02';
    var MAR = '03';
    var APR = '04';
    var MAY = '05';
    var JUN = '06';
    var JUL = '07';
    var AUG = '08';
    var SEP = '09';
    var OCT = '10';
    var NOV = '11';
    var DEC = '12';

    var DPHL_LAGOS = [[JAN, 0], [FEB, 4.35], [MAR, 1.43], [APR, 0], [MAY, 2.82], [JUN, 4.29]];
    var DPHL_IBADAN = [['01', 0], ['02', 3.75], ['03', 1.28], ['04', 0], ['05', 0], ['06', 3.66]];
    var DPHL_MINNA = [['01', 0], ['02', 0.64], ['03', 0], ['04', 0.64], ['05', 0], ['06', 0]];
    var DPHL_ALL = [];
    var DPLL = [['01', 0], ['02', 0], ['03', 0], ['04', 1.92], ['05', 0], ['06', 0]];
    var DGC = [['01', 1.25], ['02', 1.23], ['03', 0], ['04', 0], ['05', 4.65], ['06', 2.5]];
    var GENERALATTR = [];

    //set DPHL combination array
    DPHL_LAGOS.forEach((element) => {
        DPHL_ALL.push(element);
    });

    DPHL_IBADAN.forEach((element) => {
        DPHL_ALL.push(element);
    });

    DPHL_MINNA.forEach((element) => {
        DPHL_ALL.push(element);
    });

    //set GENERAL ATTR combination array
    DPHL_ALL.forEach((element) => {
        GENERALATTR.push(element);
    });

    DPLL.forEach((element) => {
        GENERALATTR.push(element);
    });

    DGC.forEach((element) => {
        GENERALATTR.push(element);
    });
    

    $("#chart1").html("");

    if(option == 1)
    {
            var plot1 = $.jqplot('chart1', [DPHL_LAGOS], {
            title:'Attrition Rate Analysis - DPHL LAGOS',
            axes:{
                xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{formatString:'%b'},//ickOptions:{formatString:'%b/%e/%Y'},
                tickInterval:'1 month'
                }
            },
            series:[{lineWidth:2, markerOptions:{style:"circle"}}]
        });
    }
    else if(option == 2)
    {
            var plot1 = $.jqplot('chart1', [DPHL_IBADAN], {
            title:'Attrition Rate Analysis - DPHL IBADAN',
            axes:{
                xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{formatString:'%b'},//ickOptions:{formatString:'%b/%e/%Y'},
                tickInterval:'1 month'
                }
            },
            series:[{lineWidth:2, markerOptions:{style:"circle"}}]
        });
    }
    else if(option == 3)
    {
            var plot1 = $.jqplot('chart1', [DPHL_MINNA], {
            title:'Attrition Rate Analysis - DPHL MINNA',
            axes:{
                xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{formatString:'%b'},//ickOptions:{formatString:'%b/%e/%Y'},
                tickInterval:'1 month'
                }
            },
            series:[{lineWidth:2, markerOptions:{style:"circle"}}]
        });
    }
    else if(option == 4)
    {
            var plot1 = $.jqplot('chart1', [DPLL], {
            title:'Attrition Rate Analysis - DPLL',
            axes:{
                xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{formatString:'%b'},//ickOptions:{formatString:'%b/%e/%Y'},
                tickInterval:'1 month'
                }
            },
            series:[{lineWidth:2, markerOptions:{style:"circle"}}]
        });
    }
    else if(option == 5)
    {
            var plot1 = $.jqplot('chart1', [DGC], {
            title:'Attrition Rate Analysis',
            axes:{
                xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{formatString:'%b'},//ickOptions:{formatString:'%b/%e/%Y'},
                tickInterval:'1 month'
                }
            },
            series:[{lineWidth:2, markerOptions:{style:"circle"}}]
        });
    }
    else if(option == 6)
    {
            var plot1 = $.jqplot('chart1', [DPHL_ALL], {
            title:'Attrition Rate Analysis',
            axes:{
                xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{formatString:'%b'},//ickOptions:{formatString:'%b/%e/%Y'},
                tickInterval:'1 month'
                }
            },
            series:[{lineWidth:2, markerOptions:{style:"circle"}}]
        });
    }
    else
    {
            var plot1 = $.jqplot('chart1', [GENERALATTR], {
            title:'Attrition Rate Analysis',
            axes:{
                xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickOptions:{formatString:'%b'},//ickOptions:{formatString:'%b/%e/%Y'},
                tickInterval:'1 month'
                }
            },
            series:[{lineWidth:2, markerOptions:{style:"circle"}}]
        });
    }

    


}

//Location Adder JS Request Function
    $(document).ready(function() { 


        //CHART DATA VALUE


        
        requestLocation();
        requestSub();
        requestRef();
        requestEdu();
        requestInd();
        requestOpening();
        requestApp();
        requestTalentHuntApp();

        $("#locationAdder").submit(function(){


            $(".addText").css("display", "none");
            $(".loaderCont").css("display", "inline");
            var locationState = $("#locationState").val();
            var locationCountry = $("#locationCountry").val();

            if(locationState == "" && locationCountry == ""){

                $.sweetModal({
                            content: 'Both fields are compulsory',
                            icon: $.sweetModal.ICON_WARNING
                        });
            }
            else{

                var locationPostData = "locationState="+locationState+"&locationCountry="+locationCountry+"&action=14";
                $.ajax({ 
                    type:"POST",
                    url:"Manage-Locations",
                    data: locationPostData, 
                    contentType: 'application/x-www-form-urlencoded',
                    success: function(res) {
                        var serverResponse = JSON.parse(res);
                        if(serverResponse.response == "success"){

                            $("#locationState").val("");
                            $("#locationCountry").val("");
                            requestLocation();
                            $.sweetModal({
                            content: 'Location Added',
                            icon: $.sweetModal.ICON_SUCCESS
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
                            content: 'Something happened while processing your Log In\nPlease try again later.',
                            icon: $.sweetModal.ICON_WARNING
                        });
                    }.bind(this)
                });  
                

            }

            $(".loaderCont").css("display", "");
            $(".addText").css("display", "inline");
            return false;
            });






                                        $("#subAdder").submit(function(){


                            $(".addText").css("display", "none");
                            $(".loaderCont").css("display", "inline");
                            var subName = $("#subName").val();

                            if(subName == ""){

                                $.sweetModal({
                                            content: 'Both fields are compulsory',
                                            icon: $.sweetModal.ICON_WARNING
                                        });
                            }
                            else{


                            var form = $('#subAdder')[0];
                                var formData = new FormData(form);
                                $.ajax({ 
                                    type:"POST",
                                    url:"Manage-Sub",
                                    data: formData,
                                    contentType: false,
									cache: false,
									processData: false,
                                    success: function(res) {
                                        var serverResponse = JSON.parse(res);
                                        if(serverResponse.response == "success"){

                                            $("#subName").val("");
                                            requestSub();
                                            $.sweetModal({
                                            content: 'Sub Added',
                                            icon: $.sweetModal.ICON_SUCCESS
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
                                            content: 'Something happened while processing your Log In\nPlease try again later.',
                                            icon: $.sweetModal.ICON_WARNING
                                        });
                                    }.bind(this)
                                });  
                                

                            }

                            $(".loaderCont").css("display", "");
                            $(".addText").css("display", "inline");
                            return false;
                            });



                                    $("#refAdder").submit(function(){


                                        $(".addText").css("display", "none");
                                        $(".loaderCont").css("display", "inline");
                                        var subName = $("#refName").val();

                                        if(subName == ""){

                                            $.sweetModal({
                                                        content: 'Both fields are compulsory',
                                                        icon: $.sweetModal.ICON_WARNING
                                                    });
                                        }
                                        else{

                                            var locationPostData = "subName="+subName+"&action=5";
                                            $.ajax({ 
                                                type:"POST",
                                                url:"Manage-Ref",
                                                data: locationPostData, 
                                                contentType: 'application/x-www-form-urlencoded',
                                                success: function(res) {
                                                    var serverResponse = JSON.parse(res);
                                                    if(serverResponse.response == "success"){

                                                        $("#refName").val("");
                                                        requestRef();
                                                        $.sweetModal({
                                                        content: 'Ref Added',
                                                        icon: $.sweetModal.ICON_SUCCESS
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
                                                        content: 'Something happened while processing your Log In\nPlease try again later.',
                                                        icon: $.sweetModal.ICON_WARNING
                                                    });
                                                }.bind(this)
                                            });  
                                            

                                        }

                                        $(".loaderCont").css("display", "");
                                        $(".addText").css("display", "inline");
                                        return false;
                                        });


            

                                            $("#eduAdder").submit(function(){


                                                    $(".addText").css("display", "none");
                                                    $(".loaderCont").css("display", "inline");
                                                    var subName = $("#eduName").val();

                                                    if(subName == ""){

                                                        $.sweetModal({
                                                                    content: 'Both fields are compulsory',
                                                                    icon: $.sweetModal.ICON_WARNING
                                                                });
                                                    }
                                                    else{

                                                        var locationPostData = "subName="+subName+"&action=22";
                                                        $.ajax({ 
                                                            type:"POST",
                                                            url:"Manage-Edu",
                                                            data: locationPostData, 
                                                            contentType: 'application/x-www-form-urlencoded',
                                                            success: function(res) {
                                                                var serverResponse = JSON.parse(res);
                                                                if(serverResponse.response == "success"){

                                                                    $("#eduName").val("");
                                                                    requestEdu();
                                                                    $.sweetModal({
                                                                    content: 'Educational Level Added',
                                                                    icon: $.sweetModal.ICON_SUCCESS
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
                                                                    content: 'Something happened while processing your Log In\nPlease try again later.',
                                                                    icon: $.sweetModal.ICON_WARNING
                                                                });
                                                            }.bind(this)
                                                        });  
                                                        

                                                    }

                                                    $(".loaderCont").css("display", "");
                                                    $(".addText").css("display", "inline");
                                                    return false;
                                                    });  





                                                                $("#indAdder").submit(function(){


                                                                        $(".addText").css("display", "none");
                                                                        $(".loaderCont").css("display", "inline");
                                                                        var subName = $("#indName").val();

                                                                        if(subName == ""){

                                                                            $.sweetModal({
                                                                                        content: 'Both fields are compulsory',
                                                                                        icon: $.sweetModal.ICON_WARNING
                                                                                    });
                                                                        }
                                                                        else{

                                                                            var locationPostData = "subName="+subName+"&action=26";
                                                                            $.ajax({ 
                                                                                type:"POST",
                                                                                url:"Manage-Ind",
                                                                                data: locationPostData, 
                                                                                contentType: 'application/x-www-form-urlencoded',
                                                                                success: function(res) {
                                                                                    var serverResponse = JSON.parse(res);
                                                                                    if(serverResponse.response == "success"){

                                                                                        $("#indName").val("");
                                                                                        requestInd();
                                                                                        $.sweetModal({
                                                                                        content: 'Industry Catgegory Added',
                                                                                        icon: $.sweetModal.ICON_SUCCESS
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
                                                                                        content: 'Something happened while processing your Log In\nPlease try again later.',
                                                                                        icon: $.sweetModal.ICON_WARNING
                                                                                    });
                                                                                }.bind(this)
                                                                            });  
                                                                            

                                                                        }

                                                                        $(".loaderCont").css("display", "");
                                                                        $(".addText").css("display", "inline");
                                                                        return false;
                                                                        });  

                


                                        $("#aOpeningAdder").submit(function(){
                                            $(".addText").css("display", "none");
                                            $(".loaderCont").css("display", "inline");
                                            var jobTitle = $("#jobTitle").val();
                                            var jobSubID = $("#subsidiary").val();
                                            var jobLocID = $("#location").val();
                                            var duration = $("#duration").val();
                                            var jobDesc1 = encodeURIComponent(CKEDITOR.instances['jobDesct'].getSnapshot());
                                            var jobResp1 = encodeURIComponent(CKEDITOR.instances['jobRespt'].getSnapshot());
                                            var jobReq1 = encodeURIComponent(CKEDITOR.instances['jobReqt'].getSnapshot());

                                            if(jobTitle == "" || jobSubID == "" || jobLocID == "" || jobDesc1 == "" || jobResp1 == ""  || jobReq1 == "")
                                            {
                                                $.sweetModal({
                                                            content: 'All fields are compulsory',
                                                            icon: $.sweetModal.ICON_WARNING
                                                        });
                                            }
                                            else
                                            {
                                                var locationData = "jobTitle="+jobTitle+"&jobSubID="+jobSubID+"&jobLocID="+jobLocID+"&jobDesc="+jobDesc1+"&jobResp="+jobResp1+"&jobReq="+jobReq1+"&duration="+duration+"&action=29";
                                               
                                               
                                                $.ajax({ 
                                                    type:"POST",
                                                    url:"Add-Opening",
                                                    data: locationData, 
                                                    contentType: 'application/x-www-form-urlencoded',
                                                    success: function(res) {
                                                        var serverResponse = JSON.parse(res);
                                                        if(serverResponse.response == "success"){

                                                            
                                                            $.sweetModal({
                                                            content: 'Job Opening successfully Added',
                                                            icon: $.sweetModal.ICON_SUCCESS
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
                                                            content: 'Something happened while processing your Log In\nPlease try again later.',
                                                            icon: $.sweetModal.ICON_WARNING
                                                        });
                                                    }.bind(this)
                                                });
                                               
                                               
                                                $.sweetModal({
                                                            content: "We are good to go",
                                                            icon: $.sweetModal.ICON_SUCCESS
                                                });

                                                    
                                            }
                                           /* if(jobTitle == "" || jobSubID == "" || jobLocID == "" || jobDesc1 == "" || jobResp1 == "" || jobReq1 == ""){

                                                $.sweetModal({
                                                            content: 'All fields are compulsory',
                                                            icon: $.sweetModal.ICON_WARNING
                                                        });
                                            }
                                            else{

                                                var locationPostData = "jobTitle="+jobTitle+"&jobSubID="+jobSubID+"&jobLocID="+jobLocID+"&jobDesc="+jobDesc+"&jobResp="+jobResp+"&jobReq="+jobReq+"&action=29";
                                                console.log("hi we there");
                                                
                                                

                                                $.ajax({ 
                                                    type:"POST",
                                                    url:"Add-Opening",
                                                    data: locationPostData, 
                                                    contentType: 'application/x-www-form-urlencoded',
                                                    success: function(res) {
                                                        var serverResponse = JSON.parse(res);
                                                        if(serverResponse.response == "success"){

                                                            
                                                            $.sweetModal({
                                                            content: 'Job Opening successfully Added',
                                                            icon: $.sweetModal.ICON_SUCCESS
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
                                                            content: 'Something happened while processing your Log In\nPlease try again later.',
                                                            icon: $.sweetModal.ICON_WARNING
                                                        });
                                                    }.bind(this)
                                                }); 

                                                
                                                

                                            }*/

                                            $(".loaderCont").css("display", "");
                                            $(".addText").css("display", "inline");

                                            event.preventDefault();
                                            });  




        
        //get selected row
       /* $("#bbb").click(function(){
        
            alert(locationTable.rows('.selected').data().length + ' row(s) selected');
        });*/


        CKEDITOR.replace( 'jobDesct' );
        CKEDITOR.replace( 'jobRespt' );
        CKEDITOR.replace( 'jobReqt' );

        $('.crm_body_bg').ready(
            function(){
                }
        );

        
    
        
    });


</script>

</body>
</html>