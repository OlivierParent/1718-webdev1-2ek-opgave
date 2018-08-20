<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <div class="list-group">
<?php foreach ($pieces as $piece): ?>
        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="<?=route('pieces.show', ['pieceId' => $piece->id]) ?>">
            <?=ucwords($piece->name) ?>
            <i class="fas fa-chevron-circle-right"></i>
        </a>
<?php endforeach ?>
    </div>
</main>
<?=view('partials.scripts') ?>