<?php /* Template Name: О регионе */ ?>


<?php get_header(); ?>


<section class="page-title">
    <div class="page-title__bg-image-container">
        <?php
        $image = get_field('page_title_bg_image');
        if (!empty($image)) : ?>
            <img class="page-title__bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="inner-container">
            <div class="page-title__content">
                <h1 class="page-title__heading">
                    <?php the_title(); ?>
                </h1>
                <div class="breadcrumbs">
                    <?php require_once get_theme_file_path('/breadcrumbs.php'); ?>
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="invest-rating">
    <div class="container">
        <div class="inner-container">
            <h2 class="invest-rating__heading">
                Инвестиционный рейтинг
            </h2>
            <div class="invest-rating__items">
                <div class="invest-rating__item">
                    <div class="invest-rating__card">
                        <div class="invest-rating__card-left-col">
                            <div class="invest-rating__card-main-info invest-rating__card-main-info--municipal">
                                <h3 class="invest-rating__card-title">
                                    Рейтинг муниципалитетов
                                </h3>
                                <div class="invest-rating__card-text">
                                    <?php the_field('invest_rating_municipal_text', 'option'); ?>
                                </div>
                                <div class="invest-rating__card-links">
                                    <?php
                                    $file = get_field('invest_rating_municipal_file', 'option');
                                    if ($file) : ?>
                                        <a download class="invest-rating__card-link" href="<?php echo $file['url']; ?>">Скачать документы</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="invest-rating__card-right-col">
                            <div class="invest-rating__card-secondary-info">
                                <div class="invest-rating__card-features">
                                    <div class="invest-rating__card-places">
                                        <div class="invest-rating__card-third-place">
                                            <div class="invest-rating__card-place-number">
                                                3 место
                                            </div>
                                            <div class="invest-rating__card-third-place-city">
                                                <?php the_field('invest_rating_municipal_third_place', 'option'); ?>
                                            </div>
                                        </div>
                                        <div class="invest-rating__card-first-place">
                                            <div class="invest-rating__card-place-number">
                                                1 место
                                            </div>
                                            <div class="invest-rating__card-first-place-city">
                                                <?php the_field('invest_rating_municipal_first_place', 'option'); ?>
                                            </div>
                                        </div>
                                        <div class="invest-rating__card-second-place">
                                            <div class="invest-rating__card-place-number">
                                                2 место
                                            </div>
                                            <div class="invest-rating__card-second-place-city">
                                                <?php the_field('invest_rating_municipal_second_place', 'option'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invest-rating__card-numbers">
                                    <div class="invest-rating__card-numbers-row">
                                        <?php if (have_rows('invest_rating_municipal_numbers', 'option')) : ?>
                                            <?php while (have_rows('invest_rating_municipal_numbers', 'option')) : the_row();
                                                $multiplier = get_sub_field('invest_rating_municipal_numbers_amount_multiplier');
                                            ?>
                                                <div class="invest-rating__card-numbers-item">
                                                    <span class="invest-rating__card-numbers-amount">
                                                        <?php the_sub_field('invest_rating_municipal_numbers_amount'); ?>
                                                        <?php if (!empty($multiplier)) : ?>
                                                            <span class="invest-rating__card-numbers-amount-unit">
                                                                <?php echo $multiplier; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </span>
                                                    <span class="invest-rating__card-numbers-text">
                                                        <?php the_sub_field('invest_rating_municipal_numbers_amount_unit'); ?>
                                                    </span>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($municipal_link = get_field('invest_rating_municipal_show_link', 'option'))) : ?>
                                        <a href="<?php echo $municipal_link; ?>" class="invest-rating__card-numbers-show">
                                            Посмотреть
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invest-rating__item">
                    <div class="invest-rating__card">
                        <div class="invest-rating__card-left-col">
                            <div class="invest-rating__card-main-info invest-rating__card-main-info--national">


                                <h3 class="invest-rating__card-title">
                                    Национальный рейтинг
                                </h3>
                                <div class="invest-rating__card-text">
                                    <?php the_field('invest_rating_national_text', 'option'); ?>
                                </div>
                                <div class="invest-rating__card-links">


                                    <?php
                                    $file = get_field('invest_rating_national_files', 'option');
                                    if ($file) : ?>
                                        <a download class="invest-rating__card-link" href="<?php echo $file['url']; ?>"> Скачать документы</a>
                                    <?php endif; ?>

                                    <img src="<?php echo get_template_directory_uri(); ?>/img/asi.svg" alt="" class="invest-rating__card-asi-logo">
                                </div>


                            </div>
                        </div>
                        <div class="invest-rating__card-right-col">
                            <div class="invest-rating__card-secondary-info">


                                <div class="invest-rating__card-features">
                                    <div class="invest-rating__card-indicators">
                                        <h5 class="invest-rating__card-indicators-heading">
                                            Оренбуржье лидирует по показателям:
                                        </h5>
                                        <div class="invest-rating__card-indicators-content">
                                            <div class="invest-rating__card-indicators-left-col">
                                                <div class="invest-rating__card-indicators-item">
                                                    <div class="invest-rating__card-indicators-card">
                                                        <div class="invest-rating__card-indicators-card-icon-container">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/investrating-icons/icon-1.svg" alt="" class="invest-rating__card-indicators-card-icon">
                                                        </div>
                                                        <div class="invest-rating__card-indicators-card-text">
                                                            Оценка деятельности органов власти
                                                            по выдаче разрешений на строительство
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-rating__card-indicators-item">
                                                    <div class="invest-rating__card-indicators-card">
                                                        <div class="invest-rating__card-indicators-card-icon-container">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/investrating-icons/icon-3.svg" alt="" class="invest-rating__card-indicators-card-icon">
                                                        </div>
                                                        <div class="invest-rating__card-indicators-card-text">
                                                            Оценка эффективности подключения к электросетям
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-rating__card-indicators-item">
                                                    <div class="invest-rating__card-indicators-card">
                                                        <div class="invest-rating__card-indicators-card-icon-container">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/investrating-icons/icon-5.svg" alt="" class="invest-rating__card-indicators-card-icon">
                                                        </div>
                                                        <div class="invest-rating__card-indicators-card-text">
                                                            Оценка необходимой для ведения бизнеса недвижимости
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="invest-rating__card-indicators-right-col">
                                                <div class="invest-rating__card-indicators-item">
                                                    <div class="invest-rating__card-indicators-card">
                                                        <div class="invest-rating__card-indicators-card-icon-container">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/investrating-icons/icon-2.svg" alt="" class="invest-rating__card-indicators-card-icon">
                                                        </div>
                                                        <div class="invest-rating__card-indicators-card-text">
                                                            Среднее время регистрации прав собственности - 8,19 дней
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-rating__card-indicators-item">
                                                    <div class="invest-rating__card-indicators-card">
                                                        <div class="invest-rating__card-indicators-card-icon-container">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/investrating-icons/icon-4.svg" alt="" class="invest-rating__card-indicators-card-icon">
                                                        </div>
                                                        <div class="invest-rating__card-indicators-card-text">
                                                            Оценка процедур получения арендных площадей, предоставляемых регионом субъектам малого предпринимательства
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class="invest-rating__card-numbers">
                                    <div class="invest-rating__card-numbers-row">

                                        <?php if (have_rows('invest_rating_national_numbers', 'option')) : ?>
                                            <?php while (have_rows('invest_rating_national_numbers', 'option')) : the_row();
                                                $multiplier = get_sub_field('invest_rating_national_numbers_multiplier');
                                            ?>
                                                <div class="invest-rating__card-numbers-item">
                                                    <span class="invest-rating__card-numbers-amount">
                                                        <?php the_sub_field('invest_rating_national_numbers_amount'); ?>
                                                        <?php if (!empty($multiplier)) : ?>
                                                            <span class="invest-rating__card-numbers-amount-unit">
                                                                <?php echo $multiplier; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </span>
                                                    <span class="invest-rating__card-numbers-text">
                                                        <?php the_sub_field('invest_rating_national_numbers_units'); ?>
                                                    </span>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>

                                    </div>
                                    <?php if (!empty($national_rating_link = get_field('invest_rating_national_show', 'option'))) : ?>
                                        <a href="<?php echo $national_rating_link; ?>" class="invest-rating__card-numbers-show">
                                            Посмотреть
                                        </a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="advantages" id="advantages">
    <div class="container">

        <div class="inner-container">
            <h2 class="advantages__heading">
                Преимущества для бизнеса
            </h2>



            <?php
            $args = [
                'post_type' => 'advantages',
                'posts_per_page' => '-1'
            ];

            $advantages = new WP_Query($args);
            ?>

            <?php if ($advantages->have_posts()) : ?>
                <ul class="advantages__list">

                    <?php while ($advantages->have_posts()) : $advantages->the_post(); ?>
                        <li class="advantages__list-item">
                            <div class="advantages__card">
                                <div class="advantages__card-image-container">
                                    <?php
                                    $image = get_field('advantage_icon');
                                    if (!empty($image)) : ?>
                                        <img class="advantages__card-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <h5 class="advantages__card-title">
                                    <?php the_title(); ?>
                                </h5>
                                <hr class="advantages__card-divider">
                                <div class="advantages__card-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>

                </ul>

            <?php else : ?>

                Нет шагов

            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
