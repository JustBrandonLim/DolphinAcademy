<?php session_start(); ?>
<?php
    include includes.inc.php
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid p-0">
        <!--
        <a class="navbar-brand" href="index.php">
            <img class="rounded-circle" src="assets/logo.png" alt="Logo"
               width="60" height="45"/>
        </a>
        -->
        <a href="aboutus.php"id="company_name">Dolphin Academy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./courses.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./reviews.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./aboutus.php">About Us</a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <?php if ($_SESSION["loggedin"] === true): ?>
                    <?php if ($_SESSION["usergroup"] === 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./admin.php">Admin</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./settings.php">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>