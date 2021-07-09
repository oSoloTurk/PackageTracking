<?php
if (isset($_POST['password']) && isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['newAgainPassword'])) {
	$currentPassword = htmlspecialchars($_POST['currentPassword'], ENT_QUOTES, 'utf-8');
	$newPassword = htmlspecialchars($_POST['newPassword'], ENT_QUOTES, 'utf-8');
	$newAgainPassword = htmlspecialchars($_POST['newAgainPassword'], ENT_QUOTES, 'utf-8');
	$pwd = hash('sha256', htmlspecialchars($currentPassword, ENT_QUOTES, 'utf-8'));
	$data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_USER_WITH_ID_AND_PASSWORD'], "is", $_SESSION['id'], $pwd);

	if ($newPassword == $newAgainPassword) {
		if ($data->num_rows == 1) {
			$npwd = hash('sha256', htmlspecialchars($newPassword, ENT_QUOTES, 'utf-8'));
			executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_USER_PASSWORD'], "si", $npwd, $_SESSION['id']);
			$URL = 'profil.php?tab=btn-password&msg=success';
		} else $URL = "profil.php?tab=btn-password&msg=old_password";
	} else $URL = "profil.php?tab=btn-password&msg=manipulation";
	sendToPage($URL);
}
?>
<div class="float-child">
    <p class="fs-3"><?php echo $GLOBALS['messages_article']['PASSWORD_TITLE'] ?></p>
    <form class="ml-2" method="post">
        <div class="form-group">
            <label for="formGroupCurrentPasswordInput"><?php echo $GLOBALS['messages_article']['PASSWORD_ENTER_CURRENT'] ?></label>
            <input name="currentPassword" id="formGroupCurrentPasswordInput" type="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="formGroupNewPasswordInput"><?php echo $GLOBALS['messages_article']['PASSWORD_ENTER_NEW'] ?></label>
            <input name="newPassword" id="formGroupNewPasswordInput" type="password" class="form-control" required>
            <small class="form-text text-muted deactive" id="vld-password-match">
                <span class="text-danger">X</span> <?php echo $GLOBALS['messages_article']['PASSWORD_TIPS_1'] ?><br/>
            </small>
            <small class="form-text text-muted deactive" id="vld-password-length">
                <span class="text-danger">X</span>  <?php echo $GLOBALS['messages_article']['PASSWORD_TIPS_2'] ?><br/>
            </small>
            <small class="form-text text-muted deactive" id="vld-password-char">
                <span class="text-danger">X</span>  <?php echo $GLOBALS['messages_article']['PASSWORD_TIPS_3'] ?><br/>
            </small>
        </div>
        <div class="form-group">
            <label for="formGroupNewPasswordAgainInput"><?php echo $GLOBALS['messages_article']['PASWORD_ENTER_NEW_AGAIN'] ?></label>
            <input name="newAgainPassword" id="formGroupNewPasswordAgainInput" type="password" class="form-control" required>
        </div>
        <?php include("components/modals/profil_password.php"); ?>
    </form>
    <button type="button" class="btn theme-button mt-3" id="btn-password" data-bs-toggle="modal" data-bs-target="#savePassword">
        <?php echo $GLOBALS['messages_article']['OK'] ?>
    </button>
</div>
<script src="components/profile/password-tab.js"></script>
