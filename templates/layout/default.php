<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script('jquery-3.4.1.js') ?>
    <?= $this->Html->script('jquery-ui.js') ?>
    <?= $this->Html->script('uikit.min.js') ?>
    <?= $this->Html->script('uikit-icons.min.js') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(["custom", "uikit.min"]) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?php $this->loadHelper("Authentication.Identity") ?>

</head>
<body>
    <header>
        <div class="uk-margin-auto-left uk-margin-auto-right main-width">
            <div class="pro-image-back">
                <div class="uk-flex uk-flex-left@s uk-flex-center">
                    <div>
                        <img src="/img/title.png" alt="title_buttom" class="header-title small-margin-right">
                    </div>
                    <div>
                        <?= $this->Html->image("home.jpg", ["class" => "uk-margin-right small-link", "alt" => "home_buttom", "url" => ["controller" => "top", "action" => "index"]]) ?>
                    </div>
                    <div>
                        <?= $this->Html->image("interview.png", ["class" => "uk-margin-right small-link", "alt" => "home_buttom", "url" => ["controller" => "patients", "action" => "index"]]) ?>
                    </div>
                    <div>
                        <?= $this->Html->image("articles.png", ["class" => " uk-margin-right small-link", "alt" => "home_buttom", "url" => ["controller" => "articles", "action" => "index"]]) ?>
                    </div>
                    <?php if($this->Identity->isLoggedIn()): ?>
                        <div>
                            <?= $this->Html->image("management.png", ["class" => " uk-margin-right small-link", "alt" => "home_buttom", "url" => ["controller" => "management_users", "action" => "top"]]) ?>
                        </div>
                    <?php endif ?>
            
                </div>
                <div class="uk-position-right">
                    <nav class="uk-nabar-container header-small-nav" uk-navbar="mode: click; boundary-align: true; align:right;">
                        <div class="uk-navbar-right">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <a href="#"><span class="uk-icon" uk-icon="icon: menu"></span></a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><?= $this->Html->link(__("HOME"), ['controller' => 'top', 'action' => 'index']) ?></li>
                                            <li><?= $this->Html->link(__("インタビュー"), ['controller' => 'patients', 'action' => 'index']) ?></li>
                                            <li><?= $this->Html->link(__("記事"), ['controller' => 'articles', 'action' => 'index']) ?></li>
                                            <?php if($this->Identity->isLoggedIn()): ?>
                                                <li>
                                                    <?= $this->Html->link(__("管理メニュー"), ['controller' => 'management_users', 'action' => 'top']) ?>
                                                </li>
                                            <?php endif ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <main class="min-height">
        <div class="uk-margin-auto-left uk-margin-auto-right main-width padding-top">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="uk-margin-auto-left uk-margin-auto-right main-width padding-top padding-bottom">
            <div class="uk-grid uk-child-width-1-3@m uk-child-width-1-2@s uk-child-width-1-1 uk-text-center uk-text-left@s uk-grid-divider">
                <div class="uk-first-column">
                    <img src="/img/title.png" alt="title_buttom" class="header-title">
                    <p>サイト説明</p>
                    <hr class="uk-divider-icon small-divider">
                </div>
                <div>
                    <ul class="uk-list">
                        <li><?= $this->Html->link(__('HOME'), ['controller' => 'top', 'action' => 'index',]) ?></li>
                        <li><?= $this->Html->link(__('インタビュー'), ['controller' => 'patients', 'action' => 'index',]) ?></li>
                        <li><?= $this->Html->link(__('記事'), ['controller' => 'articles', 'action' => 'index',]) ?></li>
                    </ul>
                    <hr class="uk-divider-icon medium-divider">
                </div>
                <div class="medium-div"></div>
                <div>
                    <?= $this->fetch('sidebar') ?>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
