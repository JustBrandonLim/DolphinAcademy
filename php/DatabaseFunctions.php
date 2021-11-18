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
?>
