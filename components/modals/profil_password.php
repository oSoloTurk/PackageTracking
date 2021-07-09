<div class="modal" tabindex="-1" id="savePassword">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $GLOBALS['messages_article']['SAVE_CHANGES'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><?php echo $GLOBALS['messages_article']['PASSWORD_LOGOUT_TIP'] ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn theme-button-warning" data-bs-dismiss="modal"><?php echo $GLOBALS['messages_article']['CANCEL'] ?></button>
                <input name="password" class="btn theme-button-success" type="submit" value="<?php echo $GLOBALS['messages_article']['OK'] ?>">
            </div>
        </div>
    </div>
</div>