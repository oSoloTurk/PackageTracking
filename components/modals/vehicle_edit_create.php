<div class="modal" tabindex="-1" id="editOrCreate">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $GLOBALS['messages_article']['ENTER_DETAILS'] ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="ml-2" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="formGroupNameOfVehicle"><?php echo $GLOBALS['messages_article']['ENTER_NAME'] ?></label>
              <input name="vehicle_name" id="formGroupNameOfVehicle" type="text" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn theme-button-warning" data-bs-dismiss="modal"><?php echo $GLOBALS['messages_article']['CANCEL'] ?></button>
            <button type="submit" name="id" id="edit-form-submit" value=""
              class="btn theme-button-success"><?php echo $GLOBALS['messages_article']['SAVE_CHANGES'] ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>