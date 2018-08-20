<!DOCTYPE html>
<meta charset="utf-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <table class="table">
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
                <th class="text-muted"><?=$order->created_at ?></th>
                <th class="text-right" colspan="3" scope="row">Total:</th>
                <th class="text-right"><?=number_format($order->total, 2) ?></th>
            </tr>
        </tfoot>
    </table>
    <p class="mt-3">
        <a class="btn btn-outline-secondary" href="<?=route('orders.index') ?>">
            <i class="fas fa-fw fa-chevron-circle-left"></i>
            Orders
        </a>
    </p>
</main>
<?=view('partials.scripts') ?>
