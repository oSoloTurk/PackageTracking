<?php 

  include("languages/$languageCode/footer.php");
  if(!$_SESSION['mobile']) include("components/footer/footer_desktop.php");
  else include("components/footer/footer_mobile.php");  

  echo "<script>feather.replace();</script>";
  echo '<script src="scripts/footer.js"></script>';

?>