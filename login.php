<?php

include("connection/session.php");
if (hasRole("LOGIN")) header("Location:index.php?msg=logged", true, 301);

?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="lib/bootstrap.min.css" />
  <link rel="stylesheet" href="styles/theme.css">
  <link rel="stylesheet" href="styles/login.css" />
</head>

<body>

  <?php 
  include("header.php");
  if (isset($_POST['submit'])) {
    $mail = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
    $pwd = hash('sha256', htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'));
    $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_EMAIL_AND_PASSWORD'], "ss", $mail, $pwd);
    
    if ($data->num_rows == 1) {
      $userData = mysqli_fetch_array($data);
      $access_hash = hash('sha256', $mail);

      $_SESSION['token'] = $access_hash;
      $_SESSION['id'] = $userData['id'];
      $_SESSION['username'] = $userData['username'];
      
      $insert = executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_ACCESS_TOKEN'], "iss", $userData['id'], $access_hash, $access_hash);

      if (isset($_POST['remember']) && (($_POST['remember'] == 1) || ($_POST['remember'] == 'on'))) {
        setcookie("token", $access_hash, time() + 3600 * 24 * 365, '/');
        setcookie("id", $userData['id'], time() + 3600 * 24 * 365, '/');
      }
      sendToPage("index.php?msg=logged");
    } else {
      sendToPage("login.php?msg=wrong_input");
    }
  } ?>

  <article>
    <div class="container-md">
      <p class="display-5 text-center" id="page-title"><?php echo $GLOBALS['messages_article']['TITLE']; ?></p>
      <div class="row d-flex justify-content-around">
        <div class="col-md-1"></div>
        <img src="images/login.png" class="col-md-6 image" />
        <div class="col-md-5 align-self-center">
          <form class="col-md-5" method="post" id="login_form">
            <div class="form-group mb-2">
              <label for="formGroupEmailInput"><?php echo $GLOBALS['messages_article']['EMAIL']; ?></label>
              <input name="email" id="formGroupEmailInput" type="text" class="form-control" required />
              <small class="form-text text-muted deactive" id="vld-email"><span class="text-danger">X</span> <?php echo $GLOBALS['messages_article']['INVALID_EMAIL']; ?></small>
            </div>
            <div class="form-group">
              <label for="formGroupPasswordInput"><?php echo $GLOBALS['messages_article']['PASSWORD']; ?></label>
              <input name="password" id="formGroupPasswordInput" type="password" class="form-control" required />
              <small class="form-text text-muted deactive" id="vld-password-length"><span class="text-danger">X</span> <?php echo $GLOBALS['messages_article']['INVALID_PASSWORD_LENGTH']; ?></small><br />
              <small class="form-text text-muted deactive" id="vld-password-char"><span class="text-danger">X</span> <?php echo $GLOBALS['messages_article']['INVALID_PASSWORD_LETTER']; ?></small>
            </div>
            <div class="form-check mb-3">
              <input name="remember" type="checkbox" class="form-check-input" />
              <label><?php echo $GLOBALS['messages_article']['REMEMBER']; ?></label>
            </div>
            <div class="row">
              <input name="submit" class="btn theme-button-success disabled col-md-5" type="submit" value="<?php echo $GLOBALS['messages_article']['LOGIN']; ?>" id="btn-login" />
              <span class="col-md-1"></span>
              <a href="forgot.php" class="btn theme-button-warning col-md-5"><?php echo $GLOBALS['messages_article']['FORGOT']; ?></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </article>

  <?php include("footer.php"); ?>

  <script src="scripts/login.js"></script>
  <script src="lib/bootstrap.bundle.min.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>