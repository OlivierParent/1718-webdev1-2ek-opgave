<?php

use App\Http\Controllers\BackOffice\AuthController;

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'partials', 'is-active.php']);

$links = [
    'Dashboard' => [
        'route' => 'back-office.dashboard',
        'mustBeAuthenticated' => false,
        'parameters' => [],
    ],
    'Outfits' => [
        'route' => 'back-office.outfits.index',
        'mustBeAuthenticated' => true,
        'parameters' => [],
    ],
    'Pieces' => [
        'route' => 'back-office.pieces.index',
        'mustBeAuthenticated' => true,
        'parameters' => [],
    ],
    'Profile' => [
        'route' => 'back-office.admins.show',
        'mustBeAuthenticated' => true,
        'parameters' => [
            'adminId' => $_SESSION[AuthController::AUTHENTICATED] ?? null,
        ],
    ],

];
$isAuthenticated = $_SESSION[AuthController::AUTHENTICATED] ?? false;

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
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
    </div>
</nav>
