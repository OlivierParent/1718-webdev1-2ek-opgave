<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('back-office.partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <form action="<?=route('back-office.pieces.store') ?>" method="post">
        <div class="form-group row">
            <label for="input-name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10"><?php $inputName = 'name' ?>
                <input id="input-name" class="form-control<?=isset($errors) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>" type="text" value="<?=$piece->name ?? '' ?>">
<?php if (isset($errors[$inputName])): ?>
                <div class="invalid-feedback">
<?php foreach ($errors[$inputName] as $error): ?>
                    <p><?=$error ?></p>
<?php endforeach ?>
                </div>
<?php endif ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="input-description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10"><?php $inputName = 'description' ?>
                <textarea id="input-description" class="form-control<?=isset($errors) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>"><?=$piece->description ?? '' ?></textarea>
<?php if (isset($errors[$inputName])): ?>
                <div class="invalid-feedback">
<?php foreach ($errors[$inputName] as $error): ?>
                    <p><?=$error ?></p>
<?php endforeach ?>
                </div>
<?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 ml-auto">
                <button class="btn btn-primary" name="form-login" type="submit">
                    <i class="fas fa-fw fa-save"></i>
                    Save
                </button>
                <a class="btn btn-outline-secondary" href="<?=route('back-office.pieces.index') ?>">
                    <i class="fas fa-fw fa-times-circle"></i>
                    Cancel
                </a>
            </div>
        </div>
    </form>
</main>