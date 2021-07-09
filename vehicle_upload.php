<?php
include("connection/session.php");
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">

  <link rel="stylesheet" href="lib/bootstrap.min.css">
  <link rel="stylesheet" href="styles/vehicle_upload.css">
  <link rel="stylesheet" href="styles/theme.css">
</head>

<body>

  <?php

  include("header.php");

  if (isset($_POST['vehicle']) && isset($_POST['load'])) {
    $error = false;
    $over_items = "";
    $price = 0;
    foreach ($_POST as $element => $value) {
      if (strpos($element, "amount")) {
        $item_id = explode("-", $element)[1];
        $itemResult = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ITEM_WITH_ID'], "i", $item_id)->fetch_array();
        $item_index = "input-$item_id";
        if (isset($_POST[$item_index])) {
          if (($_POST[$item_index] == 1) || ($_POST[$item_index] == 'on')) {
            $price += ((int)$value * $itemResult['price']);
            if ($over_items == "") $over_items = "$item_id-$_POST[$element]";
            else $over_items = "$over_items,$item_id-$_POST[$element]";
          }
        }
      }
    }
    try {
      executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_VEHICLE_OVERS'], "siisi", $over_items, $price, 1, $_POST['target'], $_POST['vehicle']);
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
    <p class="display-7 text-center" id="price"><?php echo $GLOBALS['messages_article']['TOTAL_PRICE'] ?></p>
    <div class="container-sm">
      <form method="post">
        <div class="form-group">
          <label for="vehicle"><?php echo $GLOBALS['messages_article']['ENTER_VEHICLE'] ?></label>
          <select name="vehicle" class="form-select" id="vehicle" aria-label="<?php echo $GLOBALS['messages_article']['SELECT_VEHICLE'] ?>">
            <?php
            $result = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ALL_VEHICLES'], "");
            $vehicle = "";
            if (isset($_GET['vehicle'])) {
              $vehicle = $_GET['vehicle'];
            }
            while ($row = mysqli_fetch_array($result)) {
              printf('<option value="%s" %s>%s</option>', $row['id'], ($vehicle == $row['id'] ? "selected" : ""), $row['name']);
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="targetAdress"><?php echo $GLOBALS['messages_article']['ENTER_ADRESS'] ?></label>
          <input name="target" id="targetAdress" type="text" class="form-control" value="">
        </div>
        <div class="table-height mt-3">
          <table class="table table-hover mt-4 text-center">
            <thead>
              <th><?php echo $GLOBALS['messages_article']['DO_LOAD'] ?></th>
              <th><?php echo $GLOBALS['messages_article']['AMOUNT'] ?></th>
              <th><?php echo $GLOBALS['messages_article']['NAME'] ?></th>
              <th><?php echo $GLOBALS['messages_article']['PRICE'] ?></th>
              <th><?php echo $GLOBALS['messages_article']['DESC'] ?></th>
            </thead>
            <tbody id="nodes">
              <?php
              $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ALL_ITEMS'], "");
              $dataSize = mysqli_num_rows($data);

              while ($row = mysqli_fetch_array($data)) {
                printf('
                <tr class="node">
                    <td>
                        <input type="checkbox" name="input-%s" id="input-%s" class="form-check-input"/>
                    </td>
                    <td class="col-3">
                        <input name="item-%s-amount" id="item-%s-amount" type="number" class="form-control text-center amountSelector" min="0" value="1"/>
                    </td>
                  <td id="item-%s-name">%s</td>
                  <td id="item-%s-price">₺%s</td>
                  <td id="item-%s-desc">%s</td>
                </tr>
                ', $row['id'], $row['id'], $row['id'], $row['id'], $row['id'], $row['name'], $row['id'], $row['price'], $row['id'], (isset($row['description']) ? $row['description'] : ''));
              }

              if ($dataSize == 0) {
                printf('<td colspan="4">' . $GLOBALS['messages_article']['SEARCH_NO_RESULT'] . '</td>');
              }

              ?>
            </tbody>
          </table>
        </div>
        <div class="row justify-content-center mt-5">
          <button class="btn theme-button-success col-md-3" type="submit" name="load" value="true"><?php echo $GLOBALS['messages_article']['CHECK_LOAD'] ?></button>
        </div>
      </form>
    </div>
  </article>

  <?php include("footer.php"); ?>

  <script src="lib/bootstrap.bundle.min.js"></script>
  <script src="scripts/vehicle_upload.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>