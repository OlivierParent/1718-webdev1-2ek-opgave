<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('back-office.partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <div class="card">
        <h2 class="h4 card-header">
            <span class="badge badge-danger float-right">&euro; <?=$outfit->price ?></span>
            <?=ucwords(str_replace_first(' and ', ' &amp; ', $outfit->name)) ?>
        </h2>
        <div class="card-body">
            <p class="card-text"><?=$outfit->description ?></p>
<?php if (!empty($pieces)): ?>
            <h3 class="h5 card-title">Pieces</h3>
            <ul>
<?php foreach ($pieces as $piece): ?>
                <li>
                    <a href="<?=route('back-office.pieces.show', ['pieceId' => $piece->id]) ?>">
                        <?=ucwords($piece->name) ?>
                    </a>
                </li>
<?php endforeach ?>
            </ul>
<?php endif ?>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a class="btn btn-primary" href="<?=route('back-office.outfits.edit', ['outfitId' => $outfit->id]) ?>">
                <i class="fas fa-fw fa-edit"></i>
                Edit
            </a>
            <a class="btn btn-outline-danger" href="<?=route('back-office.outfits.delete', ['outfitId' => $outfit->id]) ?>">
                <i class="fas fa-fw fa-trash"></i>
                Delete
            </a>
        </div>
    </div>
    <p class="mt-3">
        <a class="btn btn-outline-secondary" href="<?=route('back-office.outfits.index') ?>">
            <i class="fas fa-fw fa-chevron-circle-left"></i>
            Outfits
        </a>
    </p>
</main>
<?=view('partials.scripts') ?>
