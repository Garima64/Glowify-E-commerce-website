<?php include 'includes/header.php'; ?>

<!-- Landscape Image Container -->
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <img src="images/banner1.jpg" class="img-fluid" alt="Landscape Image" style="height: 70vh; width: 100%; object-fit: cover;">
        </div>
    </div>
</div>

<!-- Most Selling Products Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Our Top Selling Products</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <a href="products.php">
                    <img src="images/p1.jpg" class="card-img-top img-animate" alt="P 1" style="height: 200px; object-fit: cover;">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Cleanser</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <a href="products.php">
                    <img src="images/p3.jpg" class="card-img-top img-animate" alt="P 3" style="height: 200px; object-fit: cover;">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Mascara</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <a href="products.php">
                    <img src="images/p4.jpg" class="card-img-top img-animate" alt="P 4" style="height: 200px; object-fit: cover;">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">Lipstick</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<style>
.img-animate {
    transition: transform 0.2s;
}

.img-animate:hover {
    transform: scale(1.05);
}
</style>