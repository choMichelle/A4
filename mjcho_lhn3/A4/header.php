<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/main-style.css?v=<?php echo time(); ?>"> 
        <!-- echo time() to resolve caching issue -->
    </head>
    <body>
        <div class="nav-bar">
            <a href="showmodels.php"><div class="nav-button">All models</div></a>
            <a href="addtowatchlist.php"><div class="nav-button">Watchlist</div></a>
            <a <?php 
                if (isset($_SESSION['email'])) {
                    echo "href=\"logout.php\"";
                }
                else {
                    echo "href=\"login.php\"";
                } 
            ?>><div class="nav-button">
                <?php
                    if (isset($_SESSION['email'])) {
                        echo "Log out";
                    }
                    else {
                        echo "Log in";
                    }
                ?>
            </div></a>
        </div>
    </body>
</html>