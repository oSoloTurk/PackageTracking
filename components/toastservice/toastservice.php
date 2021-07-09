
<?php
    if(isset($_GET["msg"])) {
        print('<div id="toastBar"></div>');
        include("languages/$languageCode/toast.php");
        print('<script src="components/toastservice/toastservice.js"></script>');
        print('<script>toastMessage("'.$GLOBALS['TOAST'][strtoupper($_GET['msg'])].'");</script>');    
    }
?>