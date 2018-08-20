<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackOffice\AuthController as BackOfficeAuthController;

?>
<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <div class="jumbotron">
        <h1 class="display-3"><i class="fa fa-tshirt"></i> <?=$title ?></h1>
        <p class="lead">Take me to the T-shirt shop.</p>
    </div>
    <div class="lead d-flex align-items-baseline">
<?php if ($_SESSION[AuthController::AUTHENTICATED] ?? false): ?>
        <a class="btn btn-primary btn-lg" href="<?=route('auth.logout') ?>" role="button">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            Logout
        </a>
<?php else: ?>
        <a class="btn btn-primary btn-lg" href="<?=route('auth.create') ?>" role="button">
            <i class="fas fa-fw fa-sign-in-alt"></i>
            Login
        </a>
        <a class="btn btn-outline-secondary btn-lg ml-1" href="<?=route('users.create') ?>" role="button">
            <i class="fas fa-fw fa-user-plus"></i>
            Register
        </a>
<?php endif ?>
<?php if ($_SESSION[BackOfficeAuthController::AUTHENTICATED] ?? false): ?>
        <a class="btn btn-outline-secondary ml-auto" href="<?=route('back-office.dashboard') ?>" title="Back Office">
            <i class="fas fa-fw fa-unlock"></i>
        </a>
<?php else: ?>
        <a class="btn btn-outline-secondary ml-auto" href="<?=route('back-office.dashboard') ?>" title="Back Office">
            <i class="fas fa-fw fa-lock"></i>
        </a>
<?php endif ?>
    </div>
</main>
<?=view('partials.scripts') ?>