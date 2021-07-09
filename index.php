<?php 
  include("connection/session.php");
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="lib/bootstrap.min.css">
  <link rel="stylesheet" href="styles/index.css" />
  <link rel="stylesheet" href="styles/theme.css">
</head>

<body>

  <?php 
  require_once("header.php");

  printf('
    <article>
      <div class="container-md">
        <div class="d-flex justify-content-center">
          <i data-feather="arrow-right" style="width: 10em; height: 10em;"></i><i data-feather="box" style="width: 10em; height: 10em;"></i><i data-feather="arrow-right" style="width: 10em; height: 10em;"></i>
        </div>
        <p class="row text-center display-1"><b>'.$GLOBALS['messages_index']['WELCOME'].'</b></p>
        <p class="text-center">
        '.$GLOBALS['messages_index']['CREATED_TEXT'].'
          <a href="https://github.com/oSoloTurk">Hakkı Ceylan</a>
        </p>
      </div>
    </article>
  ');

  ?>

  <?php include("footer.php"); ?>

  <link href="lib/bootstrap.min.css" rel="stylesheet" />
  <script src="lib/bootstrap.bundle.min.js"></script>
  <script>feather.replace({width: '8em', height: '8em'});</script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>

