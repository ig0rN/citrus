<?php
    $session = \Core\App::get('session');
    if ($session->has('error') || $session->has('success')) :
?>
    <?php if($session->has('error')) : ?>
        <div class="row justify-content-center">
            <div class="col-6 bg-danger text-center">
                <p><strong><?= $session->get('error') ?></strong></p>
            </div>
        </div>
        <?php $session->delete('error') ?>
    <?php endif; ?>
    <?php if($session->has('success')) : ?>
        <div class="row justify-content-center">
            <div class="col-6 bg-success text-center">
                <p><strong><?= $session->get('success') ?></strong></p>
            </div>
        </div>
        <?php $session->delete('success') ?>
    <?php endif; ?>
<?php
    endif;
?>
