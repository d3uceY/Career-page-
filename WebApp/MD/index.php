
<?php 
$statisticsIsActive = "active";
$dbInstance = new database("dana-career");
require "WebApp/MD/header.php"; ?>

<style>
.single_quick_activity::before{
    background-color:  transparent !important;
    z-index: -1000;
}


</style>

<div class="col-lg-12">
<div class="single_element">
<div class="quick_activity">
<div class="row">
<div class="col-12">
<div class="quick_activity_wrap">

<div class="single_quick_activity d-flex">
<div class="icon">
<img src="WebApp/HR/img/suitcase.png" alt>
</div>
<a href="#" class="count_content">
<h3><span class="counter"><?php echo $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-opening` WHERE 1"); ?></span> </h3>
<p>Open Positions</p><br>
<ul>
  
<?php

$getOpeningsDBInst = $dbInstance->execute_return("SELECT * FROM `job-opening` WHERE 1 ORDER BY id DESC LIMIT 5");

foreach($getOpeningsDBInst as $key=>$gODB){

    echo '<li style="list-style: square outside none; font-family:rajdhani,sans-serif;">'.$gODB['title'].'</li>';
}

?>

</ul>
</a>
</div>


<div class="single_quick_activity d-flex">
<div class="icon">
<img src="WebApp/HR/img/resume.png" alt>
</div>
<a href="#" class="count_content">
<h3><span class="counter"><?php echo $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE status='NEW'"); ?></span> </h3>
<p>New Application</p><br>
<ul>
  
<?php

$getOpeningsDBInst = $dbInstance->execute_return("SELECT * FROM `job-opening` WHERE 1 ORDER BY id DESC LIMIT 5");

foreach($getOpeningsDBInst as $key=>$gODB){

    $jobID = $gODB['id'];
    $jCount = $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE `job-id`='$jobID' AND `status`='NEW'");
    echo '<li style="list-style: square outside none; font-family:rajdhani,sans-serif;">'.$gODB['title'].': '.$jCount.'</li>';
}

?>

</ul>
</a>
</div>
<div class="single_quick_activity d-flex">
<div class="icon">
<img src="WebApp/HR/img/all.png" alt>
</div>
<a href="#" class="count_content">
<h3><span class="counter"><?php echo $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE 1"); ?></span> </h3>
<p>Total Applications</p><br>
<li style="list-style: square outside none; font-family:rajdhani,sans-serif;">New: <?php echo $dbInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='NEW'") > 0 ? $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='NEW'") : 0;  ?></li>
<li style="list-style: square outside none; font-family:rajdhani,sans-serif;">Accepted: <?php echo $dbInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='ACCEPTED'") > 0 ? $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='ACCEPTED'") : 0;  ?></li>
<li style="list-style: square outside none; font-family:rajdhani,sans-serif;">Shortlisted: <?php echo $dbInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='SHORTLISTED'") > 0 ? $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='SHORTLISTED'") : 0;  ?></li>
<li style="list-style: square outside none; font-family:rajdhani,sans-serif;">Rejected: <?php echo $dbInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='REJECTED'") > 0 ? $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='REJECTED'") : 0;  ?></li>
<li style="list-style: square outside none; font-family:rajdhani,sans-serif;">Pending: <?php echo $dbInstance->execute_count_no_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='PENDING'") > 0 ? $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE `status`='PENDING'") : 0;  ?></li>

</a>

</div>
<div style="background-color: #ffffff;align-content: center; text-align: center;">
<a href='#' class="btn" style="background-color:#EE2236;color:#FFFFFF;">Query Openings</a>
</div>
</div>
</div>
</div>
</div>
</div>





<div class="col-lg-12 col-xl-12">
<div class="white_box mb_30 ">
<div class="box_header border_bottom_1px  ">
<div class="main-title">
<h3 class="mb_25">Application Referrals</h3>
</div>
</div>
<div class="income_servay">
<div class="row">

<?php

$RefsData = $dbInstance->execute_return("SELECT `id`, `ref-name` FROM `ref-table`");
//die(print_r($RefsData));
if(is_array($RefsData) && count($RefsData) > 0)
{
//die(print_r($RefsData));
    for($i=0; $i<count($RefsData); $i++){

        $mRefID = $RefsData[$i]['id'];
        $mRefName = $RefsData[$i]['ref-name'];
        $refCounter = $dbInstance->execute_count_return("SELECT COUNT(*) FROM `job-apply` WHERE `ref-id`='$mRefID'");

        echo '
            <div class="col-md-3">
            <div class="count_content">
            <h3> <span class="counter">'.$refCounter.'</span> </h3>
            <p>'.$mRefName.'</p>
            </div>
            </div>
        ';
    }

}
else
{
    echo '
    
    
            <div class="col-md-3">
            <div class="count_content">
            <h3> <span class="counter">0</span> </h3>
            <p>LinkedIn</p>
            </div>
            </div>
            <div class="col-md-3">
            <div class="count_content">
            <h3><span class="counter">0</span> </h3>
            <p>Indeed</p>
            </div>
            </div>
            <div class="col-md-3">
            <div class="count_content">
            <h3><span class="counter">0</span> </h3>
            <p>Google</p>
            </div>
            </div>
            <div class="col-md-3">
            <div class="count_content">
            <h3><span class="counter">0</span> </h3>
            <p>Facebook</p>
            </div>
            </div>
            <div class="col-md-3">
            <div class="count_content">
            <h3><span class="counter">0</span> </h3>
            <p>Others</p>
            </div>
            </div>
    
    
    ';
}

?>


</div>
</div>
</div>
</div>


<div class="col-xl-6">
<div class="white_box mb_30">
<div class="box_header border_bottom_1px  ">
<div class="main-title">
<h3 class="mb_25">Recent Activity</h3>
</div>
</div>
<div class="activity_progressbar">
<div class="single_progressbar">
<h6>New Application</h6>
<div id="bar1" class="barfiller">
<div class="tipWrap">
<span class="tip"></span>
</div>
<span class="fill" data-percentage="0"></span>
</div>
</div>
<div class="single_progressbar">
<h6>Selected Application</h6>
<div id="bar2" class="barfiller">
<div class="tipWrap">
<span class="tip"></span>
</div>
<span class="fill" data-percentage="0"></span>
</div>
</div>
<div class="single_progressbar">
<h6>Shortlisted Application</h6>
<div id="bar3" class="barfiller">
<div class="tipWrap">
<span class="tip"></span>
</div>
<span class="fill" data-percentage="0"></span>
</div>
</div>
<div class="single_progressbar">
<h6>Rejected Application</h6>
<div id="bar4" class="barfiller">
<div class="tipWrap">
<span class="tip"></span>
</div>
<span class="fill" data-percentage="0"></span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php require "WebApp/HR/footer.php"; ?>