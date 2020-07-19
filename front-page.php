<?php get_header(); ?>

<section class="block front-page-intro">

    <div class="container">
        <div class="inner-container">
            <div class="front-page-intro__content">
                <h1 class="front-page-intro__main-heading">
                    <?php $field = get_field('front_page_main_heading');
                    echo !empty($field) ? $field : 'Заголовок главной страницы'; ?>
                </h1>
                <div class="front-page-intro__text">
                    <p>
                        <?php $field = get_field('front_page_main_heading_text');
                        echo !empty($field) ? $field : 'Текст под заголовком главной страницы'; ?>
                    </p>
                </div>
                <a href="#business" class="front-page-intro__open-business js-modal-open">
                    Открыть бизнес
                </a>
            </div>

            <a href="#gubernator" class="front-page-intro__scroll-down js-anchor-link">
                <svg width="40" height="60" aria-hidden="true" class="icon-scroll-down">
                    <use xlink:href="#scroll-down" />
                </svg>
            </a>
        </div>
    </div>
</section>
<section class="block gubernator" id="gubernator">
    <img src="<?php echo get_template_directory_uri(); ?>/img/guber_bg.jpg" alt="" class="gubernator__bg">
    <div class="container">
        <div class="inner-container">
            <div class="gubernator__row">
                <div class="gubernator__left-column">
                    <div class="gubernator__photo-wrapper">
                        <?php
                        $image = get_field('gubernator_photo');
                        if (!empty($image)) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" class="gubernator__photo" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class="gubernator__right-column">
                    <div class="gubernator__quote">
                        <div class="gubernator__quote-text">
                            <?php $field = get_field('gubernator_quote_text');
                            echo !empty($field) ? $field : 'Цитата губернатора'; ?>
                        </div>
                        <div class="gubernator__quote-name">

                            <?php $field = get_field('gubernator_name');
                            echo !empty($field) ? $field : 'Имя губернатора'; ?>
                        </div>
                        <div class="gubernator__quote-role">

                            <?php $field = get_field('gubernator_role');
                            echo !empty($field) ? $field : 'Должность'; ?>
                        </div>
                        <a href="#guber" class="gubernator__contact-link js-modal-open">
                            Прямая связь с губернатором
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="block why-orenburg">
    <div class="container">
        <div class="inner-container">
            <div class="why-orenburg__content">
                <h2 class="why-orenburg__heading">
                    <?php $field = get_field('why_orenburg_heading');
                    echo !empty($field) ? $field : 'Заголовок секции'; ?>
                </h2>
                <?php if (have_rows('why_orenburg_advantages')) : ?>
                    <ul class="why-orenburg__advantages-list">
                        <?php while (have_rows('why_orenburg_advantages')) : the_row();
                            $icon = get_sub_field('why_orenburg_advantages_icon');
                            $title = get_sub_field('why_orenburg_advantages_title');
                            $text = get_sub_field('why_orenburg_advantages_text');
                        ?>
                            <li class="why-orenburg__advantages-list-item">
                                <div class="why-orenburg__advantages-card">
                                    <div class="why-orenburg__advantages-icon-container">
                                        <?php if (!empty($icon)) : ?>
                                            <img src="<?php echo esc_url($icon['url']); ?>" class="why-orenburg__advantages-icon" alt="<?php echo esc_attr($icon['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="why-orenburg__advantages-card-title">
                                        <?php echo $title; ?>
                                    </h5>
                                    <div class="why-orenburg__advantages-card-text">
                                        <?php echo $text; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <div class="why-orenburg__advantages-not-found">
                        Преимуществ не найдено
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>




