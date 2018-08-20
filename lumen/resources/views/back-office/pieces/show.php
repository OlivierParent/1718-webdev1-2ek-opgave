<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('back-office.partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <div class="card">
        <h2 class="h4 card-header">
            <?=ucwords($piece->name) ?>
        </h2>
        <div class="card-body">
            <p class="card-text"><?=$piece->description ?></p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a class="btn btn-primary" href="<?=route('back-office.pieces.edit', ['pieceId' => $piece->id]) ?>">
                <i class="fas fa-fw fa-edit"></i>
                Edit
            </a>
            <a class="btn btn-outline-danger" href="<?=route('back-office.pieces.delete', ['pieceId' => $piece->id]) ?>">
                <i class="fas fa-fw fa-trash"></i>
                Delete
            </a>
        </div>
    </div>
    <p class="mt-3">
        <a class="btn btn-outline-secondary" href="<?=route('back-office.pieces.index') ?>">
            <i class="fas fa-fw fa-chevron-circle-left"></i>
            Pieces
        </a>
    </p>
</main>
<?=view('partials.scripts') ?>
