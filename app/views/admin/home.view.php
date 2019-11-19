<?php view("layouts/header") ?>

<div class="container-fluid text-right">
    <a href="/admin/logout" class="btn btn-secondary">Logout</a>
</div>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="text-center">
            <h3>Hello Admin <i><?= $user ?></i></h3>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="text-center">
            <a href="/admin/products" class="btn btn-light">Products</a>
            <a href="/admin/comments" class="btn btn-light">Comments</a>
        </div>
    </div>
</div>

<?php view("layouts/footer") ?>