<!DOCTYPE html>
<meta charset="utf-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <form action="<?=route('users.store') ?>" method="post">
        <div class="form-group row">
            <label for="input-name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10"><?php $inputName = 'name' ?>
                <input id="input-name" class="form-control<?=isset($errors) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>" type="text" value="<?=$name ?? '' ?>">
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
            <label for="input-email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10"><?php $inputName = 'email' ?>
                <input id="input-email" class="form-control<?=isset($errors) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>" type="text" value="<?=$email ?? '' ?>">
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
            <label for="input-password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10"><?php $inputName = 'password' ?>
                <input id="input-password" class="form-control<?=isset($password) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>" type="password">
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
            <label for="input-password-repeat" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10"><?php $inputName = 'password-repeat' ?>
                <input id="input-password-repeat" class="form-control<?=isset($passwordRepeat) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>" type="password">
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
                <button class="btn btn-primary" name="form-create" type="submit">
                    <i class="fas fa-fw fa-user-plus"></i>
                    Register
                </button>
                <a class="btn btn-outline-secondary" href="<?=route('home') ?>">
                    <i class="fas fa-fw fa-times-circle"></i>
                    Cancel
                </a>
            </div>
        </div>
    </form>
</main>
<?=view('partials.scripts') ?>
