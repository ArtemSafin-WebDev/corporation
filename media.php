<?php /* Template Name: Медиа */ ?>


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


<section class="news-slider news-slider--events js-news-slider" id="events">
    <div class="container">
        <div class="inner-container">
            <div class="news-slider__top-row">
                <h2 class="news-slider__heading">
                    Мероприятия
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
                    'posts_per_page' => '-1',
                    'meta_key' => 'news_event_start',
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key'   => 'news_is_event',
                            'value' => '1',
                        ),
                        array(
                            'key' => 'news_event_start',
                            'value' => date("Y-m-d H:i:s"),
                            'compare' => '>='
                        )
                    )
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
                        Нет ближайших мероприятий
                    </div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>


        </div>
    </div>
</section>




<section class="news-slider js-news-slider" id="news">
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
                    'posts_per_page' => '6',
                    'meta_query' => array(
                        array(
                            'key'   => 'news_is_event',
                            'value' => '0',
                        )
                    )
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

                    <a href="/news" class="news-archive__details">
                        Все новости
                    </a>
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



<?php
$args = [
    'post_type' => 'projects',
    'posts_per_page' => '6',
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

$projects = new WP_Query($args);
?>
<?php if ($projects->have_posts()) : ?>
    <section class="areas__slider js-areas-slider" id="projects-in-work">
        <div class="container">
            <h2 class="areas__slider-heading">
                Истории успеха
            </h2>
            <div class="areas__slider-content">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php while ($projects->have_posts()) : $projects->the_post(); ?>
                            <div class="swiper-slide">

                                <div class="projects-archive__card">
                                    <?php if ($image = get_field('project_success_story_slider_photo')) : ?>
                                        <div class="projects-archive__card-image-container">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                            <h3 class="projects-archive__card-company-name">
                                                <?php the_field('project_company_name'); ?>
                                            </h3>
                                        </div>
                                        <div class="projects-archive__card-content">
                                            <div class="projects-archive__card-representative">
                                                <div class="projects-archive__card-representative-name">
                                                    <?php the_field('project_success_story_representative_name'); ?>
                                                </div>
                                                <div class="projects-archive__card-representative-role">
                                                    <?php the_field('project_success_story_representative_role'); ?>
                                                </div>
                                            </div>
                                            <div class="projects-archive__card-general-info">
                                                <h4 class="projects-archive__card-general-info-heading">
                                                    Общая информация
                                                </h4>
                                                <div class="projects-archive__card-general-info-items">
                                                    <div class="projects-archive__card-general-info-item">
                                                        Объем инвестиций в проект: <?php $field = get_field('project_investments');
                                                                                    echo !empty($field) ? $field : 'Сумма'; ?> млн. руб.
                                                    </div>
                                                    <div class="projects-archive__card-general-info-item">
                                                        Создано: <?php $field = get_field('project_kolichestvo_sotrudnikov');
                                                                    echo !empty($field) ? $field : 'Количество'; ?> новых рабочих мест
                                                    </div>
                                                    <div class="projects-archive__card-general-info-item">
                                                        Статус: <?php
                                                                $terms = get_the_terms($post->ID, 'status');

                                                                if (is_array($terms)) {
                                                                    $term_names = array_map(function ($term) {
                                                                        return $term->name;
                                                                    }, $terms);

                                                                    echo implode(', ', $term_names);
                                                                } else {
                                                                    echo 'Неизвестно';
                                                                } ?>
                                                    </div>
                                                    <div class="projects-archive__card-general-info-item">
                                                        Отрасль: <?php
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
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="projects-archive__card-link">
                                                Читать полностью
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="areas__slider-pagination"></div>
                <a href="/projects" class="news-archive__details">
                    Все истории успеха
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php wp_reset_query(); ?>








<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>