<?php

include("connection/session.php");
if (!hasRole("USERS_DETAILS")) header("Location:index.php?msg=permission", true, 301);
?>
<html>

<head>
  <link rel="stylesheet" href="lib/bootstrap.min.css">
  <link rel="stylesheet" href="styles/usercard.css">
  <link rel="stylesheet" href="styles/theme.css">
</head>

<body>

  <?php

  include("header.php");

  if (isset($_GET['query_token'])) {
    $hash = $_GET['query_token'];
    $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_QUERY_TOKENS_FROM_HASH'], "s", $hash)->fetch_array();
    $targetId = $data['target_id'];
    $callerId = $data['caller_id'];
    $date = date("Y/m/d - H:i:s");
    if ($_SESSION['id'] != $callerId) header("index.php?msg=error", true, 301);
  } else header("index.php?msg=error", true, 301);
  
  
  if ($targetId == -1) {
    $data['email'] = "email@email.com";
    $data['username'] = "@username";
    $data['email_confirmed'] = 0;
    $data['permissions'] = "";
    $data['phone'] = "@phone";
  } else {
    if ($targetId != $callerId) executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_ACTION'], "iiis", $callerId, $targetId, 1, $date);
    $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_ID'], "i", $targetId)->fetch_array();
  }
  
  if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "save") {
      $passwordMode = false;
      if (isset($_POST['targetPassword']) && $_POST['targetPassword'] != "") {
        $hash_self = hash('sha256', $_POST['selfPassword']);
        if (executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_ID_AND_PASSWORD'], "ii", $callerId, $hash_self)->num_rows != 1) {
          sendToPage("http" . (isset($_SERVER['HTTPS']) ? 's' : '') . "://" . $_SERVER['HTTP_HOST'] . "/" . $_SERVER['REQUEST_URI'] . "&msg=selfpassword");
          exit;
        } else $passwordMode = true;
      }
      $permissions = "-";
      foreach ($GLOBALS['roles'] as $role => $id) {
        if (isset($_POST['input-' . $id . ''])) $permissions = "$permissions$id-";
      }
      switch ($_POST['emailChecked']) {
        case $GLOBALS['messages_article']['CHECKED']:
          $emailChecked = 1;
          break;
        case $GLOBALS['messages_article']['UNCHECKED']:
          $emailChecked = 0;
          break;
        case $GLOBALS['messages_article']['CHECKING']:
          $emailChecked = 2;
          break;
        default:
          $emailChecked = 0;
      }
      if ($targetId == -1) {
        $hash_target = hash('sha256', $_POST['targetPassword']);
        $result = executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_NEW_USER'], "ssisss", $_POST['username'], $_POST['email'], $emailChecked, $hash_target, $permissions,$_POST['phone']);
      } else if ($targetId != 0 || ($targetId == 0  && 0 == $callerId)) {
        $hash_target = hash('sha256', $_POST['targetPassword']);
        executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_ACTION'], "iiis", $callerId, $targetId, 3, $date);
        if ($passwordMode) $result = executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_USER_DETAILS_WITH_PASSWORD'], "ssssssi",$_POST['username'], $_POST['email'], $hash_target, $_POST['phone'], $emailChecked, $permissions, $targetId);
        else $result = executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_USER_DETAILS_WITHOUT_PASSWORD'], "sssssi",$_POST['username'], $_POST['email'], $_POST['phone'], $emailChecked, $permissions, $targetId);
      }
      if (isset($result)) {
        if ($targetId == -1) {
          $newUserId = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_EMAIL'], "s", $_POST['email'])->fetch_array()['id'];
          executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_ACTION'], "iiis", $callerId, $newUserId, 2, $date);
        }
        unset($_POST);
        echo "<script>window.open('','_self').close();</script>";
        exit;
      } else sendToPage("http" . (isset($_SERVER['HTTPS']) ? 's' : '') . "://" . $_SERVER['HTTP_HOST'] . "/" . $_SERVER['REQUEST_URI'] . "&msg=error");
    }

    if ($_POST['submit'] == "delete") {
      if ($targetId != 0) {
        executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_ACTION'], "iiis", $callerId, $targetId, 4, $date);
        executeQuery($GLOBALS['SQL_COMMANDS']['DELETE_USER'], "i", $targetId);
      }
      echo "<script>window.open('','_self').close();</script>";
      exit;
    }
  }

  ?>

  <article>
    <div class="container">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <div class="container d-flex justify-content-between">
              <i data-feather="chevron-left" onclick="window.open('','_self').close();" class="align-self-center" style="height: 6%;width: 6%;"></i>
              <i data-feather="user" style="height: 10%;width: 10%;"></i>
              <img />
            </div>
          </div>
          <div class="modal-body">
            <form method="post" id="user_informations">
              <div class="row">
                <div class="col-6 form-group">
                  <label for="usernameInput"><?php echo $GLOBALS['messages_article']['USERNAME'] ?></label>
                  <?php
                  printf('
                    <input name="username" id="usernameInput" type="text" class="form-control input-group-text" value="%s">', $data['username']);
                  ?>
                </div>
                <div class="col-6 form-group">
                  <label for="emailInput"><?php echo $GLOBALS['messages_article']['EMAIL'] ?></label>
                  <?php
                  printf('
                    <input name="email" id="emailInput" type="text" class="form-control input-group-text" value="%s" %s>', $data['email'], $targetId == -1 ? "required" : "");
                  ?>
                </div>
              </div>
              <div class="row">
                <div class="col-6 form-group">
                  <label for="phoneInput"><?php echo $GLOBALS['messages_article']['PHONE'] ?></label>
                  <?php
                  printf('
                    <input name="phone" id="phoneInput" type="text" class="form-control input-group-text" value="%s" %s>', $data['phone'], $targetId == -1 ? "required" : "");
                  ?>
                </div>
                <div class="col-6">
                  <label for="emailCheck"><?php echo $GLOBALS['messages_article']['EMAIL_STATUS'] ?></label>
                  <?php
                  printf('
                    <select name="emailChecked" id="emailCheck" type="text" class="form-control input-group-text form-select"> %s', $targetId == -1 ? "required" : "");
                  ?>
                  <option <?php if($data['email_confirmed'] == 1){echo("selected");}?>><?php echo $GLOBALS['messages_article']['CHECKED'] ?></option>
                  <option <?php if($data['email_confirmed'] == 0){echo("selected");}?>><?php echo $GLOBALS['messages_article']['UNCHECKED'] ?></option>
                  <option <?php if($data['email_confirmed'] == 2){echo("selected");}?>><?php echo $GLOBALS['messages_article']['CHECKING'] ?></option>
                  </select>
                </div>
              </div>
              <hr class="mt-3" />
              <div class="row">
                <div class="col-6 form-group">
                  <label for="usernameInput"><?php echo $GLOBALS['messages_article']['PASSWORD'] ?></label>
                  <?php
                  printf('<input name="targetPassword" id="targetPassword" type="password" class="form-control input-group-text" %s>', $targetId == -1 ? "required" : "");
                  if ($targetId != -1) printf('<small class="form-text text-muted"><span class="text-warning">?</span>' . $GLOBALS['messages_article']['USER_PASSWORD_WARN_1'] . '</small><br>');
                  else printf('<small class="form-text text-muted"><span class="text-warning">?</span>' . $GLOBALS['messages_article']['USER_PASSWORD_WARN_2'] . '</small><br>');
                  ?>
                </div>
                <div class="col-6 form-group">
                  <label for="usernameInput"><?php echo $GLOBALS['messages_article']['SELF_PASSWORD'] ?></label>
                  <input name="selfPassword" id="selfPassword" type="password" class="form-control input-group-text">
                  <?php
                  if ($targetId == -1) printf('<small class="form-text text-muted deactive"><span class="text-warning">?</span> ' . $GLOBALS['messages_article']['SELF_PASSWORD_WARN_1'] . '</small>');
                  else printf('<small class="form-text text-muted"><span class="text-warning">?</span>' . $GLOBALS['messages_article']['SELF_PASSWORD_WARN_2'] . '</small>');
                  ?>
                </div>
              </div>
              <div class="table-height">
                <table class="table table-hover mt-4 text-center mw-50">
                  <thead>
                    <th class="col-1"><?php echo $GLOBALS['messages_article']['GIVE_PERM'] ?></th>
                    <th class="col-1"><?php echo $GLOBALS['messages_article']['PERMISSION'] ?></th>
                    <th class="col-1"><?php echo $GLOBALS['messages_article']['GAINS'] ?></th>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($GLOBALS['roles'] as $role => $id) {
                      printf('
                        <tr name="data-row">
                            <td class="col-2">
                            <input type="checkbox" class="selectNode" name="input-%s" id="input-%s" %s/>
                            </td>
                            <td class="col-2">%s</td>
                            <td class="col-2">%s</td>
                        </tr>
                        ', $id, $id, (strpos($data['permissions'], "-$id-") !== false ? "checked" : ""), $id, $GLOBALS['gains'][$id]);
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-center">
            <?php
            if (hasRole("USERS_DELETE")) printf('<button type="submit" form="user_informations" name="submit" value="delete" class="btn theme-button-error">' . $GLOBALS['messages_article']['DELETE'] . '</button>');
            ?>
            <button type="button" onclick="window.open('','_self').close();" class="btn theme-button-warning" data-bs-dismiss="modal"><?php echo $GLOBALS['messages_article']['CANCEL'] ?></button>
            <?php
            if (hasRole("USERS_EDIT")) printf('<button type="submit" id="submit" form="user_informations" name="submit" value="save" class="btn theme-button-success">' . $GLOBALS['messages_article']['SAVE'] . '</a>');
            ?>
          </div>
        </div>
      </div>
    </div>

  </article>

  <?php include("footer.php"); ?>
  <script src="scripts/usercard.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>