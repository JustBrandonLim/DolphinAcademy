<html>
    <head>
        <?php
        include "./includes.inc.php";
        ?>

        <title>Dolphin Academy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        include "./nav.inc.php";
        ?>
        <main class="container">
            <h1>Setting</h1>
            <form action="./process_.php" method="post">
                <h2>Password</h2>
                <p>Creating a password allows you to log in with your Dolphin Academy username and password.</p>
                <div class="form-group">
                    <label for="email">New password:</label>
                    <input class="form-control" id="email" 
                           name="email" type ="email"  placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="pwd">Re-enter new password: </label>
                    <input class="form-control" type="password" id="pwd"  
                           name="pwd" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" style="margin-top: 10px" type="submit">Create password</button>
                </div>
                <div class="form-group">
                    <h2>Delete Account</h2>
                    <button class="btn btn-primary" style="margin-top: 10px; background: red;" type="submit">Delete your account</button>
                </div>
            </form>
        </main>
        <?php
        include "./footer.inc.php";
        ?>
    </body>
</html>
