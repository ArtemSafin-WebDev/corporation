<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <?php wp_head(); ?>
</head>

<body ontouchstart="" <?php body_class("no-touch"); ?>>
    <div class="sprite" aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;">
        <?php echo file_get_contents(get_template_directory_uri() . "/img/symbol/sprite.svg"); ?>
    </div>

    <div class="preloader">
        <div class="preloader__content">
            <div class="preloader__text">
                Откройте бизнес в Оренбурге
            </div>
            <div class="preloader__spinner">
                <div class="sk-cube-grid">
                    <div class="sk-cube sk-cube-1"></div>
                    <div class="sk-cube sk-cube-2"></div>
                    <div class="sk-cube sk-cube-3"></div>
                    <div class="sk-cube sk-cube-4"></div>
                    <div class="sk-cube sk-cube-5"></div>
                    <div class="sk-cube sk-cube-6"></div>
                    <div class="sk-cube sk-cube-7"></div>
                    <div class="sk-cube sk-cube-8"></div>
                    <div class="sk-cube sk-cube-9"></div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            z-index: 7000;

            background-color: white;
            color: #49A2DC;

            flex-direction: column;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .animatable .preloader {
            transition: opacity .3s, visibility 0s linear .3s;
            opacity: 0;
            visibility: hidden;
        }

        .preloader__text {
            font-weight: 400;
            font-size: 3rem;
            margin-bottom: 2rem;
        }

        .sk-cube-grid {
            width: 4em;
            height: 4em;
            margin: auto;
            /*
     * Spinner positions
     * 1 2 3
     * 4 5 6
     * 7 8 9
     */
        }

        .sk-cube-grid .sk-cube {
            width: 33%;
            height: 33%;
            background-color: #49A2DC;
            float: left;
            -webkit-animation: sk-cube-grid-scale-delay 1.3s infinite ease-in-out;
            animation: sk-cube-grid-scale-delay 1.3s infinite ease-in-out;
        }

        .sk-cube-grid .sk-cube-1 {
            -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
        }

        .sk-cube-grid .sk-cube-2 {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
        }

        .sk-cube-grid .sk-cube-3 {
            -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
        }

        .sk-cube-grid .sk-cube-4 {
            -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s;
        }

        .sk-cube-grid .sk-cube-5 {
            -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
        }

        .sk-cube-grid .sk-cube-6 {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
        }

        .sk-cube-grid .sk-cube-7 {
            -webkit-animation-delay: 0s;
            animation-delay: 0s;
        }

        .sk-cube-grid .sk-cube-8 {
            -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s;
        }

        .sk-cube-grid .sk-cube-9 {
            -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
        }

        @-webkit-keyframes sk-cube-grid-scale-delay {

            0%,
            70%,
            100% {
                -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1);
            }

            35% {
                -webkit-transform: scale3D(0, 0, 1);
                transform: scale3D(0, 0, 1);
            }
        }

        @keyframes sk-cube-grid-scale-delay {

            0%,
            70%,
            100% {
                -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1);
            }

            35% {
                -webkit-transform: scale3D(0, 0, 1);
                transform: scale3D(0, 0, 1);
            }
        }
    </style>

    <div class="page-content">
        <header class="page-header <?php if (!is_front_page()) echo 'page-header--solid'; ?>">
            <div class="container">

                <div class="page-header__row">
                    <div class="page-header__burger-wrapper">
                        <button class="page-header__burger js-investor-menu">
                            <span class="page-header__burger-content">
                                <span class="page-header__burger-cross">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="page-header__burger-text">
                                    всё для<br>
                                    инвестора

                                </span>

                            </span>
                        </button>
                    </div>
                    <div class="investor-menu">
                        <div class="investor-menu__content">
                            <div class="container">
                                <div class="investor-menu__row">
                                    <div class="investor-menu__nav-wrapper">


                                        <div class="investor-menu__nav">
                                            <div class="investor-menu__nav-block investor-menu__nav-block--home">
                                                <div class="investor-menu__nav-card">
                                                    <h5 class="investor-menu__nav-card-title">
                                                        <a href="/">
                                                            Главная
                                                        </a>
                                                    </h5>
                                                    
                                                </div>
                                            </div>
                                            <div class="investor-menu__nav-block">
                                                <div class="investor-menu__nav-card">
                                                    <h5 class="investor-menu__nav-card-title">
                                                        <a href="/strategy">
                                                            Стратегия развития
                                                        </a>
                                                    </h5>
                                                    <ul class="investor-menu__nav-card-list">
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/strategy#philosophy" class="investor-menu__nav-card-link">
                                                                Инвестиционная философия
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/strategy#strategy" class="investor-menu__nav-card-link">
                                                                Инвестиционная стратегия
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/strategy#institutes" class="investor-menu__nav-card-link">
                                                                Институты развития
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/strategy#npa" class="investor-menu__nav-card-link">
                                                                Нормативно-правовые акты
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="investor-menu__nav-block">
                                                <div class="investor-menu__nav-card">
                                                    <h5 class="investor-menu__nav-card-title">
                                                        <a href="/about-region">
                                                            О регионе
                                                        </a>
                                                    </h5>
                                                    <ul class="investor-menu__nav-card-list">
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/about-region#rating" class="investor-menu__nav-card-link">
                                                                Инвестиционный рейтинг
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/about-region#advantages" class="investor-menu__nav-card-link">
                                                                Преимущества для бизнеса
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/about-region#indicators" class="investor-menu__nav-card-link">
                                                                Экономические показатели
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="investor-menu__nav-block">
                                                <div class="investor-menu__nav-card">
                                                    <h5 class="investor-menu__nav-card-title">
                                                        <a href="/support">
                                                            Поддержка
                                                        </a>
                                                    </h5>
                                                    <ul class="investor-menu__nav-card-list">
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/support#apply" class="investor-menu__nav-card-link">
                                                                Единое окно
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/support#competence" class="investor-menu__nav-card-link">
                                                                Региональный центр компетенций
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/support#measures" class="investor-menu__nav-card-link">
                                                                Меры поддержки
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="investor-menu__nav-block">
                                                <div class="investor-menu__nav-card">
                                                    <h5 class="investor-menu__nav-card-title">
                                                        <a href="/invest">
                                                            Площадки
                                                        </a>
                                                    </h5>
                                                    <ul class="investor-menu__nav-card-list">
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/invest#objects" class="investor-menu__nav-card-link">
                                                                Инвестиционная карта
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/invest#projects-in-work" class="investor-menu__nav-card-link">
                                                                Реализуемые проекты
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="investor-menu__nav-block">
                                                <div class="investor-menu__nav-card">
                                                    <h5 class="investor-menu__nav-card-title">
                                                        <a href="/media">
                                                            Медиа
                                                        </a>
                                                    </h5>
                                                    <ul class="investor-menu__nav-card-list">
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/media#events" class="investor-menu__nav-card-link">
                                                                Мероприятия
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/media#news" class="investor-menu__nav-card-link">
                                                                Новости
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/media#stories" class="investor-menu__nav-card-link">
                                                                Истории успеха
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="investor-menu__nav-block">
                                                <div class="investor-menu__nav-card">
                                                    <h5 class="investor-menu__nav-card-title">
                                                        <a href="/contacts">
                                                            Контакты
                                                        </a>
                                                    </h5>
                                                    <ul class="investor-menu__nav-card-list">

                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/contacts#contacts" class="investor-menu__nav-card-link">
                                                                Контакты
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/contacts#corporation" class="investor-menu__nav-card-link">
                                                                О Корпорации
                                                            </a>
                                                        </li>
                                                        <li class="investor-menu__nav-card-list-item">
                                                            <a href="/contacts#partners" class="investor-menu__nav-card-link">
                                                                Партнерская сеть
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>





                                        </div>
                                    </div>
                                    <div class="investor-menu__btns">
                                        <div class="investor-menu__photo-card investor-menu__photo-card--pasler">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/pasler.png" class="investor-menu__photo-card-image">
                                            <div class="investor-menu__photo-card-right-col">
                                                <h5 class="investor-menu__photo-card-heading">
                                                    Денис Паслер
                                                </h5>
                                                <p class="investor-menu__photo-card-paragraph">
                                                    Губернатор Оренбургской области
                                                </p>
                                                <a href="#guber" class="gubernator__contact-link js-modal-open">
                                                    Прямая связь с губернатором
                                                </a>
                                            </div>
                                        </div>
                                        <div class="investor-menu__photo-card investor-menu__photo-card--pet">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/petuchov.png" class="investor-menu__photo-card-image">
                                            <div class="investor-menu__photo-card-right-col">
                                                <h5 class="investor-menu__photo-card-heading">
                                                    Игнат Петухов
                                                </h5>
                                                <p class="investor-menu__photo-card-paragraph">
                                                    Генеральный директор АО "Корпорация развития Оренбургской области"
                                                </p>
                                                <a href="#feedback" class="gubernator__contact-link js-modal-open">
                                                    Задать вопрос
                                                </a>
                                            </div>
                                        </div>

                                        <!-- <a href="#business" class="gubernator__contact-link js-modal-open">
                                            Открыть бизнес
                                        </a>
                                        <a href="#feedback" class="gubernator__contact-link js-modal-open">
                                            Обратная связь
                                        </a> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <a href="/" class="page-header__region-name">
                        Оренбургская область
                    </a>
                    <nav class="main-nav">
                        <ul class="main-nav__list">
                            <li class="main-nav__list-item">
                                <a href="/about-region" class="main-nav__link">
                                    О регионе
                                </a>
                            </li>
                            <li class="main-nav__list-item">
                                <a href="/strategy" class="main-nav__link">
                                    Стратегия развития
                                </a>
                            </li>
                            <li class="main-nav__list-item">
                                <a href="/invest" class="main-nav__link">
                                    Площадки
                                </a>
                            </li>
                            <li class="main-nav__list-item">
                                <a href="/support" class="main-nav__link">
                                    Поддержка
                                </a>
                            </li>

                        </ul>
                    </nav>
                    <a href="#feedback" class="page-header__feedback js-modal-open">
                        Обратная связь
                    </a>
                    <div class="page-header__language">
                        <div class="page-header__language-current">
                            ru
                        </div>
                        <svg width="12" height="12" aria-hidden="true" class="icon-lang-arrow">
                            <use xlink:href="#lang-arrow" />
                        </svg>
                        <div class="page-header__language-dropdown">
                            <div class="page-header__language-dropdown-content">
                                <a href="#" class="page-header__language-dropdown-link">en</a>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </header>
        <main class="page-main">