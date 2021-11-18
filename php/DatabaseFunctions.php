<?php
include "DatabaseConnection.php";

function getProducts()
{
    $success = false;
    
    $connection = DatabaseConnection::getInstance();
    
    $connectionGet = $connection->getConnection();
    
    if ($connectionGet->connect_error)
    {
        echo "Connection failed! Error: " . $connectionGet->connect_error;
    }
    else
    {
        // Prepare the statement:
        $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_products");
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) 
            {
                echo "<div class=\"col\">";
                echo "<div class=\"card\" style=\"width: 18rem;\">";
                echo "<div class=\"card-body\">";
                echo "<h5 class=\"card-title\">" . $row["name"] . "</h5>";
                echo "<p class=\"card-text\">" . $row["description"] . "</p>";
                echo "<a href=\"#\" class=\"btn btn-primary\">View Video</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            
            $success = true;
        }
        else
        {
            echo "Products not available!";
        }
        $statement->close();
    }
    
    return $success;
}

function saveMemberToDB() 
{
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success; 
    
    // Create database connection.
    $connection = DatabaseConnection::getInstance();
    
    $connectionGet = $connection->getConnection();
    
    // Check connection
    if ($connectionGet->connect_error) 
    {
        $errorMsg = "Connection failed: " . $connectionGet->connect_error; 
        $success = false;
    } 
    else 
    {
        // Prepare the statement:
        $stmt = $connectionGet->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");

        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed); if (!$stmt->execute())
    {
        $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error; $success = false;
    }
    $stmt->close(); 
    
    }
    $connectionGet->close(); 
}

function getTestimonials()
{
    $success = false;
    
    $connection = DatabaseConnection::getInstance();
    
    $connectionGet = $connection->getConnection();
    
    if ($connectionGet->connect_error)
    {
        echo "Connection failed! Error: " . $connectionGet->connect_error;
    }
    else
    {
        // Prepare the statement:
        $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_testimonial INNER JOIN dolphin_academy_users ON dolphin_academy_testimonial.fuser = dolphin_academy_users.id");
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()) 
            {
                echo "<div class=\"col-6\" style=\"padding-bottom:10px;\">";
                echo "<div class=\"card\" style=\"width: 30rem;\">";
                echo "<div class=\"card-body\">";
                echo "<p class=\"card-text\">" . $row["content"] . "</p>";
                echo "<h6 class=\"card-subtitle mb-2 text-muted\"> - " . $row["username"] . "</h6>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            
            $success = true;
        }
        else
        {
            echo "No testimonials found.";
        }
        $statement->close();
    }
    
    return $success;
}
?>
