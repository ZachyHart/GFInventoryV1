document.getElementById('addProductForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // References to form fields
    const imageInput = document.getElementById('productImage');
    const category = document.getElementById('productCategory').value;
    const name = document.getElementById('productName').value;
    const price = document.getElementById('productPrice').value;
    const stock = document.getElementById('productStock').value;

    // Validate input (excluding image for simplicity)
    if (!category || !name || !price || !stock || imageInput.files.length === 0) {
        alert('Please fill in all fields and select an image.');
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        const imageSrc = e.target.result;

        // Confirm save
        if (!confirm('Do you want to save this product?')) {
            return;
        }

        // Create product card HTML string with the image
        const productCard = `<div class="col-12">
            <div class="card mb-3">
                <div class="row g-0 align-items-center">
                    <div class="col-md-3 col-lg-2">
                        <img src="${imageSrc}" class="img-fluid rounded-start product-img-custom" alt="Product Image">
                    </div>
                    <div class="col-md-9 col-lg-10">
                        <div class="card-body">
                            <p class="card-text"><small class="text-category">${category}</small></p>
                            <h5 class="card-title">${name}</h5>
                            <p class="card-text">₱${price}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text"><small class="text-category">In stock x${stock}</small></p>
                                <a href="#" class="btn btn-warning">EDIT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

        // Append new product card to the container
        document.querySelector('.container .row').insertAdjacentHTML('beforeend', productCard);

        // Clear form fields and close the modal
        document.getElementById('addProductForm').reset();
        $('#addProductModal').modal('hide'); // Using jQuery for Bootstrap's modal
    };

    // Read the file as Data URL
    reader.readAsDataURL(imageInput.files[0]);
});

document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL path
    const currentPath = window.location.pathname;
    // Extract the filename or PHP script name from the path
    const currentPage = currentPath.substring(currentPath.lastIndexOf('/') + 1);

    document.querySelectorAll('.sidebar-nav .sidebar-link').forEach(function(link) {
        // Extract the link target from the href attribute
        const linkTarget = new URL(link.href).pathname.substring(new URL(link.href).pathname.lastIndexOf('/') + 1);

        if (currentPage === linkTarget) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});



