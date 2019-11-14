<?php view("layouts/header") ?>

    <div class="container-fluid clearfix">
        <div class="float-left">
            <a href="/admin/products" class="btn btn-secondary">Products</a>
        </div>
        <div class="float-right">
            <a href="/admin/logout" class="btn btn-secondary">Logout</a>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <h3>Product Create</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4">
                <form action="/admin/product/create" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Email</label>
                        <input name="image" type="file" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </form>

                <?php view('layouts/errors') ?>

            </div>
        </div>
    </div>

<?php view("layouts/footer") ?>