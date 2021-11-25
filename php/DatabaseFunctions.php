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
                    $_SESSION["userid"] = $row["userid"];
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
                    
                    include "includes.inc.php";
                    
                    session_start();
                    if ($_SESSION["loggedin"] === true)
                    {
                        echo "<form action=\"./view_course.php\" method=\"post\">";
                        echo "<button class=\"btn btn-primary\" type=\"submit\" value=\"". $row["name"] . "\" name=\"submit\"\">View " . $row["name"] . "</button>";
                        echo "</form>";
                    }
                    else  
                    {
                        echo "<a href=\"./login.php\" class=\"btn btn-primary\">Login to View Course</a>";
                    }
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
    
    function viewCourse($name)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        try
        {
            $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_courses WHERE name=?");
            $statement->bind_param("s", $name);
            $statement->execute();
            $result = $statement->get_result();
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $course_url = $row["url"];
                $changed_course_url = str_replace("/var/www/html", ".", $course_url);
                //1024×576
                echo "<div class=\"ratio ratio-16x9\">
                        <video id=\"course\" src=\"" . $changed_course_url . "\" controls autoplay></video>
                    </div>";
            }
            else 
            {
                $errorMessage = "Course not found. Please try again.";
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
            // Prepare the statement
            $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_reviews INNER JOIN dolphin_academy_users ON dolphin_academy_reviews.fuser = dolphin_academy_users.userid ORDER BY id");
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
                echo "No reviews found.";
            }
            $statement->close();
        }

        return $success;
    }
    
    //Reviews
    function addReview($review, $id)
    {
        $errormsg = "";

        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        if ($connectionGet->connect_error)
        {
            echo "Connection failed! Error: " . $connectionGet->connect_error;
        }
        else
        {
            // Prepare the insert
            $statement = $connectionGet->prepare("INSERT INTO dolphin_academy_reviews (content,fuser) VALUES (?,?)");
            //bind param
            $statement->bind_param("si",$review,$id);
            //execute and check error
            if(!$statement->execute()){
                $errormsg = "An error has occurred. Please try again.";
            };
            //close connection
            $statement->close();
        }

        return $errormsg;
    }
    
    //Reviews
    function checkReview($id)
    {
        $success = true;

        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        if ($connectionGet->connect_error)
        {
            echo "Connection failed! Error: " . $connectionGet->connect_error;
        }
        else
        {
            // Prepare the insert
            $statement = $connectionGet->prepare("SELECT * FROM dolphin_academy_reviews WHERE fuser = $id");
            //execute and check error
            if(!$statement->execute()){
                $errormsg = "An error has occurred. Please try again.";
            } else {
                $statement->store_result();
                $count = $statement->num_rows;
            }
            return $count;
            //close connection
            $statement->close();
        }

        return $errormsg;
    }
    
    function updateReview($review, $id)
    {
        $errormsg = "";

        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        if ($connectionGet->connect_error)
        {
            echo "Connection failed! Error: " . $connectionGet->connect_error;
        }
        else
        {
            // Prepare the insert
            $statement = $connectionGet->prepare("UPDATE dolphin_academy_reviews SET content = ? WHERE fuser = ?");
            //bind param
            $statement->bind_param("si",$review,$id);
            //execute and check error
            if(!$statement->execute()){
                $errormsg = "An error has occurred. Please try again.";
            };
            //close connection
            $statement->close();
        }

        return $errormsg;
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
    
    function addCourse($courseName, $courseDescription, $courseFile)
    {
        $errorMessage = "";
        
        $connection = DatabaseConnection::getInstance();
        $connectionGet = $connection->getConnection();

        $sanitizedFileName = sanitizeInput($courseFile["name"]);
        
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
        $target_file = $target_dir . basename($sanitizedFileName);
        
        try
        {
            if (!move_uploaded_file($courseFile["tmp_name"], $target_file))
            {
                $errorMessage = "An error has occured. Your file was not uploaded.";
            }
            
            $statement = $connectionGet->prepare("INSERT INTO dolphin_academy_courses (name, description, url) VALUES (?, ?, ?)");
            $statement->bind_param("sss", $courseName, $courseDescription, $target_file);
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
            $getStatement = $connectionGet->prepare("SELECT url FROM dolphin_academy_courses WHERE name=?");
            $getStatement->bind_param("s", $selectedCourseName);
            $getStatement->execute();
            $result = $getStatement->get_result();
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                if (!unlink($row["url"]))
                {
                    $errorMessage = "Deleting failed.";
                }
            }
            else
            {
                $errorMessage = "No courses available.";
            }
            $getStatement->close(); 
            
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
    
    function updatePassword($email, $pwd_hashed)
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
