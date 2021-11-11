<html>
<head>
        <?php
            include "includes.inc.php";
        ?>

    <title>Dolphin Academy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    include "nav.inc.php";
    ?>
    <main class="container">
        <h1>Member Login</h1>
        <form action="process_login.php" method="post">

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
    <button class="btn btn-primary" style="margin-top: 10px" type="submit">Login</button>
</div>
</form>
    </main>
    <?php
    include "footer.inc.php";
    ?>
</body>
</html>

