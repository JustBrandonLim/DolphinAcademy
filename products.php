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
        <main class="container">  
            <div class="row">
                <?php
                    $errorMsg = "";
                    $success = true;

                    getProducts();

                    if (!$success)
                    {
                        echo $errorMsg;
                    }

                    function getProducts()
                    {
                        global $errorMsg;

                        // Create database connection.
                        $config = parse_ini_file('./db-config.ini');
                        //$config = parse_ini_file('../../private/db-config.ini');
                        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

                        // Check connection
                        if ($conn->connect_error)
                        {
                            $errorMsg = "Connection failed! Error: " . $conn->connect_error;
                            $success = false;
                        }
                        else
                        {
                            // Prepare the statement:
                            $stmt = $conn->prepare("SELECT * FROM dolphin_academy_products");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0)
                            {
                                while($row = $result->fetch_assoc()) {
                                    echo "<div class=\"col\">";
                                    echo "<div class=\"card\" style=\"width: 18rem;\">";
                                    echo "<div class=\"card-body\">";
                                    echo "<h5 class=\"card-title\">" . $row["name"] . "</h5>";
                                    echo "<p class=\"card-text\">" . $row["description"] . "</p>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                            else
                            {
                                $errorMsg = "Products not available!";
                                $success = false;
                            }
                            $stmt->close();
                        }
                        $conn->close();
                    }
                ?>
            </div>
        </main>
    </body>
    <?php
        include "footer.inc.php"; 
    ?>
</html>