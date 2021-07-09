<?php
include("connection/session.php");
if (!hasRole("USERS_SEE_ALL")) header("Location:index.php?msg=permission", true, 301);
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="lib/bootstrap.min.css" />
  <link rel="stylesheet" href="styles/theme.css" />
  <link rel="stylesheet" href="styles/search.css" />
  <link rel="stylesheet" href="styles/users.css" />
</head>

<body>
  <?php include("header.php"); ?>
  <article>
    <p class="fs-1 text-center"><?php echo $GLOBALS['messages_article']['TITLE'] ?></p>
    <div class="container-md">
      <div class="row justify-content-between">
        <div class="col-3">
          <?php
          if (hasRole("CREATE_NEW_USER")) {
            $hash = "" . $_SESSION['id'] . "--1";
            $qToken = hash('sha256', $hash);
            $result = executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_QUERY_TOKEN'], "sid", $qToken, -1, $_SESSION['id']);
            printf('<button type="button" class="btn theme-button" id="user_add" target="popup" onclick="openTab(\'usercard.php?query_token=' . $qToken . '\', \'profil\');"><i
            data-feather="plus"></i>'.$GLOBALS['messages_article']['ADD_NEW_USER'].'</button>');
          }
          ?>
        </div>
        <div class="col-4">
          <input id="search" aria-label="Search" placeholder="<?php echo $GLOBALS['messages_article']['SEARCH_PLACEHOLDER'] ?>" class="form-control searchBar" />
        </div>
      </div>
      <div class="table-height mt-3">
        <table class="table table-hover mt-4 text-center">
          <thead>
            <th>#</th>
            <th><?php echo $GLOBALS['messages_article']['USERNAME'] ?></th>
            <th><?php echo $GLOBALS['messages_article']['EMAIL'] ?></th>
            <?php
            if (hasRole("USERS_DETAILS")) printf('<th>'.$GLOBALS['messages_article']['USER_CARD'].'</th>');
            ?>
          </thead>
          <tbody id="nodes">
            <?php
            $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_ALL_USERS'], "");
            $dataSize = mysqli_num_rows($data);
            while ($row = mysqli_fetch_array($data)) {
              $hash = "" . $_SESSION['id'] . "-" . $row['id'] . "";
              $qToken = hash('sha256', $hash);
              $result = executeQuery($GLOBALS['SQL_COMMANDS']['INSERT_QUERY_TOKEN'], "sid", $qToken, $row['id'], $_SESSION['id']);
              if (hasRole("USERS_DETAILS")) $cardButton = '<td class="col-1"><a class="btn theme-button" target="popup" onclick="openTab(\'usercard.php?query_token=' . $qToken . '\', \'' . $row['username'] . '\');"><i
                data-feather="user"></i></a></td>';
              else $cardButton = '';
              printf('
                <tr class="node" name="data-row">
                    <td class="col-1">
                        %s
                    </td>
                    <td class="col-3">
                        %s
                    </td>
                    <td class="col-3">
                      %s
                  </td>                  
                    %s                
                </tr>
                ', $row['id'], $row['username'], $row['email'], $cardButton);
            }

            if ($dataSize == 0) {
                  printf('<td colspan="4">'.$GLOBALS['messages_article']['SEARCH_NO_RESULT'].'</td>');
            }

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </article>
  <?php include("footer.php"); ?>

  <script src="lib/bootstrap.bundle.min.js"></script>
  <script src="scripts/users.js"></script>
  <script src="scripts/search.js"></script>
  <?php include("components/toastservice/toastservice.php"); ?>
</body>

</html>