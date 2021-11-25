<!DOCTYPE html>
<html lang="en">
<html>
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
            <h1>About Us</h1>
            <p>Introducing the 4 developers of Dolphin Academy</p>
        </header>
        <main>
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner container">
                    <div class="carousel-item active">
                        <div class="container">
                            <img class="d-block w-100" src="assets/cool.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h2 style="color: white;">Brandon</h2>
                              <p>description</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <img class="d-block w-100" src="assets/cool.jpg" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                              <h2 style="color: white;">Priya</h2>
                              <p>description</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                      <div class="container">
                          <img class="d-block w-100" src="assets/cool.jpg" alt="Third slide">
                          <div class="carousel-caption d-none d-md-block">
                            <h2 style="color: white;">Ismael</h2>
                            <p>description</p>
                          </div>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <div class="container">
                          <img class="d-block w-100" src="assets/cool.jpg" alt="Fourth slide">
                          <div class="carousel-caption d-none d-md-block">
                            <h2 style="color: white;">Elysia</h2>
                            <p>description</p>
                          </div>
                      </div>
                    </div>
                </div>
                  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  </a>
                  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  </a>
            </div>
        </main>
        <?php
            include "./footer.inc.php"; 
        ?>
    </body>
</html>

