<?php 
  
  include("connection/session.php");


  if(isset($_GET['vehicle'])) {
    $sourceData = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_VEHICLE_WITH_ID'], "i", $_GET['vehicle']);
    if($sourceData->num_rows != 1) $URL = 'vehicles.php?msg=error';
    else {
      $error = false;
      $data = mysqli_fetch_array($sourceData);
              
        try {
          executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_NEW_REPORT'], "ssssi", $data['over_items'], $data['name'], date("H:i:s"), date("Y/m/d"), $data['total_price']);
          executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_VEHICLE_OVERS'], "ssssi", NULL, NULL, NULL, NULL, $_GET['vehicle']);
        } catch (Exception $e) {
          $error = true;  
        } 
        
        if($error) $URL = 'vehicles.php?msg=error';
        else $URL = 'vehicles.php?msg=success';
    }
    if (headers_sent()) echo ("<script>location.href='$URL'</script>");
    else header("Location: $URL");
    exit;

    
  }
