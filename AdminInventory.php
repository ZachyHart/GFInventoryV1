<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Got Funko Collections</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <!-- Sidebar content goes here -->
            <div class="sidebar-logo">
                <img src="img/CircularLogo.jpg" alt="Logo" style="width: 100%; max-width: 120px; display: block; margin: 0 auto;">
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="AdminInventory.php" class="sidebar-link" data-page="products" title="Our Products">
                        <i class="lni lni-cart"></i>
                        <span>Our Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="AdminFeedback.php" class="sidebar-link" data-page="feedback" title="Feedback">
                        <i class="lni lni-comments"></i>
                        <span>Feedback</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="login.php" class="sidebar-link" title="Logout">
                    <i class="lni lni-exit"></i>
                </a>
            </div>
        </aside>

        <div class="main p-3">
            <div class="text-center mb-4">
                <h1>Inventory</h1>
                <!-- Trigger/Add Product Button -->
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal">ADD PRODUCT</button>
            </div>

            <div class="container">
                <div class="row">
                    <!-- Products will be added here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage" required accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Product Category</label>
                            <input type="text" class="form-control" id="productCategory" required>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="productStock" class="form-label">Stock Level</label>
                            <input type="number" class="form-control" id="productStock" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="AdminInventory.js"></script>
</body>
</html>
