<?php
include("connection/session.php");
if (!hasRole("ITEM_SEE_ALL")) header("Location:index.php?msg=permission", true, 301);
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="lib/bootstrap.min.css" />
  <link rel="stylesheet" href="styles/products.css" />
  <link rel="stylesheet" href="styles/theme.css" />
  <link rel="stylesheet" href="styles/search.css" />
</head>

<body>

  <?php

  include("header.php");

  if (isset($_POST['item_name']) && isset($_POST['id'])) {
    $error = false;
    try {
      if (empty($_POST['id'])) executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_NEW_ITEM'], "sis", $_POST['item_name'],  $_POST['item_price'], $_POST['item_desc']);
      else executeQuery($GLOBALS['SQL_COMMANDS']['UPDATE_ITEM'], "sisi", $_POST['item_name'], $_POST['item_price'], $_POST['item_desc'], $_POST['id']);  
    } catch (Exception $e) {
      $error = true;
    }
    if ($error) $URL = 'products.php?msg=error';
    else $URL = 'products.php?msg=success';
    sendToPage($URL);
  }

  if (isset($_POST['delete_item_name']) && isset($_POST['id'])) {
    $error = false;
    try {
      executeQuery($GLOBALS['SQL_COMMANDS']['DELETE_ITEM'], "i",  $_POST['id']);
    } catch (Exception $e) {
      $error = true;
    }
    if ($error) $URL = 'products.php?msg=error';
    else $URL = 'products.php?msg=success';
    sendToPage($URL);
  }
  ?>

  <article>
    <p class="fs-1 text-center"><?php echo $GLOBALS['messages_article']['TITLE']; ?></p>
    <div class="container-md ">
      <div class="row justify-content-between">
        <div class="col-3">
          <?php
          if (hasRole("ITEM_CREATE")) printf('
            <button type="button" class="btn theme-button" data-bs-toggle="modal"
            data-bs-target="#editOrCreate" id="product_add"><i
            data-feather="plus" class="me-2"></i>' . $GLOBALS['messages_article']['PRODUCT_ADD'] . '
          </button>          
          ');
          ?>
        </div>
        <div class="col-4">
          <input id="search" aria-label="Search" placeholder="<?php echo $GLOBALS['messages_article']['SEARCH_PLACEHOLDER']; ?>" class="form-control searchBar" />
        </div>
      </div>
      <div class="table-height mt-3">
        <table class="table table-hover mt-4 text-center">
          <thead>
            <th><?php echo $GLOBALS['messages_article']['NAME']; ?></th>
            <th><?php echo $GLOBALS['messages_article']['PRICE']; ?></th>
            <th><?php echo $GLOBALS['messages_article']['DESC']; ?></th>
            <th><?php echo $GLOBALS['messages_article']['DOIT']; ?></th>
          </thead>
          <?php

          $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ALL_ITEMS'], "");
          while ($row = mysqli_fetch_array($data)) {
            $item_id = $row['id'];

            if (hasRole("ITEM_EDIT")) {
              $editButton = '              
                <a id="item-' . $item_id . '-edit" class="text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editOrCreate">' . $GLOBALS['messages_article']['EDIT'] . '</a>
              ';
            } else $editButton = '<del>
              <a id="item-' . $item_id . '-edit" class="text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#editOrCreate">' . $GLOBALS['messages_article']['EDIT'] . '</a>
            </del>';

            if (hasRole("ITEM_DELETE")) {
              $deleteButton = '              
                <a id="item-' . $item_id . '-delete" class="text-secondary" href="#" data-bs-toggle="modal" data-bs-target="#delete">' . $GLOBALS['messages_article']['REMOVE'] . '</a>
              ';
            } else $deleteButton = '<del>
              <a id="item-' . $item_id . '-delete" class="text-secondary" href="#">' . $GLOBALS['messages_article']['REMOVE'] . '</a>
            </del>';

            printf('
            <tr name="data-row">
              <td id="item-%s-name">%s</td>
              <td id="item-%s-price">₺%s</td>
              <td id="item-%s-desc">%s</td>
              <td class="align-middle">
                %s | %s
              </td>
            </tr>
            ', $row['id'], $row['name'], $row['id'], $row['price'], $row['id'], (isset($row['description']) ? $row['description'] : ''), $editButton, $deleteButton);
          }

          if (mysqli_num_rows($data) == 0) {
            printf('<td colspan="4">' . $GLOBALS['messages_article']['SEARCH_NO_RESULT'] . '</td>');
          }

          ?>
        </table>
      </div>
    </div>
  </article>

  <?php include("components/modals/products_edit_create.php"); ?>
  <?php include("components/modals/products_delete.php"); ?>

  <?php include("footer.php"); ?>

  <script src="lib/bootstrap.bundle.min.js"></script>
  <script src="scripts/products.js"></script>
  <script src="scripts/search.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>