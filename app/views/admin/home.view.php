<?php view("layouts/header") ?>

<div class="container-fluid text-right">
    <a href="/admin/logout" class="btn btn-secondary">Logout</a>
</div>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="text-center">
            <h3>Hello Admin</h3>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="text-center">
            <ul>
                <li>
                    <a href="/admin/products">Products</a>
                </li>
                <li>
                    <a href="/admin/comments">Comments</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php view("layouts/footer") ?>