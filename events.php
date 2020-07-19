<?php /* Template Name: Мероприятия */ ?>


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


<section class="news-archive">
    <div class="container">
        <div class="inner-container">
            <h2 class="news-archive__heading">
                Мероприятия
            </h2>

            <?php $args = [
                'post_type' => 'news',
                'posts_per_page' => '-1',
                'meta_query' => array(
                    array(
                        'key' => 'news_is_event',
                        'value' => '1',
                    )
                )
            ];

            $news = new WP_Query($args);
            ?>

            <?php if ($news->have_posts()) : ?>
                <ul class="news-archive__list">
                    <?php while ($news->have_posts()) : $news->the_post(); ?>
                        <?php $year = get_the_date('Y') ?>
                        <li class="news-archive__list-item">
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


                                    <? endif; ?>
                                </div>
                                <div class="news-slider__card-content">
                                    <span class="news-slider__card-date">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <h5 class="news-slider__card-title">
                                        <?php the_title(); ?>
                                    </h5>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <div class="no-posts">
                    Записи отсутствуют
                </div>
            <?php endif; ?>
           
        </div>
    </div>
</section>




<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>