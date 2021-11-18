<!DOCTYPE html>
<html>
    <head>
        <?php
            include "includes.inc.php";
        ?>
    </head>
    <body>
        <?php
            include "nav.inc.php";
        ?>
        <main class="container-fluid">  
            <div class="row">
                <?php
                    require "php/DatabaseFunctions.php";
                    
                    getProducts();                    
                ?>
            </div>
        </main>
    </body>
    <?php
        include "footer.inc.php"; 
    ?>
</html>