<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('back-office.partials.navigation') ?>
<main class="container">
    <h1 class="d-flex justify-content-between align-items-center">
        <?=$title ?>
        <a href="<?=route('back-office.outfits.create') ?>" class="btn btn-primary">
            <i class="fas fa-fw fa-plus"></i>
            Add
        </a>
    </h1>
    <ul class="list-group">
<?php foreach ($outfits as $outfit):
    $parameters = ['outfitId' => $outfit->id];
?>
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="<?=route('back-office.outfits.show', $parameters) ?>">
                <?=ucwords(str_replace_first(' and ', ' &amp; ', $outfit->name)) ?>
<?php if (is_null($outfit->deleted_at)): ?>
                <a class="btn btn-outline-danger btn-sm ml-auto" href="<?=route('back-office.outfits.delete', ['outfitId' => $outfit->id]) ?>">
                    <i class="fas fa-fw fa-trash"></i>
                    Delete
                </a>
<?php else: ?>
                <a class="btn btn-outline-secondary btn-sm ml-auto" href="<?=route('back-office.outfits.delete', ['outfitId' => $outfit->id]) ?>">
                    <i class="fas fa-fw fa-trash"></i>
                    Undelete
                </a>
<?php endif ?>
<?php /*
                <a class="btn btn-primary btn-sm ml-1" href="<?=route('back-office.outfits.edit', $parameters) ?>">
                    <i class="fas fa-fw fa-edit"></i>
                    Edit
                </a>
 */ ?>
            </li>
<?php endforeach ?>
    </ul>
</main>
<?=view('partials.scripts') ?>
