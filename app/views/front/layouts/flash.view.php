<?php
    $session = \Core\App::get('session');
    if ($session->has('errors') || $session->has('success')) :
?>
    <?php if($session->has('errors')) : ?>
    <div class="bg-danger text-center">
        <ul>
            <?php foreach ($session->get('errors') as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <?php if($session->has('success')) : ?>
    <div class="bg-success text-center">
        <p><?= $session->get('success') ?></p>
    </div>
    <?php endif; ?>
<?php
    endif;
?>
