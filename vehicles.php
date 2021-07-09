<?php
include("connection/session.php");
if (!hasRole("VEHICLE_SEE_ALL")) header("Location:index.php?msg=permission", true, 301);
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="lib/bootstrap.min.css">
  <link rel="stylesheet" href="styles/theme.css">
  <link rel="stylesheet" href="styles/search.css">
  <link rel="stylesheet" href="styles/vehicles.css">
</head>

<body>

  <?php
  include("header.php");
  $error = false;
  if (isset($_POST['vehicle_name']) && isset($_POST['id'])) {
    try {
      if (empty($_POST['id'])) executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_NEW_VEHICLE'], "si", $_POST['vehicle_name'], 0);
      else executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_VEHICLE_NAME'], "si", $_POST['vehicle_name'], $_POST['id']);
    } catch (Exception $e) {
      $error = true;
    }
    if ($error) $URL = 'vehicles.php?msg=error';
    else $URL = 'vehicles.php?msg=success';
    sendToPage($URL);
  }

  if (isset($_POST['delete_vehicle_name']) && isset($_POST['id'])) {
    try {
      executeQuery($GLOBALS['SQL_COMMANDS']['DELETE_VEHICLE'], "i", $_POST['id']);
    } catch (Exception $e) {
      $error = true;
    }
    if ($error) $URL = 'vehicles.php?msg=error';
    else $URL = 'vehicles.php?msg=success';
    sendToPage($URL);
  }
  ?>

  <article>
    <p class="fs-1 text-center"><?php echo $GLOBALS['messages_article']['TITLE'] ?></p>
    <div class="container-md">
      <div class="row justify-content-between">
        <div class="col-3">
          <?php
          if (hasRole("VEHICLE_CREATE")) printf('
            <button type="button" class="btn theme-button " data-bs-toggle="modal" data-bs-target="#editOrCreate" id="vehicle_add"><i
              data-feather="plus" class="me-2"></i>' . $GLOBALS['messages_article']['VEHICLE_ADD'] . '</button> 
          ');
          ?>
        </div>
        <div class="col-4">
          <input id="search" aria-label="Search" placeholder="<?php echo $GLOBALS['messages_article']['SEARCH_PLACEHOLDER'] ?>" class="form-control searchBar" />
        </div>
        <div class="table-height mt-3">
          <table class="table table-hover mt-4 text-center mw-50">
            <thead>
              <th class="col-1">#</th>
              <th class="col-1"><?php echo $GLOBALS['messages_article']['NAME'] ?></th>
              <th class="col-3"><?php echo $GLOBALS['messages_article']['PRODUCTS'] ?></th>
              <th class="col-1"><?php echo $GLOBALS['messages_article']['VALUE'] ?></th>
              <th class="col-3"><?php echo $GLOBALS['messages_article']['ADRESS'] ?></th>
              <th class="col-3"><?php echo $GLOBALS['messages_article']['DOIT'] ?></th>
            </thead>
            <tbody>
              <?php

              $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ALL_VEHICLES'], "");

              while ($row = $data->fetch_array()) {
                $over_items = "";
                $item_id = $row['id'];
                if ($row['over_items'] != "") {
                  $itemDatas = explode(",", $row['over_items']);
                  foreach ($itemDatas as $itemElement) {
                    $itemDetails = explode("-", $itemElement);
                    $result = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ITEM_WITH_ID'], "i", $itemDetails[0])->fetch_array();
                    $itemName = $result['name'];
                    $itemAmount = $itemDetails[1];
                    if ($over_items == "") $over_items = "$itemAmount x $itemName";
                    else $over_items = "$over_items - $itemAmount x $itemName";
                  }
                }

                if (hasRole("VEHICLE_EDIT")) {
                  $editButton = '
                
                  <a id="vehicle-' . $item_id . '-edit" class="text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editOrCreate">' . $GLOBALS['messages_article']['EDIT'] . '</a>
                ';
                } else $editButton = '<del>
                <a id="vehicle-' . $item_id . '-edit" class="text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editOrCreate">' . $GLOBALS['messages_article']['EDIT'] . '</a>
              </del>';

                if (hasRole("VEHICLE_DELETE")) {
                  $deleteButton = '                
                  <a id="vehicle-' . $item_id . '-delete" class="text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#delete">' . $GLOBALS['messages_article']['REMOVE'] . '</a>
                ';
                } else $deleteButton = '<del>
                <a id="vehicle-' . $item_id . '-delete" class="text-secondary" href="#">' . $GLOBALS['messages_article']['REMOVE'] . '</a>
              </del>';

                if (hasRole("VEHICLE_QUEST_MAKE")) {
                  if ($row['active_operation']) $operationButton = '<a id="vehicle-' . $item_id . '-unload" class="text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#endAction">' . $GLOBALS['messages_article']['END_WORK'] . '</a>';
                  else $operationButton = '<a id="vehicle-' . $item_id . '-load" class="text-secondary" href="vehicle_upload.php?vehicle=' . $item_id . '">' . $GLOBALS['messages_article']['CREATE_WORK'] . '</a>';
                } else {
                  if ($row['active_operation']) $operationButton = '<del><a id="vehicle-' . $item_id . '-unload" class="text-secondary" href="#">' . $GLOBALS['messages_article']['END_WORK'] . '</a></del>';
                  else $operationButton = '<del><a id="vehicle-' . $item_id . '-load" class="text-secondary" href="#">' . $GLOBALS['messages_article']['CREATE_WORK'] . '</a></del>';
                }

                printf(
                  '
              <tr name="data-row">
                <td>%s</td>
                <td id="vehicle-%s-name">%s</td>
                <td>
                  %s
                </td>
                <td>%s%s</td>
                <td>%s</td>
                <td class="align-middle">
                  %s %s
                  %s %s
                  %s
                </td>
              </tr>
              ',
                  $item_id,
                  $item_id,
                  $row['name'],
                  $over_items,
                  (isset($row['total_price']) ? "₺" : ''),
                  (isset($row['total_price']) ? $row['total_price'] : ''),
                  (isset($row['target']) ? $row['target'] : ''),
                  $editButton,
                  "|",
                  $deleteButton,
                  "|",
                  $operationButton
                );
              }

              if (mysqli_num_rows($data) == 0) {
                printf('<td colspan="6">' . $GLOBALS['messages_article']['SEARCH_NO_RESULT'] . '</td>');
              }

              ?>
            </tbody>
          </table>
        </div>
      </div>
  </article>
  <?php include("components/modals/vehicle_edit_create.php"); ?>
  <?php include("components/modals/vehicle_end_action.php"); ?>
  <?php include("components/modals/vehicle_delete.php"); ?>
  <?php include("footer.php"); ?>

  <script src="lib/bootstrap.bundle.min.js"></script>
  <script src="scripts/vehicles.js"></script>
  <script src="scripts/search.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>