<?php
    session_start();
    if ($_SESSION["loggedin"] === true) {
        header("Location:./index.php");
        die();
    }
?>

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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $errorMessage = $email = $pwd = "";

                if (empty($_POST["email"])) {
                    $errorMessage .= "Email is required.";
                } else {
                    $email = sanitizeInput($_POST["email"]);

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorMessage .= "Invalid Email format.";
                    }
                }

                if (empty($_POST["pwd"])) {
                    $errorMessage .= "Password is required.";
                }

                if (empty($_POST['g-recaptcha-response'])) {
                    $errorMessage .= "ReCaptcha is invalid.";
                }

                if (!empty($_POST['g-recaptcha-response'])) {
                    $secret = '6Lfo6EcdAAAAAGeTjEVY3pqjywGlGngvxSDY-Htw';
                    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
                    $responseData = json_decode($verifyResponse);
                }

                if (empty($errorMessage)) {
                    $errorMessage = loginMember($email, $pwd);
                    
                    if (empty($errorMessage)) {
                        echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $(\"#modal-message\").html(\"You have logged in successfully\");
                                    });
                                    </script>";
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                    </script>";
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                            $('#close').click(function(){
                                                window.location.replace('index.php');
                                            });
                                        });
                                    </script>";
                    } else {
                        echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $(\"#modal-message\").html(\"" . $errorMessage . "\");
                                    });
                                    </script>";
                        //echo "<script>document.getElementById(\"modal-message\").innerHTML = \"" . $errorMessage . "\";</script>";
                         echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                    </script>";
                    }
                } else {
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
                <h1>Login</h1> 
                <p>For new users, please register <a href="./register.php">here</a>!</p>
            </header>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card medium-card"style="width: 28rem;">
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
                                    <div class="g-recaptcha" data-sitekey="6Lfo6EcdAAAAAIlcKsdyEcTIpdYRzztAWcz6dUfZ"></div>
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
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "./footer.inc.php";
        ?>
    </body>
</html>

