<html>
<head>
      <head>
        <?php
            include "includes.inc.php";
        ?>
    </head>
    <body>
        <?php
            include "nav.inc.php";
        ?>  

<body>
    <main class="container">
    <h1>Member Registration</h1> 
    <p>
        For existing members, please go to the 
        <a href="login.php">Sign In page</a>.
    </p>
    
    <form action="process_register.php" method="post"> 
    <div class="form-group">
        <label for="fname">First Name:</label>
        <input class="form-control" type="text" id="fname" maxlength="45" name="fname" 
               placeholder="Enter first name">
    </div>
        
    <div class="form-group">
        <label for="lname">Last Name:</label>
        <input class="form-control" type="text" id="lname" maxlength="45" name="lname" 
               placeholder="Enter last name">
    </div>
        
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email"  name="email" 
               placeholder="Enter email">
    </div>
        
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input class="form-control" type="password" id="pwd" minlength="12" name="pwd" 
               placeholder="Enter password">
    </div>
        
    <div class="form-group">
        <label for="pwd_confirm">Confirm Password:</label>
        <input class="form-control" type="password" id="pwd_confirm" minlength="12" name="pwd_confirm" 
               placeholder="Confirm password">
    </div>
        
    <div class="form-check">
        <label>
            <input type="checkbox" required name="agree"> 
            Agree to terms and conditions.
        </label> 
    </div>
 
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    </form>
</main> 
    <?php
    include "footer.inc.php";
    ?>
</body>
</html>

