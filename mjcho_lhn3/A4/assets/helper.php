<?php
function addListItem($itemName) {
    echo "<a href=\"modeldetails.php?id=$itemName\" class=\"list-anchor\"><div class=\"models-list-item\">$itemName</div></a>";
}
?>