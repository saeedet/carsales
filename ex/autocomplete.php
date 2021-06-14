<?php

include_once("./../sql/sql_functions.php");

// searching and showing autocomplete result
if(!empty($_POST["keyword"])) {
    $keyword = $_POST["keyword"];

    $result22 = searches($keyword);
    if(!empty($result22)) { ?>

        <ul id="suggestion-list">
        <?php
        foreach($result22 as $this_item) {
        ?>
            <li onClick="selectText('<?php echo $this_item; ?>');"><?php echo $this_item; ?></li>
        <?php } ?>
        </ul>

<?php } } ?>
