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
                <h3>Comments</h3>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <h4>Pending:</h4>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">Comment</td>
                        <td scope="col">Author</td>
                        <td scope="col">Email</td>
                        <td scope="col">Option</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter_p = count($pending); ?>
                    <?php foreach ($pending as $comment): ?>
                        <tr>
                            <td scope="row"><?= $counter_p ?></td>
                            <td><?= $comment->content ?></td>
                            <td><?= $comment->user_name ?></td>
                            <td><?= $comment->user_email ?></td>
                            <td>
                                <form action="/admin/comment/approve" method="post" class="d-inline">
                                    <input name="id" type="hidden" value="<?= $comment->id ?>">
                                    <button type="submit"><i class="fa fa-check text-success"></i></button>
                                </form>
                                <form action="/admin/comment/delete" method="post" class="d-inline">
                                    <input name="id" type="hidden" value="<?= $comment->id ?>">
                                    <button type="submit"><i class="fa fa-times text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php $counter_p--; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <h4>Approved:</h4>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">Comment</td>
                        <td scope="col">Author</td>
                        <td scope="col">Email</td>
                        <td scope="col">Option</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter_a = count($approved); ?>
                    <?php foreach ($approved as $comment): ?>
                        <tr>
                            <td scope="row"><?= $counter_a ?></td>
                            <td><?= $comment->content ?></td>
                            <td><?= $comment->user_name ?></td>
                            <td><?= $comment->user_email ?></td>
                            <td>
                                <form action="/admin/comment/delete" method="post" class="d-inline">
                                    <input name="id" type="hidden" value="<?= $comment->id ?>">
                                    <button type="submit"><i class="fa fa-times text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php $counter_a-- ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php view("layouts/footer") ?>