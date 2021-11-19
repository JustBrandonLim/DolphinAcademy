<?php 
    session_start();
    if ($_SESSION["usergroup"] !== 1)
    {
        header("Location:./index.php"); 
        die();
    }
?>

<!DOCTYPE html>
<html>
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
                
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $errorMessage = "";
                    
                    switch ($_POST["submit"]) {
                        case "add_course":
                            $errorMessage = addCourse($_POST["cname"], $_POST["cdesc"]);
                            break;
                        case "delete_course":
                            $errorMessage = deleteCourse($_POST["selectedCourseName"]);
                            break;
                        case "update_course":
                            $errorMessage = updateCourse($_POST["selectedCourseName"], $_POST["cname"], $_POST["cdesc"]);
                            break;
                    }
                                     
                    if (empty($errorMessage))
                    {
                        echo "<script>alert(\"Operation succeeded!\");</script>";
                    }
                    else
                    {
                        echo "<script>alert(\"" . $errorMessage . "\");</script>";
                    }
                }
            ?>
            <header>
                <h1>Admin</h1>
                <p>This admin dashboard allows you to add and delete courses from the Dolphin Academy system.</p>
            </header>
            <div class="row">
                <div class="col-auto">
                    <div class="card small-card">
                        <div class="card-body">
                            <h5 class="card-title">Add Course</h5>
                            <p class="card-text">This function allows you to add courses.</p>
                            <form name="add_course_form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"> 
                                <div class="form-group">
                                    <label for="cname">Product Name:</label>
                                    <input class="form-control" type="text" id="cnameAdd" maxlength="45" name="cname" 
                                            placeholder="Enter product name">
                                </div>

                                <div class="form-group">
                                    <label for="cdesc">Product Description:</label>
                                    <textarea class="form-control" id="cdescAdd" maxlength="255" name="cdesc" 
                                            placeholder="Enter product description"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" value="add_course" name="submit">Add Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card small-card">
                        <div class="card-body">
                            <h5 class="card-title">Delete Course</h5>
                            <p class="card-text">This function allows you to delete course.</p>
                            <form name="delete_course_form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">  
                                <div class="form-group">
                                    <label for="cname">Course Name:</label>
                                    <select class="form-select" id="cnameDelete" name="selectedCourseName">
                                        <?php 
                                            $errorMessage = populateCoursesDropDown();
                                            
                                            if (!empty($errorMessage))
                                            {
                                                echo "<script>alert(\"" . $errorMessage . "\");</script>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" value="delete_course" name="submit">Delete Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card small-card">
                        <div class="card-body">
                            <h5 class="card-title">Update Course</h5>
                            <p class="card-text">This function allows you to update courses.</p>
                            <form name="delete_course_form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">  
                                <div class="form-group">
                                    <label for="pname">Course Name:</label>
                                    <select class="form-select" id="selectedCourseNameUpdate" name="selectedCourseName">
                                        <?php 
                                            $errorMessage = populateCoursesDropDown();
                                            
                                            if (!empty($errorMessage))
                                            {
                                                echo "<script>alert(\"" . $errorMessage . "\");</script>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="cname">Course Name:</label>
                                    <input class="form-control" type="text" id="cnameUpdate" maxlength="45" name="cname" 
                                            placeholder="Enter course name">
                                </div>

                                <div class="form-group">
                                    <label for="cdesc">Course Description:</label>
                                    <textarea class="form-control" id="cdescUpdate" maxlength="255" name="cdesc" 
                                            placeholder="Enter course description"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" value="update_course" name="submit">Update Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <?php
        include "./footer.inc.php"; 
    ?>
</html>