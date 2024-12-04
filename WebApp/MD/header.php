
<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Dana Group - Career Portal</title>
<link rel="icon" href="WebApp/HR/img/DGC-logo.png" type="image/png">

<link rel="stylesheet" href="WebApp/HR/css/bootstrap1.min.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/themefy_icon/themify-icons.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/swiper_slider/css/swiper.min.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/select2/css/select2.min.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/niceselect/css/nice-select.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/owl_carousel/css/owl.carousel.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/gijgo/gijgo.min.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/font_awesome/css/all.min.css" />
<link rel="stylesheet" href="WebApp/HR/vendors/tagsinput/tagsinput.css" />



<link rel="stylesheet" type="text/css" href="WebApp/HR/jqpilot/jquery.jqplot.css" />


<link rel="stylesheet" href="WebApp/HR/vendors/datatable/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="WebApp/HR/vendors/text_editor/summernote-bs4.css" />

<link rel="stylesheet" href="WebApp/HR/vendors/morris/morris.css">

<link rel="stylesheet" href="WebApp/HR/vendors/material_icon/material-icons.css" />

<link rel="stylesheet" href="WebApp/HR/css/metisMenu.css">
<link rel="stylesheet" href="WebApp/HR/css/jquery.sweet-modal.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.css" integrity="sha512-BDStKWno6Ga+5cOFT9BUnl9erQFzfj+Qmr5MDnuGqTQ/QYDO1LPdonnF6V6lBO6JI13wg29/XmPsufxmCJ8TvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="WebApp/HR/css/style1.css" />
<link rel="stylesheet" href="WebApp/HR/css/colors/default.css" id="colorSkinCSS">

<style>
    @keyframes spinner {
    to {transform: rotate(360deg);}
    }


    a.active {
        color: #2F3390 !important;
    }
    .menu-head{
        color: #2F3390 !important;
    }
    .logo{
        background-color: #FFFFFF !important;
        justify-content: center !important;
    }
  

    .crm_body_bg{
        overflow: auto;
    }
    .loderContentBox{
        display: none;
        background-color: #EFF1F7; 
        height: 300px; 
        position: relative;
        margin-top: 50px;
        margin-bottom: 50px;
        padding: 10px;
        align-content: center;
    }
    
    .loderContentBox:before {
    content: '';
    box-sizing: border-box;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 30px;
    height: 30px;
    margin-top: -15px;
    margin-left: -15px;
    border-radius: 50%;
    border: 1px solid #ccc;
    border-top-color: #EE2326;
    animation: spinner .6s linear infinite;
    }
    #loaderTextWait{
        text-align: center;
        margin-top: 65px;
        font-family:poppins,sans-serif;
        font-weight: bold;

    }
        .barfiller{
        margin-top: 25px;
    }

</style>
</head>
<body class="crm_body_bg">



<nav class="sidebar">
<div class="logo d-flex justify-content-between">
<a href="a092e711d12148d73ec4cc0891364731"><img src="WebApp/HR/img/DGC-logo.png" alt></a>
<div class="sidebar_close_icon d-lg-none">
<i class="ti-close"></i>
</div>
</div>
<ul id="sidebar_menu">



<li><a class="<?php echo isset($statisticsIsActive) ? $statisticsIsActive : ""; ?>" href="a092e711d12148d73ec4cc0891364731">
<img src="WebApp/HR/img/dashboards.png" width="20px" height="20px" alt>
<span class="menu-head">Recruitement Stat</span>
</a></li>

<li class="<?php echo isset($jobOpeningsIsActive) ? $jobOpeningsIsActive : ""; ?>">
<a class="has-arrow" href="#" aria-expanded="false">
<img src="WebApp/HR/img/opening.png" width="20px" height="20px" alt>
<span class="menu-head">Attrition Report</span>
</a>
<ul>
<li><a class="<?php echo isset($addDPHL) ? $addDPHL : ""; ?>" href="Query-DPHL-LAGOS">DPHL - LAGOS</a></li>
<li><a class="<?php echo isset($adddphliba) ? $adddphliba : ""; ?>" href="Query-DPHL-IBADAN">DPHL - IBADAN</a></li>
<li><a class="<?php echo isset($adddphlmin) ? $adddphlmin : ""; ?>" href="Query-DPHL-MINNA">DPHL - MINNA</a></li>
<li><a class="<?php echo isset($addDGC) ? $addDGC : ""; ?>" href="Query-DGC">DGC</a></li>
<li><a class="<?php echo isset($adddpll) ? $adddpll : ""; ?>" href="Query-DPLL">DPLL</a></li>
</ul>
</li>


</ul>
</nav>




<section class="main_content dashboard_part">



<div class="loderContentBox">

<p id="loaderTextWait">Please Wait...</p>

</div><!--Table Loader close div-->


<div class="main_content_iner">
<div class="container-fluid p-0">
<div class="row justify-content-center">






