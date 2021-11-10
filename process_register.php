<?php
            include "includes.inc.php";
?>
<style>
    #successful{
      margin-left:30px;
      cursor: pointer;
    }
    h3{
       margin-left:30px;
    }
    h1{
       margin-left:30px; 
    }
    #try_again{
      margin-left:30px;
      cursor: pointer;  

    }
    p{
      margin-left:30px; 
    }
</style>    

<?php
            include "nav.inc.php";
?>

<?php
$count = 0;
$fname = ($_POST["fname"]);
$email = $lname  = $pwd = $errorMsg  = ""; 
$success = true;
        
if (empty($_POST["email"]))  
{
    $errorMsg .= "Email is required.<br>"; 
    $success = false;
} 
else 
{
    $email = sanitize_input($_POST["email"]);
    // Additional check to make sure e-mail address is well-formed. 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errorMsg .= "Invalid email format."; 
        $success = false;
    } 
}
if ($success) 
{
     $count = $count + 1;
} else 
{

}


if (empty($_POST["lname"])) 
{
    $errorMsg .= "Last Name is required.<br>"; 
    $success = false;
} 
else 
{
    $lname= sanitize_input($_POST["lname"]);
    {
        $success = true;
    } 
}
if ($success) 
{
    $count = $count + 1;
} else 
{

}

if (empty($_POST["pwd"]))
{
    $errorMsg .= "Password is required.<br>";
    $success = false;
}
if ($success) 
{
    
    $count = $count + 1;
}

else
{ 

}    
if (empty($_POST["pwd_confirm"]))
{
    $errorMsg .= "Confrimed Password is required.<br>";
    $success = false;
} 
if ($success) 
{
    $count = $count + 1;
}
else
{ 

}   

if ($_POST["pwd"] === $_POST["pwd_confirm"])
{
    $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    $count = $count + 1;
}
else
{
    $errorMsg .="Passwords do not match!<br>";

}
    
if ($count === 5)
{
    echo "<h1>Your Registration is successful!</h1>";
    echo "<h3>Thank your signing up, ". $fname," ", $lname .".</h3>";
    echo "<form action='index.php'><button id='successful' class='btn btn-success' type='submit' >Home</button></form>";
    //saveMemberToDB();
}    
else
{   
   echo "<h1>Oops!</h1>";
    echo "<h3>The following errors were detected: </h3>";
    echo "<p>".$errorMsg."</p>";
    echo "<form action='register.php'><button id ='try_again' class='btn btn-danger' type='submit' >Try Again!</button></form>"; 
}    
//Helper function that checks input for malicious or unwanted content. 
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); return $data;
} 
?>
<?php
include "footer.inc.php"; ?>
 <?php 

/* Helper function to write the member data to the DB */
/* 
function saveMemberToDB() 
{
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success; 
    
    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], 
            $config['password'], $config['dbname']);
    
    // Check connection
    if ($conn->connect_error) 
    {
        $errorMsg = "Connection failed: " . $conn->connect_error; 
        $success = false;
    } 
    else 
    {
        // Prepare the statement:
        $stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");

        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed); if (!$stmt->execute())
    {
        $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error; $success = false;
    }
    $stmt->close(); 
    
    }
$conn->close(); 
}
?>
 */
