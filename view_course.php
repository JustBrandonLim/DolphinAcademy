<?php
    session_start();
    if ($_SESSION["loggedin"] !== true) {
        header("Location:./index.php");
        die();
    }
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
        <main class="container-fluid">
            <header>
                <h1>View Course</h1>
                <p>Please do not distribute!</p>
            </header>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card large-card">
                        <div class="card-body">
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                                {
                                    $errorMessage = "";
                                    if (empty($_POST["submit"])) {
                                        $errorMessage .= "Something went wrong.\\n";
                                    }
                                    else
                                    {
                                        $errorMessage = viewCourse($_POST["submit"]);
                                    }

                                    if (!empty($errorMessage))
                                    {
                                        echo "<script>alert(\"" . $errorMessage . "\");</script>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include "./footer.inc.php";
        ?>
    </body>
</html>