<!DOCTYPE html>
<html>
    <head>
        <?php
            include "includes.inc.php";
        ?>
    </head>
    <body>
        <?php
            include "nav.inc.php";
        ?>
        <main class="container-fluid">
            <?php
                include "php/DatabaseFunctions.php";
                
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
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
                                <div class="form-group">
                                    <label for="cname">Product Name:</label>
                                    <input class="form-control" type="text" id="pname" maxlength="45" name="cname" 
                                            placeholder="Enter product name">
                                </div>

                                <div class="form-group">
                                    <label for="cdesc">Product Description:</label>
                                    <textarea class="form-control" id="pdesc" maxlength="255" name="cdesc" 
                                            placeholder="Enter product description"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Add course</button>
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
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
                                <div class="form-group">
                                    <label for="cname">Product Name:</label>
                                    <select class="form-select" id="pname" name="cname" aria-label="Products">
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
                                    <button class="btn btn-primary" type="submit">Delete Course</button>
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
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
                                <div class="form-group">
                                    <label for="pname">Product Name:</label>
                                    <select class="form-select" id="pname" name="pname" aria-label="Products">
                                        <?php 
                                            $errorMessage = populateCoursesDropDown();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cname">Product Name:</label>
                                    <input class="form-control" type="text" id="pname" maxlength="45" name="cname" 
                                            placeholder="Enter course name">
                                </div>

                                <div class="form-group">
                                        <label for="cdesc">Product Description:</label>
                                        <textarea class="form-control" id="pdesc" maxlength="255" name="cdesc" 
                                                placeholder="Enter course description"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    require "php/DatabaseFunctions.php";
                ?>
            </div>
        </main>
    </body>
    <?php
        include "footer.inc.php"; 
    ?>
</html>