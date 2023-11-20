<?php
function addListItem($itemName) {
    echo "<a href=\"modeldetails.php?id=$itemName\" class=\"list-anchor\"><div class=\"models-list-item\">$itemName</div></a>";
}

function require_SSL() {
    if ($_SERVER["HTTPS"] != "on") {
        header("Location: https://" .$_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"]);
        exit();
    }
}

function SSLtoHTTP() {
    if ($_SERVER["HTTPS"] == "on") {
        header("Location: http://" .$_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"]);
        exit();
    }
}

function validateTextInput($inputName) {
    if (isset($_POST[$inputName]) && !empty($_POST[$inputName])) {
        return true;
    }
}
?>