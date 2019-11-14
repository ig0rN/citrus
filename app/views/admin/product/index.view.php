<?php view("layouts/header") ?>

    <div class="container-fluid clearfix">
        <div class="float-left">
            <a href="/admin/home" class="btn btn-secondary">Home page</a>
        </div>
        <div class="float-right">
            <a href="/admin/logout" class="btn btn-secondary">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <h3>Products</h3>
            </div>
        </div>

        <div class="justify-content-center mt-4">
            <div class="text-right">
                <a href="/admin/product/create" class="btn btn-success">Create new</a>
            </div>
            <div class="text-center">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">Name</td>
                        <td scope="col">Option</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter_p = 1; ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td scope="row"><?= $counter_p ?></td>
                            <td><?= $product->name ?></td>
                            <td>
                                <form action="/admin/product/edit" method="get" class="d-inline">
                                    <input name="id" type="hidden" value="<?= $product->id ?>">
                                    <button type="submit"><i class="fa fa-edit text-success"></i></button>
                                </form>
                                <form action="/admin/product/delete" method="post" class="d-inline">
                                    <input name="id" type="hidden" value="<?= $product->id ?>">
                                    <button type="submit"><i class="fa fa-times text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php $counter_p++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php view("layouts/footer") ?>