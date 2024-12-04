<?php
/*
router library configuration @ugoabuchi
 */
define("ug_default_main_uri", $_SERVER['REQUEST_URI']);
define("ug_https_security", false);
define("ug_default_link", "WebApp/Career/index.php");
define("ug_404_link", "WebApp/404/index.php");

class router_lib_config{

    private $links = array();

    function __construct()
    {
        $this->links = 
        array(

            //home links
             "WebApp/Career/index.php" => "",
             "WebApp/Career/index.php" => "Career",
             "WebApp/Career/jobApply.php" => "job-apply",
             "WebApp/Career/talenthunt.php" => "talent-hunt",
             "WebApp/HR/login.php" => "HR-Login",
             "WebApp/HR/logout.php" => "HR-Logout",
             "WebApp/HR/index.php" => "HR-Dashboard",
             "WebApp/HR/location.php" => "Manage-Locations",
             "WebApp/HR/reference.php" => "Manage-Ref",
             "WebApp/HR/subsidiary.php" => "Manage-Sub",
             "WebApp/HR/eduLevel.php" => "Manage-Edu",
             "WebApp/HR/indcategory.php" => "Manage-Ind",
             "WebApp/HR/addOpening.php" => "Add-Opening",
             "WebApp/HR/qapplication.php" => "Query-Application",
             "WebApp/HR/talentHunt.php" => "Query-Talent-Hunt",
             "WebApp/HR/qopenings.php" => "Query-Openings",
             "WebApp/HR/emailtester.php" => "Test-Email",
             "WebApp/404/index.php" => "404",
             "WebApp/App/API.php" => "API_REQUEST",
             "WebApp/MD/index.php" => "a092e711d12148d73ec4cc0891364731",
             "WebApp/MD/dphllagos.php" => "Query-DPHL-LAGOS",
             "WebApp/MD/dphlibadan.php" => "Query-DPHL-IBADAN",
             "WebApp/MD/dphlminna.php" => "Query-DPHL-MINNA",
             "WebApp/MD/dgc.php" => "Query-DGC",
             "WebApp/MD/dpll.php" => "Query-DPLL"

        );
    }

    public function getLinks()
    {
        return $this->links;
    }

    public function getDefaultMainURI()
    {
        return ug_default_main_uri;
    }

    public function getHTPSSecurity()
    {
        return ug_https_security;
    }

    public function getDefaultLink()
    {
        return ug_default_link;
    }

    public function getDefault404()
    {
        return ug_404_link;
    }
}
