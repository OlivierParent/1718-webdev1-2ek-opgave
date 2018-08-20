<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <div class="card">
        <h2 class="h4 card-header">
            <?=ucwords($piece->name) ?>
        </h2>
        <div class="card-body">
            <p class="card-text"><?=$piece->description ?></p>
<?php if (!empty($outfits)): ?>
            <h3 class="h5 card-title">Used in These Products</h3>
            <ul>
<?php foreach ($outfits as $outfit): ?>
                <li>
                    <a href="<?=route('outfits.show', ['outfitId' => $outfit->id]) ?>">
                        <?=ucwords(str_replace_first(' and ', ' &amp; ', $outfit->name)) ?>
                    </a>
                </li>
<?php endforeach ?>
            </ul>
<?php endif ?>
        </div>
    </div>
    <p class="mt-3">
        <a class="btn btn-outline-secondary" href="<?=route('pieces.index') ?>">
            <i class="fas fa-fw fa-chevron-circle-left"></i>
            Pieces
        </a>
    </p>
</main>
<?=view('partials.scripts') ?>
