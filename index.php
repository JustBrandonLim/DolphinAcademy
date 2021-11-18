<!DOCTYPE html>
<style>
body{
    /*background-color: #000 !important;*/
}
section{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.zero{
    background-image: url("/images/dolphinaca1.jpg");
    height: 100vh;
    backgroud-position: center ;
    background-repeat: no-repeat ;
    background-size: cover ;   
}
.one{
    background-image: url("/images/writing1.jpg");
    height: 100vh;
    backgroud-position: center;
    background-repeat: no-repeat;
    background-size: cover;  
    
}
.two{
    background-image: url("/images/programming1.jpg");
    height: 100vh;
    backgroud-position: center;
    background-repeat: no-repeat;
    background-size: cover;   
}

.container a{
    text-decoration: none;
    color: black;
    font-size: 80px;
    margin-left: 16px; 
}
a span{
    background-color: white;
}
p span{
    background-color: white;
}

</style>
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
        <header>
<!--            <h1 class="display-4">Welcome to Dolphin Academy!</h1>
            <h2>Home of Learners</h2>-->
        </header>
<!--        <section>
            Check out our available courses<a href=#> here!</a>
        </section>-->
        <div class="container">
            <section class="zero">
                <a href="aboutus.php"><span>Dolphin Academy</span></a>
            </section>
            <section class="one">
                <a href="products.php"><span>"Learn continually - there's always "one more thing" to learn" - Steve Jobs </span></a>
            </section>
            <section class="two">
                <a href="products.php"><span>Maximise learning opportunities with us!</span></a>
            </section>
        </div>
    </body>
<?php
include "footer.inc.php"; ?>
</html>