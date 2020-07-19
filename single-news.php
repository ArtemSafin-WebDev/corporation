<?php get_header(); ?>




<?php if (have_posts()) : ?>
    <section class="govsupport-single">
        <div class="container">
            <div class="govsupport-single__row">
                <div class="govsupport-single__main">
                    <h1 class="govsupport-single__title news-single__title">
                        <?php the_title(); ?>
                    </h1>
                    <div class="news-single__meta">
                        <span class="news-single__meta-item">
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="news-single__meta-item">
                            <?php if (get_field('news_is_event')) : ?>
                                Мероприятие
                            <?php else : ?>
                                Новость
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if (get_field('news_is_event')) : ?>
                        <div class="news-single__event-info">
                            <?php
                            $datetime_start = strtotime(get_field('news_event_start'));
                            $datetime_end = strtotime(get_field('data_okonchaniya_meropriyatiya'));
                            $location = get_field('news_event_place');
                            ?>
                            <div class="news-single__event-info-card">
                                Время проведения:
                                <?php echo date_i18n('j F Y H:i', $datetime_start); ?> - <?php echo date_i18n('j F Y H:i', $datetime_end); ?>
                                <br>
                                Место проведения: <?php echo $location['address']; ?>
                            </div>


                        </div>
                    <?php endif; ?>
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="news-single__content-image-container">

                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php } ?>
                    <div class="news-single__content-text-content default-content">
                        <?php the_content(); ?>
                    </div>
                    <?php if (get_field('news_is_event')) : ?>
                        <a href="#booking" class="govsupport-single__archive-link news-single__subscribe-btn js-booking js-modal-open">
                            Записаться
                        </a>
                    <?php endif; ?>

                </div>
                <div class="govsupport-single__sidebar">
                    <h2 class="govsupport-single__other-heading">
                        Другие новости
                    </h2>

                    <?php
                    $args = [
                        'post_type' => 'news',
                        'posts_per_page' => '7',
                        'orderby' => 'date',
                        'order'   => 'DESC'
                    ];

                    $measures = new WP_Query($args);
                    ?>

                    <?php if ($measures->have_posts()) : ?>
                        <ul class="govsupport-single__other-list">
                            <?php while ($measures->have_posts()) : $measures->the_post(); ?>
                                <li class="govsupport-single__other-list-item">
                                    <a href="<?php the_permalink(); ?>" class="govsupport-single__other-card news-single__other-card">

                                        <?php the_title(); ?>

                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                    <a href="/news" class="govsupport-single__archive-link">Все новости</a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>




<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>