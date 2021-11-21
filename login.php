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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $errorMessage = $email = $pwd = "";

                if (empty($_POST["email"])) {
                    $errorMessage .= "Email is required.\\n";
                } else {
                    $email = sanitizeInput($_POST["email"]);

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorMessage .= "Invalid Email format.\\n";
                    }
                }

                if (empty($_POST["pwd"])) {
                    $errorMessage .= "Password is required.\\n";
                }
                
                if(empty($_POST['g-recaptcha-response']))
                {
                    $errorMessage = "Some error in vrifying g-recaptcha";
                }
                if(!empty($_POST['g-recaptcha-response']))
                {
                $secret = '6Lfo6EcdAAAAAGeTjEVY3pqjywGlGngvxSDY-Htw';
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);  
            }
            

            if (empty($errorMessage)) {
            $errorMessage = loginMember($email, $pwd);

            if (empty($errorMessage)) {
            echo "<script>alert(\"Thank you for logging in, ".$_SESSION["lname"]."!\");</script>";
            echo "<script type=\"text/javascript\">window.location = \"./index.php\";</script>";
            die();
            } else {
            echo "<script>alert(\"".$errorMessage."\");</script>";
            }
            } else {
            echo "<script>alert(\"".$errorMessage."\");</script>";
            }
            }
            ?>
            <header>
                <h1>Login</h1> 
                <p>For new users, please register <a href="./register.php">here</a>!</p>
            </header>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card medium-card">
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

                                
                                <form class="form-group" id="frmContact" method="POST" novalidate="novalidate">
                                    <div class="g-recaptcha" data-sitekey="6Lfo6EcdAAAAAIlcKsdyEcTIpdYRzztAWcz6dUfZ"></div>
                                    <input class="btn btn-primary" class="form-control" type="Submit" name="Submit">
                                </form>
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

