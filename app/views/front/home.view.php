<?php view("front/layouts/header") ?>

    <div class="container">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-4">
                    <img src="<?= $product->image_path ?>" alt="<?= $product->image_path ?>">
                    <h3><?= $product->name ?></h3>
                    <p><?= $product->description ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row justify-content-center">
            <div class="col-8">
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
                        <textarea name="comment" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary">Send comment</button>
                    </div>
                </form>

                <?php view('front/layouts/flash') ?>

            </div>
        </div>
    </div>

<?php view("front/layouts/footer") ?>