<?php
    use Core\App;

    if (App::get('session')->has('error') || App::get('session')->has('success')) :
?>
    <?php if(App::get('session')->has('error')) : ?>
        <div class="row justify-content-center">
            <div class="col-6 bg-danger text-center">
                <p><strong><?= App::get('session')->get('error') ?></strong></p>
            </div>
        </div>
        <?php App::get('session')->delete('error') ?>
    <?php endif; ?>
    <?php if(App::get('session')->has('success')) : ?>
        <div class="row justify-content-center">
            <div class="col-6 bg-success text-center">
                <p><strong><?= App::get('session')->get('success') ?></strong></p>
            </div>
        </div>
        <?php App::get('session')->delete('success') ?>
    <?php endif; ?>
<?php
    endif;
?>
