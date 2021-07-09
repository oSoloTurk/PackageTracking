<div class="modal" tabindex="-1" id="editOrCreate">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $GLOBALS['messages_article']['ENTER_DETAILS']; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="ml-2" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="formGroupNameOfItem"><?php echo $GLOBALS['messages_article']['ENTER_NAME']; ?></label>
              <input name="item_name" id="formGroupNameOfItem" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="formGroupPriceOfItem"><?php echo $GLOBALS['messages_article']['ENTER_PRICE']; ?></label>
              <input name="item_price" id="formGroupPriceOfItem" type="number" min="1" step="any" class="form-control" value="1" required>
            </div>
            <div class="form-group">
              <label for="formGroupDescOfItem"><?php echo $GLOBALS['messages_article']['ENTER_DESC']; ?></label>
              <input name="item_desc" id="formGroupDescOfItem" type="text" class="form-control" value="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn theme-button-warning" data-bs-dismiss="modal"><?php echo $GLOBALS['messages_article']['CANCEL']; ?></button>
            <button type='submit' name="id" id="edit-form-submit" value="" class="btn theme-button-success"><?php echo $GLOBALS['messages_article']['SAVE_CHANGES']; ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>