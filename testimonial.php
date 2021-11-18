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
        <header>
            <h1 style="text-align: center;">Testimonials on </h1>
        </header>
        <main class="container-fluid">  
            <div class="row">
                <?php
                    require "php/DatabaseFunctions.php";
                    
                    getTestimonials();                    
                ?>
            </div>
        </main>
    </body>
<?php
include "footer.inc.php"; 
?>
</html>

