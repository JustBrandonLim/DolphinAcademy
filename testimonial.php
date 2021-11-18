<!DOCTYPE html>
<html lang="en">
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
            <h1 style="text-align: center;padding-top: 30px;padding-bottom: 30px;">Testimonials By Users</h1>
        </header>
        <main class="container">  
            <div class="row">
                <?php
                    require "php/DatabaseFunctions.php";
                    
                    getTestimonials();                    
                ?>
            </div>
            <form class="form-inline">
                <textarea placeholder="Your thoughts go here!" class="form-control" rows="8" cols="100"></textarea>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
        </main>
    </body>
<?php
include "footer.inc.php"; 
?>
</html>

