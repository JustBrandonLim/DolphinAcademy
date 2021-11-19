<?php 
    session_start();
    if ($_SESSION["loggedin"] === true)
    {
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
            <?php
                include "./php/DatabaseFunctions.php";
               
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $errorMessage = $email = $pwd = "";
                    
                    if (empty($_POST["email"]))
                    {
                        $errorMessage .= "Email is required.\\n";
                    }
                    else
                    {
                        $email = sanitizeInput($_POST["email"]);
                        
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            $errorMessage .= "Invalid Email format.\\n";
                        }
                    }
                    
                    if (empty($_POST["pwd"]))
                    {
                        $errorMessage .= "Password is required.\\n";
                    }
                    
                    if (empty($errorMessage))
                    {
                        $errorMessage = loginMember($email, $pwd);
                        
                        if (empty($errorMessage))
                        {
                            echo "<script>alert(\"Thank you for logging in, " . $_SESSION["lname"] ."!\");</script>";
                        }
                        else
                        {
                            echo "<script>alert(\"" . $errorMessage . "\");</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert(\"" . $errorMessage . "\");</script>";
                    }
                }
            ?>
            <header>
                <h1>Login</h1> 
                <p>For new users, please register <a href="./login.php">here</a>!</p>
            </header>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card small-card">
                        <div class="card-body">
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input class="form-control" id="email" 
                                            name="email" type ="email"  placeholder="Enter email">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input class="form-control" type="password" id="pwd"  
                                            name="pwd" placeholder="Enter password">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Login</button>
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

