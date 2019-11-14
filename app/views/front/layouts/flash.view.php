<?php
    $session = \Core\App::get('session');
    if ($session->has('errors') || $session->has('success')) :
?>
    <?php if($session->has('error')) : ?>
        <div class="bg-success text-center">
            <p><?= $session->get('error') ?></p>
        </div>
        <?php $session->delete('error') ?>
    <?php endif; ?>
    <?php if($session->has('success')) : ?>
        <div class="bg-success text-center">
            <p><?= $session->get('success') ?></p>
        </div>
        <?php $session->delete('success') ?>
    <?php endif; ?>
<?php
    endif;
?>
