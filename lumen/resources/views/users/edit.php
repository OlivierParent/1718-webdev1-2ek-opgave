<!DOCTYPE html>
<meta charset="utf-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <form action="<?=route('users.update', ['userId' => $user->id]) ?>" method="post">
        <div class="form-group row">
            <label for="input-name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10"><?php $inputName = 'name' ?>
                <input id="input-name" class="form-control<?=isset($errors) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>" type="text" value="<?=$user->name ?? '' ?>">
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
                <button class="btn btn-primary" name="form-edit" type="submit">
                    <i class="fas fa-fw fa-save"></i>
                    Save
                </button>
            </div>
        </div>
    </form>
</main>
<?=view('partials.scripts') ?>