<section class="success-stories js-success-slider">
    <?php
    $args = [
        'post_type' => 'projects',
        'posts_per_page' => '-1',
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'project_show_on_front_page',
                'value' => '1'
            ],
            [
                'key' => 'project_has_success_story',
                'value' => '1'
            ]
        ]
    ];

    $stories = new WP_Query($args);
    ?>
    <div class="container">

        <div class="success-stories__slider">
            <?php if ($stories->have_posts()) : ?>
                <div class="success-stories__nav">
                    <div class="success-stories__nav-slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php while ($stories->have_posts()) : $stories->the_post(); ?>
                                    <div class="swiper-slide">
                                        <div class="success-stories__nav-card">
                                            <h4 class="success-stories__nav-card-title">
                                                <?php the_field('project_company_name'); ?>
                                            </h4>
                                            <div class="success-stories__nav-card-quote">
                                                <div class="success-stories__nav-card-quote-text">



                                                    <?php echo mb_strimwidth(get_field('project_success_story_quote'), 0, 180, "..."); ?>
                                                </div>
                                                <div class="success-stories__nav-card-quote-author">
                                                    <div class="success-stories__nav-card-quote-author-name">
                                                        <?php the_field('project_success_story_representative_name'); ?>
                                                    </div>
                                                    <div class="success-stories__nav-card-quote-author-role">
                                                        <?php the_field('project_success_story_representative_role'); ?>
                                                    </div>

                                                </div>
                                                <a href="<?php the_permalink(); ?>" class="success-stories__nav-permalink">Читать полностью</a>
                                            </div>
                                            <div class="success-stories__nav-card-stats">
                                                <!-- <h5 class="success-stories__nav-card-stats-heading">
                                                    Общая информация
                                                </h5> -->

                                                <div class="success-stories__nav-card-stats-blocks">
                                                    <div class="success-stories__nav-card-stats-block">
                                                        <span class="success-stories__nav-card-stats-block-key">
                                                            Объем инвестиций в проект:
                                                        </span>
                                                        <span class="success-stories__nav-card-stats-block-value">
                                                            <?php $field = get_field('project_investments');
                                                            echo !empty($field) ? $field : 'Сумма'; ?> млн. руб.
                                                        </span>
                                                    </div>
                                                    <div class="success-stories__nav-card-stats-block">
                                                        <span class="success-stories__nav-card-stats-block-key">
                                                            Создано:
                                                        </span>
                                                        <span class="success-stories__nav-card-stats-block-value">
                                                            <?php $field = get_field('project_kolichestvo_sotrudnikov');
                                                            echo !empty($field) ? $field : 'Количество'; ?> новых рабочих мест
                                                        </span>
                                                    </div>
                                                    <div class="success-stories__nav-card-stats-block">
                                                        <span class="success-stories__nav-card-stats-block-key">
                                                            Статус:
                                                        </span>
                                                        <span class="success-stories__nav-card-stats-block-value">
                                                            <?php
                                                            $terms = get_the_terms($post->ID, 'status');

                                                            if (is_array($terms)) {
                                                                $term_names = array_map(function ($term) {
                                                                    return $term->name;
                                                                }, $terms);

                                                                echo implode(', ', $term_names);
                                                            } else {
                                                                echo 'Неизвестно';
                                                            } ?>
                                                        </span>
                                                    </div>
                                                    <div class="success-stories__nav-card-stats-block">
                                                        <span class="success-stories__nav-card-stats-block-key">
                                                            Отрасль:
                                                        </span>
                                                        <span class="success-stories__nav-card-stats-block-value">
                                                            <?php
                                                            $terms = get_the_terms($post->ID, 'industry');
                                                            if (is_array($terms)) {
                                                                $term_names = array_map(function ($term) {
                                                                    return $term->name;
                                                                }, $terms);

                                                                echo implode(', ', $term_names);
                                                            } else {
                                                                echo 'Неизвестно';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="success-stories__nav-controls">
                        <div class="success-stories__nav-progress">

                        </div>
                        <div class="success-stories__nav-controls-row">
                            <button class="success-stories__nav-controls-btn success-stories__nav-controls-btn--prev">
                                <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-left">
                                    <use xlink:href="#slider-arrow-left" />
                                </svg>
                            </button>
                            <button class="success-stories__nav-controls-btn success-stories__nav-controls-btn--next">
                                <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-right">
                                    <use xlink:href="#slider-arrow-right" />
                                </svg>
                            </button>
                            <div class="success-stories__nav-controls-fraction">

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="success-stories__slider-left-col">
                <h2 class="success-stories__slider-heading">
                    Истории успеха
                </h2>
                <?php if ($stories->have_posts()) : ?>
                    <div class="success-stories__logos">
                        <ul class="success-stories__logos-list">
                            <?php while ($stories->have_posts()) : $stories->the_post(); ?>
                                <?php if ($logo = get_field('project_logo')) : ?>
                                    <li class="success-stories__logos-list-item">
                                        <a href="#" class="success-stories__logos-card">
                                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="success-stories__logos-card-icon">
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="success-stories__slider-right-col">

                <div class="success-stories__images-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php while ($stories->have_posts()) : $stories->the_post(); ?>
                                <div class="swiper-slide">
                                    <div class="success-stories__images-slider-card">
                                        <?php if ($image = get_field('project_success_story_slider_photo')) : ?>
                                            <div class="success-stories__images-slider-card-image-container">
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="success-stories__images-slider-card-image">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
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
                            <?php while ($news->have_posts()) : $news->the_post() ?>
                                <div class="swiper-slide">
                                    <a href="<?php the_permalink(); ?>" class="news-slider__card">
                                        <div class="news-slider__card-image-container">
                                            <?php the_post_thumbnail(); ?>

                                            <?php if (get_field('news_is_event')) : ?>

                                                <?php
                                                $datetime = strtotime(get_field('news_event_start'));
                                                ?>
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


<?php if (have_rows('free', 'option')) : ?>

    <section class="free-from-taxes js-free-from-taxes">
        <div class="container">
            <div class="free-from-taxes__slider">
                <div class="free-from-taxes__slider-nav">
                    <div class="free-from-taxes__slider-nav-slider">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php while (have_rows('free', 'option')) : the_row();
                                ?>
                                    <div class="swiper-slide">
                                        <div class="free-from-taxes__slider-nav-slider-card">
                                            <h4 class="free-from-taxes__slider-nav-slider-card-title">
                                                <?php the_sub_field('free-toser-name'); ?>
                                            </h4>
                                            <?php if (!empty($toser_description = get_sub_field('free-advantages-bottom-text'))) : ?>
                                                <div class="free-from-taxes__slider-nav-slider-card-text">

                                                    <?php echo mb_strimwidth($toser_description, 0, 600, "..."); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            $link = get_sub_field('free-toser-link');
                                            if ($link) : ?>
                                                <a href="<?php echo esc_url($link); ?>" class="free-from-taxes__slider-nav-slider-card-link">
                                                    перейти на сайт
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="free-from-taxes__slider-nav-content">
                        <div class="free-from-taxes__slider-nav-progress">

                        </div>
                        <div class="free-from-taxes__slider-nav-btns">
                            <button class="free-from-taxes__slider-nav-btn free-from-taxes__slider-nav-btn--prev">
                                <svg width="8" height="18" aria-hidden="true" class="icon-slider-arrow-left">
                                    <use xlink:href="#slider-arrow-left" />
                                </svg>
                            </button>
                            <button class="free-from-taxes__slider-nav-btn free-from-taxes__slider-nav-btn--next">
                                <svg width="8" height="18" aria-hidden="true" class="icon-slider-arrow-right">
                                    <use xlink:href="#slider-arrow-right" />
                                </svg>
                            </button>
                            <div class="free-from-taxes__slider-nav-fraction-pagination">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="free-from-taxes__slider-main-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php while (have_rows('free', 'option')) : the_row();
                            ?>
                                <div class="swiper-slide">
                                    <div class="free-from-taxes__slider-card">
                                        <div class="free-from-taxes__slider-card-left-col">
                                            <?php
                                            $image = get_sub_field('free-advantages-right-image');
                                            if (!empty($image)) : ?>
                                                <div class="free-from-taxes__slider-card-image-container">
                                                    <img class="free-from-taxes__slider-card-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="free-from-taxes__slider-card-right-col">
                                            <h4 class="free-from-taxes__slider-card-title">
                                                Освободите бизнес от налогов
                                                на наших площадках
                                            </h4>
                                            <?php if (have_rows('free-advantages')) : ?>
                                                <div class="free-from-taxes__slider-card-advantages">
                                                    <ul class="free-from-taxes__slider-card-list">
                                                        <?php while (have_rows('free-advantages')) : the_row(); ?>
                                                            <li class="free-from-taxes__slider-card-list-item">
                                                                <div class="free-from-taxes__slider-card-list-card">
                                                                    <h4 class="free-from-taxes__slider-card-list-card-title">
                                                                        <?php the_sub_field('free-advantages-name'); ?>
                                                                    </h4>
                                                                    <div class="free-from-taxes__slider-card-list-card-amount">
                                                                        <?php
                                                                        $toser = explode(",", get_sub_field('free-advantages-toser'));
                                                                        $first_digit = trim($toser[0]);
                                                                        $second_digit = trim($toser[1]);
                                                                        $need_letter_spacing = ($first_digit == 0) ? true : false;
                                                                        ?>
                                                                        <div class="free-from-taxes__slider-card-list-card-amount-number <?php echo $need_letter_spacing ? 'need-spacing' : ''; ?>">

                                                                            <div class="free-from-taxes__slider-card-list-card-amount-number-large">
                                                                                <?php echo $first_digit; ?>
                                                                            </div>
                                                                            .
                                                                            <?php if (isset($second_digit)) : ?>
                                                                                <div class="free-from-taxes__slider-card-list-card-amount-number-small">
                                                                                    <?php echo $second_digit; ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <div class="free-from-taxes__slider-card-list-card-amount-notoser">
                                                                                Без ТОСЭР<br>
                                                                                налог <?php the_sub_field('free-advantages-notoser'); ?> %
                                                                            </div>
                                                                        </div>
                                                                        <span class="free-from-taxes__slider-card-list-card-amount-number-percent">
                                                                            %
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<div class="region-map js-region-map">
    <div class="container">
        <h2 class="region-map__heading">
            Оренбуржье на карте
        </h2>
        <div class="region-map__wrapper">
            <div class="region-map__item">
                <div class="region-map__russia-map">

                    <img src="<?php echo get_template_directory_uri(); ?>/img/maps/russia.svg" alt="" class="region-map__russia-map-image">
                    <button class="region-map__zoom">
                        <span class="region-map__zoom-content">
                            <svg width="40" height="40" aria-hidden="true" class="icon-zoom-in">
                                <use xlink:href="#zoom-in" />
                            </svg>
                        </span>
                    </button>
                </div>

            </div>
            <div class="region-map__item">
                <div class="region-map__orenburg-map">
                    <div class="region-map__orenburg-map-layer" data-layer="base">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/maps/orenburg-base-layer.svg" alt="" class="region-map__orenburg-map-layer-image">
                    </div>

                    <div class="region-map__orenburg-map-layer" data-layer="roads">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/maps/orenburg-roads-layer.svg" alt="" class="region-map__orenburg-map-layer-image">
                    </div>

                    <div class="region-map__orenburg-map-layer hidden" data-layer="railway">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/maps/orenburg-railway-layer.svg" alt="" class="region-map__orenburg-map-layer-image">
                    </div>
                    <!-- <div class="region-map__orenburg-map-layer" data-layer="cities">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/maps/orenburg-cities-layer.svg" alt="" class="region-map__orenburg-map-layer-image">
                    </div> -->
                    <div class="region-map__orenburg-map-layer" data-layer="cities">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/maps/orenburg-villages-layer.svg" alt="" class="region-map__orenburg-map-layer-image">
                    </div>
                    <div class="region-map__orenburg-map-layer" data-layer="airport">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/maps/orenburg-airport-layer.svg" alt="" class="region-map__orenburg-map-layer-image">
                    </div>
                    <div class="region-map__orenburg-map-layer" data-layer="toser">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/maps/orenburg-toser-layer.svg" alt="" class="region-map__orenburg-map-layer-image">
                    </div>

                    <div class="region-map__orenburg-map-filters">
                        <ul class="region-map__orenburg-map-filters-list">
                            <li class="region-map__orenburg-map-filters-list-item">
                                <label class="region-map__orenburg-map-filters-checkbox">
                                    <input type="checkbox" name="toser" class="region-map__orenburg-map-filters-checkbox-input" checked>
                                    <span class="region-map__orenburg-map-filters-checkbox-content">
                                        <span class="region-map__orenburg-map-filters-checkbox-mark">

                                        </span>
                                        <span class="region-map__orenburg-map-filters-checkbox-text">
                                            ТОСЭР
                                        </span>
                                    </span>
                                </label>
                            </li>
                            <li class="region-map__orenburg-map-filters-list-item">
                                <label class="region-map__orenburg-map-filters-checkbox">
                                    <input type="checkbox" name="railway" class="region-map__orenburg-map-filters-checkbox-input">
                                    <span class="region-map__orenburg-map-filters-checkbox-content">
                                        <span class="region-map__orenburg-map-filters-checkbox-mark">

                                        </span>
                                        <span class="region-map__orenburg-map-filters-checkbox-text">
                                            ЖД Станции
                                        </span>
                                    </span>
                                </label>
                            </li>
                            <li class="region-map__orenburg-map-filters-list-item">
                                <label class="region-map__orenburg-map-filters-checkbox">
                                    <input type="checkbox" name="airport" class="region-map__orenburg-map-filters-checkbox-input" checked>
                                    <span class="region-map__orenburg-map-filters-checkbox-content">
                                        <span class="region-map__orenburg-map-filters-checkbox-mark">

                                        </span>
                                        <span class="region-map__orenburg-map-filters-checkbox-text">
                                            Аэропорты
                                        </span>
                                    </span>
                                </label>
                            </li>
                            <li class="region-map__orenburg-map-filters-list-item">
                                <label class="region-map__orenburg-map-filters-checkbox">
                                    <input type="checkbox" name="roads" class="region-map__orenburg-map-filters-checkbox-input" checked>
                                    <span class="region-map__orenburg-map-filters-checkbox-content">
                                        <span class="region-map__orenburg-map-filters-checkbox-mark">

                                        </span>
                                        <span class="region-map__orenburg-map-filters-checkbox-text">
                                            Автодороги
                                        </span>
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="region-map__buttons">
                <a href="#" class="region-map__button">Россия</a>
                <a href="#" class="region-map__button">Оренбургская область</a>
            </div>
        </div>
    </div>



</div>



<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>