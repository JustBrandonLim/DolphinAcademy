<!DOCTYPE html>
<html lang="en">
    <head>
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

            #main a{
                align-content: center;
                text-decoration: none;
                color: black;
                font-size: 10vh;
                margin-left: 16px; 
            }
            #main .container{
                padding: 0;
            }
            a span{
                background-color: white;
            }
            p span{
                background-color: white;
            }
        </style>
        <?php
            include "includes.inc.php";
        ?>
    </head>
    <body>
        <?php
            include "nav.inc.php";
        ?>
        <div id ="main" class="container-fluid p-0">
            <section class="one">
                <a href="products.php"><span>"Learn continually - there's always<br>'one more thing' to learn,"<br>- Steve Jobs </span></a>
            </section>
            <section class="two">
                <a href="products.php"><span>Maximise learning opportunities<br>with us!</span></a>
            </section>
        </div>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>