</section>






<section class="region-economics js-region-economics">
    <div class="container">
        <div class="inner-container">
            <h2 class="region-economics__heading">
                Экономика региона
            </h2>
            <div class="region-economics__content">
                <div class="region-economics__nav">

                    <?php if (have_rows('region-economics', 'option')) : ?>
                        <?php while (have_rows('region-economics', 'option')) : the_row(); ?>
                            <a href="#" class="region-economics__nav-link">
                                <span class="region-economics__nav-link-mark" style="background-color: <?php the_sub_field('region-economics-numbers-color'); ?>"></span>
                                <?php the_sub_field('region-economics-numbers-indicator-name') ?>
                            </a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="region-economics__items">
                    <?php if (have_rows('region-economics', 'option')) : ?>
                        <?php while (have_rows('region-economics', 'option')) : the_row(); ?>
                            <div class="region-economics__item">
                                <div class="region-economics__item-card <?php
                                                                        $icon_mode = get_sub_field('region-economics-icons-mode');
                                                                        if ($icon_mode) {
                                                                            echo 'region-economics__item-card--icons-mode';
                                                                        }
                                                                        ?>">
                                    <div class="region-economics__item-card-row">
                                        <div class="region-economics__item-card-left-col">
                                            <div class="region-economics__item-card-numbers">
                                                <?php if (have_rows('region-economics-numbers')) : ?>
                                                    <?php while (have_rows('region-economics-numbers')) : the_row(); ?>
                                                        <div class="region-economics__item-card-numbers-col">


                                                            <div class="region-economics__item-card-numbers-block">
                                                                <?php
                                                                $image = get_sub_field('region-economics-numbers-company-logo');
                                                                if (!empty($image)) : ?>
                                                                    <div class="region-economics__item-card-numbers-block-image-container">
                                                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="region-economics__item-card-numbers-block-content">
                                                                    <h5 class="region-economics__item-card-numbers-block-title">
                                                                        <?php the_sub_field('region-economics-numbers-name'); ?>
                                                                    </h5>
                                                                    <div class="region-economics__item-card-numbers-block-amount">
                                                                        <div class="region-economics__item-card-numbers-block-amount-number">
                                                                            <?php if (get_sub_field('region-economics-numbers-decimal')) : ?>
                                                                                <?php $exploded_value = explode('.', get_sub_field('region-economics-numbers-value')); ?>
                                                                                <span class="large"><?php echo $exploded_value[0]; ?></span>.<?php echo $exploded_value[1]; ?>
                                                                            <?php else : ?>
                                                                                <span class="large">
                                                                                    <?php the_sub_field('region-economics-numbers-value'); ?>
                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="region-economics__item-card-numbers-block-amount-units">
                                                                            <?php the_sub_field('region-economics-numbers-unit'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="region-economics__item-card-right-col">
                                            <?php if (have_rows('region-economics-graphs')) : ?>
                                                <?php while (have_rows('region-economics-graphs')) : the_row(); ?>
                                                    <div class="region-economics__graph-card">
                                                        <h5 class="region-economics__graph-card-title">
                                                            <?php the_sub_field('region-economics-graphs-name'); ?>
                                                        </h5>
                                                        <div class="region-economics__graph-card-image-container">
                                                            <?php
                                                            $image = get_sub_field('region-economics-graphs-image');
                                                            if (!empty($image)) : ?>
                                                                <img class="region-economics__graph-card-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="news-slider js-news-slider">
    <div class="container">
        <div class="inner-container">
            <div class="news-slider__top-row">
                <h2 class="news-slider__heading">
                    Новости
                </h2>
                <div class="news-slider__btns">
                    <button class="news-slider__arrow-btn news-slider__arrow-btn--prev">
                        <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-left">
                            <use xlink:href="#slider-arrow-left" />
                        </svg>
                    </button>
                    <button class="news-slider__arrow-btn news-slider__arrow-btn--next">
                        <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-right">
                            <use xlink:href="#slider-arrow-right" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="news-slider__slider-wrapper">

                <?php
                $args = [
                    'post_type' => 'news',
                    'posts_per_page' => '-1'
                ];

                $news = new WP_Query($args);
                ?>

                <?php if ($news->have_posts()) : ?>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">



                            <?php while ($news->have_posts()) : $news->the_post(); ?>
                                <div class="swiper-slide">
                                    <a href="<?php the_permalink(); ?>" class="news-slider__card">

                                        <div class="news-slider__card-image-container">
                                            <?php the_post_thumbnail(); ?>
                                            <?php if (get_field('news_is_event')) : ?>
                                                <?php $datetime = strtotime(get_field('news_event_start')); ?>

                                                <div class="news-slider__card-label">
                                                    <?php echo date_i18n('j F Y H:i', $datetime); ?>
                                                </div>

                                            <?php endif; ?>
                                        </div>

                                        <div class="news-slider__card-content">
                                            <span class="news-slider__card-date">
                                                <?php echo get_the_date(); ?>
                                            </span>
                                            <h5 class="news-slider__card-title">


                                                <?php echo mb_strimwidth(get_the_title(), 0, 120, "..."); ?>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="news-slider__no-news">
                        Нет новостей
                    </div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>
    </div>
</section>




<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>