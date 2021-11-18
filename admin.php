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
        <main class="container-fluid">  
            <div class="row">
                <h1>Admin</h1>
                <p>This admin dashboard allows you to add and delete products from the Dolphin Academy system.</p>
                <div class="col-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Product</h5>
                            <p class="card-text">This function allows you to add products.</p>
                            <form action="process_register.php" method="post"> 
                                <div class="form-group">
                                    <label for="pname">Product Name:</label>
                                    <input class="form-control" type="text" id="pname" maxlength="45" name="pname" 
                                            placeholder="Enter product name">
                                </div>

                                <div class="form-group">
                                    <label for="pdesc">Product Description:</label>
                                    <textarea class="form-control" id="pdesc" maxlength="255" name="pdesc" 
                                            placeholder="Enter product description"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Add Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Delete Product</h5>
                            <p class="card-text">This function allows you to delete products.</p>
                            <form action="process_register.php" method="post">  
                                <div class="form-group">
                                    <label for="pname">Product Name:</label>
                                    <select class="form-select" id="pname" name="pname" aria-label="Products">
                                        <option selected>Test Product 1</option>
                                        <option value="1">Test Product 1</option>
                                        <option value="2">Test Product 1</option>
                                        <option value="3">Test Product 1</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Delete Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update Product</h5>
                            <p class="card-text">This function allows you to update products.</p>
                            <form action="process_register.php" method="post">  
                                <div class="form-group">
                                    <label for="pname">Product Name:</label>
                                    <select class="form-select" id="pname" name="pname" aria-label="Products">
                                        <option selected>Test Product 1</option>
                                        <option value="1">Test Product 1</option>
                                        <option value="2">Test Product 1</option>
                                        <option value="3">Test Product 1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pname">Product Name:</label>
                                    <input class="form-control" type="text" id="pname" maxlength="45" name="pname" 
                                            placeholder="Enter product name">
                                </div>

                                <div class="form-group">
                                        <label for="pdesc">Product Description:</label>
                                        <textarea class="form-control" id="pdesc" maxlength="255" name="pdesc" 
                                                placeholder="Enter product description"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Delete Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    require "php/DatabaseFunctions.php";
                ?>
            </div>
        </main>
    </body>
    <?php
        include "footer.inc.php"; 
    ?>
</html>