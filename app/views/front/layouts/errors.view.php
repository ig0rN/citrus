<?php

$session = \Core\App::get('session');
?>
<?php if($session->has('errors')) : ?>
    <div class="bg-danger text-center">
        <ul>
            <?php foreach ($session->get('errors') as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php $session->delete('errors') ?>
<?php endif; ?>
