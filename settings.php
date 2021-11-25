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
                $errorMessage = "";
                if (empty($_POST["pwd"])) {
                    $errorMessage .= "Password is required.";
                }

                if (empty($_POST["pwd_confirm"])) {
                    $errorMessage .= "Confirm Password is required.";
                }

                if ($_POST["pwd"] === $_POST["pwd_confirm"]) {
                    $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                } else {
                    $errorMessage .= "Password and Confirm Password do not match!";
                }

                switch ($_POST["submit"]) {
                    case "delete_user":
                        $errorMessage = deleteUser($_SESSION["email"]);
                        if (empty($errorMessage)) {

                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $(\"#modal-message\").html(\"Your account is deleted\");
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
                            session_start();
                            session_unset();
                            session_destroy();
                        }
                        break;

                    case "update_password":
                        $errorMessage = updatePassword($_SESSION["email"], $pwd_hashed);
                        if (empty($errorMessage)) {
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $(\"#modal-message\").html(\"Your password has been changed\");
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
                            echo "<script type='text/javascript'>
                                        $(document).ready(function(){
                                        $('#myModal').modal('show');
                                    });
                                    </script>";
                        }
                    break;
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
                                    <input class="form-control" type="password" id="pwd" minlength="12" name="pwd" 
                                           placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Re-enter New Password: </label>
                                    <input class="form-control" type="password" id="pwd_confirm" minlength="12"  
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
                                        <input type="checkbox" name="agree" required > 
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
