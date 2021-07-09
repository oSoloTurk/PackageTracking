<div class="modal" tabindex="-1" id="delete">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $GLOBALS['messages_article']['VEHICLE_REMOVE'] ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="ml-2" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="deleteFormGroupNameOfVehicle"><?php echo $GLOBALS['messages_article']['ENTER_NAME'] ?></label>
              <input name="delete_vehicle_name" id="deleteFormGroupNameOfVehicle" type="text"
                class="form-control input-group-text" readonly="readonly" value="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn theme-button-warning" data-bs-dismiss="modal"><?php echo $GLOBALS['messages_article']['CANCEL'] ?></button>
            <button type='submit' name="id" id="delete-form-submit" value="" class="btn theme-button-error"><?php echo $GLOBALS['messages_article']['REMOVE'] ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>