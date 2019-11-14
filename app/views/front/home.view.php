<?php view("layouts/header") ?>

    <div class="container">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-4 mb-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <img src="<?= asset('images/' . $product->image_path) ?>" alt="<?= $product->image_path ?>" width="250px">
                        </div>
                        <div class="card-body text-center">
                            <h3><?= $product->name ?></h3>
                            <p><?= $product->description ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <h3>Comments:</h3>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <?php foreach ($comments as $comment) : ?>
                <div class="col-4 card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="<?= $comment->name ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="<?= $comment->email ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="description">Comment</label>
                            <textarea cols="30" rows="2" class="form-control" disabled><?= $comment->content ?></textarea>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <h3>Leave your comment:</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4">
                <form action="comment/" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Comment</label>
                        <textarea name="comment" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary">Send comment</button>
                    </div>
                </form>

                <?php view('layouts/errors') ?>

            </div>
        </div>
    </div>

<?php view("layouts/footer") ?>