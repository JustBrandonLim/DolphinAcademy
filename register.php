<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include_once "./includes.inc.php";
        ?>
    </head>
    <body>
        <?php
            include_once "./nav.inc.php";
        ?>
        <main class="container-fluid">
            <?php
                include_once "./php/DatabaseFunctions.php";
               
                //Check if POST
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $errorMessage = $fname = $lname = $email = $pwd_hashed = "";
                    
                    //Sanitize Input
                    if (!empty($_POST["fname"]))
                    {
                        $fname = sanitizeInput($_POST["fname"]);
                    }
                    
                    if (empty($_POST["lname"]))
                    {
                        $errorMessage .= "Last Name is required.<br>";
                    }
                    else
                    {
                        $lname = sanitizeInput($_POST["lname"]);
                    }
                    
                    if (empty($_POST["email"]))
                    {
                        $errorMessage .= "Email is required.<br>";
                    }
                    else
                    {
                        $email = sanitizeInput($_POST["email"]);
                        
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                        {
                            $errorMessage .= "Invalid Email format.<br>";
                        }
                    }
                    
                    if (empty($_POST["pwd"]))
                    {
                        $errorMessage .= "Password is required.<br>";
                    }
                    
                    if (empty($_POST["pwd_confirm"]))
                    {
                        $errorMessage .= "Confirm Password is required.<br>";
                    }
                    
                    if ($_POST["pwd"] === $_POST["pwd_confirm"])
                    {
                        $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                    }
                    else
                    {
                        $errorMessage .= "Password and Confirm Password do not match!<br>";
                    }
                    
                    if (empty($errorMessage))
                    {
                        $errorMessage = registerMember($fname, $lname, $email, $pwd_hashed);
                        if (empty($errorMessage))
                        {
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $(\"#modal-message\").html(\"Thank you for registering, " . $lname . "\");
                                    });
                                    </script>";
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                    </script>";
                            //echo "<script>alert(\"Thank you for registering, " . $lname . "!\");</script>";
                        }
                        else
                        {
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $(\"#modal-message\").html(\"" . $errorMessage . "\");
                                    });
                                    </script>";
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                    </script>";
                        }
                    }
                    else
                    {
                        echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $(\"#modal-message\").html(\"" . $errorMessage . "\");
                                    });
                                    </script>";
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                    </script>";
                    }
                }
            ?>
            <header>
                <h1>Register</h1> 
                <p>For existing users, please login <a href="./login.php">here</a>!</p>
            </header>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card large-card">
                        <div class="card-body">
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"> 
                                <div class="form-group">
                                    <label for="fname">First Name:</label>
                                    <input class="form-control" type="text" id="fname" maxlength="45" name="fname" 
                                            placeholder="Enter first name">
                                </div>

                                <div class="form-group">
                                    <label for="lname">Last Name:</label>
                                    <input class="form-control" type="text" id="lname" maxlength="45" name="lname" 
                                            placeholder="Enter last name">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input class="form-control" type="email" id="email"  name="email" 
                                            placeholder="Enter email">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input class="form-control" type="password" id="pwd" minlength="12" name="pwd" 
                                            placeholder="Enter password">
                                </div>

                                <div class="form-group">
                                    <label for="pwd_confirm">Confirm Password:</label>
                                    <input class="form-control" type="password" id="pwd_confirm" minlength="12" name="pwd_confirm" 
                                            placeholder="Confirm password">
                                </div>

                                <div class="form-check">
                                    <label>
                                        <input type="checkbox" required name="agree"> 
                                        Agree to terms and conditions.
                                    </label> 
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main> 
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Dolphin Academy</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p id="modal-message">TEST</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            include "./footer.inc.php";
        ?>
    </body>
</html>

