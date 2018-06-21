<!DOCTYPE html>
<html lang="ru-ru" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Lenta1 Telegram</title>

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Сервис LentaTelegram позволит вам настроить автопостинг в Telegram из Вконтакте">
    <meta name="language" content="russian">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="">
    <link href="/landing/style0.css" rel="stylesheet"
          type="text/css">
    <link href="/landing/style1.css" rel="stylesheet"
          type="text/css">
    <link href="/landing/front.css" rel="stylesheet"
          type="text/css">
</head>
<body>
<header>
    <div id="top-header" class="uk-hidden-small">
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-1">
                    <div id="top-phone">
                        Автопостинг из Вк
                    </div>
                </div>
                <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-small-1-1">
                    <div id="top-button">
                        <ul>
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Войти</a></li>
                                <li><a href="{{ route('register') }}">Зарегистрироваться</a></li>
                            @else
                                <li><a href="{{ route('home') }}">Личный кабинет</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div data-uk-sticky="{media:&#39;(min-width: 1024px)&#39;, top:-300, animation:&#39;uk-animation-slide-top&#39;}">
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-large-1-1 uk-width-medium-1-1">
                    <div id="logo">
                        <a href="/"><img
                                    src="/logo.png"
                                    alt="LentaTelegram"></a>
                    </div>
                </div>
                <div class="uk-width-large-1-1 uk-width-medium-1-1">
                    <nav id="mainmenu" class="uk-navbar">
                        <div class="uk-navbar-flip">
                            <ul class="uk-navbar-nav uk-hidden-small">
                                <li><a href="/">Главная</a></li>
                                <li>
                                    <a href="/price/">
                                        Цены
                                    </a>
                                </li>
                                <li><a href="/register">Регистрация</a></li>
                                <li><a href="/support">FAQ</a></li>
                            </ul>
                            <a href="/#mobile-nav" class="uk-navbar-toggle uk-visible-small"
                               data-uk-offcanvas=""></a>
                        </div>
                    </nav>
                    <div id="mobile-nav" class="uk-offcanvas">
                        <div class="uk-offcanvas-bar">
                            <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="">
                                <li><a href="/">Главная</a></li>
                                <li>
                                    <a href="/price/domains/">
                                        Цены
                                    </a>
                                </li>
                                <li><a href="/register">Регистрация</a></li>
                                <li><a href="/login">Личный кабинет</a></li>
                                <li><a href="/forum">Форум</a></li>
                                <li><a href="/support">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<section id="slideshow-container">
    <div id="homepage-slide" class="uk-slidenav-position" data-uk-slideshow="{autoplay:true}">
        <ul class="uk-slideshow uk-overlay-active" style="height: 480px;">
            <li style="background: url(&quot;/landing/sld1.jpg&quot;) center bottom / cover no-repeat; height: 480px;"
                aria-hidden="false" class="uk-active">
                <div class="uk-overlay-panel uk-overlay-bottom uk-overlay-fade">
                    <div class="uk-container uk-container-center">
                        <div class="uk-grid">
                            <div class="uk-width-large-7-10 uk-width-medium-7-10 uk-container-center uk-text-center">
                                <div class="slide-content2">
                                    <div class="icon-wrap large center">
                                        <i class="smico-rocket"></i>
                                    </div>
                                    <h1>Бесплатный и неограниченный сервис автопостинга</h1>
                                    <h4 class="uk-margin-small-top">
                                        Бесплатный сервис автопостинга картинок, гиф и видео* в телеграмм
                                    </h4>
                                    <a class="uk-button uk-button-large idz-button-white uk-margin-top"
                                       href="/register">
                                        Зарегестрироваться
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
<section>
    <div class="uk-container uk-container-center uk-padding">
        <div class="uk-grid">
            <div class="uk-width-large-1-1 uk-text-center">
                <h1 class="uk-margin-small-bottom">Бесплатный* сервис автопостинга для вашего канала в Telegram</h1>
                <p class="uk-text-large uk-margin-small-top text-width70 uk-margin-large-bottom">
                    И вот почему вы должны выбрать наш сервис
                </p>
                <div class="uk-grid uk-margin-top">
                    <div class="uk-width-large-1-3 uk-width-small-1-1">
                        <div class="icon-wrap center">
                            <i class="smico-speed"></i>
                        </div>
                        <h3>Контент</h3>
                        <p>Наш сервис предостваляет возможность репостинга текста, статей, картинок(и медиагрупп), гифой( до 20мб) и видео( также размером до 20мб ) </p>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-small-1-1">
                        <div class="icon-wrap center">
                            <i class="smico-lightning"></i>
                        </div>
                        <h3>Поддержка 24/7</h3>
                        <p>Мы в любое время поможем вам настроить нас сервис автоматического репостинга</p>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-small-1-1">
                        <div class="icon-wrap center">
                            <i class="smico-processor"></i>
                        </div>
                        <h3>Подключение</h3>
                        <p>Доступно несколько видов "получения" записей, выберите тот, которые максимально удобен вам</p>
                    </div>
                </div>
                <div class="uk-grid uk-margin-large-top">
                    <div class="uk-width-large-1-3 uk-width-small-1-1">
                        <div class="icon-wrap center">
                            <i class="smico-coin"></i>
                        </div>
                        <h3>Бесплатная версия</h3>
                        <p>Сервис LentaTelegram предоставляет бесплатную версию с ограниченным функционалом</p>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-small-1-1">
                        <div class="icon-wrap center">
                            <i class="smico-eraser"></i>
                        </div>
                        <h3>Группы</h3>
                        <p>Мы можем работать как с открытыми, так и с закрытыми группами</p>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-small-1-1">
                        <div class="icon-wrap center">
                            <i class="smico-www"></i>
                        </div>
                        <h3>Настройки</h3>
                        <p>Мы предоставляем вам гибкие настройки, для того что бы вы могли сделать свой канал мечты</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="uk-padding uk-margin-top">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="uk-width-large-1-10 uk-width-medium-2-10 uk-hidden-small">
                <div class="icon-wrap center idz-bottom-adjustment5">
                    <i class="smico-shopping-bag"></i>
                </div>
            </div>
            <div class="uk-width-large-9-10 uk-width-medium-8-10 uk-width-small-1-1">
                <h2>Мы обслуживаем более <span class="uk-text-thin">100</span> каналов.
                </h2>
                <div class="uk-grid uk-margin-medium-top">
                    <div class="uk-width-large-4-10">
                        <img src="/sample_object5.png"
                             alt=""
                             class="uk-align-left idz-bottom-adjustment5 idz-tablet-potrait-hidden uk-hidden-small">
                    </div>
                    <div class="uk-width-large-6-10 uk-width-medium-1-1 uk-width-small-1-1">
                        <h5>Вот некоторые из них</h5>
                        <ul class="hosting-apps">
                            <li>
                                <img src=""
                                     alt="название 1й группы"> 1
                            </li>
                            <li>
                                <img src=""
                                     alt="название 2й группы"> 2
                            </li>
                            <li>
                                <img src=""
                                     alt="название 3й группы"> 3
                            </li>
                            <li>
                                <img src=""
                                     alt="название 4й группы"> 4
                            </li>
                            <li>
                                <img src=""
                                     alt="название 5й группы"> 5
                            </li>
                            <li>
                                <img src=""
                                     alt="название 6й группы"> 6
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--<section class="section-black">--}}
    {{--<div class="uk-container uk-container-center specs-bg-img">--}}
        {{--<div class="uk-grid uk-padding">--}}
            {{--<div class="uk-width-large-1-1 uk-text-contrast">--}}
                {{--<h1 class="uk-text-contrast uk-margin-small-bottom uk-text-center">Free Hosting Features</h1>--}}
                {{--<p class="uk-text-large uk-margin-small-top uk-text-center">--}}
                    {{--Everything you could possibly need for your website.--}}
                {{--</p>--}}
                {{--<div class="uk-grid uk-margin-medium-top uk-margin-medium-bottom">--}}
                    {{--<div class="uk-width-large-1-3 uk-width-small-1-1 idz-margin-bottom-ml">--}}
                        {{--<ul class="uk-list idz-list-check green big">--}}
                            {{--<li>Unlimited Disk Space</li>--}}
                            {{--<li>Unlimited Bandwidth</li>--}}
                            {{--<li>10 Email Accounts</li>--}}
                            {{--<li>400 MySQL Databases</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="uk-width-large-1-3 uk-width-small-1-1 idz-margin-bottom-ml">--}}
                        {{--<ul class="uk-list idz-list-check green big">--}}
                            {{--<li>PHP 5.4, 5.5, 5.6, 7.0</li>--}}
                            {{--<li>MySQL 5.6</li>--}}
                            {{--<li>Apache 2.4 with .htaccess</li>--}}
                            {{--<li>Linux 3.2</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="uk-width-large-1-3 uk-width-small-1-1">--}}
                        {{--<ul class="uk-list idz-list-check green big">--}}
                            {{--<li>Free Sub Domain Name</li>--}}
                            {{--<li>Free SSL on all websites</li>--}}
                            {{--<li>Free Cloudflare CDN</li>--}}
                            {{--<li>Free DNS Service</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
{{--<section class="uk-margin-top uk-margin-bottom" style="margin-top: 30px !important;">--}}
    {{--<div class="uk-container uk-container-center">--}}
        {{--<div class="uk-grid">--}}
            {{--<div class="uk-width-1-1 ad-container">--}}
                {{--<div class="uk-grid">--}}
                    {{--<div class="uk-width-medium-1-1">--}}
                        {{--<div class="uk-panel uk-panel-box"><i class="uk-icon-frown-o"></i> <strong>Nobody likes--}}
                                                                                                   {{--ads</strong>, but--}}
                                                                                                               {{--InfinityFree--}}
                                                                                                               {{--is paid--}}
                                                                                                               {{--for using--}}
                                                                                                               {{--the ads--}}
                                                                                                               {{--on our--}}
                                                                                                               {{--website.--}}
                                                                                                               {{--If you--}}
                                                                                                               {{--like our--}}
                                                                                                               {{--free--}}
                                                                                                               {{--service,--}}
                                                                                                               {{--please--}}
                                                                                                               {{--consider--}}
                                                                                                               {{--to--}}
                                                                                                               {{--disable--}}
                                                                                                               {{--your ad--}}
                                                                                                               {{--blocker.--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
{{--<section class="uk-padding">--}}
    {{--<div class="uk-container uk-container-center">--}}
        {{--<div class="uk-grid">--}}
            {{--<div class="uk-width-large-1-1">--}}
                {{--<h1 class="uk-margin-large-bottom uk-text-center">FAQ - You got questions? We got answers!</h1>--}}
                {{--<div class="uk-grid">--}}
                    {{--<div class="uk-width-large-1-2 uk-width-small-1-1">--}}
                        {{--<h4 class="uk-margin-small-bottom">Is your hosting really free?</h4>--}}
                        {{--<p class="uk-margin-small-top uk-margin-medium-bottom">--}}
                            {{--Yes, you can host your website without having to pay. Ever.--}}
                        {{--</p>--}}
                        {{--<h4 class="uk-margin-small-bottom">How long does it takes to setup my account?</h4>--}}
                        {{--<p class="uk-margin-small-top uk-margin-medium-bottom">--}}
                            {{--Forget about waiting lists, InfinityFree accounts are automatically created in minutes.--}}
                        {{--</p>--}}
                        {{--<h4 class="uk-margin-small-bottom">For how long can I use free hosting?</h4>--}}
                        {{--<p class="uk-margin-small-top uk-margin-medium-bottom">--}}
                            {{--Forever! We have been providing free hosting since 2011 and some of our users have been with--}}
                            {{--us since that time.--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    {{--<div class="uk-width-large-1-2 uk-width-small-1-1">--}}
                        {{--<h4 class="uk-margin-small-bottom">Can I host my own domains?</h4>--}}
                        {{--<p class="uk-margin-small-top uk-margin-medium-bottom">--}}
                            {{--Yes, you can easily host your own domain name registered elsewhere on InfinityFree.--}}
                        {{--</p>--}}
                        {{--<h4 class="uk-margin-small-bottom">Do I have to get my own domain?</h4>--}}
                        {{--<p class="uk-margin-small-top uk-margin-medium-bottom">--}}
                            {{--You can get a free subdomain like yourname.epizy.com or yourname.rf.gd for free!--}}
                        {{--</p>--}}
                        {{--<h4 class="uk-margin-small-bottom">Will you put ads on my site?</h4>--}}
                        {{--<p class="uk-margin-small-top uk-margin-medium-bottom">--}}
                            {{--Never! We make enough using the ads on our main site and control panel to cover the costs.--}}
                        {{--</p>--}}
                    {{--</div>--}}
                    {{--<div class="uk-width-large-1-1 uk-text-center uk-margin-medium-top">--}}
                        {{--<a class="uk-button uk-button-small idz-button-blue" href="/suppor/">--}}
                            {{--See all questions<i class="uk-icon-chevron-circle-right"></i>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
{{--<section class="uk-margin-top uk-margin-bottom" style="margin-top: 30px !important;">--}}
    {{--<div class="uk-container uk-container-center">--}}
        {{--<div class="uk-grid">--}}
            {{--<div class="uk-width-1-1 ad-container">--}}
                {{--<div class="uk-grid">--}}
                    {{--<div class="uk-width-medium-1-1">--}}
                        {{--<div class="uk-panel uk-panel-box"><i class="uk-icon-frown-o"></i> <strong>Nobody likes--}}
                                                                                                   {{--ads</strong>, but--}}
                                                                                                               {{--InfinityFree--}}
                                                                                                               {{--is paid--}}
                                                                                                               {{--for using--}}
                                                                                                               {{--the ads--}}
                                                                                                               {{--on our--}}
                                                                                                               {{--website.--}}
                                                                                                               {{--If you--}}
                                                                                                               {{--like our--}}
                                                                                                               {{--free--}}
                                                                                                               {{--service,--}}
                                                                                                               {{--please--}}
                                                                                                               {{--consider--}}
                                                                                                               {{--to--}}
                                                                                                               {{--disable--}}
                                                                                                               {{--your ad--}}
                                                                                                               {{--blocker.--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}
<section class="section-blue">
    <div class="uk-container uk-container-center uk-padding">
        <div class="uk-grid">
            <div class="uk-width-large-1-1 uk-text-contrast uk-text-center">
                <h1 class="uk-text-contrast uk-margin-bottom">Подключайся!</h1>
            </div>
            <div class="uk-width-large-1-1 uk-text-center uk-margin-bottom">
                <a class="uk-button uk-button-large idz-button-white uk-margin-top"
                   href="/register">
                    Зарегистрироваться
                </a>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="uk-container uk-container-center footer-bg-img">
        <div class="uk-grid">
            <div class="uk-width-large-4-10 uk-width-medium-4-10 uk-width-small-1-1">
                <div id="logo-footer">
                    <img src="/logo.png"
                         alt="LentaTelegram">
                </div>
                <p>
                    бла бла бла о нас
                </p>
            </div>
            <div class="uk-width-large-6-10 uk-width-medium-6-10 uk-width-small-1-1">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-large-1-3 uk-width-medium-1-3 uk-width-small-1-1 uk-row-first">
                        <h4>О нас</h4>
                        <ul class="uk-list">
                            <li><a href="#">Контакты</a></li>
                            <li><a href="#">Условия использования</a></li>
                            <li><a href="#">Политика</a></li>
                        </ul>
                    </div>
                    <div class="uk-width-large-1-3 uk-width-medium-1-3 uk-width-small-1-1">
                        <h4>Поддержка</h4>
                        <ul class="uk-list">
                            <li><a href="#">Поддержка</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="uk-grid copyright-wrap">
            <div class="uk-width-1-2 uk-width-medium-4-10 uk-width-small-1-1">
                <p>© 2018 lentaTelegram. All rights reserved.</p>
            </div>

        </div>
    </div>
    <a href="/#top" class="to-top uk-icon-chevron-up" data-uk-smooth-scroll=""></a>
</footer>

<div class="uk-grid cookie-message" style="">
    <div class="uk-width-1-1">
        <div class="uk-float-left">
            <p>Этот сайт использует cookies для обеспечения лучшего взаимодействия
                <a href="/privacy/">Подробнее</a>
            </p>
        </div>
        <div class="uk-float-right text-right">
            <a class="uk-button uk-button-success cookie-message-close">Продолжить</a>
        </div>
    </div>
</div>

</body>
</html>