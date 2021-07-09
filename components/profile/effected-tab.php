<div class="float-child-large">
    <p class="fs-3"><?php echo $GLOBALS['messages_article']['EFFECTED_TITLE'] ?></p>
    <div class="table-height">
        <table class="table table-hover mt-2 text-center">
            <thead>
                <th><?php echo $GLOBALS['messages_article']['EFFECTED_TIME'] ?></th>
                <th><?php echo $GLOBALS['messages_article']['EFFECTED_MAKE'] ?></th>
            </thead>
            <tbody>
                <?php
                $data = executeQuery($GLOBALS['SQL_COMMANDS']['SELECT_EFFECTED_ACTIONS_WITH_ID'], "i", $_SESSION['id']);
                while ($row = mysqli_fetch_array($data)) {
                    printf('
                <tr name="data-row">
                <td>%s</td>
                <td>%s %s</td>
                </tr>
                ', $row['time'], $row['user'], $GLOBALS['actions']['effected'][$row['action']]);
                }
                if (mysqli_num_rows($data) == 0) {
                    printf('<td colspan="6">'.$GLOBALS['messages_article']['SEARCH_NO_RESULT'].'</td>');
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
