<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <div class="card-columns">
<?php foreach ($outfits as $outfit): ?>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <span class="badge badge-danger float-right">&euro; <?=$outfit->price ?></span>
                    <?=ucwords(str_replace_first(' and ', ' &amp; ', $outfit->name)) ?>
                </h4>
                <p class="card-text">
<?php foreach (explode(',', $outfit->pieces) as $piece): ?>
                    <span class="badge badge-pill badge-light"><?=$piece ?></span>
<?php endforeach ?>
                </p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a class="btn btn-primary btn-sm" href="<?=route('orders.add', ['outfitId' => $outfit->id]) ?>">
                    <i class="fas fa-fw fa-plus"></i>
                    Add to Shopping Cart
                </a>
                <a class="btn btn-outline-secondary btn-sm" href="<?=route('outfits.show', ['outfitId' => $outfit->id]) ?>">
                    <i class="fas fa-fw fa-info"></i>
                    Details
                </a>
            </div>
        </div>
<?php endforeach ?>
    </div>
</main>
<?=view('partials.scripts') ?>
