<?php

if (isset($_POST['submit'])) {
	if ($_POST['submit'] == "download") {
		ob_end_clean();
		$file = "personeldata.json";
		$fileStream = fopen($file, "w") or die($GLOBALS['messages_article']['UNABLE_OPEN']);
		$result = "{";
		foreach ($data as $key => $value) {
			if (is_numeric($key)) continue;
			if ($key == "permissions") {
				foreach ($GLOBALS['roles'] as $role_name => $role_id) {
					$value = str_replace($value, $role_id, $role_name);
				}
			}
			if ($result == "{\n\t") $result = "$result\"$key\":\"$value\"";
			else $result = "$result\n\t\"$key\":\"$value\"";
		}
		$result = "$result\n}";
		fwrite($fileStream, $result);
		fclose($fileStream);
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename=' . basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		header("Content-Type: text/plain");
		readfile($file);
		ignore_user_abort(true);
		unlink($file);
        exit;
	} else if ($_POST['submit'] == "delete") {
		$result = executeQuery($GLOBALS['SQL_COMMANDS']['DELETE_USER'], "i", $_SESSION['id']);
		unset($_POST);
		if (!$result) $URL = 'index.php?msg=success';
		else $URL = 'profil.php?tab=btn-data&msg=error';
		sendToPage($URL);
	}
}

?>

<div class="float-child">
    <p class="fs-5"><?php echo $GLOBALS['messages_article']['DATA_TITLE'] ?></p>
    <p class="fs-6"><?php echo $GLOBALS['messages_article']['DATA_TEXT_ONE'] ?></p>
    <p class="fs-6">
        <b><?php echo $GLOBALS['messages_article']['DATA_TEXT_TWO'] ?></b>
    </p>
    <div class="btn-group-horizontal">
        <form method="post">
            <?php
            if (hasRole("PROFILE_CLEAR_SELF_DATAS")) {
                echo '<button type="submit" name="submit" value="download" class="btn theme-button-success mt-1 mb-1">'.$GLOBALS['messages_article']['DOWNLOAD'].'</button>';
            }

            if (hasRole("PROFILE_DOWNLOAD_SELF_DATAS") && $_SESSION['id'] != 0) {
                echo '<button type="submit" name="submit" value="delete" class="btn btn-danger mt-1 mb-1">'.$GLOBALS['messages_article']['DELETE'].'</button>';
            }
            ?>
        </form>
    </div>
</div>
