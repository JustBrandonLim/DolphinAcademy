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
        <main class="container-fluid">
            <header>
                <h1>Login</h1> 
                <p>For new users, please register <a href="./login.php">here</a>!</p>
            </header>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card small-card">
                        <div class="card-body">
                            <form action="./php/processes/process_login.php" method="post">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input class="form-control" id="email" 
                                            name="email" type ="email"  placeholder="Enter email">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input class="form-control" type="password" id="pwd"  
                                            name="pwd" placeholder="Enter password">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include "./footer.inc.php";
        ?>
    </body>
</html>

