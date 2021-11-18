
<html>
    <head>
        <?php
            include "includes.inc.php";
            include "databasefunctions.php";
        ?>
</head>

    <body>

        <?php
        include "nav.inc.php";
        ?>
        
        <main class="container">
        <?php
        $email = $errorMsg = "";
        $success = true;
        if (empty($_POST["email"])) {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        } else {
            $email = sanitize_input($_POST["email"]);
// Additional check to make sure e-mail address is well-formed.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format.";
                $success = false;
            }
        }
        $pwd = $errorPWD = "";

        if (empty($_POST["pwd"])) {
            $errorPWD .= "Password is required.<br>";
            $success = false;
        }
        else{
            authenticateUser();
        }
function authenticateUser() {
    global $fname, $lname, $email, $Hpwd, $errorMsg, $success;

// Create database connection.    
    
    
// Check connection    
    if ($connnectionGet->connect_error) {
        $errorMsg = "Connection failed: " . $connectionGet->connect_error;
        $success = false;
    } else {
// Prepare the statement:        
        $stmt = $connectionGet->prepare("SELECT * FROM world_of_pets_members WHERE email=?");
// Bind & execute the query statement:       
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {            // Note that email field is unique, so should only have            
// one row in the result set.            
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $Hpwd = $row["password"];
// Check if the password matches:            
            if (!password_verify($_POST["pwd"], $Hpwd)) {
// Don't be too specific with the error message - hackers don't                
// need to know which one they got right or wrong. :)                
                $errorMsg = "Email not found or password doesn't match...";
                $success = false;
            }
        } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
        }
        $stmt->close();
    }
    $connectionGet->close();
}

if ($success) {
            session_start();
            $_SESSION["email"] = $email;
            echo "<h2>Login Successful!</h2>";
            echo "<h4>Welcome back!".$_SESSION["email"]."</h4>";
            echo '<a class="btn btn-primary" href="index.php" style = "background: green;">Return to Home</a>';
            echo '</div>';
            
            
        } else {
            echo '<h2>Oops!</h2>';
            echo "<h4>The following input errors were detected:</h4>";
            echo "<p>" . $errorMsg . "</p>";
            echo "<p>" . $errorPWD . "</p>";
            echo '<div class="form-group">';
            echo '<a class="btn btn-primary" href="login.php" style = "background: red;">Return to Login</a>';
            echo '</div>';
        }


      

//Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        /* * Helper function to authenticate the login. */


?>

        </main>

<?php
include "footer.inc.php";
?>

    </body>

</html>
