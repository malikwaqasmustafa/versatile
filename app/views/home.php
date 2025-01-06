<?php
$title = "Welcome to MyFramework";
require '../app/views/layouts/web/header.php';
?>

<div class="text-center">
    <h1 class="display-4 fw-bold">Welcome to Versatile PHP Framework</h1>
    <p class="lead text-muted">The lightweight and powerful PHP MVC framework for rapid development.</p>
</div>

<div class="row my-5">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Blazing Fast</h5>
                <p class="card-text">Enjoy high performance with our lightweight and optimized framework.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Easy to Use</h5>
                <p class="card-text">Start developing with our clean and intuitive MVC structure.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Modern Features</h5>
                <p class="card-text">Leverage modern routing, controllers, and views for your simple applications</p>
            </div>
        </div>
    </div>
</div>

<?php require '../app/views/layouts/web/footer.php'; ?>
