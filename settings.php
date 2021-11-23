<html>
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
            <?php
                include "./php/DatabaseFunctions.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
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
            <header>
                <h1>Settings</h1>
                <p>This settings dashboard allows you to change your password or delete your account from the Dolphin Academy system.</p>
            </header>
            <div class="row">
                <div class="col-auto">
                    <div class="card small-card">
                        <div class="card-body">
                            <h5 class="card-title">Change Password</h5>
                            <p class="card-text">This function allows you to change your password.</p>
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                <div class="form-group">
                                    <label for="email">New Password:</label>
                                    <input class="form-control" type="password" id="pwd"  
                                           name="pwd" placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Re-enter New Password: </label>
                                    <input class="form-control" type="password" id="pwd_confirm"  
                                           name="pwd_confirm" placeholder="Enter new password again">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" value="update_password" name="submit">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card small-card">
                        <div class="card-body">
                            <h5 class="card-title">Delete Account</h5>
                            <p class="card-text">This function allows you to delete your account.</p>
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                <div class="form-check">
                                    <label>
                                        <input type="checkbox" required name="agree"> 
                                        Are you sure you want to delete your account?
                                    </label> 
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" value="delete_user" name="submit">Delete Account</button>
                                </div>
                            </form>
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
