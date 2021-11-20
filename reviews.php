<?php
    session_start();
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
        <header>
            <h1 style="padding-top: 10px;padding-bottom: 10px;">Reviews</h1>
        </header>
        <main class="container"> 
            <div class="row">
                <?php
                    include "./php/DatabaseFunctions.php";
                    getReviews(); 
                    //check if method is post
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        
                        $errorMsg = $review = $update = " ";
                        $id = $_SESSION["userid"];
                        
                        switch ($_POST["submit"]) {
                        case "add_review":
                            //check if empty
                            if(empty($_POST["review"])){
                                $errorMsg .= "Empty Review! Please enter your valuable review before submitting!";
                                break;
                            }
                            else{
                                $review = htmlspecialchars($_POST["review"]);
                            }
                            
                            $errorMsg = addReview($review, $id);
                            break;
                        case "update_review":
                            if(empty($_POST["update"])){
                                $errorMsg .= "Empty Review! Please enter your valuable review before submitting!";
                                break;
                            }
                            else{
                                $update = htmlspecialchars($_POST["update"]);
                            }
                            $errorMsg = updateReview($update, $id);
                            break;
                        }
                        if (empty($errorMsg)){
                            echo "<script>alert(\"Thank you for your review!\");</script>";
                            echo "<script>window.location.replace('reviews.php');</script>";
                        }
                        else {
                            echo "<script>alert(\"" . $errorMsg . "\");</script>";
                        }
                    }
                    
                ?>
            </div>
            <?php
            $page = $_SERVER["PHP_SELF"];
            $id = $_SESSION["userid"];
                if ($_SESSION["loggedin"] != true){
                    echo "<div class='container'>
                           <p>To leave a review, please login <a href='./login.php'>here</a> first!</p>
                          </div>";
                } 
                else { 
                    $count = checkReview($id);
                    if ($count == 0){
                        //enable add review
                        echo "<form action= '$page' method='post'>
                            <div class='form-inline'>
                                <label for='review'>Your Review Of Us:</label>
                                <textarea class='form-control' id='review' name='review' placeholder='Your thoughts go here!' rows='8' cols='100' style='padding-bottom: 10px;'></textarea>
                            </div>
                            <div class='form-inline'>
                                <button class='btn btn-primary mb-2' type='submit' value='add_review' name='submit' style='margin-top: 10px;'>Submit</button>
                            </div>
                        </form>";
                    }
                    else{
                        //enable update for existing review
                        echo "<form action= '$page' method='post'>
                            <div class='form-inline'>
                                <label for='review'>Your Review Of Us:</label>
                                <textarea class='form-control' id='update' name='update' rows='8' cols='100' style='padding-bottom: 10px;'></textarea>
                            </div>
                            <div class='form-inline'>
                                <button class='btn btn-success mb-2' type='submit' value='update_review' name='submit' style='margin-top: 10px;'>Update</button>
                            </div>
                        </form>";
                    }
                }
            ?>
        </main>
        <?php
            include "./footer.inc.php"; 
        ?>
    </body>
</html>

