<?php
include("connection/session.php");
if (!hasRole("REPORTS_SEE_ALL")) header("Location:index.php?msg=permission", true, 301);

?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="lib/bootstrap.min.css">
  <link rel="stylesheet" href="styles/theme.css">
  <link rel="stylesheet" href="styles/search.css">
  <link rel="stylesheet" href="styles/reports.css">
</head>

<body>

  <?php
  include("header.php");
  if (!empty($_POST)) {
    $counter = 0;
    $error = false;
    foreach ($_POST as $k => $v) {
      try {
        executeQuery($GLOBALS['SQL_COMMANDS']['DELETE_REPORT'], "i", explode("-", $k)[1]);
        $counter++;
      } catch (Exception $e) {
        $error = true;
      }
    }
    if ($counter == 0 || $error) $URL = 'reports.php?msg=error';
    else $URL = 'reports.php?msg=success';
    sendToPage($URL);
  }
  ?>

  <article>
    <p class="fs-1 text-center"><?php echo $GLOBALS['messages_article']['TITLE'] ?></p>
    <div class="container-md">
      <p id="elementsValue">
        <?php echo $GLOBALS['messages_article']['TOTAL_SELECTED_PRICES'] ?>
      </p>
      <div class="container-md">
        <div class="d-flex flex-row justify-content-between">
          <div class="form-check align-self-center">
            <input type="checkbox" id="allSelect" class="form-check-input" /><label for="allSelect" class="text-muted form-check-label"><?php echo $GLOBALS['messages_article']['SELECT_ALL'] ?></label>
          </div>
          <div class="row">
            <?php
            if (hasRole("REPORTS_CLEAR")) printf('
            <button type="submit" form="reports" class="btn theme-button">
              ' . $GLOBALS['messages_article']['CLEAR_SELECTED'] . '
            </button>
            ');
            ?>
            <input id="search" placeholder="<?php echo $GLOBALS['messages_article']['SEARCH_PLACEHOLDER'] ?>" class="form-control" />
          </div>
        </div>
        <div class="table-height mt-3">
          <form id="reports" method="post">
            <table class="table table-hover text-center">
              <thead>
                <th> <?php echo $GLOBALS['messages_article']['SELECT'] ?></th>
                <th> <?php echo $GLOBALS['messages_article']['DATE'] ?></th>
                <th> <?php echo $GLOBALS['messages_article']['HOUR'] ?></th>
                <th> <?php echo $GLOBALS['messages_article']['VEHICLE'] ?></th>
                <th> <?php echo $GLOBALS['messages_article']['PRODUCTS'] ?></th>
                <th> <?php echo $GLOBALS['messages_article']['PRICE'] ?></th>
              </thead>
              <tbody>
                <?php
                $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ALL_REPORTS'], "");
                $value = 0;
                while ($row = mysqli_fetch_array($data)) {
                  $items = "";
                  $item_id = $row['id'];
                  $value += $row['total'];
                  if ($row['items'] != "") {
                    $itemDatas = explode(",", $row['items']);
                    foreach ($itemDatas as $itemElement) {
                      $itemDetails = explode("-", $itemElement);
                      $result = mysqli_fetch_array(executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ITEM_WITH_ID'], "i", $itemDetails[0]));
                      if ($items == "") $items = str_replace(array("{AMOUNT}", "{NAME}"), array($itemDetails[1], $result['name']), $GLOBALS['messages_article']['PRODUCT_FORMAT']);
                      else $items = "$items - " . str_replace(array("{AMOUNT}", "{NAME}"), array($itemDetails[1], $result['name']), $GLOBALS['messages_article']['PRODUCT_FORMAT']);
                    }
                  }
                  printf('
                <tr name="data-row">
                  <td>
                    <input type="checkbox" class="selectNode form-check-input" name="input-%s" id="input-%s" />
                  </td>
                  <td>%s</td>
                  <td>%s</td>
                  <td>%s</td>
                  <td>%s</td>
                  <td id="input-%s-value">₺%s</td>
                </tr>
                ', $row['id'], $row['id'], $row['date'], $row['time'], $row['vehicle'], $items, $row['id'], $row['total']);
                }
                if (mysqli_num_rows($data) == 0) {
                  printf('<td colspan="6">' . $GLOBALS['messages_article']['SEARCH_NO_RESULT'] . '</td>');
                }
                ?>
              </tbody>
            </table>
          </form>
          <?php echo "<script>document.body.innerHTML = document.body.innerHTML.replace('@maxValue', " . $value . ");</script>"; ?>
        </div>
      </div>
  </article>

  <?php include("footer.php"); ?>

  <script src="lib/bootstrap.bundle.min.js"></script>
  <script src="scripts/reports.js"></script>
  <script src="scripts/search.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>