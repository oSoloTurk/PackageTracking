<?php
if(isset($_POST['emailForm']) && isset($_POST['newmail'])) {
    $result = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_ID'], "i", $_SESSION['id']);
    $data = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) != 1) sendToPage("profil.php?tab=btn-email&msg=manipulation");
    else {
        if($data['email'] != $_POST['newmail']) {
            executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_USER_EMAIL_WITH_ID'], "si", $_POST['newmail'], $_SESSION['id']);
        }
        sendToPage('profil.php?tab=btn-email&msg=success');
    }
}
?>
<div class="float-child">
    <p class="fs-3"><?php echo $GLOBALS['messages_article']['EMAIL_TITLE'] ?></p>
    <form class="ml-2" method="POST" action="profil.php?tab=btn-email">
        <fieldset disabled>
            <div class="form-group">
                <label for="formGroupEmailInput"><?php echo $GLOBALS['messages_article']['EMAIL_ENTER_EMAIL'] ?></label>
                <input name="email" id="formGroupEmailInput" type="text" class="form-control" value="<?php echo $data['email'] ?>" required>
            </div>
        </fieldset>
        <div class="form-group">
            <label for="formGroupNewMailInput"><?php echo $GLOBALS['messages_article']['EMAIL_ENTER_NEW_EMAIL'] ?></label>
            <input name="newmail" id="formGroupNewMailInput" type="text" class="form-control" required>
            <small class="form-text text-muted deactive" id="vld-email-email">
                <span class="text-danger">X</span> <?php echo $GLOBALS['messages_article']['EMAIL_INVALID_EMAIL'] ?>
            </small>
        </div>
        <input name="emailForm" class="btn theme-button-success" type="submit" value="<?php echo $GLOBALS['messages_article']['OK'] ?>"/>   
    </form>
</div>
<script src="components/profile/email-tab.js"></script>
