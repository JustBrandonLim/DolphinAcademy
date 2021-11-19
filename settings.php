<html>
    <head>
        <?php
        include "./includes.inc.php";
        ?>

        <title>Dolphin Academy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        include "./nav.inc.php";
        ?>
        <main class="container-fluid">
            <?php
            include "./php/DatabaseFunctions.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $errorMessage = "";
                if (empty($_POST["pwd"])) {
                    $errorMessage .= "Password is required.\\n";
                }

                if (empty($_POST["pwd_confirm"])) {
                    $errorMessage .= "Confirm Password is required.\\n";
                }

                if ($_POST["pwd"] === $_POST["pwd_confirm"]) {
                    $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                } else {
                    $errorMessage .= "Password and Confirm Password do not match!\\n";
                }

                switch ($_POST["submit"]) {
                    case "delete_user":
                        $errorMessage = deleteUser($_SESSION["email"]);
                        if (empty($errorMessage)) {
                            session_start();
                            session_unset();
                            session_destroy();
                            echo "<script type=\"text/javascript\">window.location = \"./index.php\";</script>";
                            die();
                        }
                        break;

                    case "update_password":
                        $errorMessage = updatePassword($_SESSION["email"], $pwd_hashed);
                        break;
                }

                if (empty($errorMessage)) {
                    echo "<script type=\"text/javascript\">window.location = \"./index.php\";</script>";
                    die();
                } else {
                    echo "<script>alert(\"" . $errorMessage . "\");</script>";
                }
            }
            ?>
            <h1>Setting</h1>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <h2>Password</h2>
                <p>Creating a password allows you to log in with your Dolphin Academy username and password.</p>
                <div class="form-group">
                    <label for="email">New password:</label>
                    <input class="form-control" type="password" id="pwd"  
                           name="pwd" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="pwd">Re-enter new password: </label>
                    <input class="form-control" type="password" id="pwd_confirm"  
                           name="pwd_confirm" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" value="update_password" name="submit">Create Password</button>
                </div>
            </form>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" value="delete_user" name="submit">Delete Account</button>
                </div>
            </form>
        </main>
<?php
include "./footer.inc.php";
?>
    </body>
</html>
