<?php

use App\Http\Controllers\AuthController as AuthController;

?>
<!DOCTYPE html>
<meta charset="utf-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1>
        <?=$title ?>
        <a class="btn btn-outline-danger btn-sm float-right" href="<?=route('orders.clear') ?>">
            <i class="fas fa-fw fa-trash-alt"></i>
            Clear Shopping Cart
        </a>
    </h1>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Outfit</th>
                <th width="1" class="text-right text-nowrap">Price (€)</th>
                <th width="1" class="text-center">&times</th>
                <th width="1">Quantity</th>
                <th width="1" class="text-right text-nowrap">Subtotal (€)</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($outfits as $outfit): ?>
            <tr>
                <th scope="row"><?=ucwords(str_replace_first(' and ', ' &amp; ', $outfit->name)) ?></th>
                <td class="text-right"><?=$outfit->price ?></td>
                <td class="text-center">&times</td>
                <td><?=$outfit->quantity ?> </td>
                <th class="text-right"><?=number_format($outfit->subtotal, 2) ?></th>
            </tr>
<?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <th class="text-right" colspan="4" scope="row">Total:</th>
                <th class="text-right"><?=number_format($total, 2) ?></th>
            </tr>
        </tfoot>
    </table>
    <p>
<?php if ($_SESSION[AuthController::AUTHENTICATED] ?? false): ?>
        <a class="btn btn-primary btn-lg btn-block" href="<?=route('orders.store') ?>">
            <i class="fas fa-check"></i>
            Confirm Order
        </a>
<?php else: ?>
        <div class="alert alert-warning" role="alert">
            <a href="<?=route('auth.login') ?>">Login</a> first to confirm order.
        </div>
<?php endif ?>
    </p>
</main>
<?=view('partials.scripts') ?>