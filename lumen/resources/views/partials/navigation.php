<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;

require_once 'is-active.php';

$links = [
    'Outfits' => [
        'route' => 'outfits.index',
        'mustBeAuthenticated' => false,
        'parameters' => [],
    ],
    'Pieces' => [
        'route' => 'pieces.index',
        'mustBeAuthenticated' => false,
        'parameters' => [],
    ],
    'Orders' => [
        'route' => 'orders.index',
        'mustBeAuthenticated' => true,
        'parameters' => [],
    ],
    'Profile' => [
        'route' => 'users.show',
        'mustBeAuthenticated' => true,
        'parameters' => [
            'userId' => $_SESSION[AuthController::AUTHENTICATED] ?? null,
        ],
    ],

];
$isAuthenticated = $_SESSION[AuthController::AUTHENTICATED] ?? false;
$shoppingCart = $_SESSION[OrdersController::SHOPPING_CART] ?? null;

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <a class="navbar-brand" href="<?=route('home') ?>">
        <i class="fas fa-fw fa-tshirt"></i>
        CloCart
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
<?php foreach ($links as $label => $link):
    [
        'route' => $route,
        'mustBeAuthenticated' => $mustBeAuthenticated,
        'parameters' => $parameters,
    ] = $link;
?>
            <li class="nav-item">
<?php if (!$mustBeAuthenticated || $isAuthenticated): ?>
                <a class="nav-link<?=isActive($route, $parameters) ?>" href="<?=route($route, $parameters) ?>">
                    <?=$label ?>
                </a>
<?php else: ?>
                <span class="nav-link disabled">
                    <?=$label ?>
                </span>
<?php endif ?>
            </li>
<?php endforeach ?>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
<?php if (!empty($shoppingCart)):
    $total = array_sum($shoppingCart);
    $route = 'orders.create';
?>
                <a class="btn btn-primary <?=isActive($route) ?>" href="<?=route($route) ?>">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    Shopping Cart <span class="badge badge-light"><?=$total ?></span>
                </a>
<?php else: ?>
                <span class="nav-link disabled">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    Shopping Cart
                </span>
<?php endif ?>
            </li>
        </ul>
    </div>
</nav>
