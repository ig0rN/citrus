<?php view("layouts/header") ?>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="text-center">
                <h3>Login</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4">
                <form action="/admin" method="post">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input name="username" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Password</label>
                        <input name="password" type="password" class="form-control">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <?php view('layouts/errors') ?>

            </div>
        </div>
    </div>
<?php view("layouts/footer") ?>