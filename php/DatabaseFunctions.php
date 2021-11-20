<?php
    include "DatabaseConnection.php";

    function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    } 
    
    //Register
    function registerMember($fname, $lname, $email, $pwd_hashed)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("INSERT INTO dolphin_academy_users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
            $statement->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
            $statement->execute();
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again."; 
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    
    //Login
    function loginMember($email, $pwd)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_users WHERE email=?");
            $statement->bind_param("s", $email);
            $statement->execute();
            $result = $statement->get_result();
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $pwd_hashed = $row["password"];
                
                if (!password_verify($_POST["pwd"], $pwd_hashed)) 
                {               
                    $errorMessage = "Your login information is incorrect. Please try again.";
                }
                else
                {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["lname"] = $row["lname"];
                    $_SESSION["email"] = $email;
                    $_SESSION["usergroup"] = $row["usergroup"];
                }
            }
            else 
            {
                $errorMessage = "Your login information is incorrect. Please try again.";
            }
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again."; 
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    
    //Courses
    function populateCourses()
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_courses");
            $statement->execute();
            $result = $statement->get_result();
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                    echo "<div class=\"col\">";
                    echo "<div class=\"card small-card\">";
                    echo "<div class=\"card-body\">";
                    echo "<h5 class=\"card-title\">" . $row["name"] . "</h5>";
                    echo "<p class=\"card-text\">" . $row["description"] . "</p>";
                    echo "<a href=\"#\" class=\"btn btn-primary\">View Video</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            else
            {
                $errorMessage = "No courses available.";
            }
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again.";
            return $errorMessage;
        }
        
        return $errorMessage;
    }

    //Reviews
    function getReviews()
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
            $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_reviews INNER JOIN dolphin_academy_users ON dolphin_academy_reviews.fuser = dolphin_academy_users.id");
            $statement->execute();
            $result = $statement->get_result();
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                    echo "<div style=\"padding-bottom:10px;\">";
                    echo "<div class=\"card w-100\">";
                    echo "<div class=\"card-body\">";
                    echo "<p class=\"card-text\">" . $row["content"] . "</p>";
                    echo "<h6 class=\"card-subtitle mb-2 text-muted\"> - " . $row["fname"] . " " . $row["lname"] . "</h6>";
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
    
    //Admin
    function populateCoursesDropDown()
    {
        $selected = false;
        
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_courses");
            $statement->execute();
            $result = $statement->get_result();
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                    if (!$selected)
                    {
                        echo "<option selected value=\"" . $row["name"] . "\">" . $row["name"] . "</option>";
                        $selected = true;
                    }
                    else
                    {
                        echo "<option value=\"" . $row["name"] . "\">" . $row["name"] . "</option>";
                    }
                }
            }
            else
            {
                $errorMessage = "No courses available.";
            }
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again.";
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    
    function addCourse($courseName, $courseDescription)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("INSERT INTO dolphin_academy_courses (name, description) VALUES (?, ?)");
            $statement->bind_param("ss", $courseName, $courseDescription);
            $statement->execute();
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again."; 
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    
    function deleteCourse($selectedCourseName)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("DELETE FROM dolphin_academy_courses WHERE name=?");
            $statement->bind_param("s", $selectedCourseName);
            $statement->execute();
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again."; 
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    
    function updateCourse($selectedCourseName, $courseName, $courseDescription)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("UPDATE dolphin_academy_courses SET name=?, description=? WHERE name=?");
            $statement->bind_param("sss", $courseName, $courseDescription, $selectedCourseName);
            $statement->execute();
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again."; 
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    
function deleteUser($email)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("DELETE FROM dolphin_academy_users WHERE email=?");
            $statement->bind_param("s", $email);
            $statement->execute();
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again."; 
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    function updatePassword($email,$pwd_hashed)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("UPDATE dolphin_academy_users SET password=? WHERE email=?");
            $statement->bind_param("ss",$pwd_hashed,$email);
            $statement->execute();
            $statement->close(); 
        } 
        catch (Exception $e)
        {
            $errorMessage = "An error has occured. Please try again."; 
            return $errorMessage;
        }
        
        return $errorMessage;
    }
    
?>
