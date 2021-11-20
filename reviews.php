<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include "./includes.inc.php";
        ?>
    </head>
    <body>
        <?php
            include "./nav.inc.php";
        ?>
        <header>
            <h1 style="padding-top: 10px;">Reviews</h1>
        </header>
        <main class="container"> 
            <div class="row">
                <?php
                    require "./php/DatabaseFunctions.php";
                    
                    getReviews();                    
                ?>
            </div>
            <?php
                if ($_SESSION["loggedin"] != true){
                    echo "<div class=\"container\">";
                    echo "<p>To leave a review, please login <a href=\"./login.php\">here</a> first!</p>";
                    echo "</div>";
                } else {
                    echo "<form class=\"form-inline\">";
                    echo "<textarea placeholder=\"Your thoughts go here!\" class=\"form-control\" rows=\"8\" cols=\"100\" style=\"padding-bottom: 10px;\"></textarea>";
                    echo "<button type=\"submit\" class=\"btn btn-primary mb-2\" style=\"margin-top:10px;\">Submit</button>";
                    echo "</form>";
                }
            ?>
        </main>
        <?php
            include "./footer.inc.php"; 
        ?>
    </body>
</html>

