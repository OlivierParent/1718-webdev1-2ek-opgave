<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('back-office.partials.navigation') ?>
<main class="container">
    <h1 class="d-flex justify-content-between align-items-center">
        <?=$title ?>
        <a href="<?=route('back-office.pieces.create') ?>" class="btn btn-primary">
            <i class="fas fa-fw fa-plus"></i>
            Add
        </a>
    </h1>
    <ul class="list-group">
<?php foreach ($pieces as $piece): ?>
        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="<?=route('back-office.pieces.show', ['pieceId' => $piece->id]) ?>">
            <?=ucwords($piece->name) ?>
<?php if (is_null($piece->deleted_at)): ?>
            <a class="btn btn-outline-danger btn-sm ml-auto" href="<?=route('back-office.pieces.delete', ['pieceId' => $piece->id]) ?>">
                <i class="fas fa-fw fa-trash"></i>
                Delete
            </a>
<?php else: ?>
            <a class="btn btn-outline-secondary btn-sm ml-auto" href="<?=route('back-office.pieces.delete', ['pieceId' => $piece->id]) ?>">
                <i class="fas fa-fw fa-trash"></i>
                Undelete
            </a>
<?php endif ?>
            <a class="btn btn-primary btn-sm ml-1" href="<?=route('back-office.pieces.edit', ['pieceId' => $piece->id]) ?>">
                <i class="fas fa-fw fa-edit"></i>
                Edit
            </a>
        </li>
<?php endforeach ?>
    </ul>
</main>
<?=view('partials.scripts') ?>