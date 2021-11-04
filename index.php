<!DOCTYPE html>
<html>
    <head>
        <?php
            include "includes.inc.php";
        ?>
    </head>
    <body>
        <h1>Normal HTML Content...</h1>
        <?php
            echo "<h3>Content inside PHP code...</h3>";
            echo "<hr />";
            echo phpinfo();
        ?>
    </body>
</html>