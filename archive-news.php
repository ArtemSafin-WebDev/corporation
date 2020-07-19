<?php get_header(); ?>

<section class="page-title">
    <div class="page-title__bg-image-container">
        <?php
        $image = get_field('archive_news_bg');
        if (!empty($image)) : ?>
            <img class="page-title__bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="inner-container">
            <div class="page-title__content">
                <h1 class="page-title__heading">
                    Все новости
                </h1>
                <div class="breadcrumbs">
                    <?php require_once get_theme_file_path('/breadcrumbs.php'); ?>
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (have_posts()) : ?>
<section class="news-archive news-archive--sym">
    <div class="container">
        <div class="inner-container">
          
          
                <ul class="news-archive__list">
                    <?php while (have_posts()) : the_post(); ?>
                       


                    
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
                <?php the_posts_pagination(); ?>
        </div>
    </div>
</section>
<?php endif; ?>



<?php get_footer(); ?>