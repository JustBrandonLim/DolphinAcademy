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
            <h1>Courses</h1>
            <p>Please leave us a nice review <a href="./reviews.php">here</a> if the courses are useful!</p>
        </header>
        <main class="container-fluid">
            <div class="row">
                <?php
                    $errorMessage = populateCourses();
                    
                    if (!empty($errorMessage))
                    {
                        echo "<script>alert(\"" . $errorMessage . "\");</script>";
                    }
                ?>
            </div>
        </main>
        <?php
            include "./footer.inc.php"; 
        ?>
    </body>
</html>