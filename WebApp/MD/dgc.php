<?php
$jobOpeningsIsActive = "mm-active";
$addDGC = "active";
require "WebApp/MD/header.php";
?>


<h1>HR REPORT <?php echo date("Y");?> - DGC</h1>


<br/><br/>
    <br/><br/>

<div id="chart1" style="width: 700px;"></div>





<?php
require "WebApp/MD/footer.php";
?>

<script>

jQuery(document).ready(function() {
    getAttritionTableData(5);
 });


</script>