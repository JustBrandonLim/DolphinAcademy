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
            <h1>Reviews</h1>
            <p>To leave a review, please login <a href="./login.php">here</a> first!</p>
        </header>
        <main class="container-fluid">  
            <div class="row">
                <?php
                    require "php/DatabaseFunctions.php";
                    
                    getTestimonials();                    
                ?>
            </div>
        </main>
        <?php
            include "footer.inc.php"; 
        ?>
    </body>
</html>

