<?php

include("connection/session.php");

?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="lib/bootstrap.min.css" />
  <link rel="stylesheet" href="styles/theme.css">
  <link rel="stylesheet" href="styles/forgot.css" />
</head>

<body>

  <?php include("header.php"); ?>
  
  <?php

    if(isset($_GET["token"])) include "components/forgot/forgot_token.php";
    else include "components/forgot/forgot_me.php";

  ?>

  <?php include("footer.php"); ?>

  <script src="scripts/forgot.js"></script>
  <script src="lib/bootstrap.bundle.min.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>

