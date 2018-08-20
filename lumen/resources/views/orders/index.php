<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
<?php if (empty($orders)): ?>
    <p>No orders yet.</p>
<?php else: ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th class="text-right" width="1">#</th>
                <th>Date</th>
                <th class="text-center">Outfits</th>
                <th class="text-right">Total (€)</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($orders as $order): ?>
            <tr>
                <th class="text-right" scope="row"><?=$order->id ?></th>
                <td><?=$order->created_at ?></td>
                <td class="text-center"><?=$order->outfits ?></td>
                <td class="text-right"><?=$order->total ?></td>
                <td class="text-right">
                    <a class="btn btn-outline-secondary btn-sm" href="<?=route('orders.show', ['orderId' => $order->id]) ?>">
                        <i class="fas fa-fw fa-info"></i>
                        Details
                    </a>
                </td>
            </tr>
<?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
</main>
<?=view('partials.scripts') ?>