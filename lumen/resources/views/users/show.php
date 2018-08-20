<!DOCTYPE html>
<meta charset="utf-8">
<title><?=$title ?></title>
<?=view('partials.styles') ?>
<?=view('partials.navigation') ?>
<main class="container">
    <h1><?=$title ?></h1>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?=$user->name ?></h4>
            <h6 class="card-subtitle mb-2 text-muted"><a href="mailto:<?=$user->email ?>"><?=$user->email ?></a></h6>
            <div class="btn-toolbar justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-secondary" href="<?=route('home') ?>">
                        <i class="fas fa-fw fa-times-circle"></i>
                        Close
                    </a>
                    <a class="btn btn-secondary" href="<?=route('auth.logout') ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        Logout
                    </a>
                    <a class="btn btn-secondary" href="<?=route('users.edit', ['userId' => $user->id]) ?>">
                        <i class="fas fa-fw fa-edit"></i>
                        Edit
                    </a>
                    <a class="btn btn-secondary" href="<?=route('users.delete', ['userId' => $user->id]) ?>">
                        <i class="fas fa-fw fa-user-times"></i>
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
<?=view('partials.scripts') ?>
