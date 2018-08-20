<?php

use App\Http\Controllers\BackOffice\AuthController;

?>
<!DOCTYPE html>
<meta charset="UTF-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('back-office.partials.navigation') ?>
<main class="container">
    <div class="jumbotron">
        <h1 class="display-3"><i class="fa fa-tshirt"></i> CloChart <?=$title ?></h1>
        <p class="lead">For the white-collar employee.</p>
    </div>
    <div>
    <?php if ($_SESSION[AuthController::AUTHENTICATED] ?? false): ?>
        <h2>Top <?=count($outfits) ?> outfits</h2>
        <canvas id="outfits-chart" width="400" height="250"></canvas>
        <h2>Revenue last 7 days</h2>
        <canvas id="orders-chart" width="400" height="200"></canvas>
<?php endif ?>
        <p class="lead d-flex align-items-baseline">
<?php if ($_SESSION[AuthController::AUTHENTICATED] ?? false): ?>
            <a class="btn btn-primary btn-lg" href="<?=route('back-office.auth.logout') ?>" role="button">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                Logout
            </a>
<?php else: ?>
            <a class="btn btn-primary btn-lg" href="<?=route('back-office.auth.create') ?>" role="button">
                <i class="fas fa-fw fa-sign-in-alt"></i>
                Login
            </a>
<?php endif ?>
        </p>
    </div>
</main>
<?=view('partials.scripts') ?>
<?php if ($_SESSION[AuthController::AUTHENTICATED] ?? false): ?>
<script>
    // Colors
    const colors = [];
    for (let i = 0; i < 10; i++) {
        colors.push({
            h: i * 36 + 18,
            s: 85,
            l: 65
        });
    }

    // Data
    const outfitsData = JSON.parse('<?=json_encode($outfits) ?>'),
          ordersData = JSON.parse('<?=json_encode($orders) ?>');

    // Charts
    const outfitsCtx = document.getElementById('outfits-chart');
    const outfitsConfig = {
        type: 'horizontalBar',
        data: {
            labels: outfitsData.map(d => d.name),
            datasets: [{
                label: 'Total Orders',
                data: outfitsData.map(d => parseInt(d.total)),
                backgroundColor: colors.map(c => `hsla(${c.h}, ${c.s}%, ${c.l}%, .2)`),
                borderColor: colors.map(c => `hsl(${c.h}, ${c.s}%, ${c.l}%)`),
                borderWidth: 2
            }]
        }
    };
    new Chart(outfitsCtx, outfitsConfig);
    const ordersCtx = document.getElementById('orders-chart');
    const c = colors[ordersData.length];
    const ordersConfig = {
        type: 'bar',
        data: {
            labels: ordersData.map(d => d.day),
            datasets: [{
                label: 'Average Order Revenue',
                data: ordersData.map(d => d.avg_order_revenue),
                backgroundColor: 'transparent',
                borderColor: `hsl(${c.h}, ${c.s}%, ${c.l}%)`,
                borderWidth: 3,
                tension: 0,
                type: 'line'
            }, {
                    label: 'Total Revenue',
                    data: ordersData.map(d => d.total_revenue),
                    backgroundColor: colors.map(({h, s, l}) => `hsla(${h}, ${s}%, ${l}%, .2)`),
                    borderColor: colors.map(({h, s, l}) => `hsl(${h}, ${s}%, ${l}%)`),
                    borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        callback(value) {
                            return '€ ' + value;
                        }
                    },
                    tension: 0
                }]
            },
            tooltips: {
                callbacks: {
                    afterBody(tooltipItem, data) {
                        return `Orders: ${ordersData[tooltipItem[0].index].orders}`
                    }
                }
            }
        }
    };
    new Chart(ordersCtx, ordersConfig);
</script>
<?php endif ?>