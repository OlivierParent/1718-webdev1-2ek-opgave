<!DOCTYPE html>
<meta charset="utf-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
<?php if (isset($errors['message'])): ?>
    <div class="alert alert-danger" role="alert">
        <?=$errors['message'] ?>
    </div>
<?php endif ?>
    <form action="<?=route('auth.login') ?>" method="post">
        <div class="form-group row">
            <label for="input-email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10"><?php $inputName = 'email'?>
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
            <label for="input-email" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10"><?php $inputName = 'password' ?>
                <input id="input-email" class="form-control<?=isset($errors) ? (isset($errors[$inputName]) ? ' is-invalid' : ' is-valid') : '' ?>" name="<?=$inputName ?>" type="password">
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
                <button class="btn btn-primary" name="form-login" role="button" type="submit">
                    <i class="fas fa-fw fa-sign-in-alt"></i>
                    Login
                </button>
               
                <a class="btn btn-outline-secondary" href="<?=route('home') ?>" role="button">
                    <i class="fas fa-fw fa-times-circle"></i>
                    Cancel
                </a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-10 ml-auto">
                <div class="alert alert-info" role="alert">
                    <a href="<?=route('users.create') ?>">Register</a> first, if you don't have an account yet.
                </div>
            </div>
        </div>
    </form>
</main>
<?=view('partials.scripts') ?